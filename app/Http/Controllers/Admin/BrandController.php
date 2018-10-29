<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Storage;
use DB;

class BrandController extends Controller
{   
    // 品牌管理首页
    public function brand_index(Request $req) {

        $brand = Brand::get();
        
        return view('admin.brand.index',[
            'brand' => $brand,
        ]);
    }
    
    // 处理增加表单
    public function brand_docreate(Request $req) {

        $brand = new Brand;
        $brand = Brand::create( $req->all() );
        $logo = $req->logo;

        // dd($logo);
        // 如果表单中上传了图片就执行上传
        if($req->hasFile('logo') && $req->file('logo')->isValid()) {
            
            $date = date('Ymd');
            // dd($date);
            // 把图片保存到当前日期目录下
            $logo = $req->logo->store('brand/'.$date);
            // $brand->logo ='/uploads/'.$req->logo->store('brand/'.date('Ymd')); 

            // 把图片路径保存到模型
            // dd($logo);
            $brand->logo = $logo;

        }

        $brand->save();
        return redirect()->route('brand_index');
    }

    // 显示增加页面
   public function brand_create() {
       
        return view('admin.brand.create');
    }


    // 处理修改表单
    public function brand_doedit(Request $req,$id) {

        $brand = Brand::find($id);

        $brand->fill( $req->all() );

        if($req->hasFile('logo') && $req->logo->isValid()) {

            $date = date('Ymd');
            // dd($date);
            // 把图片保存到当前日期目录下
            $logo = $req->logo->store('brand/'.$date);

            // 删除原图片
            Storage::delete($brand->logo);

            $brand->logo = $logo;
        }

        $brand->save();

        return redirect()->route('brand_index');
    }


    // 显示修改页面
    public function brand_edit($id) {

        $brand = Brand::find($id);
        // dd($brand);
        return view('admin.brand.edit',[
            'brand' => $brand,
        ]);
    }


    // 删除品牌信息
    public function brand_delete($id) {

        $brand = Brand::find($id);
        // dd('sdfsdf');
        // // 从硬盘上删除图片
        Storage::delete($brand->logo);

        
        Brand::destroy($id);

        return redirect()->route('brand_index');

        // $brand = Brand::find($id);
        // dd("/public/".$brand->logo);
        // dd($brand->logo);
        // unlink('uploads/'.$brand->logo);
        // $brand = Brand::destroy($id); 
        // return redirect()->route('brand_index'); 
    }
}