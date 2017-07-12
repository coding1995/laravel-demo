<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Goods;
use App\Attributes;
use App\GoodsDetail;
use Illuminate\Support\Facades\Redis;

class WebController extends Controller
{   

    //首页
   public  function index(Request $request)
    {	
      //从redis拿到数据
      // $data = json_decode(Redis::get('json_data'));
      // $carousel = json_decode(Redis::get('json_carousel'));
      // $links = json_decode(Redis::get('json_links'));
      // if ($data == null && $carousel == null && $links==null) {//查询数据库
          //拿到不同的分类对应不同的商品
          $data = DB::table('good_sorts')
          ->where('path', 'like', '%0,%')
          ->orderBy('id', 'desc')
          ->take(10)
          ->get();
          // dd($data);
          foreach ($data as $k => $v) {
            $data[$k]->goods = DB::table('goods')
            ->where('goods.typeid', '=', $v->id)
            ->orderBy('goods.id', 'desc')
            ->take(6)
            ->get();

           }
          //拿到友情链接
          $links = DB::table('links')->where('status', '=', 0)->get();

          //轮播图
          $carousel = DB::table('carousel_figures')->where('status', '=', 0)->get();
          // dump($data);
          // 存入redis
          // $json_data = json_encode($data);
          // $json_links = json_encode($links);
          // $json_carousel = json_encode($carousel);
          // Redis::set('json_data', $json_data); 
          // Redis::set('json_links', $json_links); 
          // Redis::set('json_carousel', $json_carousel); 
  
          return view('web.index', compact('data', 'links', 'carousel'));
          
        //   } else {
        	
        // 	return view('web.index', compact('data', 'links', 'carousel'));
        // }
    }

    //商品详情
   public function detail(Request $request, $id)
   {
   		$goods = Goods::findOrFail($id);//获取商品主表信息

   		$attributes = $goods->Attributes->toArray();//获取商品属性信息
   		// dd($attributes);
   		$GoodsDetail = GoodsDetail::where('gid', '=', $id)->first();//获取商品详情表信息
   		
   		return view('web.detail', compact('goods', 'attributes', 'GoodsDetail'));

   }

   //商品列表显示
   public function list(Request $request)
   {  
      $data = DB::table('good_sorts')->get();//商品分类信息

      $brand = DB::table('goods_details')->orderBy('id', 'asc')->take(15)->get();//商品品牌

      $goods = DB::table('goods')//商品主表
                ->where(function($query) use ($request){
                      //获取关键字
                      $keyword = $request->input('keyword');
                      //检测参数
                      if(!empty($keyword)) {
                          $query->where('goodname','like','%'.$keyword.'%');
                      }
                  })
                ->paginate(8);
   		return view('web.list', compact('data', 'brand', 'goods', 'request'));
   }

   //ajax请求
   public function ajax(Request $request)
   {  
        $id = $request->id;
        if( $id == 1 ){//点击的是销量
        $goods = DB::table('goods_details')->orderBy('sellnum', 'desc')->get();
        foreach ($goods as $k => $v) {
          $goods[$k]->data = DB::table('goods')
          ->where('goods.id', '=', $v->gid)
          ->get();
        }
        return $goods;
      } else {//点击的价格

        $goods = DB::table('goods')->orderBy('price')->get();
        return $goods;
      }
   }

   public function search(Request $request)
   {
      $res = $request->res;
      $id = DB::table('good_sorts')->where('name', '=', $res)->first()->id;
      $goods = DB::table('goods')->where('typeid', '=', $id)->get();
      foreach ($goods as $k => $v) {
        $goods[$k]->data = DB::table('goods_details')
        ->where('goods_details.gid', '=', $v->id)
        ->get();
      }
      return $goods;
   }

}
