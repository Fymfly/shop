<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    
    // 会员记录管理
    public function record_index() {

        return view('admin.record.index');
    }
}
