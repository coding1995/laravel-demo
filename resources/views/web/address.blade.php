@extends('web.userinfo.layout')
@section('content')

            <div class="user-address">
                <!--标题 -->
                <div class="am-cf am-padding">
                    @if (session('success'))
                        <div class="alert alert-success" style="text-align: right;color: #00e359">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
                </div>
                <hr/>
                <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
                    @foreach($ss as $row)
                    <li class="user-addresslist">
                        <span class="new-option-r"><i class="am-icon-check-circle"></i>设为默认</span>
                        <p class="new-tit new-p-re">
                            <span class="new-txt">{{$row->name}}</span>
                            <span class="new-txt-rd2">{{$row->tel}}</span>
                        </p>
                        <div class="new-mu_l2a new-p-re">
                            <p class="new-mu_l2cw">
                                {{--<span class="title">地址：</span>--}}
                                {{--<span class="province">湖北</span>省--}}
                                {{--<span class="city">武汉</span>市--}}
                                {{--<span class="dist">洪山</span>区--}}
                                <span class="street">{{$row->address}}</span></p>
                        </div>
                        <div class="new-addr-btn">
                            <a href="{{url('web/addressedit/'.$row->id)}}"><i class="am-icon-edit"></i>编辑</a>
                            <span class="new-addr-bar">|</span>
                            <a href="{{url('web/delete/'.$row->id)}}" onclick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
                <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
                <!--例子-->
                <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                    <div class="add-dress">

                        <!--标题 -->
                        @if(session('error'))
                            <div class="partner" style="color: red">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif


                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
                        </div>
                        <hr/>
                        @if (count($errors) > 0)
                            <div class="partner" style="color: red">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                            <form class="am-form am-form-horizontal" action="/web/insert" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-form-label">收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" name="name" id="user-name" placeholder="收货人">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label">手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" name="tel" placeholder="手机号必填" type="text">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-address" class="am-form-label">所在地</label>
                                    <div class="am-form-content address" id="sanji">
                                        <select  name="pro" id="pro">
                                            <option value="-1">--请选择省份--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-form-label">详细地址</label>
                                    <div class="am-form-content">
                                        <textarea class="" rows="3" name="address"  id="user-intro" placeholder="输入详细地址"></textarea>
                                        <small>100字以内写出你的详细地址...</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label">邮编</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" name="emailno" placeholder="选填" type="text">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <input type="submit" name="" value="新增地址" class="am-btn am-btn-primary am-btn-sm">
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".new-option-r").click(function() {
                        $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                    });

                    var $ww = $(window).width();
                    if($ww>640) {
                        $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                    }

                })
            </script>

            <script>
                $.get(
                  '/web/addressshow',
                        {upid:0},
                        function (data) {
                            var str = '';
                            for (var i = 0; i<data.length; i++){
                                str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';

                            }
                            $('#pro').append(str);
                        },
                        'json'
                );

                $('#sanji').on('change','select',function(){

                    var id = $(this).val();
                    var that = $(this);
                    var size = $('#sanji select').length;

                    switch (size) {
                        case 1:
                                var selectName = 'city';
                                var selectId = 'city';
                            break;
                        case 2:
                            var selectName = 'area';
                            var selectId = 'area';
                            break;
                        case 3:
                            var selectName = 'stree';
                            var selectId = 'stree';
                            break;
                        case 4:
                            var selectName = 'flag';
                            var selectId = 'flag';
                            break;
                        default:
                            var selectName = 'other';
                            var selectId = 'other';
                            break;
                    }

                    that.nextAll('select').remove();

                    $.get(
                            '/web/addressshow',
                            {upid:id},
                            function (data){
                                var str = '<select name="'+selectName+'" id="'+selectId+'">';
                                str += '<option value="-1">--请选择--</option>';
                               for (var i = 0; i<data.length; i++){
                                   str += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
                               }
                                str += '</select>';
                                that.after(str);
                            },
                            'json'
                    );

                });
            </script>
            <div class="clear"></div>

@endsection