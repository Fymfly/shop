<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articlelist;
use App\Models\Articlecate;
use DB;

class ArticlelistController extends Controller
{
    // 显示页面
    public function articlelist_index() {

        // $articlelist = DB::table('article_list')->get()->toArray();
        $articlelist = DB::table('article_list')
                        ->join('article_caregory', 'article_list.article_cate_id', '=', 'article_caregory.id')
                        ->select('article_list.*','article_caregory.carename')
                        ->get();
      
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

        $articlecate = Articlecate::get();

        // dd($articlecate);
        return view('admin.articlelist.edit',[
            'articlelist' => $articlelist,
            'articlecate' => $articlecate,
        ]);
    }


    // 处理添加
    public function articlelist_docreate(Request $req) {

        $articlelist = new Articlelist;
        
        // dd($articlelist); 
        $articlelist = Articlelist::create( $req->all() );
        
        // $articlelist->save();

        return redirect()->route('articlelist_index');
    }

    // 显示添加页面
    public function articlelist_create() {
        
        $articlecate = Articlecate::get();

        // dd($articlecate);
        
        return view('admin.articlelist.create',[

            'articlecate' => $articlecate,
        ]);
    }


    // 删除
    public function articlelist_delete($id) {

        Articlelist::destroy($id);
        return redirect()->route('articlelist_index');
    }
}
