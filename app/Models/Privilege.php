<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Cache;
use DB;


class Privilege extends Model {

    public $timestamps = false;

    protected $table = 'privilege';
    // 设置允许字段
    protected $fillable = ['pri_name','url_path','parent_id','level','content'];


    //使用递归获取分类 （正式函数）
    public function getPrivilege($sourceItems, $targetItems, $pid=0){
        foreach ($sourceItems as $k => $v) {
            if($v->parent_id == $pid){
                $targetItems[] = $v;
                $this->getPrivilege($sourceItems, $targetItems, $v->id);
            }
        }
    }

     //使用递归获取分类信息测试函数 （测试正式函数）
     public function getPrivilegeTest($sourceItems, $targetItems, $pid=0, $str='ㅣ'){
        $str .= 'ㅡㅡ';
        foreach ($sourceItems as $k => $v) {
            if($v->parent_id == $pid){
                $v->pri_name = $str.$v->pri_name;
                $targetItems[] = $v;
                $this->getPrivilegeTest($sourceItems, $targetItems, $v->id, $str);
            }
        }
    }

    //使用递归获取分类信息 （正式函数）
    public function getPrivilegeInfo(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getPrivilege($sourceItems, $targetItems, 0);
        return $targetItems;
    }

    //测试函数 （测试正式函数）
    public function getPrivilegeInfoTest(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getPrivilegeTest($sourceItems, $targetItems);
        return $targetItems;
    }

}