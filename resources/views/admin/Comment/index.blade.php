@extends('admin.layout')

@section('content')
	   
	 <div class="tpl-content-page-title">
                评论列表
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
             
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-3">
                            <div class="am-form-group">
                              
                      
                            </div>
                        </div>
                        <div class="am-u-sm-12 am-u-md-3">
                            <div class="am-input-group am-input-group-sm">
                                <input type="text" class="am-form-field">
                                <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>
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
                                      
                                            <th class="table-title">Uisd</th>
                                            <th class="table-title">Odid</th>
                                            <th class="table-title">评论内容</th>
                                            <th></th>
                                            <th class="table-author am-hide-sm-only">状态</th>
                                            <th class="table-date am-hide-sm-only">下单日期</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $v)
                                        
                                        <?php
                                        switch ($v->grade) {
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
                                        <tr>
                                      		  
                                            <td><input type="checkbox"></td>
                                            <td>{{$v['id']}}</td>
                                            <td>{{$v['uid']}}</td>
                                            <td>{{$v['odid']}}</td>
                                           <td style="width:300px">{{$v['contents']}}</td>
                                            <td></td>
                                           <td>{{$status}}</td> 
                                            <td class="am-hide-sm-only">{{ $v['created_at'] }}</td>
                                            <td>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                 
                                                        <form action="comment/{{$v->id}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
        
                                                            <input type="submit" class='btn btn-danger' value="删除">
                                                    
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


