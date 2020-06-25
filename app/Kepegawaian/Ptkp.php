<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Ptkp extends Model
{
    //
    protected $table = "kpg_ptkps";
    protected $fillable = ['status_ptkp','keterangan','gaji_minimal'];

}
