<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index(){
        return view('login', [
            'title'=>'Login'
        ]);
        // return view('maintenance', [
        //     'title'=>'Maintenance'
        // ]);
    }

    public function authentication(Request $request){
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',

        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->remember == "on") {
                Cookie::queue(
                    Cookie::make('email', $request->email, 30 * 24 * 60 * 60)
                );
                Cookie::queue(
                    Cookie::make('password', $request->password, 30 * 24 * 60 * 60)
                );
                Cookie::queue(
                    Cookie::make('remember', $request->remember, 30 * 24 * 60 * 60)
                );
            } else {
                Cookie::queue(
                    Cookie::forget('email')
                );
                Cookie::queue(
                    Cookie::forget('password')
                );
                Cookie::queue(
                    Cookie::forget('remember')
                );
            }

            $is_block = User::Where(['email' => $request->email])->where(['is_blocked' => 1,'role' => 3])->count();
            if ($is_block > 0) {
                // $confirmation = ['message' => 'Akun kamu sudah diblok', 'icon' => 'error'];
                return back()->with('loginError','Akun kamu sudah diblock');
            } else {
                // $confirmation = ['message' => 'Login Sukses', 'icon' => 'success', 'redirect' => '/dashboard_v1'];
                return redirect()->intended('dashboard_v1')->with('loginSuccess','Login berhasil! Silahkan bekerja');
            }
        } else {
            // $confirmation = ['message' => 'Login gagal! Pastikan email dan password anda benar!', 'icon' => 'error'];
            return back()->with('loginError','Login gagal! Pastikan email dan password anda benar!');
        }
        // return response()->json($confirmation);
    }

    function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
