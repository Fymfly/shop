<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\Grade;

class GradeController extends Controller
{

    // 等级管理
    public function grade_index() {
        
        $grade = new Grade();
        $data = $grade->getAllGrade();


        return view('admin.grade.index',['data'=>$data]);
    }
}
