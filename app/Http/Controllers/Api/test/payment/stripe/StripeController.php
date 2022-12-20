<?php

namespace App\Http\Controllers\Api\test\payment\stripe;

use Stripe;
use Exception;
use App\Models\Payment;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\Travel;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripeTestPayment(Request $request, $id,$price,$codePromo){

        $code=PromoCode::where('code',$codePromo)->first();
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
            $payment=Passenger::where('payment_id',$id);

            Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            $response=$stripe->charges->create([
                'amount' =>$price,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description
              ]);

              if($response->status=='succeeded'){


                $payment->update([
                    'isCheckPayment' =>1

                ]);
                return response()->json(["message"=>$response->status],201);
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
