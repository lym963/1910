<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城</title>
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
            <li class="active"><a href="{{url('/brand/index')}}">品牌管理</a></li>
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>

<table class="table table-hover">
<center><h2>品牌列表</h2><a href="{{url('/brand/create')}}" class="btn btn-info">添加</a></center>
@if ($errors->any()) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<h3><font color="red">{{ $error }}</font></h3>
			@endforeach
		</ul> 
	</div>
@endif
<center>
<form>
	<input type="text" name="brand_name" placeholder="请输入品牌名称的关键字" value="{{$brand_name}}">
	<input type="submit" value="搜索">
</form>
</center>
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
            <th>品牌网址</th>
            <th>品牌LOGO</th>
            <th>品牌描述</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($data as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
            <td>{{$v->brand_url}}</td>
            <td>@if($v->brand_logo)<img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px">@endif</td>
            <td>{{$v->brand_desc}}</td>
            <td>
			<a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
			<a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td>{{$data->appends(["brand_name"=>$brand_name])->links()}}</td></tr>
	</tbody>
	
</table>
</body>
<script>
$(document).on("click",".page-item a",function(){
	var url=$(this).attr("href")
	$.ajaxSetup({ 
		headers:{ 
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			} 
		});
	$.post(url,function(ked){
		$("tbody").html(ked)
	})
	return false
})
</script>
</html>