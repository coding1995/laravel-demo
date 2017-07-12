<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{asset('web/AmazeUI-2.4.2/assets/css/amazeui.min.css')}}" />
    <link href="{{asset('web/css/dlstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('web/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('web/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>
    {{--<script src="{{asset('style/jquery-1.10.2.min.js')}}"></script>--}}

</head>

<body>

<div class="login-boxtitle">
    <a href="home/demo.html"><img alt="" src="{{asset('web/images/logobig.png')}}" /></a>
</div>

<div class="res-banner">
    <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="{{asset('web/images/big.jpg')}}" /></div>
        <div class="login-box">

            <div class="am-tabs" id="doc-my-tabs">
                <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                    <li class="am-active"><a href="">邮箱注册</a></li>
                    <li><a href="">手机号注册</a></li>
                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-active">
                        <form method="post" action="/web/create">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="user-name">
                                <label for="user"><i class="am-icon-user"></i></label>
                                <input type="text" name="username" id="user"
                                value="{{old('username')}}" placeholder="用户名">
                            </div>
                            <div class="user-email">
                                <label for="email"><i class="am-icon-envelope-o"></i></label>
                                <input type="email" name="email" id="email"
                              value="{{old('email')}}"  placeholder="请输入邮箱">
                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="设置密码">
                            </div>
                            <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                <input type="password" name="passwordcopy" id="passwordRepeat" placeholder="确认密码">
                            </div>

                            <div class="am-cf">
                                <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                            </div>
                        </form>
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" type="checkbox" value="checkbox"> 点击表示您同意商城《服务协议》
                            </label>
                        </div>
                        @if (count($errors) > 0)
                            <div class="login-links" style="color: red">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @elseif(session('error'))
                                <div class="partner" style="color: red">
                                    <ul>
                                        <li>{{ session('error') }}</li>
                                    </ul>
                                </div>
                        @endif

                    </div>

                    <div class="am-tab-panel">
                        <form method="post">
                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                <input type="tel" name="" id="phone" placeholder="请输入手机号">
                            </div>
                            <div class="verification">
                                <label for="code"><i class="am-icon-code-fork"></i></label>
                                <input type="tel" name="" id="code" placeholder="请输入验证码">
                                <a class="btn" href="javascript:void(0);" onclick="sendMobileCode();" id="sendMobileCode">
                                    <span id="dyMobileButton">获取</span></a>
                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input type="password" name="" id="password" placeholder="设置密码">
                            </div>
                            <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
                            </div>
                        </form>
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                            </label>
                        </div>

                        <div class="am-cf">
                            <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>

                        <hr>
                    </div>

                    <script>
                        $(function() {
                            $('#doc-my-tabs').tabs();
                        });
                    </script>
                    <script>
                        $('#reader-me').attr('checked','checked');
                    </script>
                    <script>
                        $('#user').blur(function(){
                            var uname = $(this).val();
                            var that = $(this);
                            var origin = that.attr('u');
                            if(origin != uname){
                                $.ajax({
                                    url:'/web/showusers',
                                    type:'post',
                                    data:'username='+uname,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    },
                                    success:function(data){
                                        that.attr('u', uname);
                                        if(data == 1){
                                            that.css({'border':'1px solid red'});
                                            alert('帐号已存在，请重新输入。。。');
                                        }else{
                                            that.css({'border':'1px solid green'});
                                            alert('帐号可以使用，请输入其他信息。。');
                                        }
                                    },
                                    dataType:'json'
                                });
                            }
                        });
                    </script>

                </div>
            </div>

        </div>
    </div>

    <div class="footer ">
        <div class="footer-hd ">
            <p>
                <a href="# ">恒望科技</a>
                <b>|</b>
                <a href="# ">商城首页</a>
                <b>|</b>
                <a href="# ">支付宝</a>
                <b>|</b>
                <a href="# ">物流</a>
            </p>
        </div>
        <div class="footer-bd ">
            <p>
                <a href="# ">关于恒望</a>
                <a href="# ">合作伙伴</a>
                <a href="# ">联系我们</a>
                <a href="# ">网站地图</a>
                <em>© 2015-2025 Hengwang.com 版权所有</em>
            </p>
        </div>
    </div>
</body>

</html>