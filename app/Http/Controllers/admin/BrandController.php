<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Validation\Rule;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name=request()->brand_name;
        $where=[];
        //判断搜索条件是否为空
        if($brand_name){
            $where[]=["brand_name","like","%$brand_name%"];
        }
        //获取品牌db信息
        //$data=DB::table("brand")->get();
        //ORM
        $pageSize=config("app.pageSize");
        $data=Brand::orderBy("brand_id","desc")->where($where)->paginate($pageSize);
        if(request()->ajax()){
            return view("admin.brand.ajaxIndex",["data"=>$data,"brand_name"=>$brand_name]);
        }
        return view("admin.brand.index",["data"=>$data,"brand_name"=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandPost $request)
    {
        //表单验证
        // $request->validate([ 
        //     'brand_name' => 'bail|required|unique:brand|max:20',
        //     'brand_url' => 'bail|required|unique:brand|max:50', 
        // ],[
        //     "brand_name.required"=>"品牌名称不可为空",
        //     "brand_name.unique"=>"品牌名称已存在",
        //     "brand_name.max"=>"品牌名称最大为20",
        //     "brand_url.required"=>"品牌网址不可为空",
        //     "brand_url.unique"=>"品牌网址已存在",
        //     "brand_url.max"=>"品牌网址最大为50",
        // ]);
        //筛选接值   only
        $data=$request->except(["_token"]);
        //文件上传
        if($request->hasFile("brand_logo")){
            $data["brand_logo"]=upload("brand_logo");
        }
        //添加入库
        //$res=DB::table("brand")->insert($data);
        $res=Brand::create($data);
        //判断
        if($res){
            return redirect("/brand/index");
        }
    }

    /**
     * Display the specified resource.
     *预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$data=DB::table("brand")->where("brand_id",$id)->first();
        $data=Brand::find($id);
        return view("admin.brand.edit",["brand"=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行更新
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(StoreBrandPost $request, $id)
    public function update(Request $request, $id)
    {
        // //表单验证
        // $request->validate([ 
        //     'brand_name' => 'bail|required|unique:brand|max:20',
        //     'brand_url' => 'bail|required|unique:brand|max:50', 
        // ],[
        //     "brand_name.required"=>"品牌名称不可为空",
        //     "brand_name.unique"=>"品牌名称已存在",
        //     "brand_name.max"=>"品牌名称最大为20",
        //     "brand_url.required"=>"品牌网址不可为空",
        //     "brand_url.unique"=>"品牌网址已存在",
        //     "brand_url.max"=>"品牌网址最大为50",
        // ]);
        $data=$request->except(["_token"]);
        //手动创建验证器
        $validator = Validator::make($data, [ 
            'brand_name' => [
                'required',
                Rule::unique('brand')->ignore($id,"brand_id"),
                'max:50'
            ], 
            'brand_url' => [
                'required',
                Rule::unique('brand')->ignore($id,"brand_id"),
                'max:50'
            ], 
        ],[
            "brand_name.required"=>"品牌名称不可为空",
            "brand_name.unique"=>"品牌名称已存在",
            "brand_name.max"=>"品牌名称最大为20",
            "brand_url.required"=>"品牌网址不可为空",
            "brand_url.unique"=>"品牌网址已存在",
            "brand_url.max"=>"品牌网址最大为50",
        ]);
        if ($validator->fails()) {
            return redirect('/brand/edit/'.$id)->withErrors($validator)->withInput(); 
        }
        //dd(1);
        //文件上传
        if($request->hasFile("brand_logo")){
            $data["brand_logo"]=upload("brand_logo");
        }
        //$res=DB::table("brand")->where("brand_id",$id)->update($data);
        $res=Brand::where("brand_id",$id)->update($data);
        if($res!==false){
            return redirect("/brand/index/");
        }
    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=DB::table("brand")->where("brand_id",$id)->value("brand_logo");
        if($data){
            unlink(storage_path("app/".$data));
        }
        //$res=DB::table("brand")->where("brand_id",$id)->delete();
        $res=Brand::destroy($id);
        if($res){
            return redirect("/brand/index");
        }
    }
}
