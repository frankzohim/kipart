<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AgentController extends Controller
{
    public function login(LoginRequest $request ){

        $AgentRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $Agent=Agency::where("email",$AgentRequest["email"])->first();

        return (new LoginService())->login($Agent,$AgentRequest,'AGENCE_KEY_PATH','Agent');
    }

    public function register(){

    }

    public function logout(){
        $user = Auth::guard('api-agent')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }
}
