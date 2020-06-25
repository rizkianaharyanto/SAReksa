<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = "kpg_jabatans";
    protected $fillable = ['nama_jabatan'];

    public function pegawais()
    {
        return $this->belongsToMany('App\Kepegawaian\Pegawai','kpg_naik_jabatans')->withPivot('id','pegawai_id','jabatan_id');
    }
    
}
