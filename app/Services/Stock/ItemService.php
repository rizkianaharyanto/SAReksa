<?php
namespace App\Services\Stock;

use App\Repositories\Stock\Repository;
use App\Stock\Barang;
use App\Stock\StokGudang;

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
    public function getAllStocksQty()
    {
        $b = Barang::with(['warehouseStocks:stk_stok_gudang.id,kuantitas'])->get();
        $this->c = $b->map(function ($item, $key) {
            $this->total = 0;
            $d = $item->warehouseStocks->map(function ($item, $key) {
                $this->total += $item->kuantitas;
                $item->total = $this->total;
                return $item->total;
            })->toArray();
            return(end($d));
        })->toArray();
        $data = $b->map(function ($item, $key) {
            return ([
                "id" => $item->id,
                "kode_barang" => $item->kode_barang,
                "kategori_barang" => $item->kategori_barang,
                "nama_barang" => $item->nama_barang,
                "jenis_barang" => $item->jenis_barang,
                "satuan_unit" => $item->unit->nama_satuan,
                "harga_retail" => $item->harga_retail,
                "harga_grosir" => $item->harga_grosir,
                "item_image" => $item->item_image,
                "akun_hpp" => $item->akun_hpp,
                "akun_persediaan" => $item->akun_persediaan,
                "akun_penjualan" => $item->akun_penjualan,
                "akun_pembelian" => $item->akun_pembelian,
                "pajak_id" => $item->kode_barang,
                "supplier_id" => $item->supplier_id,
                "nilai_barang" => $item->nilai_barang,
                "kuantitas_total" => $this->c[$key],
            ]);
        });
        return $data;
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
        return StokGudang::with([
            'barang',
            'gudang'
        ])->where('gudang_id', $whsId)->where('barang_id', $id)->first();
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
