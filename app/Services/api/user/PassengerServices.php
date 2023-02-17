<?php

namespace App\Services\api\user;
use App\Services\api\UrlServices;
use Illuminate\Support\Facades\Http;


class PassengerServices{

    public function add($travel_id, $arrayPassengers,$passengerPlace){

        $url=(new UrlServices())->getUrl();

        $response=Http::post($url.'/api/passengers/'.$travel_id.'/'.$arrayPassengers.'/'.$passengerPlace);

        return $response;
    }
}
