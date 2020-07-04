<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\Barang;

class KartuStockController extends Controller
{
    private $service;
    public function __construct()
    {
    }

    public function index()
    {
        $barangs = Barang::with([
            'unit',
            'kategori',
            'stockOpname',
            'stockTransfer',
            'penyesuaianStok',
            'warehouseStocks',
            'tax',
        ]);
        return view('stock.reports.kartu-stock', compact('barangs'));
    }
}
