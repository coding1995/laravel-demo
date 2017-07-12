@extends('admin.layout')

@section('content')
<div class="am-g tpl-amazeui-form">
        <div class="am-u-sm-12 am-u-md-9">  
            <form class="am-form am-form-horizontal" method="post" action="{{ asset('/admin/attributes/'.$attributes->id) }}" style="margin-top: 200px">
            {{csrf_field()}}
                <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-3 am-form-label">属性名：</label>
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
                        <input type="text" id="user-name" name="name" value="{{$attributes->name}}">
                    </div>
                </div>              
            <div class="am-u-sm-9 am-u-sm-push-3">
               <input type="hidden" name="_method" value="PUT">
                <input type="submit" value="修改" class="am-btn am-btn-primary">
                <input type="reset"  value="重置" class="am-btn am-btn-primary">
            </div>
            </form>
        </div>
</div>
@endsection
