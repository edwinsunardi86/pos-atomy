<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileUserController extends Controller
{
    function viewChangePassword(){
        return view('setting.user.change_password',[
            'active_gm'=> 'User',
            'active_m'=> '/change_password',
            'title'=> 'Change Password',
        ]);
    }
    
    function changeSelfPassword(Request $request){
        $user_id = Auth::user()->id;
        $password = $request->password;
        User::where('id',$user_id)->update(['password'=>bcrypt($password)]);
        $confirmation = ['message' => 'Password has been changed', 'icon' => 'success', 'redirect' => '/send_email'];
        $request->session()->flash('change', 'Password has been changed');
        return redirect('/dashboard_v1');
    }
}
