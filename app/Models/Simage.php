<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;

class Simage extends Model
{
    
    public $timestamps = false;

    protected $table = 'goods_image';
    // 设置允许字段
    protected $fillable = ['goods_id','bigImage','smlImage'];

    public static function goods_image($req,$goods_id) {

        foreach($req->image as $k=>$v) {

            if($req->has('image')&&$req->image[$k]->isValid()) {

                // $Image = new Image;
                $date = date('Y-m-d');
                $big_url = $req->file('image')[$k]->store('/goods/bigImg/'.$date);
                // dd($big_url);
                $path = $req->image[$k]->path();
                Image::configure(array('driver'=>'gd'));
                $img = Image::make($path);
                // dd($img);
                // 上传大图，等比例
                $img->resize(800,null,function($c){
                    $c->aspectRatio();
                });
                // dd(public_path('/uploads/goods/bigImg/'.$date));
                @mkdir(public_path('uploads/goods/bigImg/'.$date),0777,true);
                
                $img->save(public_path('/uploads/'.$big_url));

                // 上传小图 等比例
                $img->resize(400,null,function($c){
                    $c->aspectRatio();
                });
                $sm_url = $req->file('image')[$k]->store('/goods/smImg/'.$date);
                // dd($sm_url);
                @mkdir(public_path('uploads/goods/smImg/'.$date),0777,true);

                $img->save(public_path('uploads/'.$sm_url));

                DB::table('goods_image')
                    ->insert(['goods_id'=>$goods_id,'smlImage'=>$sm_url,'bigImage'=>$big_url]);
            }
        }


    }
}
