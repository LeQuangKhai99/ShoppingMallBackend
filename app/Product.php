<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'feature_image_path', 'content', 'user_id', 'category_id', 'slug', 'feature_image_name', 'view'];
    use SoftDeletes;
    public function ProductTags(){
        return $this->hasMany('App\ProductTag', 'product_id', 'id');
    }

    public function Category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function User(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tags(){
        return$this->belongsToMany('App\Tag', 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    public function images(){
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function orderItems(){
        return $this->hasMany('App\OrderItem', 'product_id', 'id');
    }
}
