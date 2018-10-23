<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TestController extends Controller
{
    public function test() {

        // 原始SQL
        // DB::insert('insert into admin(name,pass) values(?,?)', ['root','21232f297a57a5a743894a0e4a801fc3']);
        // DB::select('select * from admin where id =?',[1]);

        // 流行

        // 插入
        DB::table('admin')->insertGetId([
            'name' => 'root',
            'pass' => '21232f297a57a5a743894a0e4a801fc3',
        ]);
        

        // 修改
        // DB::table('admin')
        //     ->where('id','>',4)
        //     ->update([
        //         'name' => '玥饼',
        // ]);

        
        // 删除
        // DB::table('admin')->truncate();
    }
}
