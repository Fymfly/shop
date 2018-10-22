<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
    // 分类管理首页
    public function category_index() {

        return view('admin.category.index');
    }

    // 分类管理增加
    public function category_add() {

        return view('admin.category.category_add');
    }
}
