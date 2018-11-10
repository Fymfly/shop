<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Simage;
use App\Models\Sku;
use App\Models\Attribute_key;
use App\Models\Attribute_val;
use DB;

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
    public function goods(Request $req,$id) {

        // $goods = Goods::goods_image($id);
        $goods = Goods::where('id',$id)->first();

        $attr_key = Attribute_key::where('goods_id',$id)->select('id','attr_name')->get();
        foreach($attr_key as $k=> $v){
            $ids[] = $v->id;   
        }   
        $ids = implode($ids,',');
        $attr_val = Attribute_val::attribute_val($ids);
        
        foreach($attr_val as $v){
            $list[] = explode(',',$v->list);
        }
        // dd($list);

        $sku = Sku::where('goods_id',$id)->first();

        $simage = Simage::where('goods_id',$id)->get();
        // dd($sku);
        // dd($attribute);
        // dd($attr_val);
        return view('host.goods.goods',[

            'goods' => $goods,
            'attr_val' => $attr_val,
            'sku' => $sku,
            'simage' => $simage,
            'list'=>$list
        ]);
    }


    public function getAllGoodsSku($id) {

        $attr = new Sku;

        $attr = Sku::attribute();
        
        
    }
}
