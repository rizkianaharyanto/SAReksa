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
use App\Stock\PenyesuaianStok;

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
                'gudangs' =>$gudangs
             ]
        );
    }

    public function store(CreateStockAdjustmentRequest $req, ItemService $itemServ)
    {
        //Make Transaction Record
        $input = $req->validated();
        $stockAdjust = new PenyesuaianStok;
        $transData = $req->except(['item_id','quantity_diff']);
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
       
        return $stockAdjust;
    }
}
