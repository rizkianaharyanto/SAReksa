<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faktur extends Model
{
    use SoftDeletes;
    protected $table = 'pnj_fakturs';
    protected $guarded = ['id'];
    public function jurnals()
    {
        return $this->hasMany('App\Penjualan\Jurnal');
    }

    public function pemesanan()
    {
        return $this->hasOne('App\Penjualan\Pemesanan');
    }

    public function piutang()
    {
        return $this->hasOne('App\Penjualan\Piutang');
    }

    public function retur()
    {
        return $this->hasOne('App\Penjualan\Retur');
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
        return $this->belongsToMany('App\Stock\Barang', 'pnj_faktur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }
}
