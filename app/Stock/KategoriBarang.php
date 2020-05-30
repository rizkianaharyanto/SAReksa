<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    //
    public $guarded = [];
   
    protected $table = "stk_kategori_barang";
    public function items()
    {
        return $this->hasMany('App\Stock\Barang', 'kategori_barang');
    }
}
