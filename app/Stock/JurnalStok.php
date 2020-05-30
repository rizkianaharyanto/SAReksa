<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurnalStok extends Model
{
    use SoftDeletes;
    protected $table = 'stk_jurnal_stok';
    protected $guarded = [];
}
