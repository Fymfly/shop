<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Hash;

class LoginController extends Controller
{
    
    // 显示登录页面
    public function login() {

        return view('admin.login.login');
    }

    // 处理登录表单
    public function dologin(Request $req) {
        // 先通过用户名到数据库查询信息
        $admin = Admin::where('name',$req->user)->first();
        // echo 'sjdfksdf';

        // var_dump($admin);
        // exit;
        
        // 判断是否有这个账号
        if($admin) {

            // 判断密码
            // 表单中的密码：$req->pass
            // 数据库的密码：$admin->pass（加密）
    
            if( Hash::check($req->pass , $admin->password)) {

                // 把用户常用的数据保存到session
                session([
                    'id' => $admin->id,
                    'name' => $admin->user,
                ]);

                // 登录成功
                return redirect()->route('index');
            } else {
                // 密码错误
                return back()->withErrors('密码错误!');
            }
        } else {

            // 账号不存在
            // 返回上一个页面，并把错误信息保存到session中，返回，在下一个页面中就可以使用 $error 获取这个错误信息
            return back()->withErrors('账号不存在!');
        }

    }

}
