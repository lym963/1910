<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Goods;
use App\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::connection()->enableQueryLog();
        //搜索分类品牌下拉框
        $res=Category::get();
        $brand=Brand::get();
        $info=getCategoryInfo($res);
        //接搜索值
        $goods_name=request()->goods_name;
        $cate_id=request()->cate_id;
        $brand_id=request()->brand_id;
        $where=[];
        //判断搜索值是否为空  拼接条件
        if($goods_name){
            $where[]=["goods_name","like","%$goods_name%"];
        }
        if($cate_id){
            $where[]=["goods.cate_id","=",$cate_id];
        }
        if($brand_id){
            $where[]=["goods.brand_id","=",$brand_id];
        }
        $pageSize=config("app.pageSize");
        $data=Goods::select("goods.*","cate.cate_name","brand.brand_name")
                   ->where($where)
                   ->leftJoin("cate","goods.cate_id","=","cate.cate_id")
                   ->leftJoin("brand","goods.brand_id","=","brand.brand_id")
                   ->orderBy("goods_id","desc")
                   ->paginate($pageSize);
        foreach($data as $k=>$v){
            $data[$k]->goods_imgs=explode("|",$v->goods_imgs);
        }
        $search=request()->all();
        // echo Cookie::get("adminRemember");
        // echo Cookie::get("pwd");
        
        // $logs = DB::getQueryLog();
        // dd($logs);
        //判断是不是ajax请求
        if(request()->ajax()){
            return view("admin.goods.ajaxIndex",["data"=>$data,"info"=>$info,"brand"=>$brand,"search"=>$search]);
        }
        return view("admin.goods.index",["data"=>$data,"info"=>$info,"brand"=>$brand,"search"=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res=Category::get();
        $brand=Brand::get();
        $info=getCategoryInfo($res);
        return view("admin.goods.create",["info"=>$info,"brand"=>$brand]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $request->validate([ 
            'goods_name' => 'bail|required|unique:goods|regex:/^[\x{4e00}-\x{9fa5}\w_]{2,50}$/u',
            'goods_price' => 'bail|required|regex:/^\d+$/', 
            'goods_num' => 'bail|required|regex:/^\d{0,8}$/', 
            'cate_id' => 'bail|required',
            'brand_id' => 'bail|required',
        ],[
            "goods_name.required"=>"商品名称不可为空",
            "goods_name.unique"=>"商品名称已存在",
            "goods_name.regex"=>"商品名称格式不正确",
            "goods_price.required"=>"商品价格不可为空",
            "goods_price.regex"=>"商品价格必须为数字",
            "goods_num.required"=>"商品库存不可为空",
            "goods_num.regex"=>"商品库存必须为数字且不能大于8位",
            "cate_id.required"=>"请选择商品分类",
            "brand_id.required"=>"请选择商品品牌",
        
        ]);
        $data=$request->except(["_token"]);
        //文件上传
        if($request->hasFile("goods_img")){
            $data["goods_img"]=upload("goods_img");
        }
        //多文件上传
        //判断是否有值
        if(isset($data["goods_imgs"])){
            $data["goods_imgs"]=uploads("goods_imgs");
        }
        $res=Goods::create($data);
        //判断
        if($res){
            return redirect("/goods/index");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Goods::find($id);
        //将相册转为数组
        $data->goods_imgs=explode("|",$data->goods_imgs);
        $res=Category::get();
        $brand=Brand::get();
        $info=getCategoryInfo($res);
        return view("admin.goods.edit",["data"=>$data,"info"=>$info,"brand"=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //表单验证
        $request->validate([ 
            'goods_name' => [
                'bail',
                'required',
                Rule::unique("goods")->ignore($id,"goods_id"),
                'regex:/^[\x{4e00}-\x{9fa5}\w_]{2,50}$/u'
            ],
            'goods_price' => 'bail|required|regex:/^\d+$/', 
            'goods_num' => 'bail|required|regex:/^\d{0,8}$/', 
            'cate_id' => 'bail|required',
            'brand_id' => 'bail|required',
        ],[
            "goods_name.required"=>"商品名称不可为空",
            "goods_name.unique"=>"商品名称已存在",
            "goods_name.regex"=>"商品名称格式不正确",
            "goods_price.required"=>"商品价格不可为空",
            "goods_price.regex"=>"商品价格必须为数字",
            "goods_num.required"=>"商品库存不可为空",
            "goods_num.regex"=>"商品库存必须为数字且不能大于8位",
            "cate_id.required"=>"请选择商品分类",
            "brand_id.required"=>"请选择商品品牌",
        
        ]);
        $data=$request->except("_token");
        //文件上传
        if($request->hasFile("goods_img")){
            $data["goods_img"]=upload("goods_img");
        }
        //多文件上传
        //判断是否有值
        if(isset($data["goods_imgs"])){
            $data["goods_imgs"]=uploads("goods_imgs");
        }
        $res=Goods::where("goods_id",$id)->update($data);
        if($res!==false){
            return redirect("/goods/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Goods::destroy($id);
        if($res){
            return redirect("/goods/index");
        }
    }
}
