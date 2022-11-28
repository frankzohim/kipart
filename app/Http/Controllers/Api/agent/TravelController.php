<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\Travel\TravelDetailResource;
use App\Http\Resources\Travel\TravelResource;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{


    public function store(TravelRequest $request){
        $path=Travel::create([
            'date'=>$request->departure,
            'price'=>$request->price,
            'class'=>$request->class,
        'agency_id'=>Auth::guard('api-agent')->user()->id,
        'path_id'=>$request->path_id,
        'state'=>$request->state,
        ]);

        return new TravelResource($path);
    }

    public function update(TravelRequest $request,$id){

        $travel=Travel::find($id);

        if($travel->id==Auth::guard('api-agent')->user()->id){
            $travel->date=$request->departure;
            $travel->path_id=$request->path_id;
            $travel->price=$request->price;
            $travel->class=$request->class;
            $travel->agency_id=Auth::guard('api-agent')->user()->id;
            $travel->state=$request->state;
            $travel->save();
            return response()->json(['status'=>'success','message'=>'Voyage mis a jour']);
        }else{
            return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
        }

    }

    public function destroy($id){
        $travel=Travel::find($id);
        if($travel->id==Auth::guard('api-agent')->user()->id){
            if($travel){
                $travel->delete();
                return response()->json(['status'=>'success','message'=>'Voyage suprimé avec succes']);
            }
        }
    }

    public function detail(){

        return TravelDetailResource::collection(Travel::all());
    }
}
