@extends('admin.layout')
@section('content')

        <div class="tpl-content-page-title">
            Amaze UI 设置权限
        </div>
        <ol class="am-breadcrumb">
            <li><a href="#" class="am-icon-home">首页</a></li>
            <li><a href="#">表单</a></li>
            <li class="am-active">Amaze UI 表单</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 表单
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

                    <h2>给 {{$post->name}} 添加权限</h2>
                    <div class="am-u-sm-12 am-u-md-9">
                        @if(session('error'))
                            <div class="partner" style="color: red">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="am-form am-form-horizontal" action="{{url('admin/role/accessstore')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">所有权限 / Access</label>
                                <div class="am-u-sm-9">
                                    @if($access)
                                        @foreach($access as $v)
                                            <input type="checkbox"  name="access_id[]" value="{{$v->id}}" {{in_array($v->id,$access_id)?"checked":""}} >{{$v->title}}<br>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection