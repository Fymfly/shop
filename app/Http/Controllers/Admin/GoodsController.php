<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use DB;

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

    
    // 处理添加
    public function goods_docreate(Request $req) {

    //     return $data;
        $goods = new Goods;
        $goods = Goods::create( $req->all() );

        $goods->save();
        // dd($user);
        return redirect()->route('goods_index');
    }

    // 显示添加页面
    public function goods_create(Request $req) {

        return view('admin.goods.create');
    }


    // 处理修改的表单
    public function goods_doedit(Request $req,$id) {

        // 根据ID取出要修改的数据
        $goods = Goods::find($id);

        // 为模型填充表单数据
        $goods->fill( $req->all() );

        // 保存到数据库
        $goods->save();

        return redirect()->route('goods_index');
    }

    // 显示修改页面
    public function goods_edit($id) {

        // 根据ID取出要修改的数据
        $goods = Goods::find($id);

        return view('admin.goods.edit',[
            'goods' => $goods,
        ]);
    }


    // 删除
    public function goods_delete($id) {

        Goods::destroy($id);
        return redirect()->route('goods_index');
    }
}
