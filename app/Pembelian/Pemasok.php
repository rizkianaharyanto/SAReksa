<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemasok extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_pemasoks';
    protected $guarded = ['id'];
    public function pengirims()
    {
        return $this->hasMany('App\Pembelian\Pengirim');
    }

    public function permintaans()
    {
        return $this->hasMany('App\Pembelian\Permintaan');
    }

    public function pemesanans()
    {
        return $this->hasMany('App\Pembelian\Pemesanan');
    }

    public function penerimaans()
    {
        return $this->hasMany('App\Pembelian\Penerimaan');
    }

    public function fakturs()
    {
        return $this->hasMany('App\Pembelian\Faktur');
    }

    public function returs()
    {
        return $this->hasMany('App\Pembelian\Retur');
    }

    public function hutangs()
    {
        return $this->hasMany('App\Pembelian\Hutang');
    }

    public function pembayarans()
    {
        return $this->hasMany('App\Pembelian\Pembayaran');
    }

    public function barangs()
    {
        return $this->hasMany('App\Stock\Barang');
    }
}
