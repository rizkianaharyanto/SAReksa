<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Barang;
use App\Stock\StokOpname;
use Illuminate\Database\Eloquent\Collection;

use PDF;

class KartuStockController extends Controller
{
    private $service;
    public function __construct()
    {
    }

    public function index()
    {
        $barangs= Barang::all();
        // $barangs = Barang::with([
        //     'unit',
        //     'kategori',
        //     'stockOpname',
        //     'stockTransfer',
        //     'penyesuaianStok',
        //     'warehouseStocks',
        //     'tax',
        // ]);
        // dd($barangs);
        $details=[];
        return view('stock.reports.kartu-stock', ['barangs' => $barangs, 'details' =>$details]);
    }

    public function filter(Request $request)
    {
        $barangs= Barang::all();
        $barang = Barang::with([
            'pemasok'
        ])->find($request->barang);
        
        $stockOpname = $barang->stockOpname;
        $stockTransfer = $barang->stockTransfer;
        $stockPenyesuaian = $barang->penyesuaianStok;
        $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);
        // dd($barang);
        // dd($barang->nama_barang, $stockOpname, $stockTransfer, $stockPenyesuaian, $details);
        return view('stock.reports.kartu-stock', [
                'barangs' => $barangs,
                'barang' => $barang,
                'details'=> $details
            ]);
    }
    public function export(Request $request)
    {
        // dd($request);
        $barang = Barang::find($request->id);
        
        $stockOpname = $barang->stockOpname;
        $stockTransfer = $barang->stockTransfer;
        $stockPenyesuaian = $barang->penyesuaianStok;
        $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);
        $qty_masuk = $request->req_qty_masuk;
        $nilai_masuk = $request->req_nilai_masuk;
        $qty_keluar = $request->req_qty_keluar;
        $nilai_keluar = $request->req_nilai_keluar;
        $sisa = $request->req_sisa;
        // dd($qty_masuk);
        // dd($barang->nama_barang, $stockOpname, $stockTransfer, $stockPenyesuaian, $details);
        $pdf = PDF::loadview('stock.reports.export-kartu-stock', [
            'barang' => $barang,
            'details'=> $details,
            'qty_masuk' => $qty_masuk,
            'nilai_masuk' => $nilai_masuk,
            'qty_keluar' => $qty_keluar,
            'nilai_keluar' => $nilai_keluar,
            'sisa' => $sisa,
        ])->download('kartu-stock.pdf');
        // return view('stock.reports.export-kartu-stock', [
        //     'barang' => $barang,
        //     'details'=> $details,
        //     'qty_masuk' => $qty_masuk,
        //     'nilai_masuk' => $nilai_masuk,
        //     'qty_keluar' => $qty_keluar,
        //     'nilai_keluar' => $nilai_keluar,
        //     'sisa' => $sisa,
        // ]);
        // return $pdf->download('kartu-stock.pdf');
    }
}
