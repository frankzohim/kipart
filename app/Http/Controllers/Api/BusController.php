<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusRequest;
use App\Http\Resources\BusResource;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BusResource::collection(Bus::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusRequest $request)
    {
        $bus=Bus::create([
        'registration'=>$request->registration,
        'agency_id'=>$request->agency_id,
        'number_of_places'=>$request->number_of_places,
        'plan'=>$request->plan,
        'class'=>$request->class
        ]);

        return new BusResource($bus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bus=Bus::find($id);

        if($bus){
            return new BusResource($bus);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'Bus not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus=Bus::find($id);

        if($bus){
            $bus->delete();
        return response()->json(["message"=>"Bus deleted"],204);
        }
            return response()->json(["message"=>"Agency not found"],404);

    }
}
