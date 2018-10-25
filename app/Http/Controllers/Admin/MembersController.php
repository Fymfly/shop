<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\MembersGrade;
use App\Models\Grade;
use DB;

class MembersController extends Controller
{
    // 会员列表
    public function members_index() {

        $members = new Grade();
        $data = $members->getAllGrade();

        return view('admin.members.index',[
            'data' => $data,
        ]);
    }


    // 处理增加表单
    public function members_docreate(Request $req) {

        $members = new Members;
        // dd($members);
        $members = Members::create($req->all());
        
        // 把数据保存到数据库
        $members->save();

        // 获取用户的id
        $members_id = (int)$members->id;
        // 获取等级的id
        $grade_id = $req->input('grade_id');

        DB::table('members_grades')
            ->insert([
                'members_id'=>$members_id,
                'grade_id'=>$grade_id
            ]);

        // $members_grades->save();
        // dd($user);
        return redirect()->route('members_index');
    }

    // 显示增加表单
    public function members_create(Request $req) {

        return view('admin.members.create');
    }

    // 处理修改表单
    public function members_doedit(Request $req, $id) {

        $members = Members::find($id);

        $members->fill( $req->all() );

        // dd($members);
        $grade_id = $req->input('grade_id');

        DB::table('members_grades')
        ->where('members_id',$id)
        ->update(['grade_id'=>$grade_id]);
            // DB::table('users')
            // ->where('id', 1)
            // ->update(['votes' => 1]);

        // 获取用户的id
        // $members_id = (int)$members->id;
        // $id = $members->id;
        // // 获取等级的id
        // $grade_id = $req->input('grade_id');

        // DB::table('members_grades')
        //     ->update([
        //         'id'=>$id,
        //         'grade_id'=>$grade_id
        //     ]);

        $members->save();

        return redirect()->route('members_index');
    }

    // 显示修改表单
    public function members_edit($id) {

        // 根据ID取出要修改的数据

        // $data = new Grade();
        // $members = $data->getAllGrade($id);

        $members = Members::find($id);

        // dd($members);

        // 显示表单并把数据传到页面
        return view('admin.members.edit',[
            'members' => $members,
        ]);
    }


    // 删除
    public function members_delete($id) {

        Members::destroy($id);
        return redirect()->route('members_index');
    }
}
