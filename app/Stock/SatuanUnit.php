<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class SatuanUnit extends Model
{
    //
    protected $table = 'stk_satuan_unit';
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany('App\Stock\Barang', 'satuan_unit');
    }
}
