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
						<div class="menu-hd"><a href="{{asset('/')}}" target="_top" class="h">商城首页</a></div>
					</div>
					@if(session('webuser'))
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="{{url('web/user')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="{{url('web/logout')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>安全退出</a></div>
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
					<div class="logo"><img src="{{ asset('web/images/logo.png')}}" /></div>
					<div class="logoBig">
						<li><img src="{{ asset('web/images/logobig.png') }}" /></li>
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
