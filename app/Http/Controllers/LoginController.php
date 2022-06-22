<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            if($user->level == 'bendahara'){   
                return redirect()->intended('dashboard');
            }else if($user->level == 'pimpinan'){
                return redirect()->intended('pimpinan/dashboard');
            }
        }

        return view('login');
    }
    public function Authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            //filter user level
            // if Admin
            $user = Auth::user();
            if($user->level == 'bendahara'){   
                return redirect()->intended('dashboard');
            }else if($user->level == 'pimpinan'){
                return redirect()->intended('pimpinan/dashboard');
            }
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
