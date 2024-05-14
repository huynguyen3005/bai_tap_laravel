<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //

    public function login(Request $request){
        if($request->isMethod('POST')){
            if(Auth::attempt($request->only(['email', 'password']))){
                $user = DB::table('users')->where('email', $request->email)->first();
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('user', $user);
                return redirect()->route('home');
            }else{
                Session::flash('login_error', 'Login failed, Infomation not match');
                return redirect('/login');
            }         
        }

        return view('auth.login');
    }


    public function register(Request $request){
        if($request->isMethod('POST')){
            $request->validate([
                'username' => 'required | min:8 | unique:users',
                'email' => 'required | email | unique:users',
                'password' => 'required | confirmed',
            ]);

            $user = User::create([
                'name' => '',
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Mail::to($request->email)->send(new RegisterMail());
            return redirect()->route('login');
        }

        return view('auth.register');
    }
}
