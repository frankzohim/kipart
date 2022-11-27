<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

class CustomerController extends Controller
{
    public function login(Request $request){
        $customerRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $customer=Customer::where("email",$customerRequest["email"])->first();

       return  (new LoginService())->login($customer,'CLE_SECRETE_KIPART_CUSTOMER','Client');
    }

    public function register(){

    }
}
