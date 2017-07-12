<?php

namespace App\Http\Controllers\Admin;

use App\Access;
use App\Role;
use App\Role_access;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //ajax请求
    public function showuser(Request $request){

        $data = DB::table('roles')->pluck('name');
        $name = $request->name;
        if(in_array($name, $data)){
            echo json_encode(1);
        }else{
            echo json_encode(2);
        }

    }


    public function index(){
       $post = Role::paginate(10);
//        dd($post->name);
        return view('admin.Roles.index',compact('post'));
    }

    public function create(){

        return view('admin.Roles.create');

    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required|min:2|alpha_dash',
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于2个字符',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'name' => '角色 / Role',
        ]);
        $name = $request->input('name');
        if(Role::create(['name'=>$name])){
            return redirect('admin/role')->with(['success'=>'添加成功！！！']);
        }else{
            return back()->with(['error'=>'添加角色失败']);
        }

    }

    public function edit($id){
        $post = Role::find($id);
//        dd($post);
        return view('admin.Roles.edit',compact('post'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name'=>'required|min:2|alpha_dash',
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于2个字符',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'name' => '角色 / Role',
        ]);
        if(Role::where('id','=',$id)->update(['name'=>$request->name])){
            return redirect('admin/role')->with(['success'=>'修改成功！！！']);
        }else{
            return back()->with(['error'=>'修改失败！！']);
        }
    }

    public function setaccess($id){

         $post = Role::where('id','=',$id)->first();
        if($post){
//            $name = $post->name;
            //取出所有权限
            $access = Access::where('status','=',1)->get();
            //取出现阶段已分配的权限
            $access_id = DB::table('role_accesses')->where('role_id','=',$id)->pluck('access_id');
//            dd($access_id);
            return view('admin.Roles.setaccess',compact('post', 'access','access_id'));
        }else{
            return back()->with(['error'=>'该角色不存在,请重新选择。。。']);
        }

    }

    public function accessstore(Request $request){
        $this->validate($request, [
            'access_id'=>'required',
        ],[
            'required' => ':attribute 不能为空',
        ],[
            'access_id' => '权限设置',
        ]);
        $post=$request->all();
        $access_id = DB::table('role_accesses')->where('role_id','=',$post['id'])->pluck('access_id');
         //利用补集方法找出更改后需要删除的数据
        $delete_access_id = array_diff($access_id,$post['access_id'] );
//        dd($delete_access_id);
        if($delete_access_id){
            DB::table('role_accesses')->where('role_id','=',$post['id'])->where('access_id','=',$delete_access_id)->delete();
        }
        //需要添加的数据
        $new_access_id = array_diff($post['access_id'],$access_id );
        if($new_access_id){
            foreach($new_access_id as $accessid){
                Role_access::create(['role_id'=>$post['id'], 'access_id'=>$accessid]);
            }
        }
        return redirect('admin/role')->with(['success'=>'权限操作成功！！！']);

    }

}
