<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class webCollectController extends Controller
{
    public function index(Request $request)
    { 
    	
    	$uid = session('webuser')[0]->id;
    	$gid = $request->id;

        $data = DB::table('goods')->where('id', $gid)->get();
        $collid = DB::table('collects')->where('gid', $gid)->get();

        
        // if(empty($collid)){ 
        //     $collid[0]->id == 1;
        // }
         // DB::table('collects')->insert(['uid'=>$uid, 'gid'=>$gid])
        
    	//return $gid;
        // if($gid != $collid[0]->gid){
            if(DB::table('collects')->insert(['uid'=>$uid, 'gid'=>$gid, 'goodname'=>$data[0]->goodname, 'gmages'=>$data[0]->gmages, 'price'=>$data[0]->price]))
            {
                 return 1;
            } else {
                return 0;
            }
        // } else { 
        //     return 2;
        // }

    }

    public function show(Request $request)
    { 
        $uid = session('webuser')[0]->id;
        $uiddata = DB::table('collects')->where('uid', $uid)->get();
        
        return view('web.collection', compact('uiddata'));
    
    
        // dump($goodsdata);
        
    }

    public function del(Request $request)
    { 
        
        $uid = session('webuser')[0]->id;
        $gid = $request->id;

        // $data = DB::table('')->where('id', $gid)->get();

         // DB::table('collects')->insert(['uid'=>$uid, 'gid'=>$gid])
        //return $gid;
        if(DB::table('collects')->where('uid',$uid)->where('gid', $gid)->delete())
        {
            return 1;
        } else {
            return 0;
        }
    }


}
