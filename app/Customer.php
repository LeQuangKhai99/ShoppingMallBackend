<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function orders(){
        return $this->hasMany('App\Order', 'customer_id', 'id');
    }
}
