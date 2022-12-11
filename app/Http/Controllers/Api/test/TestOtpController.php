<?php

namespace App\Http\Controllers\Api\test;

use App\Controller\Api\services\sms\SendSmsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestOtpController extends Controller
{
    public function testOtp(Request $request){

        $send=(new SendSmsService())->sendSms("delanofofe@gmail.com","test1234",$request->mobiles,"Test OTP","Kipart","2022-12-09 17:20:02");

        return $send;
    }
}
