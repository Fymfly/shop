<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Brand extends Model {

    protected $table = 'brand';
    // 设置允许字段
    protected $fillable = ['name','logo','region','content'];

}