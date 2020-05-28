<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_pemesanans';
    protected $guarded = ['id'];
    public function permintaans()
    {
        return $this->hasMany('App\Pembelian\Permintaan');
    }

    public function penerimaans()
    {
        return $this->hasMany('App\Pembelian\Penerimaan');
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
        return $this->belongsToMany('App\Stock\Barang', 'pbl_pemesanan_details')->withTimestamps()->withPivot('jumlah_barang', 'harga');
    }
}
