<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AccessAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        $user_prev = DB::table('usersprivilege')->select('usersprivilege.menu_id','menu.path')->join('menu','usersprivilege.menu_id','=','menu.id')->where('user_id',Auth::id())->get();
        $arr_menu_prev = array();
        foreach($user_prev as $row){
            $exp_path = explode("/",$row->path);
            array_push($arr_menu_prev,strtolower($exp_path[0]));
        }
        $exp_path = explode("/",$request->path());
        if(in_array($exp_path[0],$arr_menu_prev)){
            return $next($request);
        }else{
            return redirect('dashboard_v1');
        }
        return $next($request);
    }
}
