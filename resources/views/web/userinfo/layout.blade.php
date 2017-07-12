<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>个人中心</title>

    <link href="{{asset('web/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('web/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('web/css/personal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('web/css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('web/AmazeUI-2.4.2/assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
</head>

<body>
<!--头 -->
<header>
    <article>
        <div class="mt-logo">
            <!--顶部导航条 -->
            <div class="am-container header">
                <ul class="message-l">
                    <div class="topMessage">
                        @if(session('webuser'))
                            <div class="menu-hd">
                                <a href="#" target="_top" class="h">您好！{{session('webuser')[0]->username}} 欢迎来到悦桔拉拉</a>
                            </div>
                        @else
                            <div class="menu-hd">
                                <a href="{{url('web/login')}}" target="_top" class="h">亲，请登录</a>
                                <a href="{{url('web/register')}}" target="_top">免费注册</a>
                            </div>
                        @endif
                    </div>
                </ul>
                <ul class="message-r">
                    <div class="topMessage home">
                        <div class="menu-hd"><a href="{{asset('/weba')}}" target="_top" class="h">商城首页</a></div>
                    </div>

                    @if(session('webuser'))
                        <div class="topMessage my-shangcheng">
                            <div class="menu-hd MyShangcheng"><a href="{{asset('web/user')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                        </div>
                        <div class="topMessage my-shangcheng">
                            <div class="menu-hd MyShangcheng"><a href="{{asset('web/logout')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>安全退出</a></div>
                        </div>
                    @else
                        <div class="topMessage my-shangcheng">
                            <div class="menu-hd MyShangcheng"><a href="{{url('web/login')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>请登录/注册</a></div>
                        </div>

                    @endif

                    <div class="topMessage mini-cart">
                        <div class="menu-hd"><a id="mc-menu-hd" href="{{url('/cart')}}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
                    </div>
                    <div class="topMessage favorite">
                        <div class="menu-hd"><a href="{{url('/collect')}}" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <div class="logoBig">
                    <li><img src="{{asset('web/images/logobig.png')}}" /></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form action="/list" method="get">
                            <input id="searchInput" name="keyword" type="text" placeholder="搜索" autocomplete="off">
                            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                        </form>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
<div class="nav-table">
    <div class="long-title"><span class="all-goods">全部分类</span></div>
    <div class="nav-cont">
        <ul>
            <li class="index"><a href="{{url('/')}}">首页</a></li>
            <li class="qc"><a href="{{url('/list')}}">商品列表</a></li>
        </ul>
        <div class="nav-extra">
            <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
            <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
        </div>
    </div>
</div>
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

        @yield('content')

        </div>
        <!--底部-->
        <div class="footer">
            <div class="footer-hd">
                <p>
                    <a href="#">恒望科技</a>
                    <b>|</b>
                    <a href="#">商城首页</a>
                    <b>|</b>
                    <a href="#">支付宝</a>
                    <b>|</b>
                    <a href="#">物流</a>
                </p>
            </div>
            <div class="footer-bd">
                <p>
                    <a href="#">关于恒望</a>
                    <a href="#">合作伙伴</a>
                    <a href="#">联系我们</a>
                    <a href="#">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>
    </div>

    <aside class="menu">
        <ul>
            <li class="person active">
                <a href="index.html"><i class="am-icon-user"></i>个人中心</a>
            </li>
            <li class="person">
                <p><i class="am-icon-newspaper-o"></i>个人资料</p>
                <ul>
                    <li> <a href="{{url('web/user')}}">个人信息</a></li>
                    <li> <a href="{{url('web/safety')}}">安全设置</a></li>
                    <li> <a href="{{url('web/address')}}">地址管理</a></li>
                    <li> <a href="cardlist.html">快捷支付</a></li>
                </ul>
            </li>
            <li class="person">
                <p><i class="am-icon-balance-scale"></i>我的交易</p>
                <ul>
                    <li><a href="/order">订单管理</a></li>
                    <li> <a href="change.html">退款售后</a></li>
                    <li> <a href="comment.html">评价商品</a></li>
                </ul>
            </li>
            <li class="person">
                <p><i class="am-icon-dollar"></i>我的资产</p>
                <ul>
                    <li> <a href="points.html">我的积分</a></li>
                    <li> <a href="coupon.html">优惠券 </a></li>
                    <li> <a href="bonus.html">红包</a></li>
                    <li> <a href="walletlist.html">账户余额</a></li>
                    <li> <a href="bill.html">账单明细</a></li>
                </ul>
            </li>

            <li class="person">
                <p><i class="am-icon-tags"></i>我的收藏</p>
                <ul>
                    <li> <a href="/collect">收藏</a></li>
                    <li> <a href="foot.html">足迹</a></li>
                </ul>
            </li>

            <li class="person">
                <p><i class="am-icon-qq"></i>在线客服</p>
                <ul>
                    <li> <a href="consultation.html">商品咨询</a></li>
                    <li> <a href="suggest.html">意见反馈</a></li>

                    <li> <a href="news.html">我的消息</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>

</body>

</html>