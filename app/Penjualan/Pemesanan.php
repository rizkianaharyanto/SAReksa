<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use SoftDeletes;
    protected $table = 'pnj_pemesanans';
    protected $guarded = ['id'];
    public function penawarans()
    {
        return $this->hasMany('App\Penjualan\Penawaran');
    }

    public function pengirimans()
    {
        return $this->hasMany('App\Penjualan\Pengiriman');
    }

    public function faktur()
    {
        return $this->hasOne('App\Penjualan\Faktur');
    }

    public function penjual()
    {
        return $this->belongsTo('App\Penjualan\Penjual');
    }

    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelanggan');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pbl_pemesanan_details')->withTimestamps()->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang');
    }
}
