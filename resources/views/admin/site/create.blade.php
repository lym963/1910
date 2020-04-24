<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商城--友情链接管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="{{url('/goods/index')}}">商品管理</a></li>
            <li><a href="{{url('/brand/index')}}">品牌管理</a></li>
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
			<li class="active"><a href="{{url('/site/index')}}">友情链接管理</a></li>
        </ul>
    </div>
    </div>
</nav>
<center><h2>友情链接添加</h2><a type="button" class="btn btn-info" href="{{url('/site/index')}}">列表</a></center>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/site/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="site_name" id="site_name" placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('site_name')}}</span>
				   <span id="nameSpan"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="site_url" id="site_url" placeholder="请输入网址">
				   <span style="color:red">{{$errors->first('site_url')}}</span>
				   <span id="urlSpan"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">链接类型</label>
		<div class="col-sm-10">
			<input type="radio" name="site_type" value="1" checked>LOGO链接
			<input type="radio" name="site_type" value="2">文字链接
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">图片LOGO</label>
		<div class="col-sm-10">
			<input type="file" name="site_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="site_man" placeholder="请输入联系人">
				   <span style="color:red">{{$errors->first('site_man')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-10">
			<textarea name="site_desc" class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="site_show" value="1" checked>是
			<input type="radio" name="site_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
<script src="http://js.com/jquery.js"></script>
<script>
$(function(){
	$("#site_name").blur(function(){
		var name=$(this).val();
		if(!name){
			$("#nameSpan").html("<font color=red>*网站名称不可为空</font>")
			return false;
		}
		var page=/^[\u4e00-\u9fa5\w]+$/
		if(!page.test(name)){
			$("#nameSpan").html("<font color=red>*网站名称格式不正确(中文数组字母或下划线)</font>")
			return false;
		}
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		$.ajax({
			url:"{{url('/site/store/')}}",
			type:"post",
			data:{name:name},
			success:function(ked){
				if(ked==1){
					$("#nameSpan").html("<font color=red>*网站名称已存在</font>")
				}else{
					$("#nameSpan").html("<font color=green>*√</font>")
				}
			}
		})
	})
	$("#site_url").blur(function(){
		var urls=$(this).val()
		if(!urls){
			$("#urlSpan").html("<font color=red>*网站网址不可为空</font>")
			return false;
		}
		var page=/^http:\/\/\w+$/
		if(!page.test(urls)){
			$("#urlSpan").html("<font color=red>*网站网址格式不正确(必须以http://开头)</font>")
		}else{
			$("#urlSpan").html("<font color=green>*√</font>")
		}
	})
})
</script>
</html>

