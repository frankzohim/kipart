<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'phone_number' => 'required|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('phone_number', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send sms to user


        return response(['message' => trans('passwords.sent')], 200);
    }
}
