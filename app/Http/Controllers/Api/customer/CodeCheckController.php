<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\CodeCheckRequest;

class CodeCheckController extends Controller
{
    public function check(CodeCheckRequest $request,$id)
    {

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset==null) {
            return response(['message' => "Le Code de reinitialisation de votre mot de passe est invalide"],400);
        }
        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => 'Le code de reinitialisation de votre mot de passe à expiré'], 422);
        }

        $user = User::find($id);
        if($request->code==$passwordReset->code && $request->phone_number==$user->phone_number){
            return response(['message' => "Le Code est Valide Vous serez rediriger vers un formulaire de reinitialisation de mot de passe"],202);
        }






    }
}
