<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('adminuser')){
            if(session('adminuser')[0]->is_admin == 0){
                return $next($request);
            }else{
                $userid = session('adminuser')[0]->id;
                //查询所属角色id
                $role_id = DB::table('user_roles')->where('uid','=',$userid)->pluck('role_id');
                if($role_id){
                    foreach($role_id as $roleid){
                        //查询角色所属权限id
                        $access_id = DB::table('role_accesses')->where('role_id','=',$roleid)->pluck('access_id');
                    }
                    if($access_id) {
                        $adminuser_urls = [];
                        foreach ($access_id as $accessid) {
                            //查询所属角色所拥有的权限
                            $accesslist = DB::table('accesses')->where('id', '=', $accessid)->pluck('urls');
                            $adminuser_urls = array_merge($adminuser_urls, $accesslist);
                        }
//                    dump($request->path());
//                    dump($adminuser_urls);
                        if (!in_array($request->path(), $adminuser_urls)) {
                            return redirect('admin/accesserrors');//没权限访问
                        }
                        if (in_array($request->path(), $adminuser_urls)) {
                            return $next($request);//有权限，可访问
                        }
                    }else{
                        return redirect('admin/accesserrors');//没有设置权限
                    }
                }else{
                    return redirect('admin/accesserrors');//没有设置角色
                }
            }
            return $next($request);

        }else{
            return redirect('admin/login')->with(['error'=>'请先登录！！']);
        }

    }
}
