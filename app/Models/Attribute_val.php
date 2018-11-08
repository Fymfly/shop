<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute_val extends Model
{
    protected $fillable = ['attr_val','attr_key_id'];
    // public $timestamps = false;
    protected $table = 'goods_attribute_val';
}
