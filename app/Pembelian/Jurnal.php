<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'pbl_jurnals';
    protected $guarded = ['id'];
    public function akuns()
    {
        return $this->hasMany('App\Pembelian\Akun');
    }

    public function penerimaan()
    {
        return $this->belongsTo('App\Pembelian\Penerimaan');
    }

    public function faktur()
    {
        return $this->belongsTo('App\Pembelian\Faktur');
    }

    public function returs()
    {
        return $this->belongsTo('App\Pembelian\Retur');
    }

    public function pembayaran()
    {
        return $this->belongsTo('App\Pembelian\Pembayaran');
    }
}
