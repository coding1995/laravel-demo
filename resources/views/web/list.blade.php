<!DOCTYPE html >
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="_token" content="{{ csrf_token() }}"/>
		<title>商品列表</title>

		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('web/AmazeUI-2.4.2/assets/css/admin.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('web/basic/css/demo.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('admin_css/css/test.css') }}" />
		<link href="{{ asset('web/css/seastyle.css') }}" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="{{ asset('web/basic/js/jquery-1.7.min.js') }}"></script>

		<script type="text/javascript" src="{{ asset('web/js/script.js') }}"></script>
	</head>

	<body>

		<!--顶部导航条 -->
		<div class="am-container header">
			
			@include('web.layout.header')

			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
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
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														
							
							<ul class="select">
							
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>
								<li class="select-list">
									<dl id="select1">
										<dt class="am-badge am-round">品牌</dt>	
									
										 <div class="dd-conent">										
											@foreach($brand as $brand)
											<dd>
												<a href="#" class="brand" id="brand">{{$brand->Brand}}</a>
											</dd>
											@endforeach
										 </div>
						
									</dl>
								</li>
								<li class="select-list">
									<dl id="select2">
										<dt class="am-badge am-round">分类</dt>
										<div class="dd-conent">
											
											@foreach($data as $shopSort)
											<dd>
												<a href="#" class="shopSort" id="shopSort">{{$shopSort->name}}</a>
											</dd>
											@endforeach	
										</div>
									</dl>
								 </li>
							</ul>

							<div class="clear"></div>
                        </div>
							<div class="search-content" style="width: 100%">
								<div class="sort">
									<li class="first"><a title="综合" href="{{asset('/list')}}">综合排序</a></li>
									<li><a href="javaScript:;" class="sellNum" id="1">销量排序</a></li>
									<li><a href="javaScript:;" class="sellNum1" id="sellNum1" data-id = '2'>价格优先</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes" id="goodsul">
									@foreach($goods as $v)
									<li class="li1">
										<a href="{{url('/weba/'.$v->id)}}">
										<div class="i-pic limit">
											<img src="{{$v->gmages}}" />											
											<p class="title fl">
											【{{$v->goodname}}】{{$v->introduction}}
											</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{$v->price}}</strong>
											</p>
										</div>
										</a>
									</li>
									@endforeach
								</ul>
							</div>
							<!--分页 -->
							<div>
								<ul class="am-pagination am-pagination-right" id="pages">

									{!! $goods->appends($request->only(['keyword']))->render() !!}

								</ul>
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

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home2.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>

		<!--菜单 -->
	
		<script type="text/javascript" src="{{asset('web/basic/js/quick_links.js')}}"></script>

<div class="theme-popover-mask"></div>

	</body>
<script>
$('.sellNum').click( function () {
	// console.log($('.li'));
var id = $('.sellNum').attr('id'); 
// console.log(v);
$.ajax({

	type:'POST',
	url:'/list/'+id,
	data:'id='+id,
	headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
    success:function(data){
    	// console.log(data)
		$('.li1').remove();
		$('#pages').remove();
    	var str = '';
    	for (var i = 0; i < data.length; i++) {
    		str += '<li class="li1">';
    		str += '<a href="/weba/'+data[i].data[0].id+'">';
    		str += '<div class="i-pic limit">';
    		str += '<img src="'+data[i].data[0].gmages+'"/>';
    		str += '<p class="title fl">【'+data[i].data[0].goodname+'】'+data[i].data[0].introduction+'</p>';
			str += '<p class="price fl">';
			str += '<b>¥</b>';
			str	+= '<strong>'+data[i].data[0].price+'</strong>';
			str += '</p>';
    		str += '</div>';
    		str += '</a>';
    		str += '</li>';
    	}
    	// console.log(str);
    	$('#goodsul').append(str);

    },
    

});
} );

$('#sellNum1').click( function () {
var id = $('.sellNum1').attr('data-id');
// console.log(v);
$.ajax({

	type:'POST',
	url:'/list/'+id,
	data:{'id':id,	'_token': '{{csrf_token()}}'},
    success:function(data){
		$('.li1').remove();
		$('#pages').remove();
    	var str = '';
    	for (var i = 0; i < data.length; i++) {
    		str += '<li class="li1">';
    		str += '<a href="/weba/'+data[i].id+'">';
    		str += '<div class="i-pic limit">';
    		str += '<img src="'+data[i].gmages+'"/>';
    		str += '<p class="title fl">【'+data[i].goodname+'】'+data[i].introduction+'</p>';
			str += '<p class="price fl">';
			str += '<b>¥</b>';
			str	+= '<strong>'+data[i].price+'</strong>';
			str += '</p>';
    		str += '</div>';
    		str += '</a>';
    		str += '</li>';
    	}
    	// console.log(str);
    	$('#goodsul').append(str);

    },
    

});
} );

$('a.shopSort').click( function () {
	$(this).parent().attr('id', '1');//给dd加id
	$(this).parent().siblings().removeAttr('id');//删除dd同级的id
	var res = $(this).html();//获取点击的数据
		$.ajax({
			type:'POST',
			url:'/ajax/'+res,
			data:{res:res,'_token': '{{csrf_token()}}'},
			success:function (data) {
				$('.li1').remove();
				$('#pages').remove();
		    	var str = '';
		    	for (var i = 0; i < data.length; i++) {
		    		str += '<li class="li1">';
		    		str += '<a href="/weba/'+data[i].id+'">';
		    		str += '<div class="i-pic limit">';
		    		str += '<img src="'+data[i].gmages+'"/>';
		    		str += '<p class="title fl">【'+data[i].goodname+'】'+data[i].introduction+'</p>';
					str += '<p class="price fl">';
					str += '<b>¥</b>';
					str	+= '<strong>'+data[i].price+'</strong>';
					str += '</p>';
		    		str += '</div>';
		    		str += '</a>';
		    		str += '</li>';
		    	}
		    	// console.log(str);
		    	$('#goodsul').append(str);
			},
		});
} );
</script>
</html>
