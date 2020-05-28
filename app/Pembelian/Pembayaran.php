<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pbl_pembayarans';
    public function jurnal()
    {
        return $this->belongsTo('App\Pembelian\Jurnal');
    }

    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function hutangs()
    {
        return $this->belongsToMany('App\Pembelian\Hutang', 'pbl_pembayaran_details');
    }
}
