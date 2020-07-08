<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Stock\CreateStockAdjustmentRequest;
use App\Services\Stock\ItemService;
use App\Services\Stock\StockAdjustmentService;
use App\Stock\Barang;
use App\Stock\Gudang;
use App\Stock\Ledger;
use App\Stock\PenyesuaianStok;
use App\Stock\StokGudang;

class StockAdjustmentController extends Controller
{
    private $service;
    public function __construct(StockAdjustmentService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $stockAdjustments = $this->service->all();
        $barangs = Barang::all();
        $gudangs = Gudang::all();

        return view(
            'stock.transactions.penyesuaian-stok.index',
            [
                'stockAdjustments' => $stockAdjustments,
                'barangs' => $barangs,
                'gudangs' => $gudangs
            ]
        );
    }

    public function show($id)
    {
        $stockAdjustment =  $this->service->getById($id);
        if (!$stockAdjustment) {
            return redirect('/stok/penyesuaian-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }
        return view('stock.transactions.penyesuaian-stok.details', compact('stockAdjustment'));
    }
    public function store(CreateStockAdjustmentRequest $req, ItemService $itemServ)
    {
        //Make Transaction Record
        $input = $req->validated();
        $stockAdjust = new PenyesuaianStok;
        $transData = $req->except(['item_id', 'quantity_diff']);
        $stockAdjust = PenyesuaianStok::findOrFail($stockAdjust->create($transData)->id);

        $qtyDiff = $input['quantity_diff'];
        $itemId = $input['item_id'];
        $whouseId = $input['warehouse_id'];
        foreach ($itemId as $index => $id) {
            $onBook = $itemServ->getStocksQtyByWhouse($whouseId, $id);
            $newQty = $onBook + $qtyDiff[$index];
            $itemServ->updateStocks($id, $whouseId, $newQty);

            $stockAdjust->details()->attach($id, [
                'quantity_diff'   => $qtyDiff[$index],
            ]);
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $penyesuaian = PenyesuaianStok::with([
            'details'
        ])
            ->find($id);
        $gudangs = Gudang::all();

        // dd($penyesuaian);

        return view('stock.transactions.penyesuaian-stok.edit', ['penyesuaian' => $penyesuaian, 'gudangs' => $gudangs]);
    }

    public function update(Request $req, $id, ItemService $itemServ)
    {
        // dd($id);
        // $penyesuaian = $this->service->getById($id);
        // if (!$penyesuaian) {
        //     return redirect('/stok/penyesuaian-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        // }
        // $input = $req->validated();x
        // $transData = $req->except(['item_id','quantity_diff', '_token', '_method']);
        // dd($req);
        PenyesuaianStok::where('id', $id)->update([
            "kode_ref" => $req->kode_ref,
            "warehouse_id" => $req->warehouse_id,
            "deskripsi" => $req->deskripsi,
            "akun_penyesuaian" => $req->akun_penyesuaian
        ]);
        $stockAdjust = PenyesuaianStok::where('id', $id)->with('details')->get();
        // dd($stockAdjust);
        $qtyDiff = $req['quantity_diff'];
        $itemId = $req['item_id'];
        $whouseId = $req['warehouse_id'];

        foreach ($itemId as $index => $id) {
            $onBook = $itemServ->getStocksQtyByWhouse($whouseId, $id);
            $newQty = $onBook + $qtyDiff[$index];
            $itemServ->updateStocks($id, $whouseId, $newQty);
            // dd($id);
            $stockAdjust[0]->details()->updateExistingPivot($id, [ 'quantity_diff' => $qtyDiff[$index]]);
        }
        return redirect('/stok/penyesuaian-stock');
    }

    public function posting($id)
    {
        $penyesuaian = PenyesuaianStok::find($id);
        // PenyesuaianStok::where('id', $penyesuaian->id)
        //     ->update(['status' => 'sudah posting']);
        $gudang=$penyesuaian->gudang->id;

        foreach ($penyesuaian->details as $index => $barang) {
            $detail = StokGudang::where(['gudang_id'=> $gudang, "barang_id"=> $barang->id])->get();
            // dd($detail[0]->kuantitas);
            $jurnal = Ledger::create([
                'kode_transaksi' => $penyesuaian->kode_ref,
                'barang_id' => $barang->id,
                'sisa' => 0,
                'qty_masuk' => 0,
                'nilai_masuk' => 0,
                'qty_keluar' => 0,
                'nilai_keluar' => 0,
            ]);
            if ($barang->pivot->quantity_diff >= 0) {
                $jurnal->update([
                    'qty_masuk' => $barang->pivot->quantity_diff,
                    'nilai_masuk' => $barang->nilai_barang,
                    'sisa' => $detail[0]->kuantitas - $barang->pivot->quantity_diff
                ]);
            } else {
                $jurnal->update([
                    'qty_keluar' => $barang->pivot->quantity_diff * -1,
                    'nilai_keluar' => $barang->nilai_barang,
                    'sisa' => $detail[0]->kuantitas + $barang->pivot->quantity_diff
                ]);
            }
        }
        return redirect()->back();
    }
}
