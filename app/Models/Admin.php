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


    // 登录时判断权限
    public static function getUrl($adminid) {

        $data = DB::select("SELECT c.url_path
                            FROM admin_role as a
                            LEFT JOIN role_privilege as b ON a.role_id=b.role_id
                            LEFT JOIN privilege as c ON b.pri_id=c.id
                            WHERE a.admin_id={$adminid} AND c.url_path!=''
                            ");
        $ret = [];

        foreach($data as $v) {

            // 判断是否有多个URL（包含）
            if(FALSE === strpos($v->url_path,',')) {

                // 如果没有就直接拿过来
                $ret[] = $v->url_path;
            } else {

                // 如果有 就转成数组
                $tt = explode(',',$v->url_path);
                $ret = array_merge($ret,$tt);
            }
        }

        return $ret;

    }

}