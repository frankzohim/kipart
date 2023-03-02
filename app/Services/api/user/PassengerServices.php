<?php

namespace App\Services\api\user;
use App\Services\api\UrlServices;
use Illuminate\Support\Facades\Http;


class PassengerServices{

    public function add($travel_id, $arrayPassengers){

        $url=(new UrlServices())->getUrl();

        $client = new \GuzzleHttp\Client();
        // $response = $client->post($url.'/api/passengers/'.$travel_id.'/', [
        //     'headers' => ['Content-Type'=>'application/json'],
        //     'body'    => $arrayPassengers
        // ]);

        $response=Http::asJson()->withBody($arrayPassengers,'application/json')->post($url.'/api/passengers/'.$travel_id,[

        ]);


        return $response;
    }
}
