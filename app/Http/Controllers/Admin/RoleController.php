<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Privilege;
use DB;

class RoleController extends Controller
{
    
    // 显示页面
    public function role_index() {

        $role = DB::table('role')
                ->join('role_privilege','role_privilege.role_id','=','role.id')
                ->join('privilege','privilege.id','=','role_privilege.pri_id')
                ->groupBy('role.id')
                ->select('role.*',DB::raw('group_concat(privilege.pri_name) as pri_list'))
                ->get();
        // dd($role);die;
        return view('admin.role.index',[

            'role' => $role,
        ]);
    }


    // 处理修改
    public function role_doedit(Request $req,$id) {

        $role = Role::find($id);
        $role->fill( $req->all())->save();
        $role->privilege()->detach();
        if($req->pri_id) {

            $role->privilege()->attach($req->pri_id);
        }
        
        return redirect()->route('role_index');
    }


    // 显示修改
    public function role_edit(Request $req,$id) {


        $role = Role::find($id);
        // 显示权限
        $data = new Privilege;
        $pri = $data->getPrivilegeInfoTest();

        foreach($pri as $key => $item) {
            // dump($item->pri_name);
        }
        
        $priIds = DB::table('role_privilege')->where('role_id','=',$id)->pluck('pri_id')->toArray();

        return view('admin.role.edit',[
            
            'role' => $role,
            'pri' => $pri,
            'priIds' => $priIds,
        ]);
    }


    // 处理增加
    public function role_docreate(Request $req) {

        $role = new Role;

        $data = $role->fill($req->all())->save();
        // dd($data);
        // dd($req->pri_id);
        if($req->pri_id) {
            $role->privilege()->attach($req->pri_id);
        }

        return redirect()->route('role_index');
    }

    // 显示添加
    public function role_create() {

        $data = new Privilege;
        $role = $data->getPrivilegeInfoTest();

        foreach($role as $key => $item) {
            // dump($item->pri_name);
        }

        return view('admin.role.create',[
            'role' => $role,
        ]);

    }


    // 删除
    public function role_delete(Request $req,$id) {

        Role::destroy($id);

        DB::table('role_privilege')
            ->where('role_id',$id)
            ->delete();
        
        return redirect()->route('role_index');
    }
}