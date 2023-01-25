<?php

namespace App\Http\Controllers\Api\test\payment\momo;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MomoController extends Controller
{
    public function momoPaymentTest(Request $request,$id,$price,$codePromo,$subId){

        $code=PromoCode::where('code',$codePromo)->first();
        $arrayTicket=[];
        if($code){
            $code->update([
                'isUse'=>1
            ]);
        }else{

        }
    }
}
