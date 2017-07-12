@extends('admin.layout')
@section('content')

    <div class="tpl-content-page-title">
        会员信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
        <li><a href="#">会员列表</a></li>
        <li class="am-active">查看</li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 查看会员员信息
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
                    <form class="am-form am-form-horizontal" >
                        {{--<div class="am-form-group">--}}
                            {{--<label for="user-QQ" class="am-u-sm-3 am-form-label">头像 / Pic</label>--}}
                            {{--<div class="am-u-sm-9">--}}
                        {{--</div>--}}


                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">会员帐号 / Name</label>
                            <div class="am-u-sm-9">
                                {{$post->username}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">会员等级 / </label>
                            <div class="am-u-sm-9">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">性别 / Sex</label>
                            <div class="am-u-sm-9">
                                {{$sex[$post->sex]}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-QQ" class="am-u-sm-3 am-form-label">状态 / Statu</label>
                            <div class="am-u-sm-9">
                                {{$status[$post->status]}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">电话 / Phone</label>
                            <div class="am-u-sm-9">
                                {{$post->tel}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">邮箱 / Email</label>
                            <div class="am-u-sm-9">
                                {{$post->email}}
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">创建时间 / Create Time </label>
                            <div class="am-u-sm-9">
                                {{$post->created_at}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <a href="/admin/webuser">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="button" class="am-btn am-btn-primary">查看更多</button>
                                </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection