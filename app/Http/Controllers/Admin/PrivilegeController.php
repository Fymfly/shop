<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Privilege;

class PrivilegeController extends Controller
{
    
    // 权限管理
    public function privilege_index() {

        $data = new Privilege;
        $privilege = $data->getPrivilegeInfoTest();

        foreach($privilege as $key => $item) {
            // dump($item->pri_name);
        }
        return view('admin.privilege.index',[
            
            'privilege' => $privilege,
        ]);
    }

    // 处理修改
    public function privilege_doedit(Request $req,$id) {

        $privilege = Privilege::find($id);

        $privilege->fill( $req->all() );

        $privilege->save();

        return redirect()->route('privilege_index');
    }

    // 显示修改
    public function privilege_edit(Request $req,$id) {

        $privilege = Privilege::find($id);

        return view('admin.privilege.edit',[
            
            'privilege' => $privilege,
        ]);
    }


    // 处理添加
    public function privilege_docreate(Request $req) {

        $privilege = new Privilege;

        $privilege->create( $req->all() );

        return redirect()->route('privilege_index');
    }

    // 显示添加
    public function privilege_create() {

        return view('admin.privilege.create');
    }


    // 删除
    public function privilege_delete(Request $req,$id) {

        Privilege::destroy($id);

        return redirect()->route('privilege_index');
    } 
}