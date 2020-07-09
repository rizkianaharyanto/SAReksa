<?php
namespace App\Services\Stock;

use Illuminate\Support\Collection;
use App\Stock\StokOpname;
use App\Repositories\Stock\Repository;
use App\Stock\DetailStokOpname;
use App\Services\Stock\ItemService;

class StockOpnameService
{
    private $stockOp;
    private $itemService;
    public function __construct(StokOpname $stockop, ItemService $itemService)
    {
        $this->stockOp = new Repository($stockop);
        $this->itemService = $itemService;
    }
    public function makeTransJournal($data)
    {
        return $this->stockOp->create($data->toArray())->id;
    }

    public function get($id)
    {
        return StokOpname::with([
            'details',  
            'gudang'
        ])->find($id);
    }

    public function update($payload, $id)
    {
        $payload = collect($payload);

        $stockOpname = StokOpname::with([
            'details',
            'gudang'
        ])->findOrFail($id);

        $transactionPayload = $payload->except(['kode_ref','item_id','on_hand']);
        $stockOpname->update($transactionPayload->toArray());
        $itemPayload = $payload->only(['item_id', 'on_hand']);
        if ($itemPayload) {
            $this->updateStockOpnameItems($stockOpname, $itemPayload);
        }

        return $this->get($id);
    }

    public function updateStockOpnameItems(StokOpname $stockOpname, Collection $itemPayload)
    {
        $stockOpname->details()->sync($itemPayload->get('item_id'));
         
        foreach ($itemPayload->get('item_id') as $index => $item) {
            $onHand = $itemPayload['on_hand'][$index];

            $qty = $this->itemService->getStocksQtyByWhouse($stockOpname->gudang_id, $item) ?? 0;
            
            $itemStokOpname = DetailStokOpname::where('item_id', $item)
            ->where('stock_opname_id', $stockOpname->id)->first();
            $onBook = $itemStokOpname->jumlah_tercatat ?? $qty;
            
            $itemStokOpname->update([
                'jumlah_tercatat' => $onBook,
                'jumlah_fisik' => $onHand,
                'selisih' => $onHand - $onBook
            ]);


            $this->itemService->updateStocks($item, $stockOpname->gudang_id, $onHand);
        }
    }
}
