<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    //
    use SoftDeletes;
    
    protected $table = "stk_stok_opname";
    public $guarded = ['created_at','updated_at'];
    public function details()
    {
        return $this->belongsToMany('App\Stock\Barang', 'detail_stok_opname', 'stock_opname_id', 'item_id')
        ->withPivot('jumlah_tercatat', 'jumlah_fisik');
    }
    public function gudang()
    {
        return $this->belongsTo('App\Stock\Gudang', 'gudang_id');
    }
}
