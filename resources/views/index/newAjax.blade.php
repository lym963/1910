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