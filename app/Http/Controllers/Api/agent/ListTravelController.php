<?php

namespace App\Http\Controllers\Api\agent;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListTravelController extends Controller
{
    public function list($id){

        $now = Carbon::now();
        $now->setTimezone('Africa/Douala');
        $nowHours=Carbon::parse($now)->format('H:i');
        $dayNow=Carbon::parse($now)->format("Y-m-d");
        $travel=\Illuminate\Support\Facades\DB::table('agencies')

                ->join('travel','travel.agency_id','=','agencies.id')
                ->join('paths','paths.id','=','travel.path_id')
                ->join('buses','buses.travel_id','=','travel.id')
                ->join('schedules','schedules.id','travel.schedule_id')
                ->select('travel.id','travel.date','travel.price','travel.classe','agencies.name','travel.agency_id','travel.path_id','paths.arrival','paths.departure','schedules.hours','buses.number_of_places')

                ->where('travel.agency_id','=',$id)
                ->where('travel.date','>=',$dayNow)
                // ->where('schedules.hours','>=',$nowHours)
                ->get();

                return $travel;

    }
}
