<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'slug'];
    use SoftDeletes;

    public function products(){
        return $this->hasMany('App\Product', 'category_id', 'id');
    }

}
