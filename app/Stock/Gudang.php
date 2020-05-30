<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    //

    protected $table = "stk_gudang";
    protected $guarded = [];
    public function items()
    {
        return $this->belongsToMany('App\Stock\Barang', 'stok_gudang', 'gudang_id', 'barang_id');
    }
}
