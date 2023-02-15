<?php

namespace App\Http\Controllers\Api\customer;

use App\Models\Bus;
use App\Models\Travel;
use App\Models\Payment;
use App\Models\Passenger;
use App\Services\passengers\AddPassengerServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PassengerRequest;

use function PHPUnit\Framework\isEmpty;
use App\Http\Resources\Passenger\PassengerResource;
use App\Http\Resources\Passenger\DetailTravelResource;
use App\Http\Resources\Passenger\PassengerBuyResource;
use Illuminate\Database\Eloquent\Collection;

class PassengerController extends Controller
{

    public function listPassenger($travel){


            return DetailTravelResource::collection(Payment::where('travel_id', $travel)->where('user_id',Auth::guard('api')->user()->id)->get());

    }

    public function addPassenger(Request $request,$travel_id,$sub_agency_id){


        $response=(new AddPassengerServices())->add($request,$travel_id,0);

        return $response;

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

                 //return count($travelArray);
            $placeAvailable=$bus->number_of_places - count($placeBusy);
            return response()->json(['number_of_places'=>$bus->number_of_places,'PlacePrise'=>$placeBusy,'placeAvailable'=>$placeAvailable],200);




    }

    public function updatePlace(Request $request,$payment_id){

        $PassengerData = $request->all();
        $travels=Passenger::where('payment_id',$payment_id)->get();

            foreach($PassengerData['places'] as $key => $value){

                    $travels[$key]->seatNumber=$value['seatNumber'];
                    $travels[$key]->save();
                }


            return response()->json(['message'=>"place(s) mis a jour avec success"]);
    }

    public function listTravelsOfUser(){

        $travel_id= PassengerBuyResource::collection( Passenger::join('payments','payments.id','passengers.payment_id')->join('travel','travel.id','passengers.travel_id')->select('passengers.isCheckPayment','payments.user_id','payments.id','passengers.name','passengers.telephone','passengers.travel_id','passengers.seatNumber','passengers.cni')

        ->where('passengers.isCheckPayment',1)
        ->where('payments.user_id',Auth::guard('api')->user()->id)
        ->get());
        $dataTravelId=[];
        $dataTravel=[];

        $dataPassenger=[];
        $collect=new Collection();
        $passenger=new Collection();
        // foreach($travel_id as $value){

        //     $passenger=PassengerBuyResource::collection(Passenger::where('passengers.payment_id',$value->id)
        //     ->get());

        //     $collect->push($passenger);
        //     array_push($dataPassenger,$passenger);

        // }

        // foreach($travel_id as $travel){
        //     array_push($dataTravelId,$travel->travel_id);
        // }



        // for($i=0;$i<count($dataTravelId);$i++){
        //     $travel=\Illuminate\Support\Facades\DB::table('travel')
        //     ->join('paths','paths.id','=','travel.path_id')
        //     ->join('agencies','agencies.id','=','travel.agency_id')
        //     ->join('buses','travel.id','=','buses.travel_id')
        //     ->join('schedules','schedules.id','travel.schedule_id')
        //     ->select('travel.id','travel.date','paths.departure','paths.arrival','agencies.name','schedules.hours','agencies.logo')
        //     ->where('travel.id',$dataTravelId[$i])->first();
        //      array_push($dataTravel,$travel);
        // }



            return response()->json(["data"=>$travel_id],200);

    }

}
