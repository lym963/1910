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
            <li class="active"><a href="{{url('/brand/index')}}">品牌管理</a></li>
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>

<table class="table table-hover">
<center><h2>品牌列表</h2><a href="{{url('/category/create')}}" class="btn btn-info">添加</a></center>
@if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
            <th>是否显示</th>
            <th>是否在导航显示</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($info as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{!!str_repeat("&nbsp;",$v->level*5)!!}{{$v->cate_name}}</td>
			<td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
            <td>@if($v->is_nav_show==1)是@endif @if($v->is_nav_show==2)否@endif</td>
            <td>
			<a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
			<a href="{{url('/category/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>