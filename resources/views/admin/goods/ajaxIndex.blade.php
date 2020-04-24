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
			<td colspan="14" >{{$data->appends($search)->links()}}</td>
		</tr>