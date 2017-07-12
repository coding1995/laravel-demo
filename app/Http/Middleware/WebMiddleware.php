<?php

namespace App\Http\Middleware;

use Closure;

class WebMiddleware
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
        if($request->session()->has('webuser')){
            return $next($request);
        }else{
            return redirect('web/login')->with(['error'=>'请先登录！！']);
        }

    }
}
