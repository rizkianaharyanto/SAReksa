<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Stock\StockOpnameRequest;
use App\Services\Stock\ItemService;
use App\Services\Stock\StockOpnameService;
use App\Services\Stock\InventoryLedgerService;
use App\Stock\StokOpname;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Stock\DetailStokOpname;
use App\Stock\Ledger;

class StockOpnameController extends Controller
{
    private $service;

    public function __construct(StockOpnameService $stockService)
    {
        $this->service = $stockService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stokOp = StokOpname::with('details')->get();
        $barangs = Barang::all();
        $gudangs = Gudang::all();

        return view('stock.transactions.stock-opname.index', ['stokOp' => $stokOp, 'barangs' => $barangs, 'gudangs' => $gudangs]);
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function show($id)
    {
        $stockOpname = $this->service->get($id);
        if (!$stockOpname) {
            return redirect('/stok/stock-opname')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }
        return view('stock.transactions.stock-opname.details', compact('stockOpname'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StockOpnameService $opnameServ, ItemService $itemServ, StockOpnameRequest $req)
    {
        // return $req;
        $opnameItems = $req->validated();
        $opnameItems = collect($opnameItems);
        $transData = $opnameItems->except(['item_id', 'on_hand']);
        $stockOp = StokOpname::findOrFail($opnameServ->makeTransJournal($transData));

        $itemIds = $opnameItems['item_id'];
        $whouseId = $opnameItems['gudang_id'];
        DB::beginTransaction();
        try {
            foreach ($itemIds as $index => $id) {
                $onBook = $itemServ->getStocksQtyByWhouse($opnameItems['gudang_id'], $id);
                $itemServ->updateStocks($id, $whouseId, $opnameItems['on_hand'][$index]);

                $stockOp->details()->attach($id, [
                    'jumlah_tercatat' => $onBook,
                    'jumlah_fisik'    => $opnameItems['on_hand'][$index],
                    'selisih'         => $opnameItems['on_hand'][$index] - $onBook
                ]);
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\StockOpname $stockOpname
     *
     * @return \Illuminate\Http\Response
     */
    public function posting($id)
    {
        $stockOpname = StokOpname::find($id);
        StokOpname::where('id', $stockOpname->id)
            ->update(['status' => 'sudah posting']);
        // dd($stockOpname->details[0]->id);

        foreach ($stockOpname->details as $index => $barang) {
            // dd($barang);
            $jurnal = Ledger::create([
                'kode_transaksi' => $stockOpname->kode_ref,
                'barang_id' => $barang->id,
                'sisa' => $barang->pivot->selisih,
                'qty_masuk' => 0,
                'nilai_masuk' => 0,
                'qty_keluar' => 0,
                'nilai_keluar' => 0,
            ]);
            if ($barang->pivot->selisih >= 0) {
                $jurnal->update([
                    'qty_masuk' => $barang->pivot->selisih ,
                    'nilai_masuk' => $barang->nilai_barang
                ]);
            } else {
                $jurnal->update([
                    'qty_keluar' => $barang->pivot->selisih * -1,
                    'nilai_keluar' => $barang->nilai_barang
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\StockOpname $stockOpname
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(StokOpname $stockOpname)
    {
        $stockOpname = StokOpname::with([
            'details'
        ])->find($stockOpname)->first();
        $gudangs = Gudang::all();

        if (!$stockOpname) {
            return redirect('/stok/stock-opname')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }

        if ($stockOpname->status == 'sudah posting') {
            return redirect()->back()->with('status', 'Transaksi sudah di posting ke jurnal dan tidak bisa dihapus');
        }
        return view('stock.transactions.stock-opname.edit', ['stockOpname' => $stockOpname, 'gudangs' => $gudangs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\StockOpname         $stockOpname
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StockOpnameRequest $req, $id)
    {
        $stockOpname = $this->service->get($id);
        if (!$stockOpname) {
            return redirect('/stok/stock-opname')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }

        if ($stockOpname->status == 'sudah posting') {
            return redirect()->back()->with('status', 'Transaksi sudah di posting ke jurnal dan tidak bisa dihapus');
        }
        $stockOpname = $this->service->update($req->validated(), $id);
        return redirect()->route('stock-opname.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\StockOpname $stockOpname
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemService $itemServ, $id)
    {
        $stockOp = StokOpname::findOrFail($id);

        if ($stockOp['status'] == 'sudah diposting') {
            return redirect()->back()->with('status', 'Transaksi sudah di posting ke jurnal dan tidak bisa dihapus');
        } else {
            DB::beginTransaction();
            try {
                $recordedData = $stockOp->with('details')->get()->first()->details;
                foreach ($recordedData as $i => $data) {
                    $stock = $itemServ->getStocksQtyByWhouse($stockOp->gudang_id, $data->id);

                    $perubahan = $data->pivot->jumlah_fisik - $data->pivot->jumlah_tercatat;
                    $revertStock = $stock - $perubahan;

                    $itemServ->updateStocks($data->id, $stockOp->gudang_id, $revertStock);
                }
                $stockOp->delete();
                $stockOp->details()->detach();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();
        }
    }
}
