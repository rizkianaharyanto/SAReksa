<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokOpname extends Model
{
    //
    use SoftDeletes;
    
    protected $table = "stk_stok_opname";
    public $guarded = ['id','created_at','updated_at'];

    public function details()
    {
        return $this->belongsToMany('App\Stock\Barang', 'stk_detail_stok_opname', 'stock_opname_id', 'item_id')
        ->withPivot('jumlah_tercatat', 'jumlah_fisik', 'selisih');
    }
    public function gudang()
    {
        return $this->belongsTo('App\Stock\Gudang', 'gudang_id');
    }
}
