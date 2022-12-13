<?php

namespace App\Http\Controllers\Api\customer;

use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;

class CodeCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['responseCode'=>0,'message' => 'Le code de reinitialisation de votre mot de passe à expiré'], 422);
        }

        if($passwordReset->code==$request->code){
            $passwordReset->delete();
            return response(['responseCode'=>1,'message' => "Code Valide Vous serez rediriger vers un formulaire de reinitialisation de mot de passe"],200);
        }

    }
}
