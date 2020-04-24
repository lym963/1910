<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商城--管理员管理</title>
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
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li class="active"><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>
<center><h2>管理员修改</h2><a type="button" class="btn btn-info" href="{{url('/admin/index')}}">列表</a></center>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/admin/update/'.$data->admin_id)}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" value="{{$data->admin_name}}" placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('admin_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" placeholder="请输入密码">
				   <span style="color:red">{{$errors->first('admin_pwd')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd_confirmation" placeholder="请输入确认密码">
				   <span style="color:red">{{$errors->first('admin_pwd_confirmation')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_tel" value="{{$data->admin_tel}}" placeholder="请输入手机号">
				   <span style="color:red">{{$errors->first('admin_tel')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_email" value="{{$data->admin_email}}" placeholder="请输入邮箱">
				   <span style="color:red">{{$errors->first('admin_email')}}</span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>