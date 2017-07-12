<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\webOrders;
use App\Http\Requests;

class webOrderController extends Controller
{
    
    public function index(Request $request)
    { 
    	 $uid = session('webuser')['0']->id;
    	 $data = DB::table('order_details')
    	 ->join('goods', 'order_details.gid','=', 'goods.id')
    	 ->join('orders', 'order_details.oid', '=', 'num_id')
    	 ->select('goods.goodname', 'goods.gmages', 'order_details.oid', 'order_details.created_at', 'order_details.state', 'order_details.num', 'goods.price', 'orders.buy')
    	 ->get();
    	 // dump($data);
    	 // // foreach($data as $v){ 
    	 // //  	dump();
    	 // //  $daa = DB::table('goods')->where('id', $v->gid)->value('goodname');
    	 // //  	    	dump($daa);
    	 // // }
    	 // dd($data);
    	
    	 return view('web.order', compact('data'));
    }

     public function upstate(Request $request)
    {   
    	//dd($request->all());
        $ordersId = $request->oid;
       //dd($ordersId);
        $ordersState = DB::table('order_details')->where('oid', $ordersId)->value('state');
        if($ordersState == 1){ 
            $ordersState = 3;
        }
        //dd($ordersState);
       if( DB::table('order_details')->where('oid',$ordersId)->update(['state'=>$ordersState]))
        { 
            return redirect('/order');
        } else { 
            return back();
        }


    }
    public function del(Request $request)
    { 
		$ordersId = $request->oid;
		if(DB::table('order_details')->where('oid',$ordersId)->delete()){
			if(DB::table('orders')->where('num_id',$ordersId)->delete()){
             return redirect('/order');
		  }
         }
    }
}
