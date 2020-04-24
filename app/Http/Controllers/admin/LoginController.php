<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function doLogin(Request $request){
        //接值
        $name=$request->admin_name;
        $pwd=$request->admin_pwd;
        $remember=$request->remember;
        $avoid=$request->avoid;
        //查询数据库是否存在改用户名
        $adminUser=Admin::where("admin_name",$name)->first();
        if(!$adminUser){
            return redirect("/login/index")->with("msg","用户名或密码错误");
        }
        if(decrypt($adminUser->admin_pwd)!=$pwd){
            return redirect("/login/index")->with("msg","用户名或密码错误");
        }
        session(["adminUser"=>$adminUser]);
        //判断是否是记住密码
        if($remember){
            Cookie::queue("adminRemember",$name,60*24*7);
            Cookie::queue("pwd",$pwd,60*24*7);
        }
        if($avoid){
            Cookie::queue("adminUser",serialize($adminUser),60*24*7);
        }
        return redirect("/goods/index");
    }
}
