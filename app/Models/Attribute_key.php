<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Attribute_key extends Model
{
    protected $fillable = ['attr_name','goods_id'];
    // public $timestamps = false;
    protected $table = 'goods_attribute_key';

    function vals(){
        return $this->hasMany(Attribute_val::class,'attr_key_id');
    }

}