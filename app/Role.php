<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id');
    }
}
