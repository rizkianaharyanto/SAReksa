<?php
namespace App\Services\Stock;

use Illuminate\Support\Facades\DB;
use App\Repositories\Stock\Repository;
use App\Stock\TransferStok;
use App\Stock\Barang;
use App\Stock\DetailTransferStok;
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

        $transferStock = TransferStok::with([
            'items',
            'asal',
            'tujuan'
        ])->findOrFail($id);

        $transactionPayload = $payload->except(['kode_ref','barang_id','qty']);
        $itemPayload = $payload->only(['barang_id', 'qty']);

        $from  = $transferStock['tujuan'];
        $to = $transferStock['asal'];
        $this->revertStockTransfer($from, $to, $itemPayload);
        
        $transferStock->update($transactionPayload->toArray());


        if ($itemPayload) {
            $this->updateStockTransferItems($transferStock, $itemPayload);
        }

        return $this->get($id);
    }

    public function revertStockTransfer($from, $to, $itemPayload)
    {
        DB::beginTransaction();
        try {
            foreach ($itemPayload->get('barang_id') as $index => $id) {
                $qtyFrom = $this->itemServ->getStocksQtyByWhouse($from, $id);
                $qtyDestination = $this->itemServ->getStocksQtyByWhouse($to, $id);

                $qtyFrom = $qtyFrom - $itemPayload['qty'][$index];
                $qtyDestination += $itemPayload['qty'][$index];

                if ($qtyFrom >= 0) {
                    $this->itemServ->updateStocks($id, $from, $qtyFrom);
                    $this->itemServ->updateStocks($id, $to, $qtyDestination);
                } else {
                    $condition = 1;
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
    }

    public function updateStockTransferItems(TransferStok $transferStock, $itemPayload)
    {
        $transferStock->items()->sync($itemPayload->get('barang_id'));
        

        foreach ($itemPayload->get('barang_id') as $index => $item) {
            $transferredItemQty = $itemPayload['qty'][$index];

            $qtyFrom = $this->itemServ->getStocksQtyByWhouse($transferStock->gudang_asal, $item);
            $qtyDestination = $this->itemServ->getStocksQtyByWhouse($transferStock->gudang_tujuan, $item);

            $qtyFrom = $qtyFrom - $itemPayload['qty'][$index];
            $qtyDestination += $itemPayload['qty'][$index];

            $itemTransferStok = DetailTransferStok::where('barang_id', $item)
                ->where('transfer_stok_id', $transferStock->id)->first();

            
            $itemTransferStok->update([
                'kuantitas' => $transferredItemQty,
                
            ]);


            $this->itemServ->updateStocks($item, $transferStock->gudang_asal, $qtyFrom);
            $this->itemServ->updateStocks($item, $transferStock->gudang_tujuan, $qtyDestination);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            //code...
            $transferStok = TransferStok::with('items')->find($id);
            $transferStok->delete();
            $transferStok->items()->detach();
        } catch (\Throwable $th) {
            return 0;
        }
        DB::commit();

        return 1;
    }
}
