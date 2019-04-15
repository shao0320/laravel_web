<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Model\Permission;
class AdminAuth
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
        $session = $request -> session();

        //查看用户是否登录
        if(!$session->has("user")){
            return redirect("/admin/login")->send();
        }

         View::share('username', $session->get('user.username'));
        View::share('image_url', $session->get('user.image_url'));
        View::share('user_id', $session->get('user.user_id'));
        //左侧菜单视图共享
        $user = $session->get('user');
        // dd($user);
        View::share('menus', Permission::getMenus($user));

        return $next($request);
    }
}
