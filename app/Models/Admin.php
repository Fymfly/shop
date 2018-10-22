<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Admin extends Model {

    protected $table = 'admin';
    // 设置允许字段
    protected $fillable = ['name','mobile','password'];

}