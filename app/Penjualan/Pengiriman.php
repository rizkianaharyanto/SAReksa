<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengiriman extends Model
{
    use SoftDeletes;
    protected $table = 'pnj_pengirimans';
    protected $guarded = ['id'];
    public function jurnals()
    {
        return $this->hasMany('App\Penjualan\Jurnal');
    }

    public function pemesanan()
    {
        return $this->belongsTo('App\Penjualan\Pemesanan');
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
        return $this->belongsToMany('App\Stock\Barang', 'pbl_penerimaan_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }
}
