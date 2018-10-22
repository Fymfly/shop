<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    // 个人信息
    public function login() {

        return view('admin.login.login');
    }
}
