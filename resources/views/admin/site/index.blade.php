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
            <li><a href="{{url('/brand/index')}}">品牌管理</a></li>
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
			<li class="active"><a href="{{url('/site/index')}}">友情链接管理</a></li>
        </ul>
    </div>
    </div>
</nav>

<table class="table table-hover">
<center><h2>友情链接列表</h2><a href="{{url('/site/create')}}" class="btn btn-info">添加</a></center>
<center>
<form>
	<input type="text" name="site_name" id="site_name" placeholder="请输入网站名称的关键字" value="{{$site_name}}">
	<input type="submit" value="搜索">
</form>
</center>
	<thead>
		<tr>
			<th>网站ID</th>
			<th>网站名称</th>
			<th>网站网址</th>
			<th>链接类型</th>
			<th>网站LOGO</th>
			<th>网站联系人</th>
			<th>网站介绍</th>
			<th>是否显示</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($data as $v)
		<tr>
			<td>{{$v->site_id}}</td>
			<td>{{$v->site_name}}</td>
			<td>{{$v->site_url}}</td>
			<td>@if($v->site_type==1)LOGO链接@endif @if($v->site_type==2)文字链接@endif</td>
			<td>@if($v->site_logo)<img src="{{env('UPLOAD_URL')}}{{$v->site_logo}}" width="50px">@endif</td>
			<td>{{$v->site_man}}</td>
			<td>{{$v->site_desc}}</td>
			<td>@if($v->site_type==1)是@endif @if($v->site_type==2)否@endif</td>
            <td>
			<a href="{{url('/site/edit/'.$v->site_id)}}" class="btn btn-info">编辑</a>
			<a href="javascript:void(0)" id="del" site_id="{{$v->site_id}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td>{{$data->appends(["site_name"=>$site_name])->links()}}</td></tr>
	</tbody>
	
</table>
</body>
<script>
$(function(){
	$(document).on("click",".btn-danger",function(){
		var id=$(this).attr("site_id");
		var name=$("#site_name").val()
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		$.ajax({
			url:"{{url('/site/index/')}}",
			type:"post",
			data:{"site_name":name,"id":id},
			success:function(ked){
				$("tbody").html(ked)
			}
		})
		
	})
})
</script>
</html>