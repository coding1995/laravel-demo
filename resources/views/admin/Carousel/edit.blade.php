@extends('admin.layout')

@section('content')
<div class="am-g tpl-amazeui-form" style="margin-top: 100px">
        <div class="am-u-sm-12 am-u-md-9">  
            <form class="am-form am-form-horizontal" method="post" action="{{ asset('/admin/carousel/'.$carousel->id) }}" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">标题：</label>
                    <div class="am-u-sm-9">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <input type="text" id="title" name="title" value="{{$carousel->title}}">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">状态：</label>
                    <div class="am-u-sm-9">
                       <select name="status" id="user-weibo">
							<option value="0" @if($carousel->status==0) selected  @endif>启用</option>
							<option value="1" @if($carousel->status==1) selected  @endif>禁用</option>
						</select>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">图片：</label>
                    <div class="am-u-sm-9">
                       <img src="{{$carousel->pic}}" alt="" style="width: 480px;height: 300px">
                    </div>
                </div>              
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-3 am-form-label">上传图片：</label>
                    <div class="am-u-sm-9">
                        <input type="file" name="pic">
                    </div>
                </div>
            <div class="am-u-sm-9 am-u-sm-push-3">
                <input type="hidden" name="_method" value="PUT">
                <input type="submit" value="修改" class="am-btn am-btn-primary">
                <input type="reset"  value="重置" class="am-btn am-btn-primary">
            </div>
            </form>
        </div>
</div>
@endsection
