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