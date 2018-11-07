<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Simage;
use App\Models\Sku;
use App\Models\Attribute;

class GoodsController extends Controller
{
    
    // 商品列表页
    public function goods_list($id) {
        // dd($id);
        // $goods_list = Goods::goods_image();
        $goods_list = Goods::where('cat3_id',$id)->get();
        // dd($goods);

        return view('host.goods.goods_list',[

            'goods_list' => $goods_list,
        ]);
    }


    // 商品详情页
    public function goods($id) {

        // $goods = Goods::goods_image($id);
        $goods = Goods::where('id',$id)->first();

        $attribute = Attribute::where('goods_id',$id)->first();

        $sku = Sku::where('goods_id',$id)->first();

        $simage = Simage::where('goods_id',$id)->get();
        // dd($sku);

        return view('host.goods.goods',[

            'goods' => $goods,
            'sku' => $sku,
            'attribute' => $attribute,
            'simage' => $simage,
        ]);
    }
}
