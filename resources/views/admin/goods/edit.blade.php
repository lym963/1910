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
    </div>
</nav>
<center><h2>商品修改</h2><a type="button" class="btn btn-info" href="{{url('/goods/index')}}">列表</a></center>
<form class="form-horizontal" role="form" action="{{url('/goods/update/'.$data->goods_id)}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" value="{{$data->goods_name}}" placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('goods_name')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" value="{{$data->goods_price}}" placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('goods_price')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num" value="{{$data->goods_num}}" placeholder="请输入名称">
				   <span style="color:red">{{$errors->first('goods_num')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_mark" value="{{$data->goods_mark}}" placeholder="请输入名称">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<textarea name="goods_desc" class="form-control">{{$data->goods_desc}}</textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			@if($data->goods_img)<img src="{{env('UPLOAD_URL')}}{{$data->goods_img}}" width="70px">@endif<input type="file" name="goods_img">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
		@foreach($data->goods_imgs as $vv) @if($vv)<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="70px">@endif @endforeach<input type="file" name="goods_imgs[]" multiple>
		</div>
	</div>


	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id">
				<option value="">--请选择--</option>
				@foreach($info as $v)
				<option value="{{$v->cate_id}}" @if($data->cate_id==$v->cate_id) selected @endif>{!!str_repeat("&nbsp;",$v["level"]*5)!!}{{$v->cate_name}}</option>
				@endforeach
            </select>
            <span style="color:red">{{$errors->first('cate_id')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
			<select name="brand_id">
				<option value="">--请选择--</option>
				@foreach($brand as $v)
				<option value="{{$v->brand_id}}" @if($data->brand_id==$v->brand_id) selected @endif>{{$v->brand_name}}</option>
				@endforeach
            </select>
            <span style="color:red">{{$errors->first('brand_id')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1" @if($data->is_new==1) checked @endif>是
			<input type="radio" name="is_new" value="2" @if($data->is_new==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" @if($data->is_show==1) checked @endif>是
			<input type="radio" name="is_show" value="2" @if($data->is_show==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1" @if($data->is_best==1) checked @endif>是
			<input type="radio" name="is_best" value="2" @if($data->is_best==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否首页幻灯片推荐</label>
		<div class="col-sm-10">
			<input type="radio" name="is_slide" value="1" @if($data->is_slide==1) checked @endif>是
			<input type="radio" name="is_slide" value="2" @if($data->is_slide==2) checked @endif>否
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