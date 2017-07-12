<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Web_user;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    //帐号安全页面
    public function safety(){
        return view('web.safety');
    }

    //密码修改页面
    public function password(){
        return view('web.password');
    }

    //处理密码修改
    public function passwordupdate(Request $request){
        $this->validate($request, [
            'password'=>'required',
            'newpassword'=>'required|min:6',
            'repassword'=>'required|min:6',
        ],[
            'required' => ':attribute 是必填项。。。',
            'min' => ':attribute 不得少于6个字符，请重新输入。。。',
        ],[
            'password'=>'密码',
            'newpassword'=>'新密码',
            'repassword'=>'确认密码',
        ]);
          $value = session('webuser')[0];
          $post  = $request->all();
          bcrypt($post['password']);
        if(Hash::check($post['password'] ,$value->password)){
            if($post['newpassword'] == $post['repassword']){
                $post['newpassword'] = Hash::make($post['newpassword']);
                User::where('id','=',$value->id)->update(['password'=>$post['newpassword']]);
                return back()->with(['success'=>'密码修改成功,下次登录请使用新密码！！']);
            }else{
                return back()->with(['error'=>'密码不一致！请重新输入。。。']);
            }
        }else{
            return back()->with(['error'=>'原密码错误！请重新输入。。。']);
        }
    }

    public function uploads($request){
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
            //重新获取文件
            $imglist = Image::make($_FILES['pic']['tmp_name']);
            //保存大图
            $imglist->save($firdir.$newImagesName);
            //保存图片为200*200
            $imglist->fit(200,200);
            $imglist->save($firdir."_min".$newImagesName);
//                dd($imglist);
            return $newImagesName;
        }
    }
    //头像上传方法
    public function picupload(Request $request,$uid){
        $newImagesName= $this->uploads($request);
        if(User::where('id','=',$uid)->update(['pic'=>$newImagesName])){
           if($request->oldpic != '1.jpg' ){
               $pic ='uploads/'.$request->oldpic;
               $minpic = 'uploads/_min'.$request->oldpic;
               unlink($pic);
               unlink($minpic);
           }
           return back()->with(['success'=>'上传修改成功！！！']);

        }else{
           return back()->with(['error'=>'上传失败，请重新上传！！！']);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //个人信息主页
    public function index(Request $request)
    {
        $value =  $request->session()->get('webuser');
        $uid = $value['0']->id;
        $post = DB::table('web_users')->where('uid','=',$uid)->join('users','users.id','=','web_users.uid')->first();
        return view('web.user_info',compact('post','list'));
    }

    //处理修改信息
    public function showupdate(Request $request, $uid){

        $this->validate($request, [
            'nickname'=>'required|alpha_dash',
            'name'=>'required|alpha_dash',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i'
        ],[
            'required' => ':attribute 是必填项。。。',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含文字、字母、数字、下划线，请重新输入。。。'
        ],[
            'nickname'=>'昵称',
            'name'=>'名字',
            'tel'=>'电话号码',
            'email'=>'邮箱'
        ]);
        $request->birthday=$request->YYYY.'年'.$request->MM.'月'.$request->DD.'日';
        $list=Web_user::where('uid','=',$uid)->update(['nickname'=>$request->nickname, 'name'=>$request->name, 'sex'=>$request->sex, 'birthday'=>$request->birthday]);
        $user = User::where('id','=',$uid)->update(['tel'=>$request->tel, 'email'=>$request->email]);
        if($list==1 && $user==1 ){
            return back()->with(['success'=>'修改成功！！！']);
        }else{
            return back()->with(['error'=>'修改失败，请重新修改！！！']);
        }

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
