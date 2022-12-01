<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function testResponse(){

        $client = new Client();

        try{
            $response = $client->request('GET','http://kipart.stillforce.tech/api/list/agencies');

            return $response;
        }catch(\Exception $e){
            return $e->getMessage();
        }



    }
}
