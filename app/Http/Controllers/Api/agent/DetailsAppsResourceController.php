<?php

namespace App\Http\Controllers\Api\agent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Passenger\PassengerBuyResource;
use App\Models\Passenger;
use Illuminate\Support\Facades\Auth;

class DetailsAppsResourceController extends Controller
{
    public function CountResource(){

        $countBus=DB::table('travel')
                    ->join('buses','buses.travel_id','=','travel.id')
                    ->join('agencies','travel.agency_id','=','agencies.id')
                    ->select('buses.id')
                    ->where('agencies.id','=',Auth::guard('api-agent')->user()->id)
                    ->count();

        $ticket=Passenger::where('isCheckPayment','=',1)->count();

        $ticketTotal=DB::table('travel')
                    ->join('buses','buses.travel_id','=','travel.id')
                    ->join('agencies','travel.agency_id','=','agencies.id')
                    ->join('passengers','passengers.travel_id','travel.id')
                    ->select('buses.id','buses.number_of_places','passengers.isCheckPayment')
                    ->where('agencies.id','=',Auth::guard('api-agent')->user()->id)
                    ->sum('buses.number_of_places');


        return response()->json(['numberOfBus'=>$countBus,'ticket'=>$ticket,'total'=>$ticketTotal]);
    }


}
