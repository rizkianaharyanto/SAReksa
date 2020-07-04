<?php
namespace App\Services\Stock;

use Illuminate\Support\Facades\DB;
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
        $transferStok = TransferStok::with([
           'items',
           'asal',
           'tujuan'
        ])->get();
        return $transferStok;
    }
    public function make($data)
    {
        $itemIds = $data['barang_id'];
        $stockTransfer = TransferStok::create([
            'kode_ref'      => $data['kode_ref'],
            'gudang_asal'   => $data['gudang_asal'],
            'gudang_tujuan' => $data['gudang_tujuan'],
            'deskripsi'     => $data['deskripsi'],
            'departemen'    => $data['departemen'],
            'akun_penyesuaian' => $data['akun_penyesuaian']
        ]);

        $stocksData = [
            'asal'      => $stockTransfer['gudang_asal'],
            'tujuan'    => $stockTransfer['gudang_tujuan'],
            'barang_id'   => $itemIds,
            'quantity'  => $data['qty']
        ];

        $condition = 0;
        DB::beginTransaction();
        try {
            foreach ($itemIds as $index => $id) {
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
                $stockTransfer->items()->attach($id, ['kuantitas' => $data['qty'][$index]]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();

        
        

        return $stockTransfer::with('details');
    }
    public function get($id)
    {
        $stockTransfer = TransferStok::with([
            'items',
            'asal',
            'tujuan'
            ])->find($id);
        return $stockTransfer;
    }

    public function update($payload, $id)
    {
        $payload = collect($payload);

        $stockOpname = TransferStok::with([
            'items',
            'asal',
            'tujuan'
        ])->findOrFail($id);

        $transactionPayload = $payload->except(['kode_ref','item_id','quantity_diff']);
        $stockOpname->update($transactionPayload->toArray());
        $itemPayload = $payload->only(['item_id', 'on_hand']);
        if ($itemPayload) {
            $this->updateStockOpnameItems($stockOpname, $itemPayload);
        }

        return $this->get($id);
    }
}
