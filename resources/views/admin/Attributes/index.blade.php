@extends('admin.layout')


@section('content')
<div class="tpl-portlet-components">
	<div class="portlet-title">
		<div class="caption font-green bold">
			
		</div>
		<div class="tpl-portlet-input tpl-fz-ml">
			<div class="portlet-input input-small input-inline">
				<div class="input-icon right">
							
				</div>
			</div>
		</div>
	</div>
	<div class="tpl-block">
		<form action="{{url('/admin/attributes')}}">
			<div class="am-g">
				<div class="am-u-sm-12 am-u-md-6">
					<div class="am-btn-toolbar">
						<div class="am-btn-group am-btn-group-xs">					
						</div>
					</div>
				</div>
				<div class="am-u-sm-12 am-u-md-3" style="margin-left: -20px">显示：</div>
					<div class="am-u-sm-12 am-u-md-3" style="margin-left: -180px">
						<div class="am-form-group">
							<select data-am-selected="{btnSize: 'sm'}" style="display: none;" name = "num">
								<option value="6" @if($request->input('num') == 6)  selected  @endif>
								6
								</option>
								<option value="25" @if($request->input('num') == 25)  selected  @endif>
									25
								</option>
								<option value="50" @if($request->input('num') == 50)  selected  @endif>
									50
								</option>
								<option value="100" @if($request->input('num') == 100)  selected  @endif>
									100
								</option>
							</select>
						</div>
					</div>
					<div class="am-u-sm-12 am-u-md-3" style="margin-left: 200px">属性名：</div>
					<div class="am-u-sm-12 am-u-md-3">
						<div class="am-input-group am-input-group-sm">
							<input type="text" class="am-form-field" name="name">
							<span class="am-input-group-btn">
								<input type="submit" class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" value="搜索">
							</span>
						</div>
					</div>	
			</div>
		</form>
		<div class="am-g">
			<div class="am-u-sm-12">
				<form class="am-form">
					<table class="am-table am-table-striped am-table-hover table-main">
						<thead>
							<tr>								
								<th class="table-id">
									ID
								</th>
								<th class="table-title">
									属性名
								</th>
								<th class="table-date am-hide-sm-only">
									创建时间
								</th>
								<th class="table-date am-hide-sm-only">
									修改时间
								</th>
								<th class="table-set">
									操作
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($attributes as $k=>$v)
							<tr>
								<td>
									{{$v->id}}
								</td>
								<td>
									<a href="#">
										{{$v->name}}
									</a>
								</td>
								<td class="am-hide-sm-only">
									{{$v->created_at}}
								</td>
								<td class="am-hide-sm-only">
									{{$v->updated_at}}
								</td>
								<td>
									<div class="am-btn-toolbar">
										<div class="am-btn-group am-btn-group-xs">
											<button class="am-btn am-btn-default am-btn-xs am-text-secondary">
												<span class="am-icon-pencil-square-o">
												</span>
												<a href="/admin/attributes/{{$v->id}}/edit">编辑</a>
											</button>
						
											<button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
												<span class="am-icon-trash-o">
												</span>
												<a href="javaScript:;" onclick="DelGoodSort({{$v->id}})">删除</a>
											</button>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="am-cf">
						<div class="am-fr" id="pages" >
						{!! $attributes->appends($request->only(['num','name']))->render() !!}
						</div>
					</div>
					<hr>
				</form>
			</div>
		</div>
	</div>
	<div class="tpl-alert">
	</div>
</div>
<script>
	//删除分类
	function DelGoodSort($id) {

		if (confirm("确认删除吗？")) {

			// alert($id);
			//发送异步
			$.post("{{url('/admin/attributes')}}"+'/'+$id, 

				{"_method":"delete","_token":"{{csrf_token()}}"}, 


				function (data) {

				if (data.status==0) {

					location.href = location.href;
					alert(data.msg);
				} else {

					alert(data.msg);
				}

			});

			return true;

		} else {

   			return false;
		}

	}
</script>
@endsection
