<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function SendReview(Request $request,$agency_id){

        $review=new Review;

            $review->user_id=Auth::guard('api')->user()->id;
            $review->review=$request->review;
            $review->rating=$request->rating;
            $review->agency_id=$agency_id;
            $review->save();

            return response()->json(['message'=>"commentaire ajoutée"]);
        }


}
