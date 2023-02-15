<?php

namespace App\Services\api\user;
use App\Services\api\UrlServices;
use Illuminate\Support\Facades\Http;


class PassengerServices{

    public function add($cni,$name,$type,$telephone,$seatNumber,$isCheckPayment,$travel_id,$count){

        $url=(new UrlServices())->getUrl();

        $response=Http::post($url.'/api/passengers/'.$cni.'/'.$name.'/'.$type.'/'.$telephone.'/'.$seatNumber.'/'.$isCheckPayment.'/'.$travel_id.'/'.$count);

        return $response;
    }
}
