<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{    
    protected $table = "stk_ledger";
    public $guarded = ['id'];
    

    public function barangfk()
    {
        return $this->belongsTo('App\Stock\Barang', 'barang_id');
    }
}
