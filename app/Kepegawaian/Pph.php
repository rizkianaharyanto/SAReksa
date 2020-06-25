<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Pph extends Model
{
    //
    protected $table = "kpg_pphs";
    protected $fillable = ['batas_minimal','batas_maksimal','persentase'];
}
