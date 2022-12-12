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
    public function store(Request $request,Travel $travel)
    {
        if($travel){

            $travel_id=$travel;
            $names=$request->input('name',[]);
            $types=$request->input('type',[]);
            $seatNumbers=$request->input('seatNumber',[]);
            $cnis=$request->input('cni',[]);

            foreach ($names as $index => $unit) {
                $units[] = [
                    "travel_id" => $travel_id, // change this
                    "name" => $names[$index],
                    "type" => $types[$index],
                    "seatNumber" => $seatNumbers[$index],
                    "cni" => $cnis[$index],
                ];
            }

            $created=Passenger::insert($units);
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
