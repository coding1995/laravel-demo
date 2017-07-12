<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>laravist</title>
    </head>
    <body>
       <h2>hello {{$name}} 欢迎使用悦桔拉拉帐号激活！！</h2>
       <a href="{{url('web/verify/'.$token)}}">请点击{{$token}}激活帐号！！</a>
</html>
