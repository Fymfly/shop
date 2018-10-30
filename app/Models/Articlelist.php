<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Articlelist extends Model {

    public $timestamps = false;

    protected $table = 'article_list';
    // 设置允许字段
    protected $fillable = ['title','content','article_cate_id'];

}