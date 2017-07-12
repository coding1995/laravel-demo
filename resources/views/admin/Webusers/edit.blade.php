@extends('admin.layout')
@section('content')

    <div class="tpl-content-page-title">
        会员信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
        <li><a href="#">会员列表</a></li>
        <li class="am-active">编辑</li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 编辑会员信息
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

                    <form class="am-form am-form-horizontal" method="post" action="/admin/webuser/{{$post->id}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{--<div class="am-form-group">--}}
                            {{--<label for="user-name" class="am-u-sm-3 am-form-label">头像 / Pic</label>--}}
                            {{--<div class="am-u-sm-9">--}}
                                {{--<img src="{{asset('uploads/_min'.$post->pic)}}" class="img-circle" style="width: 150px;height: 150px;" alt="">--}}
                                {{--<input type="file"  name="pic" value="" id="file" placeholder="请上传头像 / Pic">--}}
                                {{--<small>输入你的名字，让我们记住你。</small>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">会员帐号 / Name</label>
                            <div class="am-u-sm-9">
                                <input type="text" readonly="readonly" id="" name="username" value="{{$post->username}}" placeholder="输入您要修改的 / Email">
                                <small>此选项不可修改！！！</small>
                            </div>
                        </div>


                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">密码 / Password</label>
                            <div class="am-u-sm-9">
                                <input type="password" id="" name="password" value="{{$post->password}}" placeholder="输入您要修改的密码。。。">
                                {{--<small>此选项不可修改！！！</small>--}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">会员等级 / Rank</label>
                            <div class="am-u-sm-9">
                                <input type="text" readonly="readonly" id="" name="is_admin" value="" placeholder="">
                                <small>此选项不可修改！！！</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">账户余额 / Balance</label>
                            <div class="am-u-sm-9">
                                <input type="text" readonly="readonly" id="" name="is_admin" value="" placeholder="">
                                <small>此选项不可修改！！！</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">性别 / Sex</label>
                            <div class="am-u-sm-9">
                                <input name="sex" type="radio" value="1"  {{($post->sex == 1)?"checked":""}}/>男
                                <input name="sex" type="radio" value="2" {{($post->sex == 2)?"checked":""}} />女
                                <input name="sex" type="radio" value="3" {{($post->sex == 3)?"checked":""}} />保密
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-QQ" class="am-u-sm-3 am-form-label">状态 / Statu</label>
                            <div class="am-u-sm-9">
                                <input name="status" type="radio" value="1" {{($post->status == 1)?"checked":""}} />有效
                                <input name="status" type="radio" value="0" {{($post->status == 0)?"checked":""}} />无效
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">电话 / Phone</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="tel" id="" value="{{$post->tel}}" placeholder="输入您要修改的电话。。">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">邮箱 / Email</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="email" id="" value="{{$post->email}}" placeholder="输入您要修改的邮箱。。">
                                {{--<small>250字以内写出你的一生...</small>--}}
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">创建时间 / Createtime</label>
                            <div class="am-u-sm-9">
                                <input type="text" readonly="readonly" id="" name="created_at" value="{{$post->created_at}}" placeholder="">
                                <small>此选项不可修改！！！</small>
                            </div>
                        </div>


                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                            </div>
                        </div>
                    </form>
                        <div class="am-form-group">
                            <a href="/admin/webuser">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="button" class="am-btn am-btn-primary">暂不修改</button>
                                </div>
                            </a>
                        </div>
                </div>
            </div>
        </div>

    </div>

@endsection