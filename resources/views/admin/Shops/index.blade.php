@extends('admin.layout')


@section('content')
<div class="tpl-portlet-components">
	<div class="portlet-title">
		<div class="caption font-green bold">
			<span class="am-icon-code">
			</span>
			列表
		</div>
	
	</div>
	<div class="tpl-block">
		<div class="am-g">
			<div class="am-u-sm-12 am-u-md-6">
		
			</div>
		<form action="{{url('/admin/shop')}}">
		<div class="am-u-sm-12 am-u-md-3" style="margin-left: -20px">显示：</div>
			<div class="am-u-sm-12 am-u-md-3" style="margin-left: -180px">

				<div class="am-form-group">
					<select name="num" data-am-selected="{btnSize: 'sm'}" style="display: none;">
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
			<div class="am-u-sm-12 am-u-md-3" style="margin-left: 200px">商品名：</div>
			<div class="am-u-sm-12 am-u-md-3">
				<div class="am-input-group am-input-group-sm">
					<input type="text" class="am-form-field" name="keyword">
					<span class="am-input-group-btn">
						<input type="submit" class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" value="搜索">
					</span>
				</div>
			</div>
		</form>
		</div>
		<div class="am-g">
			<div class="tpl-table-images">
				@foreach($ShopData as $k=>$v)
				<div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
					<div class="tpl-table-images-content">
						<div class="tpl-table-images-content-i-time">
							发布时间：{{$v->created_at}}
						</div>
						<div class="tpl-i-title">
							商品名：{{$v->goodname}}
						</div>
						<a href="javascript:;" class="tpl-table-images-content-i">
							<div class="tpl-table-images-content-i-info">
								<span class="ico">
									
								</span>
							</div>
							<span class="tpl-table-images-content-i-shadow">
							</span>
							<img src="{{$v->gmages}}" alt="">
						</a>
						<div class="tpl-table-images-content-block">
							<div class="tpl-i-font">
							</div>
							<div class="tpl-i-more">
							</div>
							<div class="am-btn-toolbar">
								<div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
									
									<button type="button" class="am-btn am-btn-default am-btn-secondary">
										<a href="/admin/shop/edit/{{$v->id}}"><span class="am-icon-edit">
										</span>
										编辑</a>
									</button>
									<button type="button" class="am-btn am-btn-default am-btn-danger">
										<a href="javaScript:;" onclick="delShops({{$v->id}})"><span class="am-icon-trash-o">
										</span>
										删除</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>	
				@endforeach
				<div class="am-u-lg-12">
					<div class="am-cf">
						<div class="am-fr" id="pages">
					{!! $ShopData->appends($request->only(['num','keyword']))->render() !!}
						</div>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="tpl-alert">
	</div>
</div>
<script>
	function delShops($id)
	{
		// alert($id);
		if (confirm("确认删除吗？")) {

			$.post("{{url('/admin/shop/del')}}"+'/'+$id,

			{"_method":"post","_token":"{{csrf_token()}}"}, 

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
