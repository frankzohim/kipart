<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\Bus;
use App\Models\Travel;
use App\Models\Payment;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PassengerRequest;

use function PHPUnit\Framework\isEmpty;
use App\Http\Resources\Passenger\PassengerResource;
use App\Http\Resources\Passenger\DetailTravelResource;

class PassengerController extends Controller
{

    public function listPassenger($travel){


            return DetailTravelResource::collection(Payment::where('travel_id', $travel)->where('user_id',Auth::guard('api')->user()->id)->get());

    }

    public function addPassenger(Request $request,$travel_id){

        $placeBusy=[];
        $listPlace=[];
        $listPlaceAvailable=[];
        $listPlacePassengers=[];
        $bus=Bus::where('travel_id',$travel_id)->first();
        $travels=Passenger::where('travel_id',$travel_id)
        ->get();

        foreach($travels as $travel){
            array_push($placeBusy,intval($travel->seatNumber));
        }



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



        $travel_found=Travel::find($travel_id);
        $PassengerData = $request->all();
        $listPlaceAvailable=array_values($listPlace);


        for($i=0;$i<count($PassengerData['passengers']);$i++){
            array_push($listPlacePassengers,$listPlaceAvailable[$i]);
        }
        if($travel_found){

            $payment=Payment::create([
                'user_id' =>Auth::guard('api')->user()->id,
                'travel_id' =>$travel_id,
                'means_of_payment'=>'visa card'

            ]);

            if(count($listPlaceAvailable)==0){
                return response()->json(['message'=>"Toutes les places de ce bus ont deja été reservé"],200);
            }
            else{
                foreach($PassengerData['passengers'] as $key => $value){


                    $passengerModel=new Passenger;
                    $passengerModel->cni=$value['cni'];
                    $passengerModel->name=$value['name'];
                    $passengerModel->type=$value['type'];
                    $passengerModel->telephone=$value['telephone'];
                    $passengerModel->seatNumber=$listPlacePassengers[$key];
                    $passengerModel->isCheckPayment=0;
                    $passengerModel->payment_id=$payment->id;
                    $passengerModel->travel_id=$travel_id;
                    $passengerModel->save();
                }



            return response()->json(['message'=>"Passager(s) ajouté avec success",'payment_id'=>$payment->id],201);
            }


        }else{
            return response()->json(['message'=>"voyage non trouvé"],404);
        }

        return response()->json([$listPlaceAvailable,$placeBusy]);
    }


    public function listPlace($travel_id){
        $placeBusy=[];
        $listPlace=[];
        $travels=Passenger::where('travel_id',$travel_id)
        ->where('isCheckPayment',1)
        ->get();
        $bus=Bus::where('travel_id',$travel_id)->first();

        // for($i=1;$i<=$bus->number_of_places;$i++){
        //     array_push($listPlace,$i);
        // }

            foreach($travels as $travel){
                array_push($placeBusy,$travel->seatNumber);
            }
            if(count($placeBusy)>0){
                 //return count($travelArray);
            $placeAvailable=$bus->number_of_places - count($placeBusy);
            return response()->json(['number_of_places'=>$bus->number_of_places,'PlacePrise'=>$placeBusy,'placeAvailable'=>$placeAvailable],200);
            }else{
            return response()->json(['message'=>"Aucune Place n'a ete prise pour ce voyage"]);
        }

    }


}
