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

<center><h2>欢迎登陆</h2></center>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/login/doLogin')}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="admin_name" value="{{ request()->cookie('adminRemember') }}" placeholder="请输入用户名">
				   <span style="color:red">{{$errors->first('admin_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-9">
			<input type="password" class="form-control" name="admin_pwd" value="{{ request()->cookie('pwd') }}" placeholder="请输入密码">
				   <span style="color:red">{{$errors->first('admin_pwd')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label"></label>
		<div class="col-sm-9">
			<input type="checkbox" name="remember" value="1">记住密码
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label"></label>
		<div class="col-sm-9">
			<input type="checkbox" name="avoid" value="1">七天免登陆
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登陆</button>
		</div>
	</div>
</form>

</body>
</html>