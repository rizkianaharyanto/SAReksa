<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'stk_master_barang';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $appends = ['harga_retail','harga_grosir'];
    public function getHargaRetailAttribute()
    {
        $hargaRetailHistory = $this->hargaRetailHistory()->latest()->first();
        return $hargaRetailHistory ? $hargaRetailHistory->harga_retail : 0.0;
    }
    public function getHargaGrosirAttribute()
    {
        $hargaGrosirHistory = $this->hargaGrosirHistory()->latest()->first();
        return $hargaGrosirHistory ? $hargaGrosirHistory->harga_grosir : 0.0;
    }
    public function hargaGrosirHistory()
    {
        return $this->hasMany('App\Stock\HargaGrosirHistory', 'item_id');
    }
    public function hargaRetailHistory()
    {
        return $this->hasMany('App\Stock\HargaRetailHistory', 'item_id');
    }
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function unit()
    {
        return $this->belongsTo('App\Stock\SatuanUnit', 'satuan_unit')->withTrashed();
    }

    public function kategori()
    {
        return $this->belongsTo('App\Stock\KategoriBarang', 'kategori_barang')->withTrashed();
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
        return $this->belongsToMany('App\Stock\Gudang', 'stk_stok_gudang', 'barang_id', 'gudang_id')
        ->withPivot('kuantitas');
    }

    public function tax()
    {
        return $this->hasOne('App\Stock\PajakBarang', 'pajak_id');
    }

    public function scopeExclude($query, $value = array())
    {
        return $query->select(array_diff($this->getConnection()->getSchemaBuilder()
        ->getColumnListing($this->getTable()), (array) $value));
    }

    //Pembelian
    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok', 'pemasok_id');
    }

    public function permintaans()
    {
        return $this->belongsToMany('App\Pembelian\Permintaan', 'permintaan_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }

    public function pemesanans()
    {
        return $this->belongsToMany('App\Pembelian\Pemesanan', 'pemesanan_details')->withTimestamps()->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang', 'barang_belum_diterima');
    }

    public function penerimaans()
    {
        return $this->belongsToMany('App\Pembelian\Penerimaan', 'penerimaan_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }

    public function fakturs()
    {
        return $this->belongsToMany('App\Pembelian\Faktur', 'faktur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }

    public function returs()
    {
        return $this->belongsToMany('App\Pembelian\Retur', 'retur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }

    //Penjualan
    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelanggan', 'pelanggan_id');
    }
    
    public function penawarans()
    {
        return $this->belongsToMany('App\Penjualan\Penawaran', 'penawaran_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }

    public function pengirimans()
    {
        return $this->belongsToMany('App\Penjualan\Pengiriman', 'pengiriman_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }
}
