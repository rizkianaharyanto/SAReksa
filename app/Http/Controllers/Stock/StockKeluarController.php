<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock\StockKeluar;
use App\Services\StokKeluarService;

class StockKeluarController extends Controller
{
    private $service;

    public function __construct(StokKeluarService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $stokKeluarTransactions = $this->service->all();
        return view('');
    }

}
