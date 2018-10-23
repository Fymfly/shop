<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    // 显示登录页面
    public function login() {

        return view('host.login.login');
    }


    // 处理登录表单
    public function dologin(Request $req) {
        // 先通过用户名到数据库查询信息
        $user = User::where('name',$req->name)->first();
        // echo 'sjdfksdf';

        // var_dump($admin);
        // exit;
        
        // 判断是否有这个账号
        if($user) {

            // 判断密码
            // 表单中的密码：$req->password
            // 数据库的密码：$admin->password (加密)
    
            if( Hash::check($req->password , $user->password)) {

                // 把用户常用的数据保存到session
                session([
                    'id' => $user->id,
                    'name' => $user->name,
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


    // 退出登录
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }  
}
