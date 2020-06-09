<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_pembayarans';
    protected $guarded = ['id'];
    public function jurnals()
    {
        return $this->hasMany('App\Pembelian\Jurnal');
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
