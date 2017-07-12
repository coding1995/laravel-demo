@extends('web.layout.layout')

@section('Carousel')

	   <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
			<ul class="am-slides">
			@foreach($carousel as $v)
				<li class="banner1"><img src="{{$v->pic}}"></li>
			@endforeach
			</ul>
		</div>
		
@endsection

@section('side_navigation')
<div id="nav" class="navfull">
	<div class="area clearfix">
		<div class="category-content" id="guide_2">
			<div class="category">
				<ul class="category-list" id="js_climit_li">
					@foreach($data as $v)
					<li class="appliance js_toggle relative">
						<div class="category-info">
							<h3 class="category-name b-category-name">
								<a class="ml-22" title="饼干、膨化">
									{{$v->name}}
								</a>
							</h3>
							<em>
								&gt;
							</em>
						</div>
						<div class="menu-item menu-in top">
							<div class="area-in">
								<div class="area-bg">
									<div class="menu-srot">
										<div class="sort-side">
											<dl class="dl-sort">
												<dt>
													<span title="饼干">
														{{$v->name}}
													</span>
												</dt>
												@foreach($v->goods as $goods)
												<dd>
													<a name="{{$goods->goodname}}" id="{{$goods->id}}" href="{{url('/weba/'.$goods->id)}}">
														<span>
															{{$goods->goodname}}
														</span>
													</a>
												</dd>
												@endforeach
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
						<b class="arrow">
						</b>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection


@section('marqueen')
<div class="marqueen">
						<span class="marqueen-title">商城友情链接</span>
						<div class="demo">

							<ul>
							    
						<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="../person/index.html">
									<img src="{{asset('web/images/getAvatar.do.jpg')}}">
								</a>
								<em>
									@if(session('webuser'))
										您好：<span class="s-name">{{session('webuser')[0]->username}}</span>
										@else
									Hi,<span class="s-name">小叮当</span>
									@endif
								</em>
							</div>
							@if(!session('webuser'))
							<div class="member-logout">
								<a class="am-btn-warning btn" href="{{url('web/login')}}">登录</a>
								<a class="am-btn-warning btn" href="{{url('web/register')}}">注册</a>
							</div>
							@endif
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>																	    
							    @foreach($links as $v)
								<li><a target="_blank" href="{{$v->url}}"><span>[{{$v->title}}]</span>{{$v->contents}}</a></li>
								@endforeach
							</ul>
                        <div class="advTip"><img src="{{asset('web/images/advTip.jpg')}}"/></div>
						</div>
</div>
@endsection

@section('shopmain')

@foreach($data as $v)
<div class="am-container ">
	<div class="shopTitle ">
		<h4>
			{{$v->name}}
		</h4>
	</div>
</div>
<div class="am-g am-g-fixed flood method3 ">
	<ul class="am-thumbnails ">
	@foreach($v->goods as $goods)
		<li>
			<div class="list ">
				<a href="{{url('/weba/'.$goods->id)}}">
					<img src="{{$goods->gmages}} ">
					<div class="pro-title ">
						{{$goods->goodname}}
					</div>
					<span class="e-price ">
						价格：{{$goods->price}}
					</span>
				</a>
			</div>
		</li>
	@endforeach
	</ul>
</div>
@endforeach
@endsection

