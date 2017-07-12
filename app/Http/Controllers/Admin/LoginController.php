<?php

namespace App\Http\Controllers\Admin;
use App\Login;
use App\User;
use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //验证码生成
    public function captcha(){
        ob_clean();
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        //Session::flash('milkcaptcha', $phrase);
        session(['milkcaptcha'=>$phrase]);
        //这种方式也可以存值
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }



    //跳转首页
    public function index(Request $request){
        $value =$request->session()->get('adminuser');
        return view('admin.index', compact('value'));

    }

    //跳转登录页面
    public function login(){

        return view('admin.login');
    }

    //处理登录页面
    public function store(Request $request){
        if($request){
            //用户输入验证
            $this->validate($request, [
                'username'=>'required|min:3|max:30|alpha_dash',
                'password'=>'required',
            ],[
                'required' => ':attribute 是必填项。。。',
                'min' => ':attribute 不得不少于3个字符。。。',
                'max' => ':attribute 最多30个字符。。。',
                'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。',
            ],[
                    'username'=>'帐号',
                    'password'=>'密码',
                ]);
            //处理用户输入的值和验证登录
            $data = $request->all();
            $datename = $data['username'];
            $datapassword = $data['password'];
            $post= DB::table('admins')->where('username','=',$datename)->get();
             bcrypt($datapassword);
            if($post){
               if(Hash::check($datapassword ,$post[0]->password)){
                   //验证码验证
                   $request->session()->put('adminuser',$post);
                   $userInput = $request->get('captcha');
                   if(Session::get('milkcaptcha') == $userInput){
                       return redirect('admin/');
                   }else{
                       return back()->withInput($request->except('password'))->with(['error'=>'验证码错误！请重新输入。。。']);
                   }

               }else {
                   return  back()->withInput($request->except('password'))->with(['error'=>'密码错误！请重新输入。。。']);
               }
            } else {
               return  back()->withInput($request->except('password'))->with(['error'=>'帐号错误！请重新输入。。。']);
            }
        } else {
            return view('admin.login');
        }
    }

    public function logout(Request $request){
       $request->session()->forget('adminuser');
        return redirect('admin/login');
    }
}
