<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Sku;
use App\Models\Simage;
use DB;

class GoodsController extends Controller
{
    
    // 获取子分类
    public function linkage() {

        $id = (int)$_GET['id'];
        
        $category = new Category;
        $data = Category::where('parent_id',$id)->get();
    
        echo json_encode($data);
    }

    // 显示页面
    public function goods_index(Request $rep) {

        // $goods = DB::table('goods')
        //             ->join('goods_image','goods.id','=','goods_image.goods_id')
        //             ->select('goods.*','goods_image.path')
        //             ->get();

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
        // dd($req->all());die;
        $goods = Goods::create( $req->all() );

        // 如果表单中上传了图片就执行上传
        if($req->hasFile('logo') && $req->file('logo')->isValid()) {
            
            $date = date('Ymd');
            // dd($date);
            // 把图片保存到当前日期目录下
            $logo = $req->logo->store('logo/'.$date);
            // $brand->logo ='/uploads/'.$req->logo->store('brand/'.date('Ymd')); 

            // 把图片路径保存到模型
            // dd($logo);
            $goods->logo = $logo;

        }
        // dd($goods);
        $goods->save();

        $attribute = new Attribute;
        // dd($req->all());die;
        $goods_id = $goods->id;
        $attr_name = $req->attr_name;
        $attr_value = $req->attr_value;
        $addAttr = [];
        $addAttr['goods_id']=$goods_id;
        $addAttr['attr_name']=$attr_name;
        $addAttr['attr_value']=$attr_value;
        // dd($addAttr);die;
        
        $attribute->goods_attribute($addAttr);

        $Sku = new Sku;
        $goods_id = $goods->id;
        $sku_name = $req->sku_name;
        $stock = $req->stock;
        $original_price = $req->original_price;
        $present_price = $req->present_price;
        $addSku = [];
        $addSku['goods_id']=$goods_id;
        $addSku['sku_name']=$sku_name;
        $addSku['stock']=$stock;
        $addSku['original_price']=$original_price;
        $addSku['present_price']=$present_price;
        // dd($addSku);die;

        $Sku->goods_sku($addSku);

        $Image = new Simage;
        $goods_id = $goods->id;
        
        Simage::goods_image($req,$goods_id);

        // dd($user);
        return redirect()->route('goods_index');

    }

    
    // 显示添加页面
    public function goods_create(Request $req) {

        $brand = new Brand;
        $brand = Brand::get();

        $category = new Category;
        $category = Category::where('parent_id',null)->get();

        return view('admin.goods.create',[
            'brand' => $brand,
            'category' =>$category,
        ]);
    }


    // 处理修改的表单
    public function goods_doedit(Request $req,$id) {

        // 根据ID取出要修改的数据
        $goods = Goods::find($id);

        // 为模型填充表单数据
        $goods->fill( $req->all() );

        // 保存到数据库0
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
