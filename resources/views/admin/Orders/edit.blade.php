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
				
                         
                        <div class="am-u-sm-12 am-u-md-9">
                            <form class="am-form am-form-horizontal" method="post" action="{{$data->id}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label" z>ID</label>
                                    <div class="am-u-sm-9">
                                   	{{$data->id}}
                                 	</div>

                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">用户ID</label>
                                    <div class="am-u-sm-9">
                                       {{$data->uid}}
                                 	</div>
                  
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">订单ID</label>
                                    <div class="am-u-sm-9">
                                         {{$data->num_id}}
                                 	</div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-QQ" class="am-u-sm-3 am-form-label">价格</label>
                                    <div class="am-u-sm-9">
                                        <input type="number" pattern="[0-9]*"  name="buy" value="{{$data->buy}}">
                                    </div>
                                </div>
								<div class="am-form-group">
                                    <label for="user-QQ" class="am-u-sm-3 am-form-label">数量</label>
                                    <div class="am-u-sm-9">
                                        <input type="number" pattern="[0-9]*" name="num" value="{{$data->num}}" >
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label">邮编</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" id="user-email" name="postcodes" value="{{$data->postcodes}}">    
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">电话 </label>
                                    <div class="am-u-sm-9">
                                        <input type="tel" id="user-phone" name="tel" value="{{$data->tel}}">
                                    </div>
                                </div>
	
	
                                

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">收货地址</label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="2" name="address" id="user-intro" >{{$data->address}}</textarea>
                                       
                                    </div>
                                </div>
								<div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">状态</label>
                                    <div class="am-u-sm-9" name="state" id="state">
                 						{{$state[$data->state]}}
                                 	</div>
                                </div>	
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">下单时间</label>
                                    <div class="am-u-sm-9">
                                       {{$data->created_at}}
                                 	</div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>


			<script>
					
					$('div#state').on('click', function() { 
						alert(1);
					});
				

			</script>



@endsection
