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
            <li class="active"><a href="{{url('/goods/index')}}">商品管理</a></li>
            <li><a href="{{url('/brand/index')}}">品牌管理</a></li>
			<li><a href="{{url('/category/index')}}">分类管理</a></li>
			<li><a href="{{url('/admin/index')}}">管理员管理</a></li>
        </ul>
	</div>
	<div class="navbar-header" style="float:right;">
        <a class="navbar-brand" href="#" >欢迎【<font color="red">{{session("adminUser")->admin_name}}</font>】登陆</a>
    </div>
    </div>
</nav>

<table class="table table-hover">
<center><h2>商品列表</h2><a href="{{url('/goods/create')}}" class="btn btn-info">添加</a></center>
<center>
	<form>
		商品分类：<select name="cate_id">
			<option value="">--请选择--</option>
			@foreach($info as $v)
			<option value="{{$v->cate_id}}" @if(isset($search["cate_id"]))@if($search["cate_id"] == $v->cate_id) selected @endif @endif>{!!str_repeat("&nbsp;",$v["level"]*5)!!}{{$v->cate_name}}</option>
			@endforeach
		</select>
		商品品牌：<select name="brand_id">
			<option value="">--请选择--</option>
			@foreach($brand as $v)
			<option value="{{$v->brand_id}}" @if(isset($search["brand_id"]))@if($search["brand_id"] == $v->brand_id) selected @endif @endif>{{$v->brand_name}}</option>
			@endforeach
		</select>
		商品名称：<input type="text" name="goods_name" @if(isset($search["goods_name"])) value="{{$search['goods_name']}}" @endif placeholder="请输入商品名称关键字">
		<input type="submit" value="搜索">
	</form>
</center>
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>商品货号</th>
			<th>商品介绍</th>
			<th>商品图片</th>
			<th>商品相册</th>
			<th>商品分类</th>
			<th>商品品牌</th>
			<th>是否新品</th>
			<th>是否显示</th>
			<th>是否精品</th>
			<th>是否首页幻灯片推荐</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($data as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->goods_mark}}</td>
			<td>{{$v->goods_desc}}</td>
			<td>@if($v->goods_img)<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px">@endif</td>
			<td>
				@foreach($v->goods_imgs as $vv)
					@if($vv)<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="70px">@endif
				@endforeach
			</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>@if($v->is_new==1)是@endif @if($v->is_new==2)否@endif</td>
			<td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
			<td>@if($v->is_best==1)是@endif @if($v->is_best==2)否@endif</td>
			<td>@if($v->is_slide==1)是@endif @if($v->is_slide==2)否@endif</td>
            <td>
			<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>
			<a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="14">{{$data->appends($search)->links()}}</td>
		</tr>
	</tbody>
	
</table>

</body>
<script>
$(document).on("click",".page-item a",function(){
	var url=$(this).attr("href")
	$.get(url,function(ked){
		$("tbody").html(ked)
	})
	return false
})
</script>
</html>

