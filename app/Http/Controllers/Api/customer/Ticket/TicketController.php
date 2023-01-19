<?php

namespace App\Http\Controllers\Api\customer\Ticket;

use App\Models\Ticket;
use App\Models\SubAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\tickets\GenerateTicketService;
use App\Http\Resources\Ticket\Customer\ListTicketResource;
use App\Models\Passenger;
use App\Models\Path;

class TicketController extends Controller
{
    public function listTicket(){

        $myTickets=ListTicketResource::collection(Ticket::where('user_id', Auth::guard('api')->user()->id)->get());

        return $myTickets;
    }

    public function getQrCode($id){

        $subAgency=DB::table('tickets')
                    ->join('sub_agencies','sub_agencies.id','tickets.sub_agency_id')
                    ->join('travel','travel.id','tickets.travel_id')
                    ->join('passengers','passengers.id','tickets.passenger_id')
                    ->select('sub_agencies.name','travel.path_id','travel.date','tickets.passenger_id','travel.classe')
                    ->where('tickets.user_id',Auth::guard('api')->user()->id)
                    ->where('tickets.id',$id)
                    ->first();

                    $path=Path::where('id',$subAgency->path_id)->first();
                    $passenger=Passenger::where('id',$subAgency->passenger_id)->first();

        $ticketQrCode=(new GenerateTicketService())->generateTicket(
            Auth::guard('api')->user()->id,
            $subAgency->name,
            $path->departure,
            $path->arrival,
            $subAgency->date,
            $passenger->seatNumber,
            $passenger->name,
            $passenger->id,
            $passenger->telephone,
            $subAgency->classe
        );

        return $ticketQrCode;
    }
}
