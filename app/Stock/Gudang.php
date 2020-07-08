<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gudang extends Model
{
    //
    use SoftDeletes;
    protected $table = "stk_gudang";
    protected $guarded = [];
    public function items()
    {
        return $this->belongsToMany('App\Stock\Barang', 'stk_stok_gudang', 'gudang_id', 'barang_id')
        ->withPivot('kuantitas');
    }
}
