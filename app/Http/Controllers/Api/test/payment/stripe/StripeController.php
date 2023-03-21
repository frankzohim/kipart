<?php

namespace App\Http\Controllers\Api\test\payment\stripe;

use Stripe;
use Exception;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Travel;
use App\Models\Payment;
use App\Models\Passenger;
use App\Models\PromoCode;
use Faker\Calculator\TCNo;
use Illuminate\Http\Request;
use App\Services\api\UrlServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\services\sms\SendSmsService;

class StripeController extends Controller
{
    public function stripeTestPayment(Request $request, $id,$price,$codePromo,$subId){

        $code=PromoCode::where('code',$codePromo)->first();
        $url=(new UrlServices())->getUrl();
        $user=User::where('id',Auth::guard('api')->user()->id)->first();
        $arrayTicket=[];
        if($code){
            $code->update([
                'isUse'=>1
            ]);
        }else{

        }
        try{

            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

            $res=$stripe->tokens->create([
                'card' => [
                    'number' =>$request->number,
                    'exp_month' =>$request->exp_month,
                    'exp_year' =>$request->exp_year,
                    'cvc' => $request->cvc,
                ]
            ]);
            $payments=Passenger::where('payment_id',$id)->get();


            Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            $response=$stripe->charges->create([
                'amount' =>$price,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description
              ]);

              if($response->status=='succeeded'){



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
                        'isCheckPayment' =>1
                    ]);
                    $travel_id=$payment->travel_id;
                    array_push($arrayTicket,$ticket->id);

                }
                $travel=Travel::where('id',$travel_id)->first();
                $message="Vous venez de payer un ticket par carte bancaire chez Kipart pour le voyage du $travel->date";
                $sms=(new SendSmsService())->sendSms("delanofofe@gmail.com","test1234",$user->phone_number,$message,"KiPART","2022-12-09 17:20:02");
                return response()->json(["message"=>$response->status,"ticketId"=>$arrayTicket],201);
              }else{
                return response()->json([
                                    'message'=>'failed'
                                ],422);
              }



        }catch(Exception $e){
            return response()->json(['response'=>$e->getMessage()],500);
        }
    }
}
