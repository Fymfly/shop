<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['goods_id','sku_name','stock','price','old_price','sku_all'];
    public $timestamps = false;
    protected $table = 'goods_sku';
}
