<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    
    public $timestamps = false;

    protected $table = 'goods_sku';
    // 设置允许字段
    protected $fillable = ['goods_id','sku_name','stock','original_price','present_price'];

    public function goods_sku($addSku) {

        for($i=0;$i<count($addSku['sku_name']);$i++) {
            
            $sku = new Sku;
            $sku->goods_id = $addSku['goods_id'];
            $sku->sku_name = $addSku['sku_name'][$i];
            $sku->stock = $addSku['stock'][$i];
            $sku->original_price = $addSku['original_price'][$i];
            $sku->present_price = $addSku['present_price'][$i];
            $sku->save();
        }
    }
}
