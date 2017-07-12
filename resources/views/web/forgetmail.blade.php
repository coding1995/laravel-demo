<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>laravist</title>
</head>
<body>
<h2>hello {{$name}} 欢迎使用悦桔拉拉帐号密码找回！！</h2>
<a href="{{url('web/reset/'.$token)}}">请点击{{$token}}重置帐号密码！！</a>
</html>
