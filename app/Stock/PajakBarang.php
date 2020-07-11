<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class PajakBarang extends Model
{
    protected $table = "stk_pajak_master";
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo('App\Stock\Barang', 'pajak_id');
    }
}
