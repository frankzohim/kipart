<?php

namespace App\Http\Controllers\Api\test\payment\stripe;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    public function stripeTestPayment(Request $request){

        try{

            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

            $res=$stripe->tokens->create([
                'card' => [
                    'number' =>$request->number,
                    'exp_month' =>$request->exp_number,
                    'exp_year' =>$request->exp_year,
                    'cvc' => $request->cvc,
                ]
            ]);

            Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            $response=$stripe->charges->create([
                'amount' =>$request->amount,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description
              ]);

              return response()->json([$response->status],201);

        }catch(Exception $e){
            return response()->json(['response'=>'error'],500);
        }
    }
}
