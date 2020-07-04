<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBarang extends Model
{
    use SoftDeletes;

    public $guarded = [];
   
    protected $table = "stk_kategori_barang";
    public function items()
    {
        return $this->hasMany('App\Stock\Barang', 'kategori_barang');
    }
}
