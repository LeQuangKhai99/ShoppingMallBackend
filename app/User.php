<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Products(){
        return $this->hasMany('App/Product', 'user_id', 'id');
    }

    public function roles(){
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id')->withTimestamps();;
    }

    public function CheckPermissionAccess($key_code){
        // lấy đc tất cả các quyền của user đang login trong hệ thống
        $roles = auth()->user()->roles()->get();
        // so sánh giá trị đưa vào của router hiện tại xem có tồn tại trong các quyền mình lấy đc hay ko
        foreach ($roles as $role){
            $permissions = $role->permissions()->get();
            if ($permissions->contains('key_code', $key_code)){
                return  true;
            }
        }
        return false;
    }
}
