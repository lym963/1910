<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use DB;
class ProController extends Controller
{
    public function prolist(){
        $id=request()->id;
        if($id){
            $array=Category::get();
            $cateId=getCateId($array,$id);
            $goodsInfo=Goods::getGoodsInfoPid($cateId);
            return view("index.prolist",["goodsInfo"=>$goodsInfo]);
        }else{
            $goodsInfo=Goods::getGoodsInfo();
            return view("index.prolist",["goodsInfo"=>$goodsInfo]);
        }   
    }
    public function proinfo($id){
        $goodsInfoId=Goods::getGoodsInfoId($id);
        $goodsInfoId->goods_imgs=explode("|",$goodsInfoId->goods_imgs);
        return view("index.proinfo",["goodsInfoId"=>$goodsInfoId]);
    }
}
