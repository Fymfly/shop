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
                $url = $req->file('image')[$k]->store('uploads/goods/bigImg/'.$date);
                $path = $req->image[$k]->path();
                Image::configure(array('driver'=>'gd'));
                $img = Image::make($path);
                // 上传大图，等比例
                $img->resize(100,null,function($c){
                    $c->aspectRatio();
                });
                @mkdir(public_path('uploads/goods/bigImg/'.$date),0777,true);
                $img->save(public_path($url));

                // 上传小图 等比例
                $img->resize(400,null,function($c){
                    $c->aspectRatio();
                });
                $smImg = str_replace('uploads/goods/bigImg/'.$date.'/','uploads/goods/smImg/'.$date.'/',$url);

                @mkdir(public_path('uploads/goods/smImg/'.$date),0777,true);

                $img->save(public_path($smImg));

                DB::table('goods_image')
                    ->insert(['goods_id'=>$goods_id,'smlImage'=>$smImg,'bigImage'=>$url]);
            }
        }
    }
}
