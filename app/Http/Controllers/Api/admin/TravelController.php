<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\Travel\TravelResource;
use App\Http\Resources\Travel\TravelDetailResource;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TravelResource::collection(Travel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelRequest $request)
    {
        $path=Travel::create([
            'date'=>$request->date,
        'agency_id'=>$request->agency_id,
        'path_id'=>$request->path_id,
        'price'=>$request->price,
        'class'=>$request->class,
        'state'=>$request->state,
        ]);



        return new TravelResource($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $travel=Travel::find($id);

        if($travel){
            return new TravelResource($travel);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'Travel not found']);
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
        $travel=Travel::find($id);
        $travel->date=$request->departure;
            $travel->path_id=$request->path_id;
            $travel->agency_id=$request->agency_id;
            $travel->state=$request->state;
            $travel->save();
            return response()->json(['status'=>'success','message'=>'Voyage mis a jour']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel=Travel::find($id);
        if($travel){
            $travel->delete();
            return response()->json(['status'=>'success','message'=>'Voyage suprimé avec succes']);
        }
    }


}
