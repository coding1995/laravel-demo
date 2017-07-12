<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{asset('assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                Amaze UI<span> Login</span> <i class="am-icon-skyatlas"></i>

            </div>
        </div>

        <div class="login-font">
            <i>Log In </i> or <span> Sign Up</span>
        </div>
        <div class="am-u-sm-10 login-am-center">
            <form class="am-form" method="post" action="/admin/store" >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <fieldset>
                    <div class="am-form-group">
                        <input type="text" name="username" value="{{old('username')}}" class=""  id="doc-ipt-email-1" placeholder="亲，请输入账号">
                    </div>
                    <div class="am-form-group">
                        <input type="password" name="password" value="" class="" id="doc-ipt-pwd-1" placeholder="亲，请输入密码">
                    </div>
                    <div class="am-form-group">
                        <input type="text" name="captcha"  class="" id="doc-ipt-pwd-1" placeholder="亲，请输入验证码">
                        <img src="{{ URL('admin/captcha') }}" onclick="this.src=this.src+'?a=1'" alt="验证码" title="刷新图片" width="200" height="50" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                    </div>

                    <p><button type="submit" class="am-btn am-btn-default">登录</button></p>
                </fieldset>

            </form>
            <div>
                @if (session('error'))
                    <div class="alert alert-success" style="color: white">
                        {{ session('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="color:white">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function re_captcha() {
        $url = "{{ URL('admin/login') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
</script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
</body>

</html>
