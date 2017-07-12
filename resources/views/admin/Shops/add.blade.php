@extends('admin.layout')

@section('content')
<script type="text/javascript" charset="utf-8" src="{{url('/udeitor1_4_3/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{url('/udeitor1_4_3/ueditor.all.min.js')}}"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="{{url('/udeitor1_4_3/lang/zh-cn/zh-cn.js')}}"></script>
<div class="tpl-portlet-components">
	<div class="tpl-block">
		<div class="am-g">
			<div class="tpl-form-body tpl-form-line">
				<form class="am-form tpl-form-line-form" action="{{url('/admin/shop/insert')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				@if (count($errors) > 0)
			    <div class="alert alert-danger" style="color: red;">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
				@endif
					<div class="am-form-group">
						<label for="user-name" class="am-u-sm-3 am-form-label">
							商品名：
						</label>
						<div class="am-u-sm-9">
							<input type="text" class="tpl-form-input" id="user-name" placeholder="请输入商品名" name="goodname" value="{{old('goodname')}}">
							<small>
								请填写商品名0-10字左右。
							</small>
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-phone" class="am-u-sm-3 am-form-label">
							分类名：
						</label>
						<div class="am-u-sm-9">
							<select data-am-selected="{searchBox: 1}" style="display: none;" name="typeid">
								<option value="0">
									请选择
								</option>
								@foreach($GoodSort as $k=>$v)
								<option value="{{$v->id}}">
									{{$v->name}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="am-form-group">
						<label class="am-u-sm-3 am-form-label">
							价格：
						</label>
						<div class="am-u-sm-9">
							<input type="text" name="price" value="{{old('price')}}">
						</div>
					</div>
					<div class="am-form-group">
						<label class="am-u-sm-3 am-form-label">
							品牌：
						</label>
						<div class="am-u-sm-9">
							<input type="text" name="Brand" value="{{old('Brand')}}">
						</div>
					</div>
					<div class="am-form-group">
						<label class="am-u-sm-3 am-form-label">
							商品简介：
						</label>
						<div class="am-u-sm-9">
							<input type="text" name="introduction" value="{{old('introduction')}}">
						</div>
					</div>
					<div class="am-form-group">
						<label class="am-u-sm-3 am-form-label">
							库存量：
						</label>
						<div class="am-u-sm-9">
							<input type="text" name="store" value="{{old('store')}}">
						</div>
					</div>
					<div class="am-form-group">
						<label class="am-u-sm-3 am-form-label">
							属性名：
						</label>
						<div>
                        <ul>
                            @foreach($attributes as $k=>$v)
                            <li style="float:left;margin: 10px"><label><input type="checkbox" name="attributes_id[]" value="{{$v->id}}">{{$v->name}}</label></li>
                            @endforeach
                        </ul>
                    	</div>
					</div>				
					<div class="am-form-group">
						<label for="user-weibo" class="am-u-sm-3 am-form-label">
							商品主图：
						</label>
						<div class="am-u-sm-9">
							<input type="file" id="user-weibo" name="gmages">
							<div>
							</div>
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-intro" class="am-u-sm-3 am-form-label">
							商品详情：
						</label>
						<div class="am-u-sm-9">
							<textarea class="" rows="10" id="editor" style="width: 600px;height: 500px" name="contents">
							</textarea>
						</div>
					</div>
					<div class="am-form-group">
						<div class="am-u-sm-9 am-u-sm-push-3">
							<input type="submit" value="添加" class="am-btn am-btn-primary tpl-btn-bg-color-success ">
							<input type="reset" value="重置" class="am-btn am-btn-primary tpl-btn-bg-color-success ">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
		<script>
						
		//实例化编辑器
	    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
	    var ue = UE.getEditor('editor',{
	    	toolbars: [
    ['fullscreen', 'source', 'undo', 'redo', 'bold', 'simpleupload','link']
				]
	    });
		</script>
@endsection
