<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Goods;
use App\Category;
class IndexController extends Controller
{
    //首页
    public function index(){
        $is_slide=Goods::getIndexSlide();
        $pid=Category::getCatePidTop();
        $is_best=Goods::getIndexBest();
        $is_new=Goods::getIndexNew();
        return view("index.index",["slide"=>$is_slide,"pid"=>$pid,"best"=>$is_best,"new"=>$is_new]);
    }
    //登陆
    public function login(){
        return view("index.login");
    }
    //注册
    public function reg(){
        return view("index.reg");
    }
    //执行注册
    public function register(){
        
        $data=request()->except(["_token","user_pwd_confirmation"]);
        $codeSession=session("code");
        if(request()->ajax()){
            if($data["code"]==$codeSession){
                echo json_encode(["code"=>"00001","msg"=>"√"]);
                die;
            }else{
                echo json_encode(["code"=>"00001","msg"=>"验证码不正确"]);
                die;
            }
        }
        //注册验证
        request()->validate([ 
            'user_pwd' => 'bail|required|regex:/^\w{5,15}$/', 
            'user_pwd_confirmation' => 'bail|same:user_pwd', 
        ],[
            "user_pwd.required"=>"密码不可为空",
            "user_pwd.regex"=>"密码格式不正确(由5至15位字母数字下划线组成)",
            "user_pwd_confirmation.same"=>"确认密码必须和密码一致",
        ]);
        $data["user_pwd"]=encrypt($data["user_pwd"]);
        $data["user_time"]=time();
        $res=Users::create($data);
        if($res){
            return redirect("/login");
        }
    }
    //执行登陆
    public function doLogin(){
        $data=request()->except("_token");
        $user_name=Users::where("user_name",$data["user_name"])->first();
        if(!$user_name){
            return redirect("/login")->with("msg","用户名或密码错误");
        }
        if(decrypt($user_name->user_pwd)!=$data["user_pwd"]){
            return redirect("/login")->with("msg","用户名或密码错误");
        }else{
            session(["userLogin"=>$user_name]);
            request()->session()->save();
            if($data["refer"]){
                return redirect($data["refer"]);
            }
            return redirect("/");
        }
        
    }
    //手机发送
    public function sendSms(){
       $mobile=request()->mobile;
       $preg="/^1[3|5|6|7|8|9]\d{9}$/";
       if(!preg_match($preg,$mobile)){
            echo json_encode(["code"=>"00001","msg"=>"手机号格式不正确"]);
            die;
       }
       $code=rand(100000,999999);
       //$res=sendMobile($mobile,$code);
       $res["Message"]="OK";
       if($res["Message"]=="OK"){
            session(["code"=>$code]);
            request()->session()->save();
            echo json_encode(["code"=>"00000","msg"=>"发送成功"]);
            die;
       }else{
            echo json_encode(["code"=>"00001","msg"=>"发送失败"]);
            die;
       }
    }
    //邮箱发送
    public function sendEmail(){
        $email=request()->email;
        $preg="/^\w{5,15}@(qq|163)\.(com|cn)$/";
        if(!preg_match($preg,$email)){
            echo json_encode(["code"=>"00001","msg"=>"邮箱格式不正确"]);
            die;
        }
        $code=rand(100000,999999);
        sendEmail($email,$code);
        session(["code"=>$code]);
        request()->session()->save();
        echo json_encode(["code"=>"00000","msg"=>"发送成功"]);die;
    }
}
