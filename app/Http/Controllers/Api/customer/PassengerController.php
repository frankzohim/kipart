<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\Travel;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PassengerRequest;
use App\Http\Resources\Passenger\PassengerResource;

use function PHPUnit\Framework\isEmpty;

class PassengerController extends Controller
{

    public function listPassenger($travel){

        return PassengerResource::collection(Passenger::where('travel_id', $travel)->get());
    }

    public function addPassenger(PassengerRequest $request,$number_passenger,$travel_id){


        $travel_found=Travel::find($travel_id);

        if($travel_found){
            for($i=0;$i<$number_passenger;$i++){

                    $passenger=new Passenger;
                    $passenger['cni']=$request->cni[$i];
                    $passenger['name']=$request->name[$i];
                    $passenger['type']=$request->type[$i];
                    $passenger['seatNumber']=$request->seatNumber[$i];
                    $passenger['travel_id']=$travel_id;
                    $passenger->save();

            }


            return response()->json(['message'=>"Passager(s) ajouté avec success"],201);
        }else{
            return response()->json(['message'=>"voyage non trouvé"],404);
        }
    }

}
