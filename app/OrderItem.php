<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
