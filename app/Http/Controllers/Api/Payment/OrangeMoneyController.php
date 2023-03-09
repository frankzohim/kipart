<?php

namespace App\Http\Controllers\Api\Payment;


use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\PromoCode;
use App\Models\SubAgency;
use Illuminate\Http\Request;
use App\Services\api\UrlServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class OrangeMoneyController extends Controller
{
    public function pay($number,$amount,$subId){



        $agencyName=SubAgency::where('id',$subId)->first();
        $token=Self::getAccessToken(); // 1-step one: init payment with getAcessToken
        $payToken=Self::initPayment($token); // 2-Step Two:get Payment Token
        $paymentResponse=Self::paymentValidation($token,$payToken,$number,$amount,$agencyName->name); // 3-Step Final:Payment
        $response=json_decode($paymentResponse);

        if($response->message=='60019 :: Le solde du compte du payeur est insuffisant'){

            return response()->json(["message"=>'Votre Credit est insuffisant'],200);
        }

        return response()->json(["message"=>'Votre paiement a bien été initialiser,veuillez confirmer votre paiement','accessToken'=>$token,'payToken'=>$payToken],200);
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

    public static function paymentValidation($token,$payToken,$number,$amount,$agencyName){


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
            "orderId"=>"order123",
            "description"=>"Ticket de Voyage",
            "payToken"=>$payToken]),'application/json')->post('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/pay',[

        ]);

        return $response;
    }

    public  function getPaymentStatus($token,$payToken,$id,$codePromo,$subId,$price){

        $code=PromoCode::where('code',$codePromo)->first();
        $url=(new UrlServices())->getUrl();
        $arrayTicket=[];
        if($code){
            $code->update([
                'isUse'=>1
            ]);
        }else{

        }


        $payments=Passenger::where('payment_id',$id)->get();


            $status=Self::status($token,$payToken);
        if(isset($status)){

            while($status=='PENDING'){

            $status=Self::status($token,$payToken);

            }

            if($status=='SUCCESSFULL'){
                foreach($payments as $payment){

                    $ticket=Ticket::create([
                        'user_id'=>Auth::guard('api')->user()->id,
                        'sub_agency_id'=>$subId,
                        'travel_id'=>$payment->travel_id,
                        'passenger_id'=>$payment->id,
                        'type'=>1
                    ]);
                    $r=Http::post($url.'/api/add/bordereau/'.$price.'/0/'.$subId.'/'.$payment->travel_id.'/'.$ticket->passenger_id);
                    $payment->update([
                        'isCheckPayment' =>1,
                        'means_of_payment'=>"Orange Money"
                    ]);

                    array_push($arrayTicket,$ticket->id);
            }

            return response()->json(["message"=>'payment effectué',"ticketId"=>$arrayTicket],200);
        }if($status=='CANCELLED'){

            return response()->json(["message"=>"votre transaction a ete annulé"],200);
        }if($status=='EXPIRED'){
            return response()->json(["message"=>"votre transaction a expiré veuillez reassayez"],200);
        }




    }
    }

    public static function status($token,$payToken){

        $response=Http::withToken($token)->withoutVerifying()->withHeaders([
            'X-AUTH-TOKEN' => 'WU5PVEVIRUFEOllOT1RFSEVBRDIwMjA='
        ])->get('https://api-s1.orange.cm/omcoreapis/1.0.2/mp/paymentstatus/'.$payToken);

        $status=json_decode($response->getBody());
         if(isset($status->data->status)){
            return $status->data->status;
         }else{
            return response()->json(["message"=>$status]);
         }

    }
}
