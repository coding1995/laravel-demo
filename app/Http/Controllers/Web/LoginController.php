<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\User_info;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{

    //帐号激活方法
    public function tokenemail($token){
           $user = User::where('token',$token)->first();
           if(is_null($user)){
               return redirect('/');
           }
           $user->status = 1;
           $user->token = str_random(48);
           $user->save();
        return redirect('web/login')->with(['success' => '帐号激活成功，请登录！！！']);

    }

    //邮箱找回密码
    public function resetemail(Request $request,$token){
           $info = User::where('token', $token)->first();
          if($request->token  == $info->token ){
              return view('web.reset', compact('info'));
          }

    }

    //处理重置后的密码写入
    public function doreset(Request $request){
            $this->validate($request, [
                'password'=>'required|min:6|max:30',
                'repassword'=>'required|min:6|max:30',
            ],[
                'required' => ':attribute 是必填项。。。',
                'min' => ':attribute 不得不少于6个字符。。。',
                'max' => ':attribute 最多30个字符。。。',
            ],[
                'password'=>'密码',
                'repassword'=>'确认密码',
            ]);
            $id = $request->input('id');
            $password= $request->input('password');
            $repassword=$request->input('repassword');
        if($password == $repassword){
               $datapassword = Hash::make($password);
               $token = str_random(48);
            if(User::where('id','=',$id)->update(['password'=>$datapassword,'token'=>$token])){
                return redirect('web/login')->with(['success' => '密码重置成功，请重新登录！！！']);
            }else{
                echo '密码找回失败，请重新设置。。。';
            }
        }else{
            return back()->withInput()->with(['error'=>'密码不一致，请重新确认输入。。。']);
        }
    }

    //发送邮件方法
    public function mail($user,$subject,$view,$data){

            Mail::queue($view,$data,function($message) use($user,$subject){
                  $message->to($user->email)->subject($subject);
            });

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

    //登录页面
     public function login(){

         return view('web.login');
     }

    //注销登录
    public function logout(Request $request){
        $request->session()->forget('webuser');
        return redirect('web/login');

    }

    //处理登录页面
    public function store(Request $request){
        if($request ){
            $this->validate($request, [
                'username'=>'required|min:3|max:30|alpha_dash',
                'password'=>'required',
            ],[
                'required' => ':attribute 是必填项。。。',
                'min' => ':attribute 不得不少于3个字符。。。',
                'max' => ':attribute 最多30个字符。。。',
                'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
            ],[
                'username'=>'帐号',
                'password'=>'密码',
            ]);

            $data = $request->all();
            $datename = $data['username'];
            $datapassword = $data['password'];
            $post= DB::table('users')->where('username','=',$datename)->get();
//            dd($post);
            bcrypt($datapassword);
            if($post){
                //验证帐号激活情况
                if($post[0]->status == 0){
                    return back()->with(['error'=>'帐号未激活，请激活后再尝试登录！！']);
                }
                //验证半小时内允许输错密码3次
                $wTime=3;
                $wrongTime = $this->handlerlogin($post,$min=30);
                if($wrongTime > $wTime){
                    echo '123';
                    return redirect('web/login')->withInput()->with(['error'=>'您刚刚输错很多次密码，为了保证账户安全，系统已经将您账号锁定30min']);
                }
                //验证密码
                if(Hash::check($datapassword ,$post[0]->password)){
                    //验证码验证
                    $request->session()->put('webuser',$post);
                    $userInput = $request->get('captcha');
                    if(session('milkcaptcha') == $userInput){
                        return redirect('/');//跳转主页，需要修改
                    }else{
                        return back()->withInput($request->except('password'))->with(['error'=>'验证码错误！请重新输入。。。']);
                    }

                }else {
                    //错误信息写入类
                    $this->errorwrite($post);
                    return back()->withInput($request->except('password'))->with(['error'=>'密码错误！请重新输入。。。']);
                }
            } else {
                return  back()->withInput($request->except('password'))->with(['error'=>'帐号错误！请重新输入。。。']);
            }
        }
        return view('web.login');
    }

    //跳转注册页面
    public function register(){
            return view('web.register');
    }

    //处理注册页面
    public function create(Request $request)
    {
//        dd($request->username);
            $this->validate($request, [
                'username' => 'required|min:3|max:15|alpha_dash',
                'password' => 'required|min:6|max:30',
                'passwordcopy' => 'required|min:6|max:30',
                'email' => 'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i'
            ], [
                'required' => ':attribute 不能为空',
                'min' => ':attribute 字符长度太短，请重新输入。。',
                'max' => ':attribute 最多30个字符',
                'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。',
                'regex' => ':attribute 填入非法，请重新写入。。。'
            ], [
                'username' => '用户名',
                'password' => '设置密码',
                'passwordcopy' => '确认密码',
                'email' => 'email邮箱'
            ]);

            $post = $request->all();
//           dd($post);
        if($post['password'] == $post['passwordcopy']){
            $post['password'] = Hash::make($post['password']);
            $post['remember_token'] = $post['_token'];
            $post['status'] = 0;
            $post['token'] = str_random(48);
             $user = User::create($post);
            if ($user) {
                DB::table('web_users')->insert(['uid' =>$user->id]);
                $data = [ 'token'=>$user->token, 'name'=>$user->username ];
                $view = 'web.mail';
                $subject = '悦桔拉拉帐号激活邮件！';
                $this->mail($user,$subject,$view,$data);
                return redirect('web/login')->with(['success' => '注册成功，请在邮件中激活后登录！！！']);
            } else {
                return back()->withInput();
            }
        }else{
            return back()->withInput()->with(['error'=>'密码不一致，请重新输入...']);
        }
    }

    //登录错误三次后要30分钟后登录
    public function handlerlogin($post,$min=30){
            $uid = $post[0]->id;
            $time = date('Y-m-d H:i:s',time());
            $prevtime = time() - $min*60;
            $prevTime = date('Y-m-d H:i:s',$prevtime);
            $ip = ip2long($_SERVER['REMOTE_ADDR']);
            $data = User_info::where('uid','=',$uid)->where('pass_wrong_time_status','=',2)->whereBetween('logintime',[$prevTime,$time])->where('ipaddr','=',$ip)->get();
            $wrongTime = count($data);
            return $wrongTime;

    }

    //错误信息写入类
    public function errorwrite($post){
            $uid = $post[0]->id;
            $ip = ip2long($_SERVER['REMOTE_ADDR']);
            $timedata = date('Y-m-d H:i:s');
            $datalist = [ 'uid'=>$uid, 'ipaddr'=>$ip, 'logintime'=>$timedata,'pass_wrong_time_status'=>2 ];
            User_info::create($datalist);
    }


    public function forget(){
           return view('web.forget');
    }

    public function doforget(Request $request){

        $this->validate($request, [
            'username'=>'required|min:3|max:30|alpha_dash',
            'email'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',
        ],[
            'required' => ':attribute 是必填项。。。',
            'min' => ':attribute 不得不少于3个字符。。。',
            'max' => ':attribute 最多30个字符。。。',
            'regex' => ':attribute 填入非法，请重新写入。。。',
            'alpha_dash'=> ':attribute 只能包含字母、数字、下划线，请重新输入。。。'
        ],[
            'username'=>'帐号',
            'email'=>'邮箱',
        ]);

            $info=User::where('email',$request->input('email'))->where('username',$request->input('username'))->first();
            $data = [ 'token'=>$info->token, 'name'=>$info->username ];
            $view = 'web.forgetmail';
            $subject = '悦桔拉拉帐号密码重置邮件！';
            $this->mail($info,$subject,$view,$data);
        return redirect('web/login')->with(['success' => '密码找回邮件发送成功，请到邮箱中查看！！！']);
    }

}
