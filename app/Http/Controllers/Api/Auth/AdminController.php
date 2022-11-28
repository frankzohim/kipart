<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AdminController extends Controller
{
    public function login(LoginRequest $request){
        $AdminRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $admin=Admin::where("email",$AdminRequest["email"])->first();

        return (new LoginService())->login($admin,$AdminRequest,'CLE_SECRETE_KIPART_ADMIN','Administrateur');
    }

    public function register(){

    }

    public function logout(){
        $user = Auth::guard('api-admin')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }
}
