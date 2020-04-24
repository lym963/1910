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
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li class="active"><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>

<table class="table table-hover">
<center><h2>商品列表</h2><a href="{{url('/admin/create')}}" class="btn btn-info">添加</a></center>

	<thead>
		<tr>
			<th>管理员ID</th>
			<th>管理员名称</th>
			<th>管理员手机号</th>
			<th>管理员邮箱</th>
			<th>添加时间</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($data as $v)
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>
			<td>{{$v->admin_email}}</td>
			<td>{{$v->admin_time}}</td>
            <td>
			<a href="{{url('/admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
			<a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
	
</table>
 <center>{{$data->links()}}</center>
</body>
</html>