<?php

namespace App\Http\Controllers\Api\test;

use App\Controller\Api\services\sms\SendSmsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\OTPRequest;
use Illuminate\Http\Request;

class TestOtpController extends Controller
{
    public function testOtp(OTPRequest $request){

        $sms=(new SendSmsService())->sendSms("delanofofe@gmail.com","test1234",$request->mobiles,"Test OTP","Kipart","2022-12-09 17:20:02");

        $smsResponse=json_decode($sms->getBody());

        if($smsResponse["responsecode"]==1){

            return response()->json(["status"=>"success","message"=>"message envoyé avec success au $request->mobiles"],200);
        }else{
            return response()->json(["status"=>"fail!","message"=>"une erreur s'est produite"],401);
        }

    }
}
