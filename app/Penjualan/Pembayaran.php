<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pnj_pembayarans';

    public function jurnals()
    {
        return $this->hasMany('App\Penjualan\Jurnal');
    }

    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelanggan');
    }

    public function piutangs()
    {
        return $this->belongsToMany('App\Penjualan\Piutang', 'pnj_pembayaran_details');
    }
}