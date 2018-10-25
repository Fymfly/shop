<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Goods extends Model {

    protected $table = 'goods';
    // 设置允许字段
    protected $fillable = ['num','name','original_price','present_price','region'];

}