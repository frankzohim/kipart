<?php

namespace App\Services\tickets;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class GenerateTicketService{

    public function generateTicket($user_id,$subAgencyName,$departure,$arrival,$date,$seatNumber,$passengerName,$passengerId,$passengerPhone,$class){


        $accessToken=$this->generateToken();
        $send=Http::withHeaders([

            'Authorization'=> "Bearer $accessToken",

            ])->
            post("http://qrcode.mykipart.com/api/v1/qrcodes",[

            "user_id"=>$user_id,
            "agency"=>$subAgencyName,
            "departure"=>$departure,
            "arrival"=>$arrival,
            "date"=>$date,
            'seat_number'=>$seatNumber,
            'passenger_name'=>$passengerName,
            'passenger_id'=>$passengerId,
            'passenger_phone'=>$passengerPhone,
            "class"=>$class,
            "token"=>$accessToken
        ]);


        return response($send, 200)
            ->header('Content-Type','image/svg');
    }

    public function generateToken(){
        $response = Http::post('http://qrcode.mykipart.com/oauth/token', [
            'grant_type'    => 'password',
            'username' => "contact@mykipart.com",
            'password' =>"password",
            'client_secret' => 'eTwE4vI1WNApTKVx9yv9WfRM02G9OpG4bCsSsLPU',
            'client_id'=>2
        ]);
        $access_token = json_decode((string) $response->getBody(), true)['access_token'];

        Session::put('tokenTravel', $access_token);
        Session::save();
        return $access_token;
    }
}
