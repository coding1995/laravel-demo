@extends('admin.layout')

@section('content')
		

	 <div class="tpl-content-page-title">
                订单详情
            </div>
            <ol class="am-breadcrumb">
                <li><a href="admin" class="am-icon-home">首页</a></li>
                
                <li class="am-active"> 订单详情</li>
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 订单详情
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-small input-inline">
                            <div class="input-icon right">
                                <i class="am-icon-search"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                        </div>
                    </div>

                
                </div>
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">
				     <?php
                                        switch ($data[0]->state) {
                                            case 0:
                                                $status = '差评';
                                                break;
                                            case 1:
                                                $status = '中评';
                                                break;
                                            case 32:
                                                $status = '好评';
                                                break;
                                          
                                            default:
                                                $status = '未知状态';
                                        }
                                    ?>
                        <div class="am-u-sm-12 am-u-md-9">
                          <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label" z>ID</label>
                                    <div class="am-u-sm-9">
                                    {{$data[0]->id}}
                                    </div>

                            </div>
                            <br>
                            <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">用户ID</label>
                                    <div class="am-u-sm-9">
                                       {{$data[0]->uid}}
                                    </div>
                  
                            </div>
                            <br>
                            <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">订单ID</label>
                                    <div class="am-u-sm-9">
                                       {{$data[0]->oid}}
                                    </div>
                  
                            </div>
                            <br>
                             <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">商品ID</label>
                                    <div class="am-u-sm-9">
                                       {{$data[0]->gid}}
                                    </div>
                  
                            </div>
                           
                            <br>
                             <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">数量</label>
                                    <div class="am-u-sm-9">
                                       {{$data[0]->num}}
                                    </div>
                  
                            </div>
                            <br>
                            <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">单价</label>
                                    <div class="am-u-sm-9">
                                       {{$data[0]->price}}
                                    </div>
                  
                            </div>
                            <br>
                           
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">商品图片</label>
                                <div class="am-u-sm-9">
                                  <img src="{{$goodsimage}}">
                            </div>
                            <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <a href="/admin/orders" class="am-btn am-btn-primary">返回列表</a>
                                    </div>
                            </div>
                            
                             
                             </div>
                        </div>
                        
                    </div>
                </div>

            </div>


			



@endsection
