<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Cache;
class NewController extends Controller
{
    public function new(){
        $cate_name=request()->cate_name;
        $page=request()->page;
        $where=[];
        if($cate_name){
            $where[]=["cate_name","like","%$cate_name%"];
        }
        $pageSize=config("app.pageSize");
        $cateInfo=Cache::get("cateInfo".$page ."_".$cate_name);

        if(!$cateInfo){
            $cateInfo=Category::where($where)->paginate($pageSize);
            Cache::put("cateInfo".$page."_".$cate_name,$cateInfo,300);
        }
       
        if(request()->ajax()){
            return view("index.newAjax",["cateInfo"=>$cateInfo,"cate_name"=>$cate_name]);
        }
        return view("index.new",["cateInfo"=>$cateInfo,"cate_name"=>$cate_name]);
    }
}
