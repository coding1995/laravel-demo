<?php

namespace App\Http\Controllers\Web;
use App\Address;
use App\District;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function addressshow(){
        $upid = intval($_GET['upid']);
        $list = District::where('upid','=',$upid)->get(['id','name','upid']);
//        dd($list);
        return json_encode($list);
    }

    //添加地址视图
    public function index(Request $request)
    {
        $value=$request->session()->get('webuser');
        $uid=$value[0]->id;
        return view('web.address',['ss'=>self::alladdress($uid)]);
    }

    public function showselect($selectid){
        $list = DB::table('districts')->where('id','=',$selectid)->get(['id','name']);
        return $list[0]->name;
    }

    //地址添加数据库
    public function insert(Request $request){
        $this->validate($request, [
            'name'=>'required|alpha_dash',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'address'=>'required',
            'pro'=>'required',
            'city'=>'required',
            'area'=>'required',
        ],[
            'required' => ':attribute 是必填项。。。',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'address'=>'地址',
            'name'=>'名字',
            'tel'=>'电话号码',
            'pro'=>'省份',
            'city'=>'城市',
            'area'=>'地区',
        ]);
        $value=$request->session()->get('webuser');
        $data = $request->except('_token');
        $data['uid']=$value[0]->id;
        $pro = $this->showselect($request->pro);
        $city = $this->showselect($request->city);
        $area = $this->showselect($request->area);
        if($request->stree == -1){
            $stree = '';
        }else{
            $stree= isset($request->stree)?$this->showselect($request->stree):'';
        }
        $data['address']= $pro.'&nbsp;'.$city.'&nbsp;'.$area.'&nbsp;'.$stree.'&nbsp;'.$request->address;
        $s =Address::create($data);
//        $s = DB::table('addresses')->insert($data);
        if($s){
            return back();
        }else{
            return back()->withInput()->with(['error'=>'地址添加失败，请重新添加！！！']);
        }
    }

    //查询数据库前台展示地址
    public static function alladdress($id){
        return DB::table('addresses')->where('uid','=',$id)->get();

    }

    //删除用户新增地址
    public function delete($id){
        if ( Address::destroy($id))
        {
            return back();
        }else{
            return back()->with(['error'=>'删除失败！请重新操作']);
        }
    }

    //修改新增用户信息
    public function addressedit($id){
         $post = Address::where('id','=',$id)->first();
//        dd($post);
        return view('web.addressedit',compact('post'));
    }

    //处理修改地址
    public function addressupdate(Request $request, $id){
        $this->validate($request, [
            'name'=>'required|alpha_dash',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'address'=>'required',
        ],[
            'required' => ':attribute 是必填项。。。',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'address'=>'地址',
            'name'=>'名字',
            'tel'=>'电话号码',
        ]);
        if(Address::where('id','=',$id)->update(['name'=>$request->name, 'tel'=>$request->tel, 'address'=>$request->address, 'emailno'=>$request->emailno]))
        {
            return redirect('web/address')->with(['success'=>'修改成功！！！']);
        }else{
            return back()->with(['error'=>'修改失败，请重新编辑！！']);
        }
    }
}
