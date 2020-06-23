<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class HargaRetailHistory extends Model
{
    protected $table = 'stk_harga_retail_history';
    protected $guarded = [
        'id',
    ];

    public function item()
    {
        return $this->belongsTo('App\Stock\Item', 'item_id');
    }
}
