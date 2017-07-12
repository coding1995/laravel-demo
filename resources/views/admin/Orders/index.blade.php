@extends('admin.layout')

@section('content')
	   
	 <div class="tpl-content-page-title">
                订单列表
            </div>
            <ol class="am-breadcrumb">
      
             
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 列表
                    </div>

                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-small input-inline">
                            <div class="input-icon right">
                                <i class="am-icon-search"></i>
                                <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                        </div>
                    </div>


                </div>
                @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-3">
                            <div class="am-form-group">
                               
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-3">
                            <div class="am-input-group am-input-group-sm">
                               
          </span>
                            </div>
                        </div>
                    </div>
                    <div class="am-g">
                        <div class="am-u-sm-12">
                           <!--  <form class="am-form" > -->
                          
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                             
                                            <th class="table-id">ID</th>
                                      
                                            <th class="table-title">订单号</th>
                                            <th class="table-title">订单总金额</th>
                                            <th class="table-title">收货地址</th>
                          
                                      
                                            
                                            <th class="table-author am-hide-sm-only">电话</th>
                                              <th class="table-author am-hide-sm-only">数量</th>
                                               <th class="table-author am-hide-sm-only">状态</th>
                                            <th class="table-date am-hide-sm-only">下单日期</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
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
                                        <tr>
                                      		  
                                            <td><input type="checkbox"></td>
                                            <td>{{$v['id']}}</td>
                                            <td>{{$v['num_id']}}</td>
                                            <td>{{$v['buy']}}</td>
                                           <td style="width:300px">{{$v['address']}}</td>
                                           <td>{{$v['tel']}}</td>
                                           <td>{{$v['num']}}</td>
                                           
                                           <td>{{$status}}</td> 
                                            <td class="am-hide-sm-only">{{ $v['created_at'] }}</td>
                                          
                                            <td>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                    @if ($v['state'] == 0)
                                                        <a href="orders/upstate?ordersid={{$v->num_id}}" class="btn btn-default " >发货</a>
                                                    @endif

                                                        <a href="orders/{{$v->id}}" class="btn btn-success">修改</a>
                                                        <a href="ordersdetail/{{$v->num_id}}" class="btn btn-default">查看</a>
                                                        
                                                        <form action="orders/{{$v->id}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        @if ($v['state'] == 2)
                                        
                                                            <input type="submit" class='btn btn-danger' value="删除">
                                                        @endif
                                                       </form>
                                                    </div>
                                                </div>
                                            </td>
                                             
                                        </tr>

                                         @endforeach
                                    </tbody>
                                </table>
                                
                                   {{$data->links()}}
                               
                                <hr>
                                    
                            <!-- </form> -->
                        </div>

                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>

@endsection


