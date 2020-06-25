<?php

namespace App\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = "kpg_users";
    protected $fillable = ['name','email','userable_id','userable_type','password'];

}
