<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    
    // 管理员列表
    public function admin_index() {

        return view('admin.admin.index');
    }
}
