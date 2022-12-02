<?php

namespace App\Http\Controllers\Auth\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'this email is not exist in admins table',
        ]);

        $creds=$request->only('email','password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->with('fail','incorrect incredentials');
        }
    }

    public function logout(Request $request){

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
