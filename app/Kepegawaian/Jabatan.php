<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = "kpg_jabatans";

    public function pegawai()
    {
        return $this->belongsToMany('App\Kepegawaian\Pegawai')->withPivot('id','pegawai_id','jabatan_id');
    }
}
