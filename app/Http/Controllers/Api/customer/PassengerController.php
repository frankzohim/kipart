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


        $travel_found=Travel::find($travel_id);
        $PassengerData = $request->all();

        if($travel_found){

            $payment=Payment::create([
                'user_id' =>Auth::guard('api')->user()->id,
                'travel_id' =>$travel_id,
                'means_of_payment'=>'visa card'

            ]);
            foreach($PassengerData['passengers'] as $key => $value){

                    $passengerModel=new Passenger;
                    $passengerModel->cni=$value['cni'];
                    $passengerModel->name=$value['name'];
                    $passengerModel->type=$value['type'];
                    $passengerModel->seatNumber=$value['seatNumber'];
                    $passengerModel->isCheckPayment=0;
                    $passengerModel->payment_id=$payment->id;
                    $passengerModel->travel_id=$travel_id;
                    $passengerModel->save();

            }


            return response()->json(['message'=>"Passager(s) ajouté avec success",'payment_id'=>$payment->id],201);
        }else{
            return response()->json(['message'=>"voyage non trouvé"],404);
        }
    }




}
