<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    //
	use SoftDeletes;
    protected $table = "kpg_jabatans";
    protected $fillable = ['nama_jabatan'];
    protected $dates = ['deleted_at'];

    public function pegawais()
    {
        return $this->belongsToMany('App\Kepegawaian\Pegawai','kpg_naik_jabatans')->withPivot('id','pegawai_id','jabatan_id','keterangan','tanggal');
    }
    
}
