<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Attribute extends Model
{   

    public $timestamps = false;

    protected $table = 'goods_attribute';
    // 设置允许字段
    protected $fillable = ['attr_name','attr_value','goods_id'];

    // 添加商品属性
    public function goods_attribute($addAttr) {
            
        for($i=0;$i<count($addAttr['attr_name']);$i++){
            
            $arr = explode(",",$addAttr['attr_value'][$i]);
            for($j=0;$j<count($arr);$j++){
                $attribute = new Attribute;
                $attribute->goods_id = $addAttr['goods_id'];
                $attribute->attr_name = $addAttr['attr_name'][$i];
                $attribute->attr_value = $arr[$j];
                $attribute->save();
            }
        }
        

        // dd($attribute);

        // $attribute->save();
    }

}
