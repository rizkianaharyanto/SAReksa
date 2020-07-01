<?php
namespace App\Services\Stock;

use Illuminate\Support\Collection;
use App\Repositories\Stock\Repository;
use App\Stock\Barang;
use App\Stock\StokGudang;
use App\Stock\HargaRetailHistory;
use App\Stock\HargaGrosirHistory;

class ItemService
{
    protected $model;
    public function all()
    {
        return Barang::all();
    }
    public function create($payload)
    {
        $payload = collect($payload);
        $barang = Barang::create($payload->except(['harga_retail', 'harga_grosir'])->toArray());
        
        $payload['item_id'] = $barang->id;
        HargaGrosirHistory::create($payload->only(['item_id','harga_grosir'])->toArray());
        HargaRetailHistory::create($payload->only(['item_id','harga_retail'])->toArray());
        
        return $barang;
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
        return $stocks =  $this->getStocksByWhouse($itemId, $whsId) ? $this->getStocksByWhouse($itemId, $whsId)->kuantitas : 0 ;
    }
    public function updateStocks($itemId, $whsId, $qty)
    {
        Barang::find($itemId)->warehouseStocks()->syncWithoutDetaching([$itemId => [
            'gudang_id' => $whsId,
            'kuantitas' => $qty,
        ]]);
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
