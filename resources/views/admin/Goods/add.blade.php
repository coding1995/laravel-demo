@extends('admin.layout');

@section('content')

<div class="am-g tpl-amazeui-form">
        <div class="am-u-sm-12 am-u-md-9">  
            <form class="am-form am-form-horizontal" method="post" action="{{ asset('/admin/goods') }}">
            {{csrf_field()}}
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">分类名称</label>
                    <div class="am-u-sm-9">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <input type="text" id="user-name" name="name" value="{{old('name')}}">
                    </div>
                </div>              
                <div class="am-form-group">
                    <label for="user-email" class="am-u-sm-3 am-form-label">父级分类</label>
                    <div class="am-u-sm-9">
                        <!-- <input type="email" id="user-email"> -->
                        <select id="user-email" name="pid">
                            <option value="0">一级分类</option>
                            @foreach($GoodSort as $k=>$v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <div class="am-u-sm-9 am-u-sm-push-3">
                <input type="submit" value="添加" class="am-btn am-btn-primary">
                <input type="reset"  value="重置" class="am-btn am-btn-primary">
            </div>
            </form>
        </div>
</div>
@endsection
