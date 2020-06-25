<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = "kpg_pegawais";
    protected $fillable = ['nama','ktp','email','handphone','masuk','catatan','alamat','kode_pos','npwp','ptkp','kode_pegawai'];

    public function jabatans()
    {
    	return $this->belongsToMany('App\Kepegawaian\Jabatan','kpg_naik_jabatans')->withPivot('id','pegawai_id','jabatan_id','tanggal');
    }

}
