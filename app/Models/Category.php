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

    
    // 商品分类
    public function category(){
        $bool = DB::table('category')->insert(
            ['category_name'=>$category_name,'parent_id'=>$category_id,'level'=>'2']
          );
    }

    public $subCat=[];
    // 显示返回 分类的方法
    public static function catindex(){
        // 先获取所有的分类
        $catData = self::all();
        // dd($catData);
        // 在循环           
        $cat = [];
        foreach($catData as $k=>$v){
            // 判断是否是一级分类
            if($v->parent_id==0){
                // 如果等于一级分类 就删除这个值的下标
                unset($catData[$k]);
                // 判断是否是二级分类
                foreach($catData as $k1=>$v1){
                    if($v1->parent_id==$v->id && $v1->level==0){
                        unset($catData[$k1]);
                        // 判断是否是三级分类 并赋值
                        foreach($catData as $k2=>$v2){
                            if($v2->level==$v1->id){
                                unset($catData[$k2]);
                                $v1->subCat[] = $v2;
                            }
                        }
                        // dd($v1);
                        $v->subCat[] = $v1;
                    }
                }
                // dd($v);
                $cat[] = $v;
            }
        }
        dd($cat);
        return $cat;
    }



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
        $category->level = 2;
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