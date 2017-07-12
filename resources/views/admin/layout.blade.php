<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台首页</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{ asset('admin_css/i/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admin_css/i/app-icon72x72@2x.png') }}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" s/>
    <link rel="stylesheet" href="{{ asset('admin_css/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_css/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_css/css/test.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_css/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('style/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('style/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_css/css/app.css') }}">
    <script src="{{ asset('admin_css/js/echarts.min.js') }}"></script>
    <script src="{{asset('style/jquery-1.10.2.min.js')}}"></script>
</head>

<body data-type="index">

    <!-- 这是导航模块 -->
    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="{{ asset('admin_css/img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

        </div>

   
        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-bell-o"></span>  <span class="am-badge tpl-badge-success am-round"></span></span>
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-comment-o"></span>  <span class="am-badge tpl-badge-danger am-round"></span></span>
                    </a>
                    
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-calendar"></span>  <span class="am-badge tpl-badge-primary am-round"></span></span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3> <span class="tpl-color-primary"></span> </h3><a href="###"</a></li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc"></span>
                                <span class="percent"></span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc"> </span>
                                <span class="percent"></span>
                                </span>
                                <span class="progress">
                       <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-secondary" style="width:30%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc"></span>
                                <span class="percent"></span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-warning" style="width:60%"></div></div>
                    </span>
                            </a>
                        </li>

                    </ul>
                </li>
             
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="tpl-header-list-user-nick">{{$value[0]->username}}</span><span class="tpl-header-list-user-ico"> <img src="{{ asset('uploads/_min'.$value[0]->pic) }}"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li><a href="{{asset('admin/logout')}}" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>
        </div>
    </header>
    <!-- 导航结束 -->





    <!-- 侧边栏 -->
    <div class="tpl-page-container tpl-page-header-fixed">


        <div class="tpl-left-nav tpl-left-nav-hover">
            <div class="tpl-left-nav-title">
                    列表
            </div>
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                   <li class="tpl-left-nav-item">
                        <a href="{{ asset('admin') }} " class="nav-link active">
                            <i class="am-icon-home"></i>
                            <span>首页</span>
                        </a>
                    </li>
               

                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>

                            <span>管理员信息</span>

                        
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->

                                <a href="{{ asset('/admin/user/') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>管理员列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/user/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加管理员</span>

                               

                            </li>

                            
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>权限管理</span>
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/role') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>角色列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/access') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>权限列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>

                           

                            <span>订单管理</span>

                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                           
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                              
                                <a href="{{ asset('/admin/orders') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>订单列表</span>

                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            
                        </ul>
                    </li>
                 
                       
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>商品管理</span>
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/shop') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/shop/add') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品添加</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>友情链接管理</span>
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/link') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>友情链接列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>
                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/link/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>友情链接添加</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>商品属性管理</span>
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/attributes') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品属性列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>
                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/attributes/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品属性添加</span>

                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>商品分类管理</span>
                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/goods') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品分类列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>
                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/goods/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>商品分类添加</span>

                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            
                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>会员信息</span>

                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->

                                <a href="{{ asset('/admin/webuser/') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>会员列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/webuser/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加会员</span>
                                        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>

                        </ul>
                    </li>
                    <li class="tpl-left-nav-item">
                        <!-- 打开状态 a 标签添加 active 即可   -->
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list active">
                            <i class="am-icon-table"></i>
                            <span>轮播图管理</span>

                            <!-- 列表打开状态的i标签添加 tpl-left-nav-more-ico-rotate 图表即90°旋转  -->
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" style="display:block">
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->

                                <a href="{{ asset('/admin/carousel') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>轮播图列表</span>
                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>
                            <li>
                                <!-- 打开状态 a 标签添加 active 即可   -->
                                <a href="{{ asset('/admin/carousel/create') }}" class="active">
                                    <i class="am-icon-angle-right"></i>
                                    <span>添加轮播图</span>
                                        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                </a>

                            </li>

                        </ul>
                    </li>                   
                  
                </ul>
            </div>
        </div>





        <div class="tpl-content-wrapper">
            @if(session('info'))
               <div class="tpl-content-page-title">
                    {{session('info')}}
                </div>
            @endif
            @yield('content')
            @show

        </div>

    </div>

    <!-- 侧边栏结束 -->


   <script src="{{ asset('admin_css/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_css/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('admin_css/js/iscroll.js') }}"></script>
   <script src="{{ asset('admin_css/js/app.js') }}"></script>
</body>

</html>
