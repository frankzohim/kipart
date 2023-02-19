<?php

namespace App\Services\api\agent;
use App\Services\api\UrlServices;
use Illuminate\Support\Facades\Http;


class AddPassengerServices{

    public function add($request,$id,$sub_agency_id){

        $url=(new UrlServices())->getUrl();

        $response=Http::post($url.'/api/add/passenger/'.$id.'/'.$sub_agency_id,[
            'name'=>$request->name,
            'type'=>$request->type,
            'cni'=>$request->cni,
            'telephone'=>$request->telephone,
        ]);

        return $response;
    }
}
