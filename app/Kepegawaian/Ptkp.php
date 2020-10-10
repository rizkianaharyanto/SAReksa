<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ptkp extends Model
{
    //
	use SoftDeletes;
    protected $table = "kpg_ptkps";
    protected $fillable = ['status_ptkp','keterangan','gaji_minimal'];
    protected $dates = ['deleted_at'];


    
    public function pegawai()
    {
        return $this->hasMany('App\Kepegawaian\Pegawai');
    }

}
