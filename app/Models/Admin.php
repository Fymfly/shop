<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;


class Admin extends Model {

    protected $table = 'admin';
    // 设置允许字段
    protected $fillable = ['name','mobile','password','email'];


     // 获取管理员对应的权限
     public function role_privilege() {

        $admin_id = session::get('id');

        $admin_pri = DB::table('admin_role')
                        ->join('role_privilege','admin_role.role_id','=','role_privilege.role_id')
                        ->join('privilege','role_privilege.pri_id','=','privilege.id')
                        ->where([['admin_role.admin_id',$admin_id],
                                ['privilege.url_path','!=','']
                        ])->get();
        dd($admin_id);

        // 把二维数组转为一维数组
        $_ret = [];

        foreach($admin_pri as $k => $v) {

        
        }
    } 

}