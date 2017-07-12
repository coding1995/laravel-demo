<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('web/basic/css/demo.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/css/cartstyle.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('web/css/jsstyle.css') }}" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="{{ asset('web/js/address.js') }}"></script>

	</head>

	<body>

		<!--顶部导航条 -->
			@include('web.layout.header')

			<div class="clear"></div>
			<div class="concent">
				<!--地址 -->
				@foreach($addresses as $v)
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						
						<div class="clear"></div>
						<ul>
							<div class="per-border"></div>
							<li class="user-addresslist defaultAddr">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                  						 <span class="buy-user">{{$v->name}} </span>
										<span class="buy-phone">{{$v->tel}}</span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <!-- <span class="province">湖北</span>省
										<span class="city">武汉</span>市
										<span class="dist">洪山</span>区 -->
										<span class="street">{{$v->address}}</span>
										</span>

										</span>
									</div>
									<ins class="deftip">默认地址</ins>
								</div>
								<div class="address-right">
									<a href="../person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" class="hidden">设为默认</a>
									<span class="new-addr-bar hidden">|</span>
									<a href="#">编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
								</div>

							</li>
							<div class="per-border"></div>
							
						</ul>
						@endforeach
						<div class="clear"></div>
					</div>
					
					

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">金额</div>
									</div>
									
								</div>
							</div>
							<div class="clear"></div>

							<tr class="item-list">
								<div class="bundle  bundle-last">
									<?php 
									$total = 0;
									?>
									@foreach($data as $v)

									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="{{$v->gmages}}" class="itempic J_ItemImg"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->goodname}}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">商品规格:{{$v->name}}</span>
														
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->price}}</em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															
													{{$v->num}}
													
														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{$v->price*$v->num}}</em>
												</div>
											</li>
												<?php 

													$total += $v->price*$v->num;
												?>											

										</ul>
									@endforeach
										<div class="clear"></div>

									</div>
							</tr>
							<div class="clear"></div>
							</div>

							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										
										<div class="clear"></div>

									</div>
							</tr>
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						
							
							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    	<span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$total}}</em>
											</span>
										</div>
										<form action="/loworder" method="POST">
                                             <input type="hidden" name="total" value="{{$total}}">
                                              <input type="hidden" name="uid" value="{{session('webuser')['0']->id}}">

                                              <input type="hidden" name="_token" value="{{csrf_token()}}">
										<!-- {{dump($addresses)}} -->
										@foreach($addresses as $v)
										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
								  				<!--  <span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区 -->
												<span class="street">{{$v->address}}</span>
												</span>
												</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                         <span class="buy-user">{{$v->name}} </span>
												<span class="buy-phone">{{$v->tel}}</span>
												</span>
											</p>
										</div>
									</div>
										@endforeach
									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<button id="J_Go"  class="btn-go" tabindex="0" style="float:right" title="点击此按钮，提交订单">提交订单</button>
										</div>
									</div>
									</form>
									<div class="clear"></div>
								</div>
							</div>
						</div>
							

						<div class="clear"></div>
					</div>
				</div>
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
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

			</div>

			<div class="clear"></div>
	</body>

</html>
