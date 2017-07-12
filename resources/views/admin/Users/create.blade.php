@extends('admin.layout')
@section('content')
    <div class="tpl-content-page-title">
        管理员信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
        <li><a href="#">管理员信息</a></li>
        <li class="am-active">添加管理员</li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 添加管理员信息
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
                    <form class="am-form am-form-horizontal" method="post" action="/admin/user" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">头像 / Pic</label>
                            <div class="am-u-sm-9">
                                {{--<img src="" class="img-circle" style="width: 150px;height: 150px;" alt="">--}}

                                <input type="file"  name="pic" value="{{old('pic')}}" id="file" placeholder="请上传头像 / Pic">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">管理员 / Name</label>
                            <div class="am-u-sm-9">
                                <input type="text" value="{{old('username')}}" id="" name="username"  placeholder="请输入您要注册的管理员名字。。">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">密码 / Password</label>
                            <div class="am-u-sm-9">
                                <input type="password" id="" value="{{old('password')}}" name="password"  placeholder="输入您要注册的密码。。。">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">类别 / Family</label>
                            <div class="am-u-sm-9">
                                <select name="is_admin">
                                    <option value="0" >管理员</option>
                                    <option value="1">非管理员</option>
                                </select>

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">性别 / Sex</label>
                            <div class="am-u-sm-9">
                                <input name="sex" type="radio" value="1" />男&nbsp;&nbsp;
                                <input name="sex" type="radio" value="2" />女&nbsp;&nbsp;
                                <input name="sex" type="radio" value="3" />保密
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-QQ" class="am-u-sm-3 am-form-label">状态 / Statu</label>
                            <div class="am-u-sm-9">
                                <input name="grade" type="radio" value="1"  />有效&nbsp;&nbsp;
                                <input name="grade" type="radio" value="0" />无效

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">电话 / Phone</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="tel" id="" value="{{old('tel')}}" placeholder="请输入您的电话。。">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">邮箱 / Email</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="email" value="{{old('email')}}" id="" value="" placeholder="请输入您的邮箱。。">

                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">所属角色 / Name</label>
                            <div class="am-u-sm-9">
                            @if($post)
                                @foreach($post as $v)
                                        <input type="checkbox"  name="role_id[]" value="{{$v->id}}">{{$v->name}}
                                @endforeach
                            @endif
                            </div>
                        </div>


                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">提交</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('style/jquery-1.10.2.min.js')}}"></script>

    <script>
        $('input[name=username]').blur(function(){
            var uname = $(this).val();
            var that = $(this);
            var origin = that.data('u');
            if ( origin != uname ) {
                $.ajax({
                    url:"/admin/showuser",
                    type: 'post',
                    data: 'username='+uname,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function(data){
                        that.data('u', uname);

                        that.nextAll('span.tip').remove();
                        if (data == 1){
                            that.css({'border':'2px solid red'});
                            that.after('<span class="tip" style="color: red" >用户名已存在，请重新输入。。。</span>');
                        }else{
                            that.css({'border':'2px solid green'});
                            that.after('<span class="tip" style="color: green" >用户名可以使用！！</span>');
                        }
                    },
                    dataType:'json'
                });
            }
        });
    </script>
@endsection
