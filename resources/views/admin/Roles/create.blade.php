@extends('admin.layout')
@section('content')
        <div class="tpl-content-page-title">
            Amaze UI 添加角色
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
                        <form class="am-form am-form-horizontal" action="{{url('admin/role/store')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">角色 / Role</label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name" id="user-name" placeholder="">
                                    <small>请输入要添加的角色。。。</small>
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
            $('input[name=name]').blur(function(){
                var uname = $(this).val();
                var that = $(this);
                var origin = that.data('u');
                if ( origin != uname ) {
                    $.ajax({
                        url:"/role/showuser",
                        type: 'post',
                        data: 'name='+uname,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success:function(data){
                            that.data('u', uname);

                            that.nextAll('span.tip').remove();
                            if (data == 1){
                                that.css({'border':'2px solid red'});
                                that.after('<span class="tip" style="color: red" >角色名已存在，请重新输入。。。</span>');
                            }else{
                                that.css({'border':'2px solid green'});
                                that.after('<span class="tip" style="color: green" >角色名可以使用！！</span>');
                            }
                        },
                        dataType:'json'
                    });
                }
            });
        </script>
@endsection








