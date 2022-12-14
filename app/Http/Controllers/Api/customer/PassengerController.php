<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PassengerRequest;
use App\Http\Resources\Passenger\PassengerResource;

class PassengerController extends Controller
{

    public function listPassenger($travel){

        return PassengerResource::collection(Passenger::where('travel_id', $travel)->get());
    }

    public function addPassenger(PassengerRequest $request,$travel){

        if($travel){

            $passenger=new Passenger;
            $passenger->name=$request->name;
            $passenger->type=$request->type;
            $passenger->cni=$request->cni;
            $passenger->seatNumber=$request->seatNumber;
            $passenger->travel_id=$travel;


            foreach($request->name as $key=>$value){

                $passager['name']=$request->name[$key];
                $passager['type']=$request->type[$key];
                $passager['cni']=$request->cni[$key];
                $passager['seatNumber']=$request->seatNumber[$key];
                $passager['travel_id']=$travel;

                Passenger::create($passager);



             };

            return response()->json(['message'=>"Passager ajouté avec success"],201);
        }else{
            return response()->json(['message'=>"voyage non trouvé"],404);
        }
    }

}
