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
use App\Http\Resources\Ticket\Agent\TicketByAgencyResource;

class TicketController extends Controller
{
    public function listTickets(){
        $myTickets=ListTicketResource::collection(Ticket::where('sub_agency_id',Auth::guard('api-agent')->user()->id)->orderBy("id", "desc")->get());

        return response()->json(["data"=>$myTickets],200);
    }

    public function listTicketsOfTravel($id){
        $myTickets=TicketByAgencyResource::collection(Ticket::where('travel_id',$id)->orderBy("id", "desc")->get());

        return response()->json(["data"=>$myTickets],200);
    }

    public function listTicketsPaginate(){
        $myTickets=ListTicketResource::collection(Ticket::where('sub_agency_id',Auth::guard('api-agent')->user()->id)->orderBy("id", "desc")->paginate(5));

        return response()->json(["data"=>$myTickets],200);
    }
}
