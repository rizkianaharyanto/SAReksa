<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akun extends Model
{
    //
	use SoftDeletes;
    protected $table = "kpg_akuns";
    protected $fillable = ['nama_akun','keterangan'];
    protected $dates = ['deleted_at'];
    
    public function tunjangans()
    {
        return $this->hasMany('App\Kepegawaian\Tunjangan');
    }


}
