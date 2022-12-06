<?php

namespace App\Http\Controllers\Auth\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AgentController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|exists:agencies,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'this email is not exist in agencies table',
        ]);

        $response = Http::post('http://kipart.stillforce.tech/oauth/token', [
            'grant_type'    => 'password',
            'username' => $request->email,
            'password' =>$request->password,
            'client_secret' => 'KAB357Z3cvAtKF0rOgF4GARR3qBb8SNU3WrhtPR6',
            'client_id'=>5
        ]);
        $access_token = json_decode((string) $response->getBody(), true)['access_token'];

        Session::put('token', $access_token);
        Session::save();

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
