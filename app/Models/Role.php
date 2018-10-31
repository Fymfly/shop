<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Role extends Model {

    protected $table = 'role';
    // 设置允许字段
    protected $fillable = ['name','mobile','password','email'];

}