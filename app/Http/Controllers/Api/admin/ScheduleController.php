<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Schedule;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\schedule\ScheduleResource;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  ScheduleResource::collection(Schedule::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $schedule=Schedule::create([
            'hours'=>$request->hours
        ]);

        $schedule->agencies()->attach($request->agency_id);


        return  new ScheduleResource($schedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule=Schedule::find($id);

        if($schedule){
            return new ScheduleResource($schedule);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'schedule not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        $schedule=Schedule::find($id);
        $input=$request->all();
        $update=$schedule->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'schedule update']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'schedule not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if($schedule){
            $schedule->delete();
        return response()->json(["message"=>"schedule deleted"],204);
        }else{
            return response()->json(["message"=>"Schedule not found"],404);
        }
    }
}
