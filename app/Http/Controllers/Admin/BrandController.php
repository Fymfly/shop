<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{   
    // 品牌管理首页
    public function brand_index() {

        return view('admin.brand.index');
    }
}
