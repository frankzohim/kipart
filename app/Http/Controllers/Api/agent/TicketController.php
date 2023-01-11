<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Agency\ticket\TicketResource;
use App\Models\SubAgency;

class TicketController extends Controller
{
    public function listTickets(){
        $agency=SubAgency::where('agency_id',Auth::guard('api-agent')->user()->agency_id)->first();

        $myTickets=TicketResource::collection( Passenger::join('payments','payments.id','passengers.payment_id')->join('travel','travel.id','passengers.travel_id')->select('passengers.isCheckPayment','payments.user_id','payments.id','passengers.name','passengers.telephone','passengers.travel_id','passengers.seatNumber','passengers.cni')
        ->where('passengers.isCheckPayment',1)
        ->where('travel.agency_id',$agency->agency_id)
        ->get());

        return response()->json(["data"=>$myTickets],200);
    }
}
