<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Admin;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config("app.pageSize");
        $data=Admin::orderBy("admin_id","desc")->paginate($pageSize);
        return view("admin.admin.index",["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admin.create");
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
            'admin_name' => 'bail|required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}\dA-Za-z]{0,18}$/u',
            'admin_pwd' => 'bail|required|regex:/^\w{6,12}$/', 
            'admin_pwd_confirmation' => 'bail|required|same:admin_pwd', 
            'admin_tel' => 'bail|required|regex:/^1[34578][0-9]{9}$/',
            'admin_email' => 'bail|required|email',
        ],[
            "admin_name.required"=>"管理员名称不可为空",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"管理员名称格式不正确",
            "admin_pwd.required"=>"管理员密码不可为空",
            "admin_pwd.regex"=>"管理员密码必须为6至12位",
            "admin_pwd_confirmation.required"=>"确认密码不可为空",
            "admin_pwd_confirmation.same"=>"确认密码必须和密码一致",
            "admin_tel.required"=>"管理员手机号不可为空",
            "admin_tel.regex"=>"管理员手机号格式不正确",
            "admin_email.required"=>"管理员邮箱不可为空",
            "admin_email.email"=>"管理员邮箱格式不正确",
        
        ]);
        $data=$request->except(["_token","admin_pwd_confirmation"]);
        $data["admin_pwd"]=encrypt($data["admin_pwd"]);
        $data["admin_time"] = time();
        $res=Admin::insert($data);
        
        if($res){
            return redirect("/admin/index");
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
        $data=Admin::find($id);
        return view("admin.admin.edit",["data"=>$data]);
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
            'admin_name' => [
                'bail',
                'required',
                Rule::unique("admin")->ignore($id,"admin_id"),
                'regex:/^[\x{4e00}-\x{9fa5}\dA-Za-z]{0,18}$/u'
            ],
            'admin_pwd' => 'bail|required|regex:/^\w{6,12}$/', 
            'admin_pwd_confirmation' => 'bail|required|same:admin_pwd', 
            'admin_tel' => 'bail|required|regex:/^1[34578][0-9]{9}$/',
            'admin_email' => 'bail|required|email',
        ],[
            "admin_name.required"=>"管理员名称不可为空",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"管理员名称格式不正确",
            "admin_pwd.required"=>"管理员密码不可为空",
            "admin_pwd.regex"=>"管理员密码必须为6至12位",
            "admin_pwd_confirmation.required"=>"确认密码不可为空",
            "admin_pwd_confirmation.same"=>"确认密码必须和密码一致",
            "admin_tel.required"=>"管理员手机号不可为空",
            "admin_tel.regex"=>"管理员手机号格式不正确",
            "admin_email.required"=>"管理员邮箱不可为空",
            "admin_email.email"=>"管理员邮箱格式不正确",
        
        ]);
        $data=$request->except(["_token","admin_pwd_confirmation"]);
        $data["admin_pwd"]=encrypt($data["admin_pwd"]);
        $data["admin_time"]=time();
        $res=Admin::where("admin_id",$id)->update($data);
        if($res){
            return redirect("/admin/index");
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
        $res=Admin::destroy($id);
        if($res){
            return redirect("/admin/index");
        }
    }
}
