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
        // if ($request->ajax()) {
        //     \Log::info('AJAX detected for: ' . $request->path());
        // }
        // if (!in_array($exp_path[0],$arr_menu_prev)) {
        //     \Log::info('AJAX ACCESS DENIED for prefix: ' . $exp_path);
        //     return response()->json(['error' => 'DENIED'], 403);
        // }
        if($request->ajax() || $request->wantsJson()){
            $ajaxCheck = $this->checkAjaxAccess($request, $arr_menu_prev);
            if ($ajaxCheck !== null) {
                return $ajaxCheck;   // return error JSON
            }
            return $next($request);  // return ke controller
        }

        $exp_path = explode("/",strtolower($request->path()));
        if(!in_array($exp_path[0],$arr_menu_prev)){
            return $next($request);
        }

        // \Log::info('AccessAuthorization middleware triggered: ' . $request->path());
        

        return $next($request);
    }

    private function checkAjaxAccess(Request $request, $arr_menu_prev)
    {
        // --- ambil uri pertama ---
        $path = $request->path();
        $exp_path = explode("/",strtolower($path));
        $main_path = $exp_path[0];

        // --- Jika tidak punya akses, kirimkan JSON error ---
        if(!in_array($main_path, $arr_menu_prev)){
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have access to this menu'
            ], 403);
        }
        return null;
    }
}
