<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    // 会员列表
    public function members_index() {

        return view('admin.members.index');
    }
}
