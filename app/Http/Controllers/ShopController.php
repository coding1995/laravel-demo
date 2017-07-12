<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GoodsDetail;

use App\Goods;

use App\Attributes;

use DB;

class ShopController extends Controller
{	
	/**
	 * 商品列表的显示
	 * @return [type] [description]
	 */
    public function index(Request $request)
    {	
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
    	// var_dump($request->all());
    	//获取分类信息
    	// $GoodSort = GoodsController::GetGoodSort();
    	$ShopData = Goods::orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('keyword');
                    //检测参数
                    if(!empty($keyword)) {
                        $query->where('goodname','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num', 6));

    	return view('admin.shops.index', ['ShopData'=>$ShopData, 'request'=>$request, 'value'=>$value]);
    }

    /**
     * 商品添加页面的显示
     */
    public function add(Request $request)
    {	
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
    	//获取分类信息
    	$GoodSort = GoodsController::GetGoodSort();

        //获取属性名
        $attributes = AttributesController::getAttributes();

    	return view('admin.shops.add', ["GoodSort"=>$GoodSort, "attributes"=>$attributes, 'value'=>$value]);
    }

    /**
     * 商品删除执行操作
     */
    public function destroy($id)
    {	

    	 //创建模型
        $goods = Goods::findOrFail($id);
        //读取的商品主图信息
        $profile = $goods->gmages;
        $path = '.'.$profile;
        if(file_exists($path)) {
            unlink($path);
        }
    	$res = Goods::destroy($id);
        if ( $res ) {   

        	if (DB::table('goods_details')->where('gid', '=', $id)->delete()) {
	        		
                if ($goods->attributes()->detach()) {
                    $data = [
                    "status"=>0,
                    "msg"=>"商品删除成功！！！",
                    ];
                }
        	}
        	
        } else {
        	 $data = [
                "status"=>1,
                "msg"=>"商品删除失败！！！",
            ];
        }

        return $data;
    }

    /**
     * 商品编辑页面显示
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit(Request  $request,$id)
    {	
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        //获取分类信息
        $GoodSort = GoodsController::GetGoodSort();
        //获取属性名
        $attributes = AttributesController::getAttributes();
        //获取商品信息
    	$Goods = new Goods;
    	$data = $Goods->findOrFail($id);
        //获取商品属性
        $dataAttributes = $data->Attributes->toArray();
        $ids = [];
        foreach ($dataAttributes as $key => $v) {
            $ids[] = $v['id'];
        }
        //商品详情
    	$GoodsDetail = new GoodsDetail;
    	$dataDetail = $GoodsDetail->where('gid', '=', $id)->get();
    	foreach ($dataDetail as $key => $v) {
    		
    	}
    	
    	return view('admin.shops.edit', ['Data'=>$data,
            'GoodSort'=>$GoodSort, //商品分类
            'value1'=>$v, //商品详情
            'attributes'=>$attributes,//商品属性
            'ids'=>$ids,//商品属性ID
            'value'=>$value
            ]);
    }

    /**
     * 商品更新操作
     */
    public function update(Request $request)
    {		

    	    $data = $request->all();
    		// dd($data['id']);
    		//创建模型
    		$Goods = new Goods;
    		$Goods = $Goods->findOrFail($data['id']);
    		$Goods->typeid = $data['typeid'];
    		$Goods->goodname = $data['goodname'];
    		$Goods->price = $data['price'];
            $Goods->state = $data['state'];
    		$Goods->introduction = $data['introduction'];
    		
    		//处理图片上传
	        if($request->hasFile('gmages')) {
            //拼接文件夹路径
            $destinationPath = './Upload/'.date('Y-m-d').'/'; //规则 /Upload/20121010/12381902381.jpg
            //拼接文件路径
            $fileName = time().rand(100000, 999999);
            //获取上传文件的后缀
            $suffix = $request->file('gmages')->getClientOriginalExtension();
            //文件的完整的名称
            $fullName = $fileName.'.'.$suffix;
            //保存文件
            $request->file('gmages')->move($destinationPath, $fullName);
            //拼接文件上传之后的路径  
            $Goods->gmages = trim($destinationPath.$fullName,'.');
        }

        if ($Goods->save()) {//如果插入goods表中成功则

        	//将商品详情存入goods_detail表中
        	$GoodsDetail = new GoodsDetail;
        	$GoodsDetail = $GoodsDetail->where('gid', '=', $data['id'])->get();
        	foreach ($GoodsDetail as $key => $value) {
        		# code...
        	}
	     	$value->gid = $data['id'];
	     	$value->Brand = $data['Brand'];
	     	$value->store = $data['store'];
	     	$value->contents = $data['contents'];

	     	if ($value->save()) {
	     		
                //将attributes数据存入到中间表 post_tag中
                if ($Goods->attributes()->sync($data['attributes_id'])) {
                    return redirect('/admin/shop')->with('info', '商品更新成功');               
                }
	     	}

        } else {
	     		return back()->with('info','商品更新失败');
	     	}
    }

    /**
     * 商品添加执行操作
     * 
     * 
     */
    public function insert(Request $request)
    {
            // dd($request->all());
    		//表单验证
    		$this->validate($request, [
            'goodname' => 'required',
            'typeid' => 'required',
            'price' => 'required|integer',
            'Brand' => 'required',
            'introduction' => 'required',
            'store' => 'required|integer',
            'contents' => 'required',
            'gmages' => 'image',
           
	        ],[
            'goodname.required' => '商品名不能省略',
            'typeid.required' => '分类名不能省略',
            'price.required' => '价格不能省略',
            'price.integer' => '价格请输入整数',
            'Brand.required' => '品牌名不能省略',
            'introduction.required' => '商品简介不能省略',
            'store.required' => '库存不能省略',
            'store.integer' => '库存量请输入整数',
            'contents.required' => '商品详情不能省略',
            'gmages.image' =>'请上传(jpeg、png、bmp、gif、 或 svg)等格式的图片',
	          
	        ]);
        
    		$data = $request->all();
    		// dd($data['typeid']);
    		//创建模型
    		$Goods = new Goods;
    		$Goods->typeid = $data['typeid'];
    		$Goods->goodname = $data['goodname'];
            $Goods->price = $data['price'];
    		$Goods->introduction = $data['introduction'];
    		$GetData = $Goods->get();
    		foreach ($GetData as $key => $v) {

    			if ($v->goodname==$data['goodname']) {

	     		return back()->with('info','商品名已经存在');
    				
    			}
    		}
    		
    		//处理图片上传
	        if($request->hasFile('gmages')) {
            //拼接文件夹路径
            $destinationPath = './Upload/'.date('Y-m-d').'/'; //规则 /Upload/20121010/12381902381.jpg
            //拼接文件路径
            $fileName = time().rand(100000, 999999);
            //获取上传文件的后缀
            $suffix = $request->file('gmages')->getClientOriginalExtension();
            //文件的完整的名称
            $fullName = $fileName.'.'.$suffix;
            //保存文件
            $request->file('gmages')->move($destinationPath, $fullName);
            //拼接文件上传之后的路径  
            $Goods->gmages = trim($destinationPath.$fullName,'.');
        }

        if ($Goods->save()) {//如果插入goods表中成功则

        	$Goods = $Goods->orderBy('id', 'desc')->first();//获取商品ID
        	//将商品详情存入goods_detail表中
        	$GoodsDetail = new GoodsDetail;
	     	$GoodsDetail->gid = $Goods['id'];
	     	$GoodsDetail->Brand = $data['Brand'];
	     	$GoodsDetail->store = $data['store'];
	     	$GoodsDetail->contents = $data['contents'];

	     	if ($GoodsDetail->save()) {
	     		//将attributes数据存入到中间表 post_tag中
                if ($Goods->attributes()->sync($data['attributes_id'])) {
                    return redirect('/admin/shop')->with('info', '商品添加成功');               
                }
	     	}

        } else {
	     		return back()->with('info','商品添加失败');
	     	}
    }
}

