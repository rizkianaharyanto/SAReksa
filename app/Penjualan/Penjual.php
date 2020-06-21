<?php

namespace App\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjual extends Model
{
    protected $table = 'pnj_penjuals';
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
    public function returs()
    {
        return $this->hasMany('App\Penjualan\Retur');
    }
    public function fakturs()
    {
        return $this->hasMany('App\Penjualan\Faktur');
    }
    
}
