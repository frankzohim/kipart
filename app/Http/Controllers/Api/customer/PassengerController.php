<?php

namespace App\Http\Controllers\Api\customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Passenger\PassengersResource;
use App\Models\Passenger;
use App\Models\Travel;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PassengersResource(Passenger::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$travel)
    {
        if($travel){

            $passenger=new Passenger;
            $passenger->name=$request->name;
            $passenger->type=$request->type;
            $passenger->cni=$request->cni;
            $passenger->seatNumber=$request->seatNumber;
            $passenger->travel_id=$travel;


            foreach($request->name as $key=>$value){

                $passager['name']=$request->name[$key];
                $passager['type']=$request->type[$key];
                $passager['cni']=$request->cni[$key];
                $passager['seatNumber']=$request->seatNumber[$key];
                $passager['travel_id']=$travel;

                Passenger::create($passager);



             };







            return response()->json(['message'=>"Passager ajouté avec success"]);
        }else{
            return response()->json(['message'=>"voyage non trouvé"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
