<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    //
    protected $table = "kpg_penggajians";
    protected $fillable = ['pegawai_id','jumlah','gaji','pajak','tanggal','status'];
    
    public function pegawai()
    {
        return $this->belongsTo('App\Kepegawaian\Pegawai')->withTrashed();
    }

    public function tunjangan()
    {
        return $this->belongsToMany('App\Kepegawaian\Tunjangan','kpg_penggajian_tunjangans')->withPivot('id','penggajian_id','tunjangan_id','jumlah_tunjangan')->withTrashed();
    }
    
}
