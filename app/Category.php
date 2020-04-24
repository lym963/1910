<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="cate";
    protected $primaryKey="cate_id";
    public $timestamps=false;
    protected $guarded=[];

    //获取等级分类
    public static function getCatePidTop(){
        return self::select("cate_id","cate_name")->where("pid",0)->take(4)->get();
    }
}
