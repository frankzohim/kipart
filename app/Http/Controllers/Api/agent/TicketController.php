<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\SubAgency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Agency\ticket\TicketResource;
use App\Http\Resources\Ticket\Agent\ListTicketResource;

class TicketController extends Controller
{
    public function listTickets(){
        $myTickets=ListTicketResource::collection(Ticket::where('sub_agency_id',Auth::guard('api-agent')->user()->id)->orderBy("id", "asc")->get());

        return response()->json(["data"=>$myTickets],200);
    }

    public function listTicketsOfTravel($id){
        $myTickets=ListTicketResource::collection(Ticket::where('sub_agency_id',Auth::guard('api-agent')->user()->id)->where('travel_id',$id)->orderBy("id", "asc")->get());

        return response()->json(["data"=>$myTickets],200);
    }
}
