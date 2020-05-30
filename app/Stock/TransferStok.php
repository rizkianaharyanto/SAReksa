<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferStok extends Model
{
    use SoftDeletes;
    protected $table = "stk_transfer_stok";
    public $guarded=['id'];
    public function items()
    {
        {
            return $this->belongsToMany('App\Stock\Barang', 'detail_transfer_stok', 'transfer_stock_id', 'item_id');
        }
    }
}
