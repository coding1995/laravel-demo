@extends('admin.layout')

@section('content')
<div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 列表
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
						<form action="/admin/carousel">
                        <div class="portlet-input input-small input-inline">
                            <div class="input-icon right">
                                <input type="text" class="form-control form-control-solid" placeholder="搜索..." name="keyword">
                                <button class="am-icon-search" style="margin-top: -55px; margin-left: 115px"></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                            </div>
                        </div>
                    </div>
                    <div class="am-g">
                        <div class="tpl-table-images">
                        @foreach($carousel as $v)
                            <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
                                <div class="tpl-table-images-content">
                                    <div class="tpl-table-images-content-i-time">发布时间：{{$v->created_at}}</div>
                                    <div class="tpl-table-images-content-i-time">状态：@if($v->status==0) 启用 @else 禁用@endif</div>
                                    <a href="javascript:;" class="tpl-table-images-content-i">
                                        <div class="tpl-table-images-content-i-info">
                                        </div>
                                        <span class="tpl-table-images-content-i-shadow"></span>
                                        <img src="{{$v
                                        ->pic}}" alt="">
                                    </a>
                                    <div class="tpl-table-images-content-block">
                                        <div class="tpl-i-font">
                                           标题：{{$v->title}}
                                        </div>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                                <button type="button" class="am-btn am-btn-default am-btn-secondary">
                                                <a href="/admin/carousel/{{$v->id}}/edit"><span class="am-icon-edit"></span> 编辑</a></button>
                                                <button type="button" class="am-btn am-btn-default am-btn-danger">
                                                <a href="javaScript:;" onclick="delCarousel({{$v->id}})"><span class="am-icon-trash-o"></span> 删除</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            <div class="am-u-lg-12">
                                <div class="am-cf">
                                    <div class="am-fr" id="pages">
					{!! $carousel->appends($request->only(['keyword']))->render() !!}
						</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>

<script>
	function delCarousel($id)
	{
		if (confirm("确认删除吗？")) {

			$.post("{{url('/admin/carousel')}}"+'/'+$id,

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
