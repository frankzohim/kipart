<?php

namespace App\Http\Controllers\Api\test\payment\stripe;

use Stripe;
use Exception;
use App\Models\Payment;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\Ticket;
use App\Models\Travel;
use Faker\Calculator\TCNo;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripeTestPayment(Request $request, $id,$price,$codePromo,$subId){

        $code=PromoCode::where('code',$codePromo)->first();
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
                        'passenger_id'=>$payment->id
                    ]);
                    $payment->update([
                        'isCheckPayment' =>1
                    ]);

                    array_push($arrayTicket,$ticket->id);

                }


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
