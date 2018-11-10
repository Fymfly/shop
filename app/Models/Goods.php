<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Goods extends Model {

    protected $table = 'goods';
    // 设置允许字段
    protected $fillable = ['logo','goods_name','content','region','cat1_id','cat2_id','cat3_id','brand_id','price'];


    // 获取商品图片
    public static function goods_image() {

        $goods = DB::table('goods_image')
                    ->join('goods','goods.id','=','goods_image.goods_id')
                    // ->join('goods_sku','goods_sku.goods_id','=','goods.id')
                    ->select('goods_image.bigImage','goods_image.smlImage','goods.*')
                    ->get();
        // dd($goods);die;
        return $goods;
    }

}