<?php

namespace App\Http\Controllers\Api\Payment;


use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class OrangeMoneyController extends Controller
{
    public function pay($number,$amount,$id,$codePromo,$subId){

        $code=PromoCode::where('code',$codePromo)->first();
        $arrayTicket=[];
        if($code){
            $code->update([
                'isUse'=>1
            ]);
        }else{

        }

        $payments=Passenger::where('payment_id',$id)->get();
        $token=Self::getAccessToken(); // 1-step one: init payment with getAcessToken
        $payToken=Self::initPayment($token); // 2-Step Two:get Payment Token
        $paymentResponse=Self::paymentValidation($token,$payToken,$number,$amount); // 3-Step Final:Payment
        $response=json_decode($paymentResponse);
        $statusPay=Self::getPaymentStatus($token,$payToken);
        $status=json_decode($statusPay);

        if($status->data->status=='SUCCESS'){
            foreach($payments as $payment){

                $ticket=Ticket::create([
                    'user_id'=>Auth::guard('api')->user()->id,
                    'sub_agency_id'=>$subId,
                    'travel_id'=>$payment->travel_id,
                    'passenger_id'=>$payment->id,
                    'type'=>1
                ]);
                $payment->update([
                    'isCheckPayment' =>1,
                    'means_of_payment'=>"Orange Money"
                ]);

                array_push($arrayTicket,$ticket->id);
        }

        return response()->json(["message"=>'payment effectué',"ticketId"=>$arrayTicket],200);
    }else{

        return response()->json(["message"=>$status->message,"status"=>$status->data->status],200);
    }

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


        // $params=response()->json([
        //     "notifUrl"=>"http://127.0.0.1:8000/api/pay/withOrangeMoney",
        //     "channelUserMsisdn"=>"693781611",
        //     "amount"=>"20",
        //     "subscriberMsisdn"=>"690394365",
        //     "pin"=>"4080",
        //     "orderId"=>"order1234",
        //     "description"=>"Payment d'un voyage",
        //     "payToken"=>$payToken]);
        //     $json=json_encode($params->getData());
        // try{


        //     $client = new \GuzzleHttp\Client();
        //     $response = $client->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay', [
        //         'verify' => false,
        //         'headers' => [
        //         'Authorization' => 'Bearer '.$token,
        //         'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA=',],
        //         'body'    => $params
        //     ]);

        // }catch (GuzzleException $e) {
        //     return "Exception!: " . $e->getMessage();
        // }

        $response=Http::asJson()->withToken($token)->withoutVerifying()->withHeaders([
            'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA=',
        ])->withBody(json_encode(["notifUrl"=>"https://mykipart.com/",
            "channelUserMsisdn"=>"693781611",
            "amount"=>$amount,
            "subscriberMsisdn"=>$number,
            "pin"=>"4080",
            "orderId"=>"order1234",
            "description"=>"Payment d'un voyage",
            "payToken"=>$payToken]),'application/json')->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay',[

        ]);

        return $response;
    }

    public static function getPaymentStatus($token,$payToken){

        $response=Http::withToken($token)->withoutVerifying()->withHeaders([
            'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA='
        ])->get('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/paymentstatus/'.$payToken);

        return $response;
    }
}
