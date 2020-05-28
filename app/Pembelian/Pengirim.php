<?php

namespace App\Pembelian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengirim extends Model
{
    use SoftDeletes;
    protected $table = 'pbl_pengirims';
    protected $guarded = ['id'];
    public function pemasok()
    {
        return $this->belongsTo('App\Pembelian\Pemasok');
    }
}
