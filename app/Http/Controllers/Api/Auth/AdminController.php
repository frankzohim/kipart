<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

class AdminController extends Controller
{
    public function login(Request $request){
        $AdminRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $admin=Admin::where("email",$AdminRequest["email"])->first();

        return (new LoginService())->login($admin,'CLE_SECRETE_KIPART_Admin','Administrateur');
    }

    public function register(){

    }
}
