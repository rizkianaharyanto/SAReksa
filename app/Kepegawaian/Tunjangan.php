<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tunjangan extends Model
{
    //
	use SoftDeletes;
    protected $table = "kpg_tunjangans";
    protected $fillable = ['nama_tunjangan','akun_id'];
    protected $dates = ['deleted_at'];
    
    public function akun()
    {
        return $this->belongsTo('App\Kepegawaian\Akun')->withTrashed();
    }

    public function penggajian()
    {
        return $this->belongsToMany('App\Kepegawaian\Penggajian','kpg_penggajian_tunjangans')->withPivot('id','penggajian_id','tunjangan_id','jumlah_tunjangan');
    }
}
