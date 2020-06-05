<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retur extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_returs';
    protected $guarded = ['id'];
    public function jurnal()
    {
        return $this->belongsTo('App\Pembelian\Jurnal');
    }

    public function faktur()
    {
        return $this->hasOne('App\Pembelian\Faktur');
    }

    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pbl_retur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }
}
