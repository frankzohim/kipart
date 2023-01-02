<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GenerateTicket extends Controller
{
    public function generateTicket(Request $request){

        $send=Http::post("http://qrcode.mykipart.com/api/v1/qrcodes",[

            "user_id"=>$request->user_id,
            "agency"=>$request->agency,
            "departure"=>$request->departure,
            "arrival"=>$request->arrival,
            "date"=>$request->date,
            'seat_number'=>$request->seat_number,
            'passenger_name'=>$request->passenger_name,
            'passenger_id'=>$request->passenger_id,
            'passenger_id'=>$request->passenger_id,
            "class"=>$request->class,
        ]);

        return $send;
    }
}
