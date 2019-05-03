<?php

namespace App\Http\Middleware;

use Closure;
use App\Tools\ToolsAdmin;

class PermissionAuth
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
        $session = $request->session();
           // dd($session);
        $urls = ToolsAdmin::getUrlsByUserId($session->get('user.user_id'));
                // dd($urls);   
        $route = \Route::currentRouteName();

        //判断当前用户不是超管并且没有相对应的权限
        if($session->get("user.is_super") != 2 && !in_array($route,$urls)){
            return redirect("/403")->send();
        }

        return $next($request);
    }
}
