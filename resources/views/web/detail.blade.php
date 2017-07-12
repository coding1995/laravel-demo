<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>商品页面</title>

		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/admin.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/basic/css/demo.css') }}" rel="stylesheet" type="text/css" />
		<link type="text/css" href="{{ asset('web/css/optstyle.css') }}" rel="stylesheet" />
		<link type="text/css" href="{{ asset('web/css/style.css') }}" rel="stylesheet" />

		<script type="text/javascript" src="{{ asset('web/basic/js/jquery-1.7.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('web/basic/js/quick_links.js')}}"></script>

		<script type="text/javascript" src="{{ asset('web/AmazeUI-2.4.2/assets/js/amazeui.js')}}"></script>
		<script type="text/javascript" src="{{ asset('web/js/jquery.imagezoom.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('web/js/jquery.flexslider.js')}}"></script>
		<script type="text/javascript" src="{{ asset('web/js/list.js')}}"></script>

	</head>

	<body>


		<!--顶部导航条 -->
		@include('web.layout.header')
		

			
			<div class="listMain">

				<!--分类-->
			<div class="nav-table">
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
			</div>
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="#">首页</a></li>
					<li><a href="#">分类</a></li>
					<li class="am-active">内容</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="{{asset('web/images/01.jpg')}}" title="pic" />
								</li>
								<li>
									<img src="{{asset('web/images/02.jpg')}}" />
								</li>
								<li>
									<img src="{{asset('web/images/03.jpg')}}" />
								</li>
							</ul>
						</div>
					</section>
				</div>

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
						
							<div class="tb-booth tb-pic tb-s310">
								<img src="{{$goods->gmages}}" alt="" id="small" />
									<div id="show">
										<img src="{{$goods->gmages}}" alt="" style="width: 800px;height: 800px">
									</div>
							</div>
								<style>						
									#show{
										width: 400px;
										height: 400px;
										overflow: hidden;
										position: absolute;
										display: none;
										left:430px;
										top:0px;
									}
								</style>
							<script>
								 //放大镜函数
							 function zoom () {
							 	//找到小图
							 	var small = document.getElementById('small');

							 	var big = document.getElementById('show');

							 	// 鼠标移入事件，让放大区显示
							 	small.onmouseover = function () 
							 	{
							 		big.style.display = 'block';
							 	}

							 	//已有小图相对位置,改变是大图滚动条位置
							 	small.onmousemove = function (ev) 
							 	{
							 		var e = ev||event;

							 		var offX = e.offsetX;
							 		var offY = e.offsetY;

							 		//根据小图的相对位置，改变大图的滚动条距离
									big.scrollLeft = offX*3 - 100;
									
									big.scrollTop = offY*3 - 100;	
							 	}

							 	//鼠标移出后，放大区隐藏
							 	small.onmouseout = function () 
							 	{
							 		big.style.display = 'none';
							 	}
							 }
							 zoom();
							</script>
							<ul class="tb-thumb" id="thumblist">
								
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>	
				 {{$goods->goodname}}
	          </h1>
						</div>
						<div class="tb-detail-list">
							<!--价格-->
							<div>
								<li>									
									<b>简介：{{$goods->introduction}}</b>        
								</li>
							</div>
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>价格</dt>
									<dd><em>¥</em><b class="sys_item_price">{{$goods->price}}</b>  </dd>                                 
								</li>
								<div class="clear"></div>
							</div>

							<!--地址-->
							

							<!--销量-->
							<ul class="tm-ind-panel">
								<li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">销量：</span><span class="tm-count">{{$GoodsDetail->sellnum}}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">库存：</span><span class="tm-count">{{$GoodsDetail->store}}</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
											<form class="theme-signin" name="loginform" action="/adcart" method="post">
												 <input type="hidden" name="_token" value="{{csrf_token()}}">
												 <input type="hidden" name="id" value="{{$goods->id}}">
												<div class="theme-signin-left">

													<div class="theme-options">
														<div class="cart-title">规格：</div>
														<ul>
														@foreach($attributes as $v)
															<li style="float:left" class="sku-line"><label><input type="checkbox" name="attributes_id[]" value="{{$v['id']}}">{{$v['name']}}</label></li>
														@endforeach
														</ul>
														
													</div>

													
													<div class="theme-options">
														<div class="cart-title number">数量：</div>
														<dd>
															<input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
															<input id="text_box" name="num" type="text" value="1" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
														</dd>
													</div>
													<div class="clear"></div>

													<div class="btn-op">
														<div class="btn am-btn am-btn-warning">确认</div>
														<div class="btn close am-btn am-btn-warning">取消</div>
													</div>
												</div>
												

											
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
							<!--活动	-->
							
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							
							
							</div>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login">
									<button type="submit" id="LikBasket" title="点此按钮到下一步确认购买信息" >立即购买</button>
								</div>
							</li>
							<li>
								<div class="clearfix tb-btn tb-btn-buy theme-login">
									<a title="收藏" href="javaScript:;" onclick="collects({{$goods->id}})" >收藏</a>

								</div>
							</li>
						</div>
						</form>
					</div>

					<div class="clear"></div>

				</div>

				
				<div class="clear"></div>
				
							
				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					  
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">宝贝详情</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">全部评价</span></a>

								</li>

								
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									{!!$GoodsDetail->contents!!}

								</div>

								<div class="am-tab-panel am-fade">
									
                                    商品评价

								</div>

								

							</div>

						</div>

						<div class="clear"></div>

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

				</div>
			</div>
			<!--菜单 -->
				<script>
				function collects($id)
					{
						

							$.get(

								"{{url('/collect')}}"+'/'+$id,

								{"_method":"get"}, 

								function (data) {
									
									switch(data){ 
										case '1':
												alert('收藏成功');
										break;
										case '0':
												alert('收藏失败');
										break;
										case '2': 
												alert('你已经收藏了');
										break;
									}
									console.log(data);
								}
							
							);
						
					}
						
				</script>

	</body>

</html>
