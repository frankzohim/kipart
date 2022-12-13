<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request,$id)
    {


        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['responseCode'=>0,'message' => 'Le code de reinitialisation de votre mot de passe à expiré'], 422);
        }

        // find user's email
        $user = User::firstWhere('id', $id);

        if($request->code==$passwordReset->code){
           // update user password
            $password=bcrypt($request->password);
            $user->password=$password;
            $user->save();

            // delete current code
            $passwordReset->delete();

            return response(['responseCode'=>1,'message' =>'mot de passe reinitialisé avec success'], 200);
        }

        if($request->code!=$passwordReset->code){

            return response(['responseCode'=>2,'message' => "le Code de reinitialisation de votre mot de passe est invalide"],404);
        }




    }
}
