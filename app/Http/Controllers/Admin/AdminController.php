<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Hash;
use DB;

class AdminController extends Controller
{
    
    // 管理员列表
    public function admin_index() {

        $admin = DB::table('admin')
                    ->join('admin_role','admin.id','=','admin_role.admin_id')
                    ->join('role','role.id','=','admin_role.role_id')
                    ->select('admin.*','role.role_name')
                    ->get();

        return view('admin.admin.index',[
            'admin' => $admin,
        ]);

    }

    // 处理修改
    public function admin_doedit(Request $req,$id) {

        $admin = Admin::find($id);

        $admin->fill( $req->all() );

        // 获取用户的id
        $admin_id = (int)$admin->id;

        // 获取角色的id
        $role_id = $req->input('role_name');

        DB::table('admin_role')
            ->where('admin_id',$admin_id)
            ->update(['role_id'=>$role_id]);

        $admin->save();

        // $admin->password = $password;
        // dd($admin);\
        // dd($role_id);
        return redirect()->route('admin_index');
    }

    // 显示修改
    public function admin_edit($id) {

        $admin = Admin::find($id);

        $role = Role::get();
        // dd($role);

        $admin_role = DB::table('admin_role')->where('admin_id','=',$id)->first();

        // dd($admin_role);
        return view('admin.admin.edit',[
            'admin' => $admin,
            'role' => $role,
            'admin_role' => $admin_role,
        ]) ;
    }


    // 处理添加 
    public function admin_docreate(Request $req) {

        $admin = new Admin;

        $admin->fill( $req->all() );

        // // 把密码加密
        $password = Hash::make($req->password);

        $admin->password = $password;

        $admin->save();

        // 获取用户的id
        $admin_id = (int)$admin->id;

        // 获取角色的id
        $role_id = $req->input('role_name');

        DB::table('admin_role')
            ->insert([
                'admin_id' => $admin_id,
                'role_id' => $role_id,
            ]);

        // $admin->password = $password;
        // dd($admin);\
        // dd($role_id);
        return redirect()->route('admin_index');
    }

    // 显示添加
    public function admin_create() {

        $role = Role::get();

        return view('admin.admin.create',[
            
            'role' => $role,
        ]);
    }


    // 删除
    public function admin_delete(Request $req,$id) {

        DB::table('admin_role')
            ->where('admin_id',$id)
            ->delete();

        return redirect()->route('admin_index');
    }

}
