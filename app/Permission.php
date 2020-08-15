<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function PermissionChildren(){
        return $this->hasMany('App\Permission', 'parent_id');
    }

    public function roles(){
        return $this->belongsToMany('App\Role', 'permission_role', 'permission_id', 'role_id')->withTimestamps();
    }
}
