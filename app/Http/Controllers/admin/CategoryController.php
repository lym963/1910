<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Http\Requests\StoreCategoryPost;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *详情列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Category::get();
        $info=getCategoryInfo($res);
        //dd($info);
        return view("admin.category.index",["info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res=Category::get();
        $info=getCategoryInfo($res);
        //dd($info);
        return view("admin.category.create",["info"=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPost $request)
    {
        //表单验证
        // $request->validate([ 
        //     'cate_name' => 'bail|required|unique:cate|max:20', 
        // ],[
        //     "cate_name.required"=>"分类名称不可为空",
        //     "cate_name.unique"=>"分类名称已存在",
        //     "cate_name.max"=>"分类名称最大为20",
        // ]);
        $data=$request->except("_token");
        $name=$request->only("cate_name");
        $res=Category::create($data);
        if($res){
            return redirect("/category/index");
        }
        //return redirect("/category/create")->withErrors(["分类名称已存在"]);
    }

    /**
     * Display the specified resource.
     *详情展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::find($id);
        $res=Category::get();
        $info=getCategoryInfo($res);
        return view("admin.category.edit",["data"=>$data,"info"=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(StoreCategoryPost $request, $id)
    public function update(Request $request, $id)
    {
        //表单验证
        $request->validate([ 
            'cate_name' => [
                'bail',
                'required',
                Rule::unique("cate")->ignore($id,"cate_id"),
                'max:20'
            ], 
        ],[
            "cate_name.required"=>"分类名称不可为空",
            "cate_name.unique"=>"分类名称已存在",
            "cate_name.max"=>"分类名称最大为20",
        ]);
        $data=$request->except("_token");
        $res=Category::where("cate_id",$id)->update($data);
        if($res!==false){
            return redirect("/category/index");
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
        $res=Category::where("pid",$id)->first();
        if($res==null){
            $res1=Category::destroy($id);
            if($res1){
                return redirect("/category/index");
            }
        }else{
            return redirect("/category/index")->withErrors("该分类下有子分类");
        }
    }
}
