<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retur extends Model
{
    use SoftDeletes;
    protected $table = 'pnj_returs';
    protected $guarded = ['id'];
    public function jurnals()
    {
        return $this->hasMany('App\Penjualan\Jurnal');
    }

    public function faktur()
    {
        return $this->hasOne('App\Penjualan\Faktur');
    }

    public function piutang()
    {
        return $this->hasOne('App\Penjualan\Piutang');
    }

    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelangggan');
    }

    public function penjual()
    {
        return $this->belongsTo('App\Penjualan\Penjual');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pbl_retur_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak', 'status_barang')->withTimestamps();
    }
}
