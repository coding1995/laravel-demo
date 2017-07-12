<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use DB;
use App\Http\Requests;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
       
        $data = Orders::orderby('id','desc')->paginate(5);

   
       
       return  view('admin.Orders.index', compact('data', 'value'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
      
        $data = Orders::find($id);
        $state = array("0"=>"未发货","1"=>"已发货","2"=>"无效");
       // dump($data);
        return view('admin.Orders.edit', compact('data', 'state', 'value'));
    }

  

    /**s
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->all());
       if( Orders::where('id','=', $id)->update(['buy'=>$request->buy, 'written'=>$request->written, 'postcodes'=>$request->postcodes, 'address'=>$request->address, 'tel'=>$request->tel, 'num'=>$request->num]))
        { 
            return redirect('admin/orders');
        } else { 
            return back();
        }
    }

    public function upstate(Request $request)
    {   
        $ordersId = $request->ordersid;

        $ordersState = DB::table('order_details')->where('oid', $ordersId)->value('state');
        //dd($ordersState);
        if($ordersState == 0){ 
            $ordersState = 1;
        } else { 
            return back();
        }

       if( DB::table('order_details')->where('oid',$ordersId)->update(['state'=>$ordersState]))
        { 
            if( DB::table('orders')->where('num_id',$ordersId)->update(['state'=>$ordersState])) { 
                
                return redirect('admin/orders')->with(['success' => '发货成功']);
            }
          
        } else { 
            return back();
        }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if (Orders::destroy($id))
        { 
            return redirect('admin/orders');
        }
        
    }
}
