<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class HargaGrosirHistory extends Model
{
    protected $table = 'stk_harga_grosir_history';
    protected $guarded = [
        'id',
    ];

    public function item()
    {
        return $this->belongsTo('App\Stock\Barang', 'item_id');
    }
}
