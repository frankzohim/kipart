<?php

namespace App\Http\Controllers\Api\test;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class TestCodePromoController extends Controller
{
    public function testCodePost($code,$price){

        $promoCode=PromoCode::where('code',$code)->first();

        if($promoCode){
            $percent=$promoCode->percent;
            $code=$promoCode->code;
            $reducedPrice=$price*$percent/100;
            return response()->json(['message'=>'success','reduced_price'=>$reducedPrice,'promo_code'=>$code],200);

        }else{
            return response()->json(['message'=>'mauvais code'],404);
        }


    }
}
