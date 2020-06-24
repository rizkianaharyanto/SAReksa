<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\ItemService;
use App\Stock\Barang;

class ItemStockController extends Controller
{
    private $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function getStocksByGudang(Request $request, $barangId)
    {
        $gudangId = $request->gudangId;
        $stokBarang = $this->itemService->getStocksByWhouse($barangId, $gudangId);
        return $stokBarang ? $stokBarang : ['message' => 'Barang Tidak ditemukan'];
    }
    public function getStocksTotalById($barangId)
    {
    }
}
