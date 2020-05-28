<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'pbl_jurnals';
    public function akuns()
    {
        return $this->hasMany('App\Pembelian\Akun');
    }

    public function penerimaans()
    {
        return $this->hasMany('App\Pembelian\Penerimaan');
    }

    public function fakturs()
    {
        return $this->hasMany('App\Pembelian\Faktur');
    }

    public function returs()
    {
        return $this->hasMany('App\Pembelian\Retur');
    }

    public function pembayarans()
    {
        return $this->hasMany('App\Pembelian\Pembayaran');
    }
}
