<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{

    // 等级管理
    public function grade_index() {

        return view('admin.grade.index');
    }
}
