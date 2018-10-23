<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class User extends Model {

    protected $table = 'user';
    // 设置允许字段
    protected $fillable = ['name','mobile','password','email'];

}