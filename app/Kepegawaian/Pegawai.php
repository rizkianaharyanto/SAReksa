<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    //
	use SoftDeletes;
    protected $table = "kpg_pegawais";
    protected $fillable = ['nama','ktp','email','handphone','masuk','catatan','alamat','kode_pos','npwp','ptkp','kode_pegawai'];
    protected $dates = ['deleted_at'];

    public function jabatans()
    {
    	return $this->belongsToMany('App\Kepegawaian\Jabatan','kpg_naik_jabatans')->withPivot('id','pegawai_id','jabatan_id','tanggal','keterangan')->withTrashed();
    }
    
    public function penggajian()
    {
        return $this->hasMany('App\Kepegawaian\Penggajian');
    }

    public function ptkps()
    {
        return $this->belongsTo('App\Kepegawaian\Ptkp')->withTrashed();
    }

}
