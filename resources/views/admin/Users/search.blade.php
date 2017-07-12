@extends('admin.layout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="tpl-content-page-title">
        管理员信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="#" class="am-icon-home">首页</a></li>
        <li><a href="#">管理员信息</a></li>
        <li class="am-active">管理员列表</li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 管理员列表
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
                            <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>
                            <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm'}">
                            <option value="option1">所有类别</option>
                            <option value="option2">管理员</option>
                            <option value="option3">非管理员</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <form action="{{url('/admin/search')}}" method="post">
                        <div class="am-input-group am-input-group-sm">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="text" name="keyword" class="am-form-field">
                            <span class="am-input-group-btn">
                            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="submit" ></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main" border="0">
                        <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" class="tpl-table-fz-check" id="all"></th>
                            <th class="table-id">ID</th>
                            <th class="table-author am-hide-sm-only">头像</th>
                            <th class="table-title">管理员</th>
                            <th class="table-type">类别</th>

                            <th class="table-type">状态</th>
                            <th class="table-date am-hide-sm-only">添加日期</th>
                            <th class="table-set" width="20%">操作</th>
                        </tr>
                        </thead>@foreach($post as $v)
                            <tbody>

                            <tr>
                                <td id="list"><input type="checkbox"></td>
                                <td>{{$v->id}}</td>
                                <td><a href="#"><img src="{{asset('uploads/_min'.$v->pic)}}" class="img-circle" style="width: 80px;height: 80px;" ></a></td>
                                <td>{{$v->username}}</td>
                                <td class="am-hide-sm-only">{{$is_admin[$v->is_admin]}}</td>
                                <td>{{$grade[$v->grade]}}</td>
                                <td class="am-hide-sm-only">{{$v->created_at}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a href="/admin/user/{{$v->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button></a>
                                            <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span><a href="/admin/user/{{$v->id}}"> 查看</a></button>
                                            @if ($v->is_admin !== 0)
                                                <form action="/admin/user/{{$v->id}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="javascript:return del()"><span class="am-icon-trash-o"></span> 删除</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody> @endforeach
                    </table>
                    <div class="am-cf">

                        <div class="am-fr">
                            <ul class="am-pagination tpl-pagination">
                                {{--<span>{{ $post->links() }}</span>--}}
                            </ul>
                        </div>
                    </div><div></div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>
    <script>
        function del(){
            var msg = "您真的确定要删除管理员吗？\n\n请确认！";
            if(confirm(msg)==true){
                return true;
            }else {
                return false;
            }
        }
    </script>

@endsection