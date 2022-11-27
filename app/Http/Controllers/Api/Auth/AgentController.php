<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

class AgentController extends Controller
{
    public function login(Request $request ){

        $AgentRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $Agent=Agency::where("email",$AgentRequest["email"])->first();

        return (new LoginService())->login($Agent,'CLE_SECRETE_KIPART_AGENCE','Agent');
    }

    public function register(){

    }
}
