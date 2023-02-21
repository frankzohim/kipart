<?php

namespace App\Services\api\user;
use App\Services\api\UrlServices;
use Illuminate\Support\Facades\Http;


class PassengerServices{

    public function add($travel_id, $arrayPassengers,$subagency){

        $url=(new UrlServices())->getUrl();

        $client = new \GuzzleHttp\Client();
        $response = $client->post($url.'/api/passengers/'.$travel_id.'/'.$subagency, [
            'headers' => ['Content-Type'=>'application/json'],
            'body'    => $arrayPassengers
        ]);

        return json_decode($response->getBody());
    }
}
