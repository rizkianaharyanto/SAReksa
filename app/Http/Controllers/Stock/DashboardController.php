<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Gudang;
use App\Stock\Barang;
use App\Stock\StokOpname;
use App\Stock\TransferStok;
use App\Stock\PenyesuaianStok;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $barangs = Barang::all();
        $gudangs = Gudang::all();
        
        $totalTransaksi = count(StokOpname::all()) + count(TransferStok::all()) + count(PenyesuaianStok::all());


        return view('stock.dashboard', [
            'gudangs' => $gudangs,
            'barangs' => $barangs,
            'totalTransaksi' => $totalTransaksi
        ]);
    }
}
