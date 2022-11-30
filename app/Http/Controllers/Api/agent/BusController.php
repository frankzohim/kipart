<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Bus\BusResource;

class BusController extends Controller
{
    public function store(BusRequest $request){

        $bus=Bus::create([
            'registration'=>$request->registration,
            'agency_id'=>Auth::guard('api-agent')->user()->id,
            'number_of_places'=>$request->number_of_places,
            'plan'=>$request->plan,
            'class'=>$request->class
            ]);

            return new BusResource($bus);
    }


    public function update(BusRequest $request,$id){


            $bus=Bus::find($id);

            if($bus->agency_id==Auth::guard('api-agent')->user()->id){
                    $input=$request->all();
                    $update=$bus->update($input);
                if($update){
                return response()->json(['status'=>'success','message'=>'Bus update']);
                }
                else{
                    return response()->json(['status'=>'fail!','message'=>'Bus not found']);
                }
            }else{
                return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
            }



    }

    public function destroy($id)
    {
        $bus=Bus::find($id);

        if($bus->agence_id==Auth::guard('api-agent')->user()->id){
                if($bus){
                    $bus->delete();
                return response()->json(["message"=>"Bus deleted"],204);
                }
                    return response()->json(["message"=>"Agency not found"],404);

            }else{
                return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
            }
        }


}
