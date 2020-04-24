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