<?php
namespace App\Services\Stock;

use App\Repositories\Stock\Repository;
use App\Stock\Barang;

class ItemService
{
    protected $model;
    public function all()
    {
        return Barang::all();
    }
    public function create($data)
    {
        $this->model = new Barang;
        $this->model->save($data);
        return $this->model;
    }
    public function getStocksQty($itemId)
    {
        $theItem = Barang::find($itemId);
        $Barang = Barang::find($itemId)->warehouseStocks();
        $qtySum = 0;
        // return $Barang;
        foreach ($Barang as $i) {
            $qtySum += $i->pivot->kuantitas;
        }
        return [
            'id'        => $theItem->id,
            'name'      => $theItem->nama_barang,
            'quantity'  => $qtySum
        ];
    }
    public function getStocksByWhouse($id, $whsId)
    {
        return Barang::find($id)->warehouseStocks()->wherePivot('gudang_id', $whsId);
    }
    public function getStocksQtyByWhouse($whsId, $itemId)
    {
        return $this->getStocksByWhouse($itemId, $whsId)->first()->pivot->kuantitas;
    }
    public function updateStocks($itemId, $whsId, $qty)
    {
        $Barangtock = $this->getStocksByWhouse($itemId, $whsId);
        $Barangtock->updateExistingPivot($whsId, ['kuantitas'=>$qty]);
        return 201;
    }
    public function except($columns)
    {
        $pluckBarang =Barang::exclude($columns)->get();
        return $pluckBarang;
    }
    public function delete($id)
    {
    }
}
