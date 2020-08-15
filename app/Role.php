<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function users(){
        return $this->belongsToMany('App\User', 'user_role','user_id', 'role_id')->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id')->withTimestamps();
    }
}
