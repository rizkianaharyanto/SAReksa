<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    protected $table = 'pnj_piutangs';
    protected $guarded = ['id'];
    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelanggan');
    }

    public function pembayarans()
    {
        return $this->belongsToMany('App\Penjualan\Pembayaran', 'pbl_pembayaran_details');
    }

    public function faktur()
    {
        return $this->hasOne('App\Penjualan\Faktur');
    }
    
    public function retur()
    {
        return $this->hasOne('App\Penjualan\Retur');
    }
}
