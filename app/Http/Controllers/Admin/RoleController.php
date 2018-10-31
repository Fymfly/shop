<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    
    // 显示页面
    public function role_index() {



        return view('admin.role.index');
    }

    // 显示添加
    public function role_create() {

        return view('admin.role.create');
    }
}