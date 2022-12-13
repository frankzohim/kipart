<?php

namespace App\Http\Controllers\Api\customer;

use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\CodeCheckRequest;

class CodeCheckController extends Controller
{
    public function check(CodeCheckRequest $request)
    {

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset==null) {
            return response(['responseCode'=>2,'message' => "Le Code de reinitialisation de votre mot de passe est invalide"],404);
        }
        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['responseCode'=>0,'message' => 'Le code de reinitialisation de votre mot de passe à expiré'], 422);
        }

        if($request->code==$passwordReset->code){
            return response(['responseCode'=>1,'message' => "Le Code est Valide Vous serez rediriger vers un formulaire de reinitialisation de mot de passe"],200);
        }






    }
}