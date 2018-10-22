<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    
    // 显示后台主页
    public function index() {

        return view('admin.index.index');
    }

    public function home() {

        return view('admin.index.home');
    }
}
