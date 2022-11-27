<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $user=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);

        $userc=User::where("email",$user["email"])->first();

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

    public function register(Request $request){

        $user=$request->validate([
            'name'=>'required',
            'email'=>["email","required"],
            'password'=>["required","string",],
            'phone_number'=>["required","max:20"]
        ]);

        $user=User::create([
            "name"=>$user["name"],
            "email"=>$user["email"],
            "password"=>bcrypt($user["password"]),
            "phone_number"=>$user["phone_number"],
            "role_id"=>3,
        ]);

        return response($user,201);
    }
}
