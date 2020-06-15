<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penawaran extends Model
{
    use SoftDeletes;
    protected $table = 'pnj_penawarans';
    protected $guarded = ['id'];

    public function pemesanan()
    {
        return $this->belongsTo('App\Penjualan\Pemesanan');
    }

    public function penjual()
    {
        return $this->belongsTo('App\Penjualan\Penjual');
    }
    
    public function pelanggan()
    {
        return $this->belongsTo('App\Penjualan\Pelanggan');
    }

    public function barangs()
    {
        return $this->belongsToMany('App\Stock\Barang', 'pnj_penawaran_details')->withPivot('jumlah_barang', 'harga', 'unit', 'pajak')->withTimestamps();
    }
}
