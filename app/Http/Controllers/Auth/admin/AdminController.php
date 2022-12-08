<?php

namespace App\Http\Controllers\Auth\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'this email is not exist in admins table',
        ]);

        $response = Http::post('http://kipart.stillforce.tech/oauth/token', [
            'grant_type'    => 'password',
            'username' => $request->email,
            'password' =>$request->password,
            'client_secret' => '5OIvyt0vYo5UbZ29PRhdor9R9imZKru9Nij2EMUb',
            'client_id'=>4
        ]);
        $access_token = json_decode((string) $response->getBody(), true)['access_token'];
        $numberAgency=$this->countAgency();
        Session::put('token', $access_token);
        Session::put('numberAgency',$numberAgency);
        Session::save();
        $creds=$request->only('email','password');



        if(Auth::guard('admin')->attempt($creds)){

            return view('admin.dashboard');
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

     public function countAgency(){

        $accessToken=Session::get('token');

        $countAgency=Http::withToken($accessToken)
        ->get('http://kipart.stillforce.tech/api/admin/v1/countAllAgency');

        return $countAgency;

    }
}
