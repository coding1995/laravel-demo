@extends('web.userinfo.layout')
 @section('content')
     <link href="{{asset('web/css/infstyle.css')}}" rel="stylesheet" type="text/css">
            <div class="user-info">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                </div>
                <hr/>

                <!--头像 -->
                <form action="/web/picupload/{{$post->uid}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                    <input type="hidden" name="oldpic" value="{{$post->pic}}">
                <div class="user-infoPic">

                    <div class="filePic">
                        <input type="file" name="pic" class="inputPic" value="{{$post->pic}}" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                        <img class="am-circle am-img-thumbnail" src="{{asset('uploads/_min'.$post->pic)}}" alt="" />

                    </div>

                    <p class="am-form-help">头像</p>

                    <div class="info-m">
                        <div><b>用户名：<i>{{$post->username}}</i></b></div>
                        <div class="vip">
                            <span></span><a href="#">会员专享</a>
                        </div>
                    </div>
                    <div class="info-btn">
                        <input type="submit" name="" value="提交上传" class="am-btn am-btn-primary am-btn-sm">
                    </div>
                </div>

                </form>
                <!--个人信息 -->
                @if (session('success'))
                    <div class="alert alert-success" style="text-align: right;color: green">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-success" style="text-align: right;color: red">
                        {{ session('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="partner" style="color: red">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="info-main">
                    <form class="am-form am-form-horizontal" name="reg_testdate" action="/web/showupdate/{{$post->uid}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="am-form-group">
                            <label for="user-name2" class="am-form-label">帐号昵称</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="nickname" placeholder="nickname" value="{{$post->nickname}}" >
                                <small>昵称长度不能超过40个汉字</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">姓名</label>
                            <div class="am-form-content">
                                <input type="text" value="{{$post->name}}" name="name" id="user-name2" placeholder="name">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-form-label">性别</label>
                            <div class="am-form-content sex">
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="1" {{($post->sex == 1)?"checked":""}} data-am-ucheck> 男
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="2" data-am-ucheck {{($post->sex == 2)?"checked":""}} > 女
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="3" {{($post->sex == 3)?"checked":""}} data-am-ucheck> 保密
                                </label>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">生日</label>
                            <div class="am-form-content">
                                {{$post->birthday}}
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-birth" class="am-form-label">修改</label>
                            <div class="am-form-content birth">
                                <div class="birth-select">
                                    <select value=""  name="YYYY" onchange="YYYYDD(this.value)">
                                        <option value="" >请选择 年</option>
                                    </select>
                                    <em>年</em>
                                </div>
                                <div class="birth-select2">
                                    <select  name="MM" value="" onchange="MMDD(this.value)">
                                        <option value="">选择 月</option>
                                    </select>
                                    <em>月</em></div>
                                <div class="birth-select2">
                                    <select  name="DD" value="">
                                        <option value="">选择 日</option>
                                    </select>
                                    <em>日</em></div>
                            </div>

                        </div>



                        <div class="am-form-group">
                            <label for="user-phone" class="am-form-label">电话</label>
                            <div class="am-form-content">
                                <input id="user-phone" name="tel" placeholder="telephonenumber" value="{{$post->tel}}" type="tel">

                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-form-label">电子邮件</label>
                            <div class="am-form-content">
                                <input id="user-email" value="{{$post->email}}" placeholder="Email" name="email" type="email">

                            </div>
                        </div>
                        <div class="info-btn">
                            <input type="submit" name="" value="保存修改" class="am-btn am-btn-primary am-btn-sm">
                        </div>

                    </form>
                </div>

            </div>

            <script language="JavaScript"><!--
                function YYYYMMDDstart()
                {
                    MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                    //先给年下拉框赋内容
                    var y  = new Date().getFullYear();
                    for (var i = (y-30); i <= y; i++) //以今年为准，前30年，后30年
                        document.reg_testdate.YYYY.options.add(new Option(" "+ i +" ", i));

                    //赋月份的下拉框
                    for (var i = 1; i < 13; i++)
                        document.reg_testdate.MM.options.add(new Option(" " + i + " ", i));

                    document.reg_testdate.YYYY.value = y;
                    document.reg_testdate.MM.value = new Date().getMonth() + 1;
                    var n = MonHead[new Date().getMonth()];
                    if (new Date().getMonth() ==1 && IsPinYear(YYYYvalue)) n++;
                    writeDay(n); //赋日期下拉框Author:meizz
                    document.reg_testdate.DD.value = new Date().getDate();
                }
                if(document.attachEvent)
                    window.attachEvent("onload", YYYYMMDDstart);
                else
                    window.addEventListener('load', YYYYMMDDstart, false);
                function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)
                {
                    var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;
                    if (MMvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}
                    var n = MonHead[MMvalue - 1];
                    if (MMvalue ==2 && IsPinYear(str)) n++;
                    writeDay(n)
                }
                function MMDD(str)   //月发生变化时日期联动
                {
                    var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;
                    if (YYYYvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}
                    var n = MonHead[str - 1];
                    if (str ==2 && IsPinYear(YYYYvalue)) n++;
                    writeDay(n)
                }
                function writeDay(n)   //据条件写日期的下拉框
                {
                    var e = document.reg_testdate.DD; optionsClear(e);
                    for (var i=1; i<(n+1); i++)
                        e.options.add(new Option(" "+ i + " ", i));
                }
                function IsPinYear(year)//判断是否闰平年
                {     return(0 == year%4 && (year%100 !=0 || year%400 == 0));}
                function optionsClear(e)
                {
                    e.options.length = 1;
                }
                //--></script>
@endsection













