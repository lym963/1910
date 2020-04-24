@extends('layouts.shop')
@section('title', '登陆')
@section('content')
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/register')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_name" id="name" placeholder="输入手机号码或者邮箱号" /></div>
       <span id="nameSpan"></span>
       <div class="lrList2"><input type="text" id="code" placeholder="输入短信或邮箱验证码" /> <button type="button">获取验证码</button></div>
       <span id="codeSpan"></span>
       <div class="lrList"><input type="password" name="user_pwd" id="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <span id="pwdSpan">{{$errors->first('user_pwd')}}</span>
       <div class="lrList"><input type="password" name="user_pwd_confirmation" id="pwds" placeholder="再次输入密码" /></div>
       <span id="pwdsSpan">{{$errors->first('user_pwd_confirmation')}}</span>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @include("index.public.foot")
     <script>
          $("button").click(function(){
               var name=$("#name").val()
               if(!name){
                    $("#nameSpan").html("<font color=red>*手机号或邮箱号不可为空</font>")
                    return false;
               }
               var reg=/^1[3|5|6|7|8|9]\d{9}$/
               var preg=/^\w{5,15}@(qq|163)\.(com|cn)$/
               $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
               if(reg.test(name)){
                    $.post("/sendSms",{mobile:name},function(result){
                         $("#nameSpan").html("<font color=green>*"+result.msg+"</font>")
                    },"json")
                    return false;
               }else if(preg.test(name)){
                    $.post("/sendEmail",{email:name},function(result){
                         $("#nameSpan").html("<font color=green>*"+result.msg+"</font>")
                    },"json")
                    return false;
               }else{
                    $("#nameSpan").html("<font color=red>*手机号或邮箱号格式不正确</font>")
                    return false;          
               }
          })
          $("#code").blur(function(){
               var code=$("#code").val()
               if(!code){
                    $("#codeSpan").html("<font color=red>*验证码不可为空</font>")
                    return false;
               }
               $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
               $.post("/register",{code:code},function(result){
                         $("#codeSpan").html("<font color=green>*"+result.msg+"</font>")
               },"json")
          })
          $("#user_pwd").blur(function(){
               var pwd=$("#user_pwd").val()
               if(!pwd){
                    $("#pwdSpan").html("<font color=red>*密码不可为空</font>")
                    return false;
               }
               var preg=/^\w{5,18}$/
               if(!preg.test(pwd)){
                    $("#pwdSpan").html("<font color=red>*密码格式不正确(由5-15位字母数字下划线组成)</font>")
                    return false;
               }else{
                    $("#pwdSpan").html("<font color=green>*√</font>")
               }
          })
          $("#pwds").blur(function(){
               var pwd=$("#user_pwd").val()
               var pwds=$("#pwds").val()
               if(pwd!=pwds){
                    $("#pwdsSpan").html("<font color=red>*确认密码必须和密码一致</font>")
                    return false;
               }else{
                    $("#pwdsSpan").html("<font color=green>*√</font>")
               }
          })
          
     </script>
@endsection