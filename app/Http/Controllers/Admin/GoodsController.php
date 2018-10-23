<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;

class GoodsController extends Controller
{
    
    // 显示页面
    public function goods_index(Request $rep) {

        $goods = Goods::get();
        // dd($goods);
        return view('admin.goods.index',[
            'goods' => $goods,
        ]);
    }
}
