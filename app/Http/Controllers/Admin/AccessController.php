<?php

namespace App\Http\Controllers\Admin;

use App\Access;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    //ajax请求
    public function showuser(Request $request){

        $data = DB::table('accesses')->pluck('title');
        $name = $request->title;
        if(in_array($name, $data)){
            echo json_encode(1);
        }else{
            echo json_encode(2);
        }

    }

     public function index(){
         $post = Access::paginate(10);
//        dd($post->name);
         return view('admin.Access.index',compact('post'));
     }

    public function create(){

        return view('admin.Access.create');

    }

    public function store(Request $request){
        $this->validate($request, [
            'title'=>'required|min:2|alpha_dash',
            'urls'=>'required'
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于2个字符',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'title' => '权限名 / Role',
            'urls' =>'权限地址'
        ]);

         $post = $request->all();
//         $post['urls']=json_encode($post['urls']);
        if(Access::create($post)){
            return redirect('admin/access')->with(['success'=>'添加成功！！！']);
        }else{
            return back()->with(['error'=>'添加角色失败']);
        }

    }

    public function edit($id){
        $post = Access::find($id);
//        dd($post);
        return view('admin.Access.edit',compact('post'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'title'=>'required|min:2|alpha_dash',
            'urls'=>'required'
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于2个字符',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'title' => '权限名 / Role',
            'urls' =>'权限地址'
        ]);
        if(Access::where('id','=',$id)->update(['title'=>$request->title, 'urls'=>$request->urls])){
            return redirect('admin/access')->with(['success'=>'修改成功！！！']);
        }else{
            return back()->with(['error'=>'修改失败！！']);
        }
    }

    public function accesserrors(){
        return view('admin.accesserrors');
    }
}
