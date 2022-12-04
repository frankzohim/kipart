<?php

namespace App\Http\Controllers\Auth\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|exists:agencies,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'this email is not exist in agencies table',
        ]);

        $creds=$request->only('email','password');

        if(Auth::guard('agent')->attempt($creds)){
            return redirect()->route('agent.dashboard');
        }else{
            return redirect()->route('agent.login')->with('fail','incorrect incredentials');
        }
    }

    public function logout(Request $request){

        Auth::guard('agent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}