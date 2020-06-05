<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permintaan extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_permintaans';
    protected $guarded = ['id'];
    public function pemesanan()
    {
        return $this->belongsTo('App\Pembelian\Pemesanan');
    }

    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pbl_permintaan_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }
}
