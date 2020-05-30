<?php

namespace App\Services\Stock;

use App\Stock\Barang;
use App\Stock\ItemPurchaseTransaction;
use App\Services\Stock\CogsCalculationService;
use App\Services\Stock\ItemService;
use App\Services\Stock\InventoryLedgerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPurchaseService
{
    public function __construct()
    {
    }
    public function makeJournal($transData, $itemData)
    {
        DB::beginTransaction();
        $created = null;
        try {
            //code...
            $purchTransaction = ItemPurchaseTransaction::create($transData);
            // $itemData = $itemData();
            foreach ($itemData['item_id'] as $index => $id) {
                # code...
                $purchTransaction->details()->attach($id, [
                    'quantity' => $itemData['quantity'][$index],
                    'harga_beli' => $itemData['harga_beli'][$index]
                ]);
            }
            $created =  $purchTransaction->with('details')->where('id', $purchTransaction->id)->get();
        } catch (\Throwable $th) {
            DB::rollback();
            // throw $th;
        }
        DB::commit();
        // $create = $this->created;
        return $created;
    }

    public function makePurchase($purchTrans, CogsCalculationService $calcserv, ItemService $itemSrv, InventoryLedgerService $invLedg)
    {


        // $itemId = $purchTrans->details()->id;
        // $item = Items::find($itemId);
        // $debit_account = $item->akun_persediaan;
        // $credit_account = $item->akun_pembelian;
        // $userMethod = "FIFO";
        // $stocksData =  $itemSrv->getStocksQtyByWhouse($purchTrans->whs_id, $itemId);

        // if ($userMethod == "FIFO") {

        //     $item->nilai_barang = $calcserv->FIFO($purchTrans, $item, $stocksData);
        //     $item->save();
        //     $invLedg->posting($purchTrans->details(), $debit_account, $credit_account);
        // } else if ($userMethod == "LIFO") {

        //     $stocksData =  $itemSrv->getStocksQtyByWhouse($purchTrans->whs_id, $itemId);

        //     $item->nilai_barang = $calcserv->LIFO($purchTrans);

        //     $item->save();

        //     $invLedg->posting($purchTrans->details(), $debit_account, $credit_account);
        // } else {
        //     $stocksData =  $itemSrv->getStocksQtyByWhouse($purchTrans->whs_id, $itemId);

        //     $item->nilai_barang = $calcserv->average($purchTrans, $item, $stocksData);

        //     $item->save();

        //     $invLedg->posting($purchTrans->details(), $debit_account, $credit_account);
        // }
    }
}
