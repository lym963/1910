<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table="goods";
    protected $primaryKey="goods_id";
    public $timestamps=false;
    protected $guarded=[];

    //获取首页幻灯片数据
    public static function getIndexSlide(){
        return Goods::select("goods_id","goods_img")->where("is_slide",1)->orderBy("goods_id","desc")->take(5)->get();
    }
    //获取推荐数据
    public static function getIndexBest(){
        return Goods::select("goods_id","goods_img","goods_name","goods_price")->where("is_best",1)->orderBy("goods_id","desc")->take(8)->get();
    }
    //获取新品数据
    public static function getIndexNew(){
        return Goods::select("goods_id","goods_img","goods_name","goods_price")->where("is_new",1)->orderBy("goods_id","desc")->take(3)->get();
    }
    //获取商品详情
    public static function getGoodsInfoId($id){
        return self::find($id);
    }
    //获取商品列表
    public static function getGoodsInfo(){
        return self::orderBy("goods_id","desc")->get();
    }
    public static function getGoodsInfoPid($id){
        return self::whereIn("cate_id",$id)->orderBy("goods_id","desc")->get();
    }
}
