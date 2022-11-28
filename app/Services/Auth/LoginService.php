<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;


class LoginService{

    public function login($auth,$resquest,$token,$type){

        if(!$auth) return response(["message"=>"Aucun $type trouvé"],401);
        if(!Hash::check($resquest["password"],$auth->password)){
            return response(['aucun utilisateur trouver avec ce mot de passe'],401);
        }
        $token=$auth->createToken($token)->accessToken;

        return response([
            'utilisateur'=>$auth,
            "token"=>$token
        ],200);
    }
}
