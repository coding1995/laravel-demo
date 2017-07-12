<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>订单管理</title>

		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/admin.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css">

		<link href="{{ asset('web/css/personal.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('web/css/orstyle.css') }}" rel="stylesheet" type="text/css">

		<script src="{{ asset('web/AmazeUI-2.4.2/assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('web/AmazeUI-2.4.2/assets/js/amazeui.js') }}"></script>

	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="/weba"><a href="{{url('/weba')}}">首页</a></li>
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

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
									<div class="order-top">
										<div class="th th-item">
											<td class="td-inner">商品</td>
										</div>
										<div class="th th-price">
											<td class="td-inner">单价</td>
										</div>
										<div class="th th-number">
											<td class="td-inner">数量</td>
										</div>
										<div class="th th-operation">
											<td class="td-inner">商品操作</td>
										</div>
										<div class="th th-amount">
											<td class="td-inner">合计</td>
										</div>
										<div class="th th-status">
											<td class="td-inner">交易状态</td>
										</div>
										<div class="th th-change">
											<td class="td-inner">交易操作</td>
										</div>
									</div>

									<div class="order-main">
										<div class="order-list">
											<!-- {{dump($data)}} -->
											@foreach($data as $v)

			                                    <?php
			                                        switch ($v->state) {
			                                            case 0:
			                                                $status = '未发货';
			                                                break;
			                                            case 1:
			                                                $status = '已发货';
			                                                break;
			                                            case 2:
			                                                $status = '无效';
			                                                break;
			                                             case 3:
			                                                $status = '确认收货';
			                                                break;
			                                            
			                                                
			                                            default:
			                                                $status = '未知状态';
			                                        }
			                                    ?>
											<!--交易成功-->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{$v->oid}}</a></div>
													<span>成交时间：{{$v->created_at}}</span>
												
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="#" class="J_MakePoint">
																		<img src="{{$v->gmages}}" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{$v->goodname}}</p>
																			
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{$v->price}}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{$v->num}}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{$v->buy}}
																
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">{{$status}}</p>
																	
																</div>
															</li>
															 
															
															 	
															@if($status == '确认收货')
																	<li class="td td-change">
																		<a href="/orders/del?oid={{$v->oid}}" class=
																		'am-btn am-btn-danger anniu'>
																			删除订单</a>
																	</li>
															@endif
															
															@if($status == '已发货')
																	<li class='td td-change'>
																		<a href="/orders/upstates?oid={{$v->oid}}" class=
																		'am-btn am-btn-danger anniu'>
																		确认收货</a>
																	</li>
															@endif
															
														</div>
													</div>
												</div>
											</div>
											@endforeach
											
											
									<!--  -->
															<!-- <li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	提醒发货</div>
															</li> -->
														
															<!-- <li class="td td-change">
																<div class="am-btn am-btn-danger anniu">
																	确认收货</div>
															</li> -->
														

										</div>

									</div>

								</div>
							</div>

						</div>
					</div>
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
							<li> <a href="web/user">个人信息</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="address.html">地址管理</a></li>
							<li> <a href="cardlist.html">快捷支付</a></li>
						</ul>
					</li>
					<li class="person">
						<p><i class="am-icon-balance-scale"></i>我的交易</p>
						<ul>
							<li><a href="order">订单管理</a></li>
						
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
							<li> <a href="collect">收藏</a></li>
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
