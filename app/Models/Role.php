<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Role extends Model {

    public $timestamps = false;

    protected $table = 'role';
    // 设置允许字段
    protected $fillable = ['role_name'];

    public function privilege() {

        return $this->belongsToMany('App\Models\Role','role_privilege','role_id','pri_id');
    }

}