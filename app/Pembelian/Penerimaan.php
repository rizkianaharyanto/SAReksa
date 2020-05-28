<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerimaan extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_penerimaans';
    protected $guarded = ['id'];
    public function jurnal()
    {
        return $this->belongsTo('App\Pembelian\Jurnal');
    }

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
        return $this->belongsToMany('App\Stock\Barang', 'pbl_penerimaan_details')->withPivot('jumlah_barang', 'harga')->withTimestamps();
    }
}
