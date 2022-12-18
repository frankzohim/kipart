<?php

namespace App\Http\Controllers\Api\test\payment\stripe;

use Stripe;
use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripeTestPayment(Request $request, $id){

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

            Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

            $response=$stripe->charges->create([
                'amount' =>$request->amount,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description
              ]);

              if($response->status=='succeeded'){

                Payment::create([
                    'user_id' =>Auth::guard('api')->user()->id,
                    'travel_id' =>$id,
                    'means_of_payment'=>'visa card'

                ]);

              }

              return response()->json([$response->status],201);

        }catch(Exception $e){
            return response()->json(['response'=>'error'],500);
        }
    }
}
