<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class HargaJualHistory extends Model
{
    protected $table = "stk_harga_jual_history";

    protected $guarded = [
        'id',
    ];

    public function item()
    {
        return $this->belongsTo('App\Stock\Barang', 'item_id');
    }
}
