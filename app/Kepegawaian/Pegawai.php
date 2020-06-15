<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = "kpg_pegawais";

    public function jabatan()
    {
    	return $this->belongsToMany('App\Kepegawaian\Jabatan')->withPivot('id','pegawai_id','jabatan_id');
    }

}
