@extends('admin.layout')
@section('content')
        <div class="tpl-content-page-title">
            Amaze UI 添加权限
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">表单</a></li>
            <li class="am-active">Amaze UI 表单</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 表单
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">
                            <i class="am-icon-search"></i>
                            <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                    </div>
                </div>


            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">


                    <div class="am-u-sm-12 am-u-md-9">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="partner" style="color: red">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form class="am-form am-form-horizontal" action="/admin/access/update/{{$post->id}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">权限标题 / Role</label>
                                <div class="am-u-sm-9">
                                    <input type="text" value="{{$post->title}}" name="title" id="user-name" placeholder="">
                                    <small>请输入要添加的权限标题。。。</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">地址 / Urls</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" name="urls" id="user-intro" placeholder="一行一个url。。">{{$post->urls}}</textarea>
                                    <small></small>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <script>
            $('input[name=title]').blur(function(){
                var uname = $(this).val();
                var that = $(this);
                var origin = that.data('u');
                if ( origin != uname ) {
                    $.ajax({
                        url:"/access/showuser",
                        type: 'post',
                        data: 'title='+uname,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success:function(data){
                            that.data('u', uname);

                            that.nextAll('span.tip').remove();
                            if (data == 1){
                                that.css({'border':'2px solid red'});
                                that.after('<span class="tip" style="color: red" >权限名已存在，请重新输入。。。</span>');
                            }else{
                                that.css({'border':'2px solid green'});
                                that.after('<span class="tip" style="color: green" >权限名可以使用！！</span>');
                            }
                        },
                        dataType:'json'
                    });
                }
            });
        </script>
@endsection









