<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function login(Request $request){
        $user=$request->validate([
            'email'=>["email","required"],
            'password'=>'required|min:6',
        ]);
        $userc=Customer::where("email",$user["email"])->first();

        if(!$userc) return response(["message"=>"Aucun utilisateur"],401);

        if(!Hash::check($user["password"],$userc->password)){
            return response(['aucun utilisateur trouver avec ce mot de passe'],401);
        }
        $token=$userc->createToken("CLE_SECRETE_KIPART")->accessToken;

        return response([
            'utilisateur'=>$userc,
            "token"=>$token
        ],200);
    }
}
