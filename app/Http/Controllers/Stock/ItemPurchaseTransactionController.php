<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\InventoryLedger;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\ItemPurchaseTransaction;
use App\Services\CogsCalculationService;
use App\Services\InventoryLedgerService;
use App\Services\ItemPurchaseService;
use App\Services\ItemService;
use App\Items;

class ItemPurchaseTransactionController extends Controller
{
    protected $model;
    public function __construct()
    {
    }
    public function index()
    {
        $allData = $this->model->all();
        return view('stock.item-purchases', compact("allData"));
    }
    public function store(Request $request, ItemPurchaseService $itemPurch)
    {
        $itemSrv = new ItemService;
        $purchaseData = $request->only(['warehouse_id', 'total_pembelian']);
        $whouseId = $purchaseData['warehouse_id'];
        $purchasedItems  = $request->except(['warehouse_id', 'total_pembelian']);
        //Makes The Transaction Journal and Attach it to Items
        $transJournal =  $itemPurch->makeJournal($purchaseData, $purchasedItems);
        // return $transJournal->first()->details->first();
        foreach ($transJournal->first()->details as $index => $item) {
            $qtyInHouse = 0;
            $qty = 0;
            $this->makePurchase($transJournal->first(), $item);

            $qtyInHouse = $itemSrv->getStocksQtyByWhouse($whouseId, $item->id);
            $qty = $qtyInHouse + $item->pivot->quantity;


            $itemSrv->updateStocks($item->id, $whouseId, $qty);
        }
    }

    public function makePurchase($purchTrans, $item)
    {
        $calcserv = new CogsCalculationService;
        $itemSrv = new ItemService;
        $invLedg = new InventoryLedgerService;

        $itemId = $item->id;
        $debit_account = $item->akun_persediaan;
        $credit_account = $item->akun_pembelian;
        $userMethod = "average";
        $stocksData =  $itemSrv->getStocksQtyByWhouse($purchTrans->warehouse_id, $itemId);
        if ($userMethod == "FIFO") {
            //
            $item->nilai_barang = $calcserv->FIFO($item, $stocksData);
            $item->update();
            $invLedg->posting($item, $debit_account, $credit_account);
        } elseif ($userMethod == "LIFO") {
            $item->nilai_barang = $calcserv->LIFO($item);
            $item->update();
            $invLedg->posting($item, $debit_account, $credit_account);
        } else {
            $item->nilai_barang = $calcserv->average($purchTrans, $item, $stocksData);
            $item->update();
            $invLedg->posting($item, $debit_account, $credit_account);
        }
    }



    public function destroy($id)
    {
        //
        $this->model->delete($id);
        return "Success";
    }
}
