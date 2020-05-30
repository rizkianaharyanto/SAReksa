<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class PenyesuaianStok extends Model
{
    public $guarded = [];
    protected $table = "stk_penyesuaian_stok";
    public function details()
    {
        return $this->belongsToMany('App\Items', 'detail_penyesuaian_stok', 'stock_adjustment_id', 'item_id');
    }
}
