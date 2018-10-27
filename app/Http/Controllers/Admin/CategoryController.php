<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    
    // 分类管理首页
    public function category_index(){
        $data = new Category;
        $category = $data->getCategoryInfoTest();
        // dd($category);
        foreach ($category as $key => $item) {
            // dump($item->category_name);
        }
        return view('admin.category.index',[
            'category' => $category,
        ]);

    }
    

    // 分类管理处理添加一级分类
    public function category_docreate(Request $req) {
          
        $name = $req->category_name;
        // dd($name);
        $category = new Category();
        $category->createOne( $name );
        // dd($category);
        
        // $category->save();


        return redirect()->route('category_index');
    }


    // 分类管理添加显示处理一级分类
    public function category_create() {

        return view('admin.category.create');
    }


    // 分类管理处理添加二级分类
    public function category_docreatet(Request $req) {
        
        $id = $req->id;
        $name = $req->category_name;
        $category = new Category;
        $category->createTwo($id,$name);

        return redirect()->route('category_index'); 
    }

    
    // 分类管理添加显示处理二级分类
    public function category_createt() {
        
        return view('admin.category.createt');
    }


    // 处理修改表单
    public function category_doedit(Request $req,$id) {

        // 根据ID取出要修改的数据
        $category = Category::find($id);

        // 为模型填充表单数据
        $category->fill( $req->all() );

        // 保存到数据库
        $category->save();

        return redirect()->route('category_index'); 

    }


    // 显示修改页面
    public function category_edit($id) {
        // dd('sdfsdf');
        $category = Category::find($id);
        // dd($category);
        return view('admin.category.edit',[
            'category' => $category,
        ]);
    }


    // 删除分类
    public function category_delete(Request $req) {
        // dd('sdfsfd');
        $id = $req->id;
        $category = new Category;
        $category->Categorydelete($id);

        return redirect()->route('category_index');
    }

}
