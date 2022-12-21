<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Bus;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\Bus\BusDetailResource;

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
            'number_of_places'=>$request->number_of_places,
            'plan'=>$request->plan,
            'classe'=>$request->classe,
            'travel_id'=>$request->travel_id,
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
            return new BusDetailResource($bus);
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
    public function update(BusRequest $request, $id)
    {
        $bus=Bus::find($id);
        $input=$request->all();
        $update=$bus->update($input);
        if($update){
        return response()->json(['status'=>'success','message'=>'Bus update']);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'Bus not found']);
        }
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
