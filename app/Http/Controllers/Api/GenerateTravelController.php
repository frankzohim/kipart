<?php

namespace App\Http\Controllers\Api;

use DateTime;
use Carbon\Carbon;
use App\Models\Path;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bus;

class GenerateTravelController extends Controller
{

    public function generateTravelToThwoMonth(Request $request,$path_id){

        $agency=Agency::find($request->agency_id);
        $bus=Bus::where('agency_id',$request->agency_id)->get();
        // $day=new DateTime($now);
        // $strip=$day->format('Y-m-d');
        // $c=Carbon::parse($strip)->format('Y-m-d');
// 31-5-2022
        //$endMonth = $day->addDays(32)->format('d-m-Y');


        $path=Path::find($path_id);
        for($y=1;$y<=13;$y++){
            $now = Carbon::now();
            $now=Carbon::parse($now)->format('Y-m-d');
        for($i=0;$i<31;$i++){
            $randomBus=$bus->random();
                $data=[
                    'date'=>$now,
                    'bus_id'=>$randomBus->id,
                    'path_id' =>$path->id,
                    'schedule_id' =>$y,
                    'price'=>2500,
                    'classe'=>$request->classe,
                    'state'=>1
                ];

                Travel::insert($data);

                $now=Carbon::parse($now)->addDays(1)->format('Y-m-d');
            }

        }

        return response()->json(["message"=>"les Voyages de l'agence $agency->name generé avec success"]);

    }

    public function updatePrice($classe,$price,$agency_id){

        $data=[
            'agency_id'=>$agency_id,
            'price'=>$price,
            'classe'=>$classe,
        ];

        $travels=Travel::where('agency_id',$agency_id)->get();

        foreach($travels as $travel){
            $travel->update($data);
        }


        return "mise a jour avec sucees";
    }
}
