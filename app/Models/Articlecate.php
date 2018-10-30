<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Articlecate extends Model {

    public $timestamps = false;

    protected $table = 'article_caregory';
    // 设置允许字段
    protected $fillable = ['carename','content','article_cate_id'];

}