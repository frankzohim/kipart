<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerateTravelController extends Controller
{

    public function generateTravelToThreeMonth($hour){

        $day = Carbon::now();;
// 31-5-2022
$endMonth = $day->addDays(32)->format('d-m-Y');
        for($i=0;$i<63;$i++){

            $data=[
                'date'=>$day,
                'agency_id'=>2,
                'path_id' =>1,
                'departure_time' =>$hour,
                'price'=>
            ]
        }


    }
}
