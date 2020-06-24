<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    protected $table = 'stk_stok_gudang';

    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'gudang_id',
        'barang_id'
    ];
    public function barang()
    {
        return $this->belongsTo('App\Stock\Barang', 'barang_id');
    }
    public function gudang()
    {
        return $this->belongsTo('App\Stock\Gudang', 'gudang_id');
    }
}
