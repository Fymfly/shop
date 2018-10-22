<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonageController extends Controller
{
    
    // 个人信息
    public function personage_index() {

        return view('admin.personage.index');
    }
}
