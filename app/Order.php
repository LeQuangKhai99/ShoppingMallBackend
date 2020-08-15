<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany('App\OrderItem', 'order_id', 'id');
    }

    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

}
