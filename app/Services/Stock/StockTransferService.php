<?php
namespace App\Services\Stock;

use App\Repositories\Stock\Repository;
use App\Stock\TransferStok;
use App\Stock\Barang;
use App\Services\Stock\ItemService;

class StockTransferService
{
    private $model;
    private $itemServ;
    public function __construct(ItemService $itemserv, TransferStok $stocktrf)
    {
        $this->itemServ = $itemserv;
        $this->model = new Repository($stocktrf);
    }
    public function all()
    {
        return $this->model->all();
    }
    public function make($data)
    {
        $itemId = $data['item_id'];
        $newStockTrf = $this->model;
        $stockTransfer = $newStockTrf::create([
            'kode_transfer' => $data['kode_transfer'],
            'gudang_asal'   => $data['gudang_asal'],
            'gudang_tujuan' => $data['gudang_tujuan'],
            'deskripsi'     => $data['deskripsi'],
            'departemen'    => $data['departemen'],
        ]);

        $stocksData = [
            'asal'      => $stockTransfer['gudang_asal'],
            'tujuan'    => $stockTransfer['gudang_tujuan'],
            'item_id'   => $itemId,
            'quantity'  => $data['qty']
        ];

        $condition = 0;
        DB::beginTransaction();
        try {
            foreach ($itemId as $index => $id) {
                $from = $stocksData['asal'];
                $to = $stocksData['tujuan'];
                $qtyFrom = $this->itemServ->getStocksQtyByWhouse($stocksData['asal'], $id);
                $qtyDestination = $this->itemServ->getStocksQtyByWhouse($stocksData['tujuan'], $id);
                $qtyFrom = $qtyFrom-$stocksData['quantity'][$index];
                $qtyDestination += $stocksData['quantity'][$index];
                if ($qtyFrom >= 0) {
                    # code...
                    $this->itemServ->updateStocks($id, $from, $qtyFrom);
                    $this->itemServ->updateStocks($id, $to, $qtyDestination);
                } else {
                    $condition = 1;
                }
                $stockTransfer->items()->attach($id, ['quantity' => $data['qty'][$index]]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();

        
        

        return $newStockTrf;
    }
}
