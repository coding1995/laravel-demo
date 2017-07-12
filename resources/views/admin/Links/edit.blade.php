@extends('admin.layout')


@section('content')
<div class="tpl-portlet-components">
	<div class="portlet-title">
	</div>
	<div class="tpl-block ">
		<div class="am-g tpl-amazeui-form">
			<div class="am-u-sm-12 am-u-md-9">
				<form class="am-form am-form-horizontal" action="{{url('/admin/link/'.$link->id)}}" method="post">
               <input type="hidden" name="_method" value="PUT">
				{{csrf_field()}}
					@if (count($errors) > 0)
                        <div class="alert alert-danger" style="color: red">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
					<div class="am-form-group">
						<label for="user-weibo" class="am-u-sm-3 am-form-label">
							标题：
						</label>
						<div class="am-u-sm-9">
							<input type="text" id="user-weibo" name="title" value="{{$link->title}}">
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-weibo" class="am-u-sm-3 am-form-label">
							URL地址：
						</label>
						<div class="am-u-sm-9">
							<input type="text" id="user-weibo" name="url" value="{{$link->url}}">
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-weibo" class="am-u-sm-3 am-form-label">
							状态：
						</label>
						<div class="am-u-sm-9">
						<select name="status" id="user-weibo">
							<option value="0" @if($link->status==0) selected  @endif>启用</option>
							<option value="1" @if($link->status==1) selected  @endif>禁用</option>
						</select>
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-intro" class="am-u-sm-3 am-form-label">
							描述：
						</label>
						<div class="am-u-sm-9">
							<textarea class="" rows="5" id="user-intro" name="contents">{{$link->contents}}
							</textarea>
						</div>
					</div>
					<div class="am-form-group">
						<div class="am-u-sm-9 am-u-sm-push-3">
							<input type="submit" value="修改" class="am-btn am-btn-primary">
							<input type="reset" value="重置" class="am-btn am-btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
