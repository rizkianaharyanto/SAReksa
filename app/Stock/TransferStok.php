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
        return $this->belongsToMany('App\Stock\Barang', 'stk_detail_transfer_stok', 'transfer_stok_id', 'barang_id')
        ->withPivot('kuantitas');
    }
    
  
    public function asal()
    {
        return $this->belongsTo('App\Stock\Gudang', 'gudang_asal');
    }

    public function tujuan()
    {
        return $this->belongsTo('App\Stock\Gudang', 'gudang_tujuan');
    }
}
