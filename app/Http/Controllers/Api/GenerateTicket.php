<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GenerateTicket extends Controller
{
    public function generateTicket(Request $request){


        $accessToken=$this->generateToken();
        $send=Http::withHeaders([

            'Authorization'=> "Bearer $accessToken",

            ])->
            post("http://qrcode.mykipart.com/api/v1/qrcodes",[

            "user_id"=>4,
            "agency"=>$request->agency,
            "departure"=>$request->departure,
            "arrival"=>$request->arrival,
            "date"=>$request->date,
            'seat_number'=>$request->seat_number,
            'passenger_name'=>$request->passenger_name,
            'passenger_id'=>$request->passenger_id,
            'passenger_phone'=>$request->passenger_phone,
            "class"=>$request->class,
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
