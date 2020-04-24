<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
class CheckLogin
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
        //获取登陆session
        $adminUser=session("adminUser");
        //判断是否登陆
        if(!$adminUser){
            $adminCookie=Cookie::get("adminUser");
            if($adminCookie){
                session(["adminUser"=>unserialize($adminCookie)]);
            }else{
                return redirect("/login/index");
            }
        }
        return $next($request);
    }
}
