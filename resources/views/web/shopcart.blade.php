<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/basic/css/demo.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/css/cartstyle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/css/optstyle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/css/index.css') }}" rel="stylesheet" type="text/css" />
		
		<script src="{{ asset('web/js/jquery.1.4.2-min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('web/js/jquery.js') }}"></script>

	</head>

	<body>

		<!--顶部导航条 -->
		<div class="am-container header">
			@include('web.layout.header')
		

			<div class="clear"></div>
		

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
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
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							
							<div class="clear"></div>
							<div class="bundle-main">
		
							</div>
						</div>
					</tr>
					<div class="clear"></div>
					
						 
					<tr class="item-list">
						
						<div class="bundle  bundle-last ">
						
								<div class="bundle-main">
								
								

				@if(empty($data))
					<h1 style="font-size:30px">购物车空空如也，快去<a href="weba" style="font-size:40px;color:#f90">购买</a>吧~~~</h1>
				@endif
				<?php 
					$total = 0; //总价变量
					$nums = 0;  //总件数变量
				?>
								@foreach($data as $v)	
								<?php 

									$total += $v->price*$v->num;
									$nums  += $v->num;
								?>
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											
											<label for="J_CheckBox_170769542747"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank"  class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{$v->gmages}}" ></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="{{$v->goodname}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->goodname}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
									
											
											<span class="sku-line">{{$v->name}}</span>
											
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
											
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0">{{$v->price}}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<a href="/cutnum/{{$v->id}}"  >-</a>
													<input class="text_box" name="" type="text" value="{{$v->num}}" style="width:30px;" />
													<a href="/addnum/{{$v->id}}"  >+</a>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{$v->price*$v->num}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="/shopdel/{{$v->id}}" class="delete">删除</a>
										</div>
									</li>
								</ul>
							
								@endforeach

														</div>
						</div>
					
					</tr>
				</div>
				<div class="clear"></div>
				
				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						
					</div>
					
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">{{$nums}}</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">{{$total}}</em></strong>
						</div>
						<div class="btn-area">
							<a href="/addorder/{{session('webuser')['0']->id}}" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

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

			<!--操作页面

			<div class="theme-popover-mask"></div>

			
		<!--引导 -->
	
	</body>

</html>
