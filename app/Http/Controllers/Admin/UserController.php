<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use App\User_role;
use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TomLingham\Searchy\Facades\Searchy;

class UserController extends Controller
{
    public function search(Request $request){
        $is_admin = array(0=>"管理员",1=>"非管理员");
        $grade=array(1=>"有效",0=>"无效");
        $post = Searchy::admins('username','email','tel')->query($request->keyword)->get();
        return view('admin.Users.search',compact('post','is_admin','grade'));
    }



    public function showuser(Request $request){

        $data = DB::table('admins')->pluck('username');
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
        $is_admin = array(0=>"管理员",1=>"非管理员");
        $grade=array(1=>"有效",0=>"无效");
        $post = Admin::paginate(10);
        return view('admin.Users.index',compact('post','is_admin','grade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Role::all();

        return view('admin.Users.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $file =  $request->file('pic');
                //判断文件是否上传成功
                if($file->isValid()){
                //存储路径
                $firdir = "uploads/";
                //原文件名
                $imagename = $file->getClientOriginalName();
                //扩展名
                $extension = $file->getClientOriginalExtension();
                }
                //新生产路径
                $newImagesName = md5(time()).random_int(5,5).".".$extension;
                //执行存储
//              $file->move($firdir,$newImagesName);
                //重新获取文件
                $imglist = Image::make($_FILES['pic']['tmp_name']);
                //保存大图
                $imglist->save($firdir.$newImagesName);
                //保存图片为200*200
                $imglist->fit(200,200);
                $imglist->save($firdir."_min".$newImagesName);
//                dd($imglist);
        }

        $this->validate($request, [
            'pic'=>'required',
            'username'=>'required|min:3|max:15|alpha_dash',
            'password'=>'required|min:3|max:30',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',
            'role_id'=>'required'
        ],[
            'required' => ':attribute 不能为空',
            'min' => ':attribute 是必填不少于3个字符',
            'max' => ':attribute 最多30个字符',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'pic' => '头像',
            'username' => '管理员 / Name',
            'password' => '密码',
            'tel' => '电话号码',
            'email' => 'email邮箱',
            'role_id'=> '所属角色'
        ]);

        $post = $request->all();
        $post['password']  = Hash::make($post['password']);
        $post['pic'] = $newImagesName;
        $post['remember_token'] = $post['_token'];
        $user = Admin::create($post);
        if($user){
                //添加所属角色
                if($post['role_id']){
                    foreach($post['role_id'] as $role_id){
                        DB::table('user_roles')->insert(['uid' =>$user->id, 'role_id' =>$role_id]);
                    }
                }
            return redirect('admin/user')->with(['success'=>'添加成功！！！']);
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
    public function show($id)
    {
        $is_admin = array(0=>"管理员",1=>"非管理员");
        $grade=array(1=>"有效",0=>"无效");
        $sex=array(1=>"男",2=>"女",3=>'保密');
        $post = Admin::find($id);
        if ($post == null){
            abort(503);
        }
        return view('admin.Users.show',compact('post','is_admin','grade','sex'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $is_admin = array(0=>"管理员",1=>"非管理员");
        $post = Admin::find($id);
        $role = Role::all();
        $role_id = DB::table('user_roles')->where('uid','=',$id)->pluck('role_id');
        return view('admin.Users.edit',compact('post', 'is_admin','role','role_id'));
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
        //头像不修改时取原来的头像
        $request->pic = $request->picname;
        //密码加密（判断密码是否改变）
        if (Hash::needsRehash($request->password)) {
            $request->password = Hash::make($request->password);
        }
        //头像修改
        if($request->isMethod('put')){
            $file =  $request->file('pic');
            if($file != null){
                //判断文件是否上传成功
                if($file->isValid()){
                    //存储路径
                    $firdir = "uploads/";
                    //原文件名
                    $imagename = $file->getClientOriginalName();
                    //扩展名
                    $extension = $file->getClientOriginalExtension();
                }
                //新生产路径
                $newImagesName = md5(time()).random_int(5,5).".".$extension;
                //重新获取文件
                $imglist = Image::make($_FILES['pic']['tmp_name']);
                //保存大图
                $imglist->save($firdir.$newImagesName);
                //保存图片为200*200
                $imglist->fit(200,200);
                $imglist->save($firdir."_min".$newImagesName);
                $request->pic = $newImagesName;
            }
        }
//        判断验证
        $this->validate($request, [
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',
            'role_id'=>'required'
        ],[
            'required' => ':attribute 不能为空',
            'regex' => ':attribute 填入非法，请重新写入。。。'
        ],[
            'tel' => '电话号码',
            'email' => 'email邮箱',
            'role_id'=>'所属角色'
        ]);
        //执行修改
        if(Admin::where('id','=',$id)->update(['password'=>$request->password, 'sex'=>$request->sex, 'grade'=>$request->grade, 'pic'=>$request->pic, 'tel'=>$request->tel, 'email'=>$request->email]))
        {
            $role_id = DB::table('user_roles')->where('uid','=',$id)->pluck('role_id');
            //利用集合查询变动角色需要删除的角色
            $role_id_delete = array_diff($role_id, $request->role_id);
            if($role_id_delete){
                DB::table('user_roles')->where('uid','=',$id)->where('role_id','=',$role_id_delete)->delete();
            }
            //利用集合查询变动角色需要添加的角色
            $new_role_id = array_diff( $request->role_id,$role_id);
            if($new_role_id){
                foreach($new_role_id as $roleid){
                    User_role::create(['uid'=>$id, 'role_id'=>$roleid]);
                }
            }
            return redirect('admin/user')->with(['success'=>'修改成功！！！']);
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
        if (Admin::destroy($id))
        {
            $pic ='uploads/'.$_POST['pic'];
            $minpic = 'uploads/_min'.$_POST['pic'];
            unlink($pic);
            unlink($minpic);
            return redirect('admin/user');
        }

    }
}
