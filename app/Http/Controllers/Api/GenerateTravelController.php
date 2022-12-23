<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Schedule;
use App\Models\Travel;

class GenerateTravelController extends Controller
{

    public function generateTravelToThwoMonth($agency_id,$hour){

        $agency=Agency::find($agency_id);
        $day = Carbon::now();;
// 31-5-2022
        $endMonth = $day->addDays(32)->format('d-m-Y');

        $schedule=Schedule::create([
            'hours'=>$hour
        ]);
        for($i=0;$i<63;$i++){

            $data=[
                'date'=>$day,
                'agency_id'=>$agency_id,
                'path_id' =>1,
                'schedule_id' =>$schedule->id,
                'price'=>2500
            ];

            Travel::insert($data);
            $day= $day->addDays(1)->format('d-m-Y');
        }

        return response()->json(["message"=>"les Voyages de $hour de l'agence $agency->name generé avec success"]);

    }
}
