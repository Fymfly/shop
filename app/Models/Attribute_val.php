<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Attribute_val extends Model
{
    protected $fillable = ['attr_val','attr_key_id'];
    // public $timestamps = false;
    protected $table = 'goods_attribute_val';

    // public static function attribute_val() {

    //     $attribute_val = DB::table('attribute_key')
    //                     ->join('attribute_val','attribute_val.attr_key_id','=','attribute_key.id')
    //                     ->select('attribute_val.attr_val')
    //                     ->get();

    //     dd($attribute_val);die;
    //     return $attribute_val;
    // }

    public static function attribute_val($ids){
        return DB::select("
                          SELECT an.attr_name,GROUP_CONCAT(av.attr_val) as list
                          from goods_attribute_key an
                          LEFT JOIN goods_attribute_val av on av.attr_key_id = an.id
                          where an.id in ($ids)
                          GROUP BY an.id
                          ");

    }
}
