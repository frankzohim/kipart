<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Bus;
use App\Models\Ticket;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PassengerRequest;
use App\Services\passengers\AddPassengerServices;

class AddPassengerController extends Controller
{
    public function add(PassengerRequest $request,$travel_id,$sub_agency_id){

        $listPlace=[];
        $placeBusy=[];
        $travels=Passenger::where('travel_id',$travel_id)->get();

        foreach($travels as $travel){
            array_push($placeBusy,intval($travel->seatNumber));
        }
        $bus=Bus::where('travel_id',$travel_id)->first();

        for($i=1;$i<=$bus->number_of_places;$i++){
            array_push($listPlace,$i);
            }
            for($y=0;$y<count($placeBusy);$y++){
                $pos = array_search($placeBusy[$y], $listPlace);
                if ($pos !== false) {

                    // Remove from array
                    unset($listPlace[$pos]);

                }
            }

            $listPlaceAvailable=array_values($listPlace);

        $passengerModel=new Passenger;
        $passengerModel->cni=$request->cni;
        $passengerModel->name=$request->name;
        $passengerModel->type=$request->type;
        $passengerModel->telephone=$request->telephone;
        $passengerModel->seatNumber= $listPlaceAvailable[0];
        $passengerModel->isCheckPayment=1;
        $passengerModel->travel_id=$travel_id;
        $passengerModel->save();

        $ticket=new Ticket;
        $ticket->sub_agency_id=$sub_agency_id;
        $ticket->travel_id=$travel_id;
        $ticket->passenger_id= $passengerModel->id;
        $ticket->type= 0;

        return response()->json(['message'=>"Passager creer avec success","place"=>$listPlaceAvailable[0]],201);
    }
}
