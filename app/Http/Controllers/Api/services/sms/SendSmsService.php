<?php

namespace App\Http\Controllers\Api\services\sms;

use App\Http\Requests\OTPRequest;
use Illuminate\Support\Facades\Http;

class SendSmsService{

    public function sendSms(string $user,string $password,$mobile, string $content, string $sender, string $schedule){

        $send=Http::post("https://smsvas.com/bulk/public/index.php/api/v1/sendsms",[

            "user"=>$user,
            "password"=>$password,
            "senderid"=>$sender,
            "sms"=>$content,
            "mobiles"=>$mobile,
            "scheduletime"=>$schedule,
        ]);

        return $send;

    }
}
