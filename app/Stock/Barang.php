<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = "stk_master_barang";
    protected $guarded = ['id','created_at','updated_at'];

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function unit()
    {
        return $this->belongsTo('App\Stock\SatuanUnit', 'satuan_unit');
    }
    
    public function kategori()
    {
        return $this->belongsTo('App\Stock\KategoriBarang', 'kategori_barang');
    }
    
    public function stockOpname()
    {
        return $this->belongsToMany('App\Stock\StokOpname', 'detail_stok_opname', 'item_id', 'stock_opname_id');
    }
    
    
    public function stockTransfer()
    {
        return $this->belongsToMany('App\Stock\StokTransfer', 'detail_transfer_stok', 'item_id', 'transfer_stock_id');
    }
    
    public function penyesuaianStok()
    {
        return $this->belongsToMany('App\Stock\PenyesuaianStok', 'detail_pergerakan_stok', 'item_id', 'penyesuaian_stok_id');
    }
    public function warehouseStocks()
    {
        return $this->belongsToMany('App\Stock\StokGudang', 'stok_gudang', 'barang_id', 'gudang_id')
        ->withPivot('kuantitas');
    }
    public function tax()
    {
        return $this->hasOne('App\Stock\PajakBarang', 'pajak_id');
    }
    public function scopeExclude($query, $value = array())
    {
        return $query->select(array_diff($this->getConnection()->getSchemaBuilder()
        ->getColumnListing($this->getTable()), (array)$value));
    }

    //Pembelian
    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok', 'pemasok_id');
    }
    
    public function permintaans()
    {
        return $this->belongsToMany('App\Pembelian\Permintaan', 'permintaan_details')->withPivot('jumlah_barang', 'harga')->withTimestamps();
    }

    public function pemesanans()
    {
        return $this->belongsToMany('App\Pembelian\Pemesanan', 'pemesanan_details')->withTimestamps()->withPivot('jumlah_barang', 'harga');
    }

    public function penerimaans()
    {
        return $this->belongsToMany('App\Pembelian\Penerimaan', 'penerimaan_details')->withPivot('jumlah_barang', 'harga')->withTimestamps();
    }

    public function fakturs()
    {
        return $this->belongsToMany('App\Pembelian\Faktur', 'faktur_details');
    }

    public function returs()
    {
        return $this->belongsToMany('App\Pembelian\Retur', 'retur_details');
    }
}
