<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\ForgotPasswordRequest;
use App\Http\Controllers\Api\services\sms\SendSmsService;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        $data = $request->validate([
            'phone_number' => 'required|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('phone_number', $request->phone_number)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);
        $message="Votre code de reinitialisation de mot de passe est ".$data['code'];
        // Send sms to user
        $sms=(new SendSmsService())->sendSms("delanofofe@gmail.com","test1234",$request->phone_number,$message,"Kipart","2022-12-09 17:20:02");

        return response(['message' => "Un code de reinitialisation vous a été envoyé à votre numéro de telephone"], 200);
    }
}
