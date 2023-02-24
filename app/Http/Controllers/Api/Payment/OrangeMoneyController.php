<?php

namespace App\Http\Controllers\Api\Payment;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class OrangeMoneyController extends Controller
{
    public function pay($number,$amount){
        $token=Self::getAccessToken(); // 1-step one: init payment with getAcessToken
        $payToken=Self::initPayment($token); // 2-Step Two:get Payment Token
        $paymentResponse=Self::paymentValidation($token,$payToken,$number,$amount); // 3-Step Final:Payment

        return $paymentResponse;
    }

    public static function getAccessToken(){

        $response=Http::withoutVerifying()->asForm()->withHeaders([
            'Authorization' => 'Basic aXRMRHFOZW5oY2dHSTBhUmNDWTVmOXZNWkZrYTpSbUdUcFdBSWRoZlRLOXJ3RGFQdmY1emJybWdh',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->post("https://api-s1.orange.cm/token",[
            'grant_type'=>'client_credentials'
        ]);

        $token=json_decode($response->body());
        return $token->access_token;

    }

    public static function initPayment($token){

        $response=Http::withToken($token)->withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA=',
        ])->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/init');
        $tokenPay=json_decode($response->body());
        return $tokenPay->data->payToken;
    }

    public static function paymentValidation($token,$payToken,$number,$amount){


        $params=response()->json([
            "notifUrl"=>"http://127.0.0.1:8000/api/pay/withOrangeMoney",
            "channelUserMsisdn"=>"693781611",
            "amount"=>"20",
            "subscriberMsisdn"=>"690394365",
            "pin"=>"4080",
            "orderId"=>"order1234",
            "description"=>"Payment d'un voyage",
            "payToken"=>$payToken]);
            $json=json_encode($params->getData());
        try{


            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay', [
                'verify' => false,
                'headers' => [
                'Authorization' => 'Bearer '.$token,
                'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA=',],
                'body'    => $params
            ]);

        }catch (GuzzleException $e) {
            return "Exception!: " . $e->getMessage();
        }

        // $response=Http::withToken($token)->withoutVerifying()->withHeaders([
        //     'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA=',
        // ])->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay',[
        //     "body" => $json,
        // ])->json();

        return $response;
    }
}
