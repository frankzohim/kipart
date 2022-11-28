<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class CustomerController extends Controller
{
    public function login(LoginRequest $request){
        $customerRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $customer=User::where("email",$customerRequest["email"])->first();

       return  (new LoginService())->login($customer,$customerRequest,'CLE_SECRETE_KIPART_CUSTOMER','Client');
    }

    public function register(){

    }

    public function logout(){
        $user = Auth::guard('api')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }
}
