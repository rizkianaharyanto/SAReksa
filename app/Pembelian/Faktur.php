<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faktur extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_fakturs';
    protected $guarded = ['id'];
    public function jurnals()
    {
        return $this->hasMany('App\Pembelian\Jurnal');
    }

    public function pemesanan()
    {
        return $this->hasOne('App\Pembelian\Pemesanan');
    }

    public function retur()
    {
        return $this->hasOne('App\Pembelian\Retur');
    }

    public function hutang()
    {
        return $this->hasOne('App\Pembelian\Hutang');
    }

    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pbl_faktur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }
}
