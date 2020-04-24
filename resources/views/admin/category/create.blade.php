<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			<li class="active"><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>
<center><h2>分类添加</h2><a type="button" class="btn btn-info" href="{{url('/category/index')}}">列表</a></center>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/category/store')}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" 
				   placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('cate_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类等级</label>
		<div class="col-sm-10">
			<select name="pid">
				<option value="0">顶级分类</option>
				@foreach($info as $v)
				<option value="{{$v->cate_id}}">{!!str_repeat("&nbsp;",$v["level"]*5)!!}{{$v->cate_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" checked>是
			<input type="radio" name="is_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_nav_show" value="1" checked>是
			<input type="radio" name="is_nav_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>