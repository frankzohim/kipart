<?php

namespace App\Http\Controllers\Api;

use DateTime;
use Carbon\Carbon;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerateTravelController extends Controller
{

    public function generateTravelToThwoMonth(Request $request){

        $agency=Agency::find($request->agency_id);
        $now = Carbon::now();
        $now=Carbon::parse($now)->format('Y-m-d');
        // $day=new DateTime($now);
        // $strip=$day->format('Y-m-d');
        // $c=Carbon::parse($strip)->format('Y-m-d');
// 31-5-2022
        //$endMonth = $day->addDays(32)->format('d-m-Y');

        $schedule=Schedule::create([
            'hours'=>$request->hour
        ]);
        for($i=0;$i<63;$i++){

            $data=[
                'date'=>$now,
                'agency_id'=>$request->agency_id,
                'path_id' =>1,
                'schedule_id' =>$schedule->id,
                'price'=>2500,
                'classe'=>"Standart",
                'state'=>1
            ];

            Travel::insert($data);

            $now=Carbon::parse($now)->addDays(1)->format('Y-m-d');
        }

        return response()->json(["message"=>"les Voyages de $request->hour de l'agence $agency->name generé avec success"]);

    }
}
