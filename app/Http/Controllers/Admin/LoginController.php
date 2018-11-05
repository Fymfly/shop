<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use DB;
use Hash;

class LoginController extends Controller
{
    
    // 显示登录页面
    public function alogin() {

        return view('admin.login.login');
    }

    // 处理登录表单
    // public function adologin(Request $req) {
    //     // 先通过用户名到数据库查询信息
    //     $admin = Admin::where('name',$req->name)->first();

        
    //     // 判断是否有这个账号
    //     if($admin) {

    //         // 判断密码
    //         // 表单中的密码：$req->password
    //         // 数据库的密码：$admin->password (加密)
    
    //         if( Hash::check($req->password , $admin->password)) {

    //             // 把用户常用的数据保存到session
    //             session([
    //                 'id' => $admin->id,
    //                 'name' => $admin->name,
    //             ]);
                
    //             $adminid = session('id');
    //             $c = DB::table('admin_role')
    //                     ->where('admin_id','=',$adminid)
    //                     ->where('role_id','=','1')
    //                     ->count();
                
    //             if($c>0) {

    //                 session(['root'=>true]);
    //             } else {

    //                 $url_path = Admin::getUrl($adminid);
    //                 session(['url_path'=>$url_path]);
    //             }

    //             // 登录成功 
    //             return redirect()->route('aindex');
                
    //         } else {
    //             // 密码错误
    //             return back()->withErrors('密码错误!');
    //         }

    //     } else {

    //         // 账号不存在
    //         // 返回上一个页面，并把错误信息保存到session中，返回，在下一个页面中就可以使用 $error 获取这个错误信息
    //         return back()->withErrors('账号不存在!');
    //     }

    // }


    // 退出登录
   public function alogout(){
    session()->flush();
    return redirect()->route('alogin');
}  


    public function adologin(Request $req){  
        $admin = Admin::where('name',$req->name)->first();
                        
        if($admin){
            if(Hash::check($req->password,$admin->password)){
                session([
                    'id'=>$admin->id,
                    'name'=>$admin->name,
                ]); 
                
                $adminid = session('id');
                $c = DB::table('admin_role')
                        ->where('admin_id','=',$adminid)
                        ->where('role_id','=','1')
                        ->count();
                // dd($c);
                if($c>0){
                    session(['root'=>true]);
                }
                else{
                    $url_path = Admin::getUrl($adminid);
                    session(['url_path'=>$url_path]);
                }
                
                return redirect()->route('aindex');
            }
            return back()->withInput()->withErrors(['password'=>['密码不正确']]);
        }
        else
        {
            return back()->withInput()->withErrors(['mobile'=>['用户名不存在']]);
        }
        
    }


// public function adologin(Request $req) {

//     $admin = Admin::where('username',$req->name)->first();

//     if($admin) {

//         if(Hash::check($req->password,$admin->password)) {

//             session([
//                 'id' => $admin->id,
//                 'name' => $admin->name,
//             ]);

//             $adminid = session('id');
//             $c = DB::table('admin_id')
//                     ->where('admin_id','=',$adminid)
//                     ->where('role_id','=','1')
//                     ->count();

//             if($c>0) {

//                 session(['root'=>true]);
//             } else {

//                 $url_path = Admin::getUrl($adminid);
//                 session('[root=>true'=>$url_path]);                                                                                                                                       
//             }

            

//         }
//     }
// }

}
