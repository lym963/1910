<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site;
use Illuminate\Validation\Rule;
class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site_name=request()->site_name;
        $id=request()->id;
        $where=[];
        if($site_name){
            $where[]=["site_name","like","%$site_name%"];
        }
        $pageSize=config("app.pageSize");
        if(request()->ajax()){
            Site::destroy($id);
            $data=Site::where($where)->orderBy("site_id","desc")->paginate($pageSize);
            return view("admin.site.ajaxIndex",["data"=>$data,"site_name"=>$site_name]);
        }
        $data=Site::where($where)->orderBy("site_id","desc")->paginate($pageSize);
        return view("admin.site.index",["data"=>$data,"site_name"=>$site_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.site.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $ajax=$request->all();
            $isName=Site::where("site_name",$ajax)->first();
            if($isName){
                return 1;
            }else{
                return 2;
            }
        }
        //表单验证
        $request->validate([ 
            'site_name' => 'bail|required|unique:site|regex:/^[\x{4e00}-\x{9fa5}\w_]+$/u',
            'site_url' => 'bail|required|regex:/^http:\/\/\w+$/', 
        ],[
            "site_name.required"=>"网站名称不可为空",
            "site_name.unique"=>"网站名称已存在",
            "site_name.regex"=>"网站名称格式不正确",
            "site_url.required"=>"网站网址不可为空",
            "site_url.regex"=>"网站网址必须以http://开头",
        ]);
        $data=$request->except("_token");
        //文件上传
        if($request->hasFile("site_logo")){
            $data["site_logo"]=upload("site_logo");
        }
        $res=Site::create($data);
        //判断
        if($res){
            return redirect("/site/index");
        }
    }
    public function ajax(){

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
        $data=Site::find($id);
        return view("admin.site.edit",["data"=>$data]);
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
            'site_name' => [
                'bail',
                'required',
                Rule::unique("site")->ignore($id,"site_id"),
                'regex:/^[\x{4e00}-\x{9fa5}\w_]+$/u'
            ],
            'site_url' => 'bail|required|regex:/^http:\/\/\w+$/', 
        ],[
            "site_name.required"=>"网站名称不可为空",
            "site_name.unique"=>"网站名称已存在",
            "site_name.regex"=>"网站名称格式不正确",
            "site_url.required"=>"网站网址不可为空",
            "site_url.regex"=>"网站网址必须以http://开头",
        ]);
        $data=$request->except("_token");
        //文件上传
        if($request->hasFile("site_logo")){
            $data["site_logo"]=upload("site_logo");
        }
        $res=Site::where("site_id",$id)->update($data);
        if($res){
            return redirect("/site/index");
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
       
    }
}
