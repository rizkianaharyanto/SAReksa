<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'pnj_jurnals';
    protected $guarded = ['id'];
    public function akuns()
    {
        return $this->hasMany('App\Penjualan\Akun');
    }

    public function pengiriman()
    {
        return $this->belongsTo('App\Penjualan\Pengiriman');
    }

    public function faktur()
    {
        return $this->belongsTo('App\Penjualan\Faktur');
    }

    public function retur()
    {
        return $this->belongsTo('App\Penjualan\Retur');
    }

    public function pembayaran()
    {
        return $this->belongsTo('App\Penjualan\Pembayaran');
    }
}
