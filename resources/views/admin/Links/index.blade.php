@extends('admin.layout')

@section('content')
<div class="tpl-portlet-components">
	<div class="portlet-title">
		
	</div>
	<div class="tpl-block">
		<div class="am-g">
			<div class="am-u-sm-12 am-u-md-6">
				<div class="am-btn-toolbar">
				</div>
			</div>
			<div class="am-u-sm-12 am-u-md-3">
				
			</div>
			<div class="am-u-sm-12 am-u-md-3">
				<div class="am-input-group am-input-group-sm">
					<input type="text" class="am-form-field">
					<span class="am-input-group-btn">
						<button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search"
						type="button">
						</button>
					</span>
				</div>
			</div>
		</div>
		<ul class="tpl-task-list">
			@foreach($link as $k=>$v)
			<li>
				<div class="task-checkbox">
					<input type="hidden" value="1" name="test">
				</div>
				<div class="task-title">
					<span class="task-title-sp">
						{{$v->title}}
					</span>
					<span class="label label-sm label-danger">
						@if($v->status==0) 启用 @else 禁用 @endif
					</span>
				</div>
				<div class="task-config">
					<div class="am-dropdown tpl-task-list-dropdown" data-am-dropdown="">
						<a href="###" class="am-dropdown-toggle tpl-task-list-hover " data-am-dropdown-toggle="">
							<i class="am-icon-cog">
							</i>
							<span class="am-icon-caret-down">
							</span>
						</a>
						<ul class="am-dropdown-content tpl-task-list-dropdown-ul">
							<li>
								<a href="/admin/link/{{$v->id}}/edit">
									<i class="am-icon-pencil">
									</i>
									编辑
								</a>
							</li>
							<li>
								<a href="javascript:;" onclick="delLink({{$v->id}})">
									<i class="am-icon-trash-o">
									</i>
									删除
								</a>
							</li>
						</ul>
					</div>
				</div>
			</li>
			@endforeach
			<li>
				<div class="task-checkbox">
					<input type="hidden" value="1" name="test">
				</div>
				<div class="task-title">
					<span class="task-title-sp">
						
					</span>
					
				</div>
				<div class="task-config">
					<div class="am-dropdown tpl-task-list-dropdown" data-am-dropdown="">
						
						
					</div>
				</div>
			</li>
			<li>
				<div class="task-checkbox">
					<input type="hidden" value="1" name="test">
				</div>
				<div class="task-title">
					<span class="task-title-sp">
						
					</span>
					
				</div>
				<div class="task-config">
					<div class="am-dropdown tpl-task-list-dropdown" data-am-dropdown="">
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<script>
	function delLink($id)
	{
		if (confirm("确认删除吗？")) {

			$.post("{{url('/admin/link')}}"+'/'+$id,

			{"_method":"delete","_token":"{{csrf_token()}}"}, 

			function (data) {

				if (data.status==0) {

					location.href = location.href;
					alert(data.msg);
				} else {

					alert(data.msg);
				}

			}
				);

			return true;
		} else {

			return false;
		}
	}
</script>
@endsection
