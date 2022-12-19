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

    public function addPassenger(Request $request,$travel_id){


        $travel_found=Travel::find($travel_id);
        $PassengerData = $request->all();

        if($travel_found){
            foreach($PassengerData['passengers'] as $key => $value){

                    $passengerModel=new Passenger;
                    $passengerModel->cni=$value['cni'];
                    $passengerModel->name=$value['name'];
                    $passengerModel->type=$value['type'];
                    $passengerModel->seatNumber=$value['seatNumber'];
                    $passengerModel->travel_id=$travel_id;
                    $passengerModel->save();

            }


            return response()->json(['message'=>"Passager(s) ajouté avec success"],201);
        }else{
            return response()->json(['message'=>"voyage non trouvé"],404);
        }
    }

}
