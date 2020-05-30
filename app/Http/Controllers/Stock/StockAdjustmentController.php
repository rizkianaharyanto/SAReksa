<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Stock\ItemService;
use App\Stock\PenyesuaianStok;
use App\Http\Requests\Stock\CreateStockAdjustmentRequest;
use Illuminate\Support\Facades\DB;

class StockAdjustmentController extends Controller
{
    //
    public function __construct()
    {
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
