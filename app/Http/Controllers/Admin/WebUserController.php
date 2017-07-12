<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Web_user;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TomLingham\Searchy\Facades\Searchy;

class WebUserController extends Controller
{
    //会员搜索
    public function searchs(Request $request){
        $status = array(1=>'有效', 0=>'无效');
        $post = Searchy::users('username','email','tel')->query($request->keyword)->get();
        return view('admin.Webusers.search',compact('post','status'));

    }

    //ajax请求
    public function showusers(Request $request){

        $data = DB::table('users')->pluck('username');
        $name = $request->username;
        if(in_array($name, $data)){
            echo json_encode(1);
        }else{
            echo json_encode(2);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = array(1=>'有效', 0=>'无效');
        $post = User::paginate(10);
        return view('admin.Webusers.index', compact('post','status'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Webusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|min:3|max:15|alpha_dash',
            'password'=>'required|min:3|max:30',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i'
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于3个字符',
            'max' => ':attribute 最多30个字符',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'username' => '会员帐号 / Name',
            'password' => '密码',
            'tel' => '电话号码',
            'email' => 'email邮箱'
        ]);
        $post = $request->all();
//        dd($post);
        $post['password']  = Hash::make($post['password']);
        $post['remember_token'] = $post['_token'];
         $user = User::create($post);
        if($user){
            DB::table('web_users')->insert(['sex' =>$post['sex'], 'uid' =>$user->id]);
            return redirect('admin/webuser')->with(['success'=>'添加成功！！！']);
        }else {
            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $sex = array(1=>"男",2=>"女",3=>'保密');
        $status=array(1=>"有效",0=>"无效");
        $post = DB::table('web_users')->where('uid','=',$id)->join('users','users.id','=','web_users.uid')->first();
        if ($post == null){
            abort(503);
        }
        return view('admin.Webusers.show',compact('post','sex','status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $post = DB::table('web_users')->where('uid','=',$id)->join('users','users.id','=','web_users.uid')->first();
//        dd($post);
        return view('admin.Webusers.edit',compact('post'));
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
        $this->validate($request, [
            'password'=>'required|min:3',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i'
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于6个字符',
            'max' => ':attribute 最多50个字符',
            'regex' => ':attribute 填入非法，请重新写入。。。'
        ],[
            'password'=>'会员密码',
            'tel' => '电话号码',
            'email' => 'email邮箱'
        ]);
        $request->password = Hash::make($request->password);
        $user = User::where('id','=',$id)->update(['password'=>$request->password, 'status'=>$request->status, 'tel'=>$request->tel, 'email'=>$request->email]);
        $list=Web_user::where('uid','=',$id)->update(['sex'=>$request->sex]);
        if($list==1 && $user==1)
        {
            return redirect('admin/webuser')->with(['success'=>'修改成功！！！']);
        }else{
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
        if (User::destroy($id))
        {
           DB::table('web_users')->where('uid', '=', $id)->delete();
            return redirect('admin/webuser');
        }

    }
}
