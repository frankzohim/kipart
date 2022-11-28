<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\schedule\ScheduleResource;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function list(){

        return ScheduleResource::collection(Schedule::all());
    }

    public function store(ScheduleRequest $request){

        $schedule=Schedule::create([
            'hours'=>$request->hours
        ]);

        $schedule->agencies()->attach(Auth::guard('api-agent')->user()->id);


        return  new ScheduleResource($schedule);
    }

    public function update(ScheduleRequest $request,$id)
{
    $schedule=Schedule::find($id);

    if($schedule->agence_id==Auth::guard('api-agent')->user()->id){
        $input=$request->all();
        $update=$schedule->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'schedule update']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'schedule not found']);
        }
    }else{
        return response()->json(['status'=>'Forbidden!','message'=>'Unauthorized'],403);
    }
}

public function destroy($id){
    $schedule=Schedule::find($id);

    if($schedule->agency_id==Auth::guard('api-agent')->user()->id){
        if($schedule){
            $schedule->delete();
        return response()->json(["message"=>"schedule deleted"],204);
        }else{
            return response()->json(["message"=>"Schedule not found"],404);
        }
    }
}
}
