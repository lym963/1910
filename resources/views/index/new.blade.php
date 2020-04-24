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

<table class="table table-hover">
<center><h2>列表</h2></center>
<center>
    <form action="">
        <input type="text" name="cate_name">
        <input type="submit" value="搜索">
    </form>
</center>
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
        @foreach($cateInfo as $v)
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
        <tr>
            <td colspan="5">{{$cateInfo->appends(["cate_name"=>$cate_name])->links()}}</td>
        </tr>
        
	</tbody>
</table>

</body>
</html>
<script>
    $(document).on("click",".page-item a",function(){
	var url=$(this).attr("href")
	$.get(url,function(ked){
		$("tbody").html(ked)
	})
	return false
})
</script>