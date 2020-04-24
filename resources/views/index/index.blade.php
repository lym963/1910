@extends('layouts.shop')
@section('title', '首页')
@section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">{{session("userLogin.user_name")}}</h1>
        <ul>
         <li><a href="{{url('/prolist')}}"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('/login')}}">登录</a></li>
      <li><a href="{{url('/reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      @foreach($slide as $img)
      <a href="{{url('/proinfo/'.$img->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$img->goods_img}}" /></a>
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
      @foreach($pid as $p)
      <li><a href="{{url('/prolist/'.$p->cate_id)}}">{{$p->cate_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
          @foreach($best as $b)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/proinfo/'.$b->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$b->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/proinfo/'.$b->goods_id)}}">{{$b->goods_name}}</a></dd>
        <dd class="ip-price"><strong>¥{{$b->goods_price}}</strong></dd>
       </dl>
      </div>
          @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
          @foreach($new as $n)
      <dl>
       <dt><a href="{{url('/proinfo/'.$n->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$n->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$n->goods_id)}}">{{$n->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$n->goods_price}}</strong> </div>
        <div class="prolist-yishou"><span>5.0折</span></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @include("index.public.foot")
@endsection