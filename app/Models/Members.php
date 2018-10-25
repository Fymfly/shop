<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Members extends Model {

    protected $table = 'members';
    // 设置允许字段
    protected $fillable = ['name','sex','mobile','email','region','grade_id'];

}