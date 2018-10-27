<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Cache;
use DB;


class Category extends Model {

    protected $table = 'category';
    // 设置允许字段
    protected $fillable = ['category_name','level','parent_id'];

    protected $primaryKey='id';
    public $timestamps=false;

    //使用递归获取分类 （正式函数）
    public function getCategory($sourceItems, $targetItems, $pid=0){
        foreach ($sourceItems as $k => $v) {
            if($v->parent_id == $pid){
                $targetItems[] = $v;
                $this->getCategory($sourceItems, $targetItems, $v->id);
            }
        }
    }


    // 添加一级分类
    public function createOne($name) {

        $category = new Category;
        $category->category_name = $name;

        // dd($name);
        $category->level = 0;
        $category->save();
    }


    // 添加二级分类
    public function createTwo($id,$name) {

        $category = new Category;
        $category->parent_id = $id;
        $category->category_name = $name;
        // $category->level = $level;
        $category->level = 1;
        $category->save();
    }


    // 修改分类
    // public function Categoryedit($id,$name) {

    //     $category = Category::where('id',$id)->first();
    //     $category->category_name = $name;
    //     $category->save();
    // }


    // 删除分类
    public function Categorydelete($id) {

        return Category::where('id',$id)->delete();
    }


    //使用递归获取分类信息测试函数 （测试正式函数）
    public function getCategoryTest($sourceItems, $targetItems, $pid=0, $str='ㅣ'){
        $str .= 'ㅡㅡ';
        foreach ($sourceItems as $k => $v) {
            if($v->parent_id == $pid){
                $v->category_name = $str.$v->category_name;
                $targetItems[] = $v;
                $this->getCategoryTest($sourceItems, $targetItems, $v->id, $str);
            }
        }
    }

    //使用递归获取分类信息 （正式函数）
    public function getCategoryInfo(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getCategory($sourceItems, $targetItems, 0);
        return $targetItems;
    }

    //测试函数 （测试正式函数）
    public function getCategoryInfoTest(){
        $sourceItems = $this->get();
        $targetItems = new Collection;
        $this->getCategoryTest($sourceItems, $targetItems);
        return $targetItems;
    }
}