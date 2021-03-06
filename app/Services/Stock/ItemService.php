<?php
namespace App\Services\Stock;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Repositories\Stock\Repository;
use App\Stock\Barang;
use App\Stock\StokGudang;
use App\Stock\HargaRetailHistory;
use App\Stock\HargaGrosirHistory;
use App\Stock\HargaJualHistory;

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

        $imageItemUrl = $this->saveItemImage($payload->get('item_image'));
        $payload['item_image'] = $imageItemUrl;
        
        $barang = Barang::create($payload->except(['harga_retail', 'harga_grosir','harga_jual'])->toArray());
        
        $payload['item_id'] = $barang->id;
        HargaGrosirHistory::create($payload->only(['item_id','harga_grosir'])->toArray());
        HargaRetailHistory::create($payload->only(['item_id','harga_retail'])->toArray());
        HargaJualHistory::create($payload->only(['item_id','harga_jual'])->toArray());
        return $barang;
    }

    public function saveItemImage($image)
    {
        $name = Str::random(12).'.'. $image->extension();
        $path = $image->storeAs('img', $name, 'public');
        return $path;
    }
    public function getAllStocksQty()
    {
        $b = Barang::with([
            'warehouseStocks:stk_stok_gudang.id,kuantitas',
            'unit',
            'kategori'
            ])->get();
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
            return (collect([
                "id" => $item->id,
                "item_image" => $item->item_image,
                "kode_barang" => $item->kode_barang,
                "kategori_barang" => $item->kategori->nama_kategori,
                "nama_barang" => $item->nama_barang,
                "jenis_barang" => $item->jenis_barang,
                "satuan" => $item->unit->nama_satuan,
                "harga_retail" => $item->harga_retail,
                'harga_jual'    => $item->harga_jual,
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
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
            ]));
        });
        return collect($data);
    }
    public function getStocksQty($itemId)
    {
        $theItem = Barang::find($itemId);
        $Barang = Barang::find($itemId);
        $qtySum = 0;
        // return $Barang;
        foreach ($Barang->warehouseStocks as $i) {
            // dd($i->pivot->kuantitas);
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

    public function getAllStocksByWhouse($whsId)
    {
        return StokGudang::with([
            'barang',
            'gudang'
        ])->where('gudang_id', $whsId)->get();
    }

    public function getAllStocksByWhouseNotNull($whsId)
    {
        return StokGudang::with([
            'barang',
            'gudang'
        ])->where('gudang_id', $whsId)->where('kuantitas', '>', 0)->get();
    }
    public function getStocksQtyByWhouse($whsId, $itemId)
    {
        return $stocks =  $this->getStocksByWhouse($itemId, $whsId) ? $this->getStocksByWhouse($itemId, $whsId)->kuantitas : 0 ;
    }
    public function updateStocks($itemId, $whsId, $qty)
    {
        $stocks = Barang::find($itemId)->warehouseStocks() ?? null;
        if ($stocks) {
            StokGudang::with([
                'barang',
                'gudang'
            ])->where('gudang_id', $whsId)->where('barang_id', $itemId)->delete();
        }
        Barang::find($itemId)->warehouseStocks()->attach([$itemId => [
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
        $item = Barang::with([
            'warehouseStocks',
            'hargaRetailHistory',
            'hargaGrosirHistory'
        ])->findOrFail($id);

        DB::beginTransaction();
        try {
            $item->warehouseStocks()->detach();
            $item->hargaRetailHistory() ?? $item->hargaRetailHistory()->delete();
            $item->hargaGrosirHistory() ?? $item->hargaGrosirHistory()->delete();
            $item->delete();
        } catch (\Throwable $th) {
            DB::rollback();
        }
        DB::commit();
    }
}
