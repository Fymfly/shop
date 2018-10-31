<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Privilege extends Model {

    protected $table = 'privilege';
    // 设置允许字段
    protected $fillable = ['pri_name','url_path','parent_id'];

}