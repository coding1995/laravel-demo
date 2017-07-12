@extends('web.userinfo.layout')
@section('content')
    <link href="{{asset('web/css/stepstyle.css')}}" rel="stylesheet" type="text/css">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
        </div>
        <hr/>
        <!--进度条-->
        <div class="m-progress">
            <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
                        @if (session('success'))
                            <span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                        @else
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                        @endif
                <span class="u-progress-placeholder"></span>
            </div>
            @if(session('error'))
                <div class="partner" style="color: red">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" style="color: green; text-align: right">
                    {{ session('success') }}
                </div>
            @endif
            <div class="u-progress-bar total-steps-2">
                <div class="u-progress-bar-inner"></div>
            </div>
        </div>
        <form class="am-form am-form-horizontal" action="/web/passwordupdate" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="am-form-group">
                <label for="user-old-password" class="am-form-label">原密码</label>
                <div class="am-form-content">
                    <input type="password" name="password" id="user-old-password" placeholder="请输入原登录密码">
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-new-password" class="am-form-label">新密码</label>
                <div class="am-form-content">
                    <input type="password" name="newpassword" id="user-new-password" placeholder="由数字、字母组合">
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-confirm-password" class="am-form-label">确认密码</label>
                <div class="am-form-content">
                    <input type="password" name="repassword" id="user-confirm-password" placeholder="请再次输入上面的密码">
                </div>
            </div>
            <div class="info-btn">
                {{--<div class="am-btn am-btn-danger">--}}
                    <input type="submit" name="" value="保存修改" class="am-btn am-btn-primary am-btn-sm">
                {{--</div>--}}
            </div>

        </form>


    @endsection