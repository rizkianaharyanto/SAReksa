<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Barang;
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
        // $barangs = Barang::find($request->barang)->with([
        //     'unit',
        //     'kategori',
        //     'stockOpname',
        //     'stockTransfer',
        //     'penyesuaianStok',
        //     'warehouseStocks',
        //     'tax',
        //     ]);
        $barangs= Barang::all();
        $barang = Barang::find($request->barang);
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
        // $barangs = Barang::find($request->barang)->with([
        //     'unit',
        //     'kategori',
        //     'stockOpname',
        //     'stockTransfer',
        //     'penyesuaianStok',
        //     'warehouseStocks',
        //     'tax',
        //     ]);
        $barang = Barang::find($request->id);
        $stockOpname = $barang->stockOpname;
        $stockTransfer = $barang->stockTransfer;
        $stockPenyesuaian = $barang->penyesuaianStok;
        $details = new Collection([$stockOpname, $stockTransfer, $stockPenyesuaian]);
        // dd($request);
            // dd($barang->nama_barang, $stockOpname, $stockTransfer, $stockPenyesuaian, $details); 
            $pdf = PDF::loadview('stock.reports.export-kartu-stock', [
                'barang' => $barang, 
                'details'=> $details
            ]);
            // return view('stock.reports.export-kartu-stock', [
            //     'barang' => $barang, 
            //     'details'=> $details
            // ]);
            return $pdf->download('kartu-stock.pdf');
    }
}
