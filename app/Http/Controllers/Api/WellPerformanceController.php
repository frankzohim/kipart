<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WellPerformanceController extends Controller
{
    public function wellPerformanceOfPath(){

        $pathWellPerformance=DB::table('travel')
                                ->join('paths','paths.id','travel.path_id')
                                ->join('passengers','passengers.travel_id','travel.id')
                                ->select('passengers.isCheckPayment','paths.departure','paths.arrival')
                                ->where('passengers.isCheckPayment','=',1)
                                ->where('paths.travel_id','=','travel.id');
    }
}
