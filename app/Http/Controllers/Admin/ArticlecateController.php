<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articlecate;

class ArticlecateController extends Controller
{
    // 显示页面
    public function articlecate_index() {

        $articlecate = Articlecate::get();

        return view('admin.articlecate.index',[
            'articlecate' => $articlecate,
        ]);
    }

    // 处理修改
    public function articlecate_doedit(Request $req,$id){

        $articlecate = Articlecate::find($id);
        
        $articlecate->fill( $req->all() );

        $articlecate->save();

        return redirect()->route('articlecate_index');
    }

    // 显示修改
    public function articlecate_edit($id) {

        $articlecate = Articlecate::find($id);

        return view('admin.articlecate.edit',[

            'articlecate' => $articlecate,
        ]);
    }


    // 处理添加
    public function articlecate_docreate(Request $req) {

        $articlecate = new Articlecate;
        $articlecate = Articlecate::create( $req->all() );

        $articlecate->save();

        return redirect()->route('articlecate_index');
    }

    // 显示添加
    public function articlecate_create() {

        return view('admin.articlecate.create');
    }


    // 删除
    public function articlecate_delete($id) {

        Articlecate::destroy($id);

        return redirect()->route('articlecate_index');
    }
}
