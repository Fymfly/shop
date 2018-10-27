<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
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

        $brand->save();
        return redirect()->route('brand_index');
    }

    // 显示增加页面
   public function brand_create() {
       
        return view('admin.brand.create');
    }
}
