<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdersDetail;
use App\Http\Requests;
use DB;

class OrdersDetailController extends Controller
{
    //
    public function show(Request $request,$id)
    { 
    	$value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        //dump($id);
    	$data = DB::table('order_details')->where('oid',$id)->get();
    	//dump($data);
        if(!empty($data)){
            $goodsid = $data[0]->gid;

        	$goodsdata = DB::table('goods')->where('id',$goodsid)->get();
        	$goodsimage= $goodsdata[0]->gmages;
        	//dd($goodsimage);
        	return view('admin.Orders.show', compact('data','goodsimage', 'value'));
        } else { 
            return back();
        }
    }
}
