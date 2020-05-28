<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $table = 'pbl_hutangs';
    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function pembayarans()
    {
        return $this->belongsToMany('App\Pembelian\Pembayaran', 'pbl_pembayaran_details');
    }
}
