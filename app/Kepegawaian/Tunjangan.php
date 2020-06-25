<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    //
    protected $table = "kpg_tunjangans";
    protected $fillable = ['nama_akun','keterangan'];
    
    public function akun()
    {
        return $this->belongsTo('App\Kepegawaian\Akun');
    }
}
