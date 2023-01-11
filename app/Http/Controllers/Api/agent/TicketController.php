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
        $myTickets=ListTicketResource::collection(Ticket::where('sub_agency_id',Auth::guard('api-agent')->user()->id)->get());

        return response()->json(["data"=>$myTickets],200);
    }
}
