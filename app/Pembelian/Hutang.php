<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $table = 'pbl_hutangs';
    protected $guarded = ['id'];
    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function pembayarans()
    {
        return $this->belongsToMany('App\Pembelian\Pembayaran', 'pbl_pembayaran_details');
    }

    public function faktur()
    {
        return $this->hasOne('App\Pembelian\Faktur');
    }
    
    public function retur()
    {
        return $this->hasOne('App\Pembelian\Retur');
    }
}
