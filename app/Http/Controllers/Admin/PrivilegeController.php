<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivilegeController extends Controller
{
    
    // 权限管理
    public function privilege_index() {

        return view('admin.privilege.index');
    }
}
