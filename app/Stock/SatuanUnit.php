<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SatuanUnit extends Model
{
    use SoftDeletes;
    protected $table = 'stk_satuan_unit';
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany('App\Stock\Barang', 'satuan_unit');
    }
}
