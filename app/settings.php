<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class settings extends Model
{
    protected $fillable = ['config_key', 'config_value', 'type'];
    use SoftDeletes;
}
