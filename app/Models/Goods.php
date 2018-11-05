<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Goods extends Model {

    protected $table = 'goods';
    // 设置允许字段
    protected $fillable = ['logo','goods_name','content','region','cat1_id','cat2_id','cat3_id','brand_id'];

}