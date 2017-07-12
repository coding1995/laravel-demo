@extends('admin.layout')
@section('content')


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <div class="tpl-content-page-title">
            Amaze UI 权限列表
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">Amaze UI CSS</a></li>
            <li class="am-active">文字列表</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">
                            <a href="{{url('admin/access/create')}}"  class="btn btn-default btn-primary pull-right">新增权限</a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="tpl-block">

                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-check"><input type="checkbox" class="tpl-table-fz-check" ></th>
                                    <th class="table-id" >ID</th>
                                    <th class="table-author am-hide-sm-only" >权限</th>
                                    <th class="table-author am-hide-sm-only" >Urls</th>
                                    <th class="table-set" width="40%">操作</th>
                                </tr>
                                </thead>
                                @foreach($post as $v)
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{$v->id}}</td>
                                        <td class="am-hide-sm-only">{{$v->title}}</td>
                                        <td class="am-hide-sm-only">{{$v->urls}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="/admin/access/{{$v->id}}/edit"><span class="am-icon-pencil-square-o"></span> 编辑</a></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <div class="am-cf">

                                <ul class="am-pagination tpl-pagination">
                                    <span>{{ $post->links() }}</span>
                                </ul>

                            </div>
                            <hr>

                        </form>
                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>

@endsection
