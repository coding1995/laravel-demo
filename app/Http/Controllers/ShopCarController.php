<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopCar;
use DB;
use App\Goods;
use App\Attributes;

use App\Http\Requests;

class ShopCarController extends Controller
{
    
    public function add(Request $request)
    { 

    	if(!empty(session('webuser'))){

	        // dd($request->all());
    		  $uid = session('webuser')['0']->id;
		  	  $goodsid = $request->toArray()['id'];
		  	  $num = $request->toArray()['num'];
		  	 
		  	  foreach($request->toArray()['attributes_id'] as $v){ 
		  	  		$att = $v;
		  	  }
		  	  // dump($att);
		  	 
	  	  	// dump($goodsid);


		  	$goodsData = DB::table('goods')->where('id',$goodsid)->get();
		
			$attdata = DB::table('attributes')->where('id', $att)->get();
			// dd($attdata);

			//$shopdata = DB::table('shop_cars')->where('uid',$uid)->get();
			$shopgoodsid = DB::table('shop_cars')->where('uid',$uid)->value('goodsid');
			//dump($shopgoodsid);
			$shopgid = DB::table('shop_cars')->where('uid',$uid)->where('gid',$att)->value('gid');
			//dump($shopgid);

			$shopnum = DB::table('shop_cars')->where('uid',$uid)->where('gid',$att)->value('num');
			//dd($shopgoodsid);
			 if($shopgid != $att){
			
				$datas = DB::table('shop_cars')->insert([
					'uid' => $uid,
					'goodsid' => $request->toArray()['id'],
					'goodname' => $goodsData[0]->goodname,
					'gmages' => $goodsData[0]->gmages,
					'price' => $goodsData[0]->price,
					'num' => $num,
					'gid' => $attdata[0]->id,
					'name' => $attdata[0]->name
					]);

				 if ($datas) {
			
					return redirect('/cart');
				}
			  } else { 
			  	$a = $shopnum + $num;
			  	//dd($shopnum);

			  	DB::table('shop_cars')->where('goodsid', $goodsid)->where('gid',$att)->update(['num'=>$a]);
			  	return redirect('/cart');
			  	// return '123';
			  }
		} else { 

		return view('web.login');
	    
	    } 
	}

	public function show(Request $request)
	{ 
		if(!empty(session('webuser'))){
		
			$uid = session('webuser')['0']->id;
			$data = DB::table('shop_cars')->where('uid',$uid)->get();
			return view('web.shopcart', compact('data'));

		} else { 

			return view('web.login');
	    } 
	}

	//增加商品
	public function addNum($id)
	{ 
	  	$uid = session('webuser')['0']->id;
	  	$shopData = DB::table('shop_cars')->where('id',$id)->get();  
	  	$goodsid = $shopData[0]->goodsid;
		$goodsnum = $shopData[0]->num;

		$goodsData = DB::table('goods_details')->where('gid',$goodsid)->get();
		$goodsStore = $goodsData[0]->store;
		//判断库存
		if($goodsStore <= $goodsnum){ 
			echo '<script>alert("库存不足了");location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';
			exit;
		}
				$nums = $goodsnum + 1;
			  

			  	DB::table('shop_cars')->where('id', $id)->update(['num'=>$nums]);
			  	return redirect('/cart');

	}
	//减少商品
	public function cutNum($id)
	{ 
	
		$shopNum = DB::table('shop_cars')->where('id',$id)->value('num');  

		if($shopNum <= 1) { 
			echo '<script>alert("亲，最后一个了，请删除商品~~");location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';
			exit;
		 }
		 $nums = $shopNum - 1;
			DB::table('shop_cars')->where('id', $id)->update(['num'=>$nums]);
			return redirect('/cart');

	}
	//删除商品
	public function shopDel($id)
	{ 
		if (ShopCar::destroy($id))
        { 
            return redirect('/cart');
        }
	}


	public function addOrder($id)
	{ 
			$data = DB::table('shop_cars')->where('uid', $id)->get();
			$addresses = DB::table('addresses')->where('uid', $id)->get();
			//dd($addresses );
			// $time = date('Ymd H-i-s');
			// dd($time);
			return view('web.pay', compact('data', 'addresses'));
		 
	}

	public function lowOrder(Request $request)
	{ 
		 
	
			$uid = $request->uid;
			$total = $request->total;
			//dd($total);
			$gid = $request->session()->get('gid');

			//dd($gid);
			$addresses = DB::table('addresses')->where('uid', $uid)->get();
			//dump($addresses );
			
			if(!empty($addresses)){
			 	
			$shopdata = DB::table('shop_cars')->where('uid', $uid)->get();
			//dd($shopdata);
			
			$orderid = date('Ymd') . str_pad(mt_rand(1, 999),STR_PAD_LEFT);
				
				$sellnum = 0;
				$time = date('Y-m-d H-i-s');
				
				foreach($shopdata as $v){ 
						
					if( DB::table('orders')->insert(['uid'=>$uid, 'num_id'=>$orderid, 'buy'=>$total, 'postcodes'=>$addresses[0]->emailno, 'address'=>$addresses[0]->address, 'tel'=> $addresses[0]->tel, 'num'=>$v->num, 'state'=>0, 'created_at'=>$time]))
						{ 
								if (DB::table('order_details')->insert(['uid'=>$uid, 'oid'=>$orderid, 'gid'=>$v->goodsid, 'num'=>$v->num, 'price'=>$total, 'state'=>0, 'created_at'=>$time])) 
								{ 
										if (DB::table('shop_cars')->where('uid',$uid)->delete())
									        { 
												$sellnum += $v->num;
												$store = DB::table('goods_details')->where('gid', $v->goodsid)->value('store');
												$cutstore = $store - $v->num;
													if($upstore = DB::table('goods_details')->where('gid', $v->goodsid)->update(['sellnum'=>$sellnum, 'store'=>$cutstore]))
													{ 
														return view('web.success', compact('total', 'addresses'));
													} else { 
														 return redirect('/weba');
													}
									        } 

								} 

						} else { 
							 return '<a href="/weba">下单失败</a>';
						}
				}
		    } else { 
		     	return '<a href="web/address">请添加收货地址</a>';
		    }
		

	}
} 

    


 
