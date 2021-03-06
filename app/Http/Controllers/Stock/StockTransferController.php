<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\StockTransferService;
use App\Http\Requests\Stock\CreateStockTransferRequest;
use App\Stock\TransferStok;
use App\Stock\Gudang;
use App\Stock\Barang;
use App\Stock\Ledger;
use PDF;

class StockTransferController extends Controller
{
    private $service;

    public function __construct(StockTransferService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockTransferService $stockTf)
    {
        //
        $allData = $stockTf->all();
        $gudangs = Gudang::all();
        $barangs = Barang::all();
        return view('stock.transactions.transfer-stock.index', [
            'allData' => $allData,
            'gudangs' => $gudangs,
            'barangs' => $barangs
        ]);
    }

    public function laporanindex(StockTransferService $stockTf)
    {
        $allData = $stockTf->all();
        $gudangs = Gudang::all();
        $barangs = Barang::all();
        $gudang = null;
        $start = null;
        $end = null;

        return view('stock.reports.laporan-transfer', [
            'allData' => $allData,
            'gudangs' => $gudangs,
            'barangs' => $barangs,
            'gudang' => $gudang,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function laporanfilter(StockTransferService $stockTf, Request $date)
    {
        if ($date->start == null) {
            $allData = $stockTf->all();
            $gudangs = Gudang::all();
            $barangs = Barang::all();
            $gudang = null;
            $start = null;
            $end = null;
        } else {
            $allData = TransferStok::select("stk_transfer_stok.*")
                // ->where('gudang_id', $date->gudang)
                ->whereBetween('created_at', [$date->start, $date->end])
                ->get();

            $barangs = Barang::all();
            $gudangs = Gudang::all();
            // $gudang = $date->gudang;
            $start = $date->start;
            $end = $date->end;
        }
        return view('stock.reports.laporan-transfer', [
            'allData' => $allData,
            'barangs' => $barangs,
            'gudangs' => $gudangs,
            // 'gudang' => $gudang,
            'start' => $start,
            'end' => $end
        ]);
    }

    public function laporanexport(StockTransferService $stockTf, Request $date)
    {
        if ($date->start == null) {
            $allData = $stockTf->all();
            $gudangs = Gudang::all();
            $gudang = null;
            $start = null;
            $end = null;
        } else {
            $allData = TransferStok::select("stk_transfer_stok.*")
                // ->where('gudang_id', $date->gudang)
                ->whereBetween('created_at', [$date->start, $date->end])
                ->get();
            $gudangs = Gudang::all();
            // $gudang = $date->gudang;
            $start = $date->start;
            $end = $date->end;
        }
        $pdf = PDF::loadview('stock.reports.export-transfer', [
            'allData' => $allData,
            'gudangs' => $gudangs,
            // 'gudang' => $gudang,
            'start' => $start,
            'end' => $end
        ]);
        return $pdf->download('laporan-transfer.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function posting($id)
    {
        $transfer = TransferStok::find($id);
        TransferStok::where('id', $transfer->id)
            ->update(['status' => 'sudah posting']);
        // dd($transfer->details[0]->id);

        foreach ($transfer->items as $index => $barang) {
            // dd($barang);
            $jurnal = Ledger::create([
                'kode_transaksi' => $transfer->kode_ref,
                'barang_id' => $barang->id,
                'sisa' => 0,
                'qty_masuk' => $barang->pivot->kuantitas,
                'nilai_masuk' => $barang->pivot->kuantitas,
                'qty_keluar' => $barang->pivot->kuantitas,
                'nilai_keluar' => $barang->pivot->kuantitas,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockTransferService $stockTf, CreateStockTransferRequest $req)
    {
        $input = $req->validated();
        $stockTf->make($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transferStock = $this->service->get($id);
        if (!$transferStock) {
            return redirect('/stok/transfer-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }
        return view('stock.transactions.transfer-stock.details', compact('transferStock'));
    }

    public function edit($id)
    {
        $transferStock = $this->service->get($id);
        $gudangs = Gudang::all();
        if (!$transferStock) {
            return redirect('/stok/transfer-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }
        return view('stock.transactions.transfer-stock.edit', compact('transferStock'), compact('gudangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(CreateStockTransferRequest $request, $id)
    {
        $this->service->update($request->validated(), $id);
        return redirect('/stok/transfer-stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transferStock = $this->service->get($id);
        if (!$transferStock) {
            return redirect('/stok/transfer-stock')->with('status', 'Data Transaksi tersebut tidak ditemukan');
        }

        if ($transferStock->status == "sudah posting") {
            return redirect('/stok/transfer-stock')->with('status', 'Tidak Dapat Menghapus Data Transaksi yang sudah diposting');
        }
        $this->service->delete($id);
        return redirect()->back();
    }
}
