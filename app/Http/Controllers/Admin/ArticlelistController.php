<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articlelist;
use DB;

class ArticlelistController extends Controller
{
    // 显示页面
    public function articlelist_index() {

        $articlelist = DB::table('article_list')->get()->toArray();
      
        return view('admin.articlelist.index',[
            'articlelist' => $articlelist,
        ]);
    }

    
    // 处理修改表单
    public function articlelist_doedit(Request $req,$id) {

        $articlelist = Articlelist::find($id);

        $articlelist->fill( $req->all() );

        $articlelist->save();

        return redirect()->route('articlelist_index');
    }

    // 显示修改页面
    public function articlelist_edit($id) {

        $articlelist = Articlelist::find($id);

        return view('admin.articlelist.edit',[
            'articlelist' => $articlelist,
        ]);
    }


    // 处理添加
    public function articlelist_docreate(Request $req) {

        $articlelist = new Articlelist;
        $articlelist = Articlelist::create( $req->all() );
        
        $articlelist->save();

        return redirect()->route('articlelist_index');
    }

    // 显示添加页面
    public function articlelist_create() {

        return view('admin.articlelist.create');
    }


    // 删除
    public function articlelist_delete($id) {

        Articlelist::destroy($id);
        return redirect()->route('articlelist_index');
    }
}
