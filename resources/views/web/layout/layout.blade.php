<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>首页</title>

		<link href="{{asset('web/AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('web/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('web/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('web/css/hmstyle.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{asset('web/AmazeUI-2.4.2/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('web/AmazeUI-2.4.2/assets/js/amazeui.min.js')}}"></script>

	</head>

	<body>
		<div class="hmtop">
			<!--顶部导航条 -->
			@include('web.layout.header')
			
			
			<div class="banner">
                      <!--轮播 -->
						
						@yield('Carousel')
						@show

		<script type="text/javascript">
					(function() {
						$('.am-slider').flexslider();
					});
					$(document).ready(function() {
						$("li").hover(function() {
							$(".category-content .category-list li.first .menu-in").css("display", "none");
							$(".category-content .category-list li.first").removeClass("hover");
							$(this).addClass("hover");
							$(this).children("div.menu-in").css("display", "block")
						}, function() {
							$(this).removeClass("hover")
							$(this).children("div.menu-in").css("display", "none")
						});
					})
		</script>
						<div class="clear"></div>	
			</div>						
			
			<div class="shopNav">
				<div class="slideall">
			        
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="{{asset('/')}}">首页</a></li>
                                <li class="qc"><a href="{{asset('/list')}}">商品列表</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
		        				
						<!--侧边导航 -->
						
						@yield('side_navigation')
						@show
						<!--轮播 -->
						


					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="{{asset('web/images/navsmall.jpg')}}" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('web/images/huismall.jpg')}}" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('web/images/mansmall.jpg')}}" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="{{asset('web/images/moneysmall.jpg')}}" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					
					@yield('marqueen')
					@show
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
					<div class="shopMain" id="shopmain">
						@yield('shopmain')
						@show
					</div>
				</div>
			</div>
		</div>
		</div>
		<!--引导 -->

		<div class="navCir">
			<li class="active"><a href="home3.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
		<!--菜单 -->
		
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
		<script type="text/javascript " src="{{asset('web/basic/js/quick_links.js')}} "></script>
	</body>

</html>
