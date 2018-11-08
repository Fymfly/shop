<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute_key;
use App\Models\Attribute_val;
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
        $category = Category::where('parent_id',0)->get();

        // dd($category);

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

        $category = Category::get();
        $brand = Brand::get();
        $attribute = Attribute::get();

        return view('admin.goods.edit',[
            'goods' => $goods,
            'category' => $category,
            'brand' => $brand,
            'attribute' => $attribute,
        ]);
    }


    // 删除
    public function goods_delete($id) {

        Goods::destroy($id);
        return redirect()->route('goods_index');
    }


    // sku

    public function goods_sku_create(){
        $id = $_GET['id'];
        // dd($goods_id);
        // 这个商品id的所有规格
        $attribute_key = Attribute_key::where('goods_id',$id)->get();
        return view("admin.goods.sku",[
            'attribute_key'=>$attribute_key,
            'id'=>$id
        ]);
    }

    public function goods_attrkey(Request $request){
        $attribute_key = new Attribute_key;
        $attribute_key->goods_id = $request->id;
        // dd($request->id);
        $attribute_key->attr_name = $request->name;
        $attribute_key->save();

    }

    public function goods_attrval(Request $request){
        
        $attribute_val = new Attribute_val;
        
        $attribute_val->attr_key_id = $request->id;
        
        // dd($request->id);
        $attribute_val->attr_val =  $request->sepcval;
        $attribute_val->save();

    }
   
    public function goods_sku_docreate(Request $req){
        $id = $_GET['id'];
        // 1.根据商品id取出规格id
        $ids = [];
        $attribute_key = Attribute_key::where('goods_id',$id)->get()->toArray();
       
        // dd($req->all());
        $data =  $req->skus;
        // dd($data);
        foreach ($data as $key => $value) {
            // dd($value);
            $sku = new Sku;
            $sku->goods_id = $req->id;
            $sku->sku_name = $value['sku_name'];
            $sku->stock = $value['stock'];
            $sku->original_price = $value['original_price'];
            $sku->present_price = $value['present_price'];
            // 拼接 规格组合
            $sku_all = [];
            foreach ($value['specs'] as $k => $v) {
                $sku_all[]= $k.':'.$v;
            }
            $sku_all = implode('-',$sku_all);

            $sku->sku_all = $sku_all;
            # code...
            // dd($sku);
            $sku->save();

        }
        return redirect()->route('goods_index');
    }
} 
