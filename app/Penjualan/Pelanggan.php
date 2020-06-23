<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    protected $table = 'pnj_pelanggans';
    protected $guarded = ['id'];
    use SoftDeletes;

    public function penawarans()
    {
        return $this->hasMany('App\Penjualan\Penawaran');
    }

    public function pemesanans()
    {
        return $this->hasMany('App\Penjualan\Pemesanan');
    }

    public function pengirimans()
    {
        return $this->hasMany('App\Penjualan\Pengiriman');
    }

    public function fakturs()
    {
        return $this->hasMany('App\Penjualan\Faktur');
    }

    public function returs()
    {
        return $this->hasMany('App\Penjualan\Retur');
    }

    public function piutangs()
    {
        return $this->hasMany('App\Penjualan\Piutang');
    }

    public function pembayarans()
    {
        return $this->hasMany('App\Penjualan\Pembayaran');
    }

    public function barangs()
    {
        return $this->hasMany('App\Stock\Barang');
    }
}
