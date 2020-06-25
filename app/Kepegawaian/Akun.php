<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    //
    protected $table = "kpg_akuns";
    protected $fillable = ['nama_akun','keterangan'];
    
    public function tunjangans()
    {
        return $this->hasMany('App\Kepegawaian\Tunjangan');
    }


}
