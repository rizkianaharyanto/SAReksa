<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class PenyesuaianStok extends Model
{
    public $guarded = ['id'];
    protected $table = "stk_penyesuaian_stok";
    public function details()
    {
        return $this->belongsToMany('App\Stock\Barang', 'stk_detail_penyesuaian_stok', 'stock_adjustment_id', 'item_id')
            ->withPivot('quantity_diff');
    }
    public function gudang()
    {
        return $this->belongsTo('App\Stock\Gudang', 'warehouse_id');
    }
}
