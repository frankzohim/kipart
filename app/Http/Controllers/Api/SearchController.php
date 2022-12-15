<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class SearchController extends Controller
{
    public function search($term){

        $travel=\Illuminate\Support\Facades\DB::table('travel')
                ->join('paths','paths.id','=','travel.path_id')
                ->join('agencies','agencies.id','=','travel.agency_id')
                ->select('travel.date','travel.price','travel.classe','paths.departure','paths.arrival','agencies.name')
                ->orWhere('agencies.name','like',"%$term%")
                ->orWhere('paths.arrival','like',"%$term%")
                ->orWhere('travel.price','like',"%$term%")
                ->orWhere('travel.classe','like',"%$term%")
                ->orWhere('paths.arrival','like',"%$term%")
                ->get();


            return response()->json(['data'=> $travel],200);

    }

    public function searchFull($type,$departure,$arrival,$datedeparture,$datearrival,$number_of_places,$classe){

        $travel=\Illuminate\Support\Facades\DB::table('travel')
                ->join('paths','paths.id','=','travel.path_id')
                ->join('agencies','agencies.id','=','travel.agency_id')
                ->join('buses','buses.id','=','travel.bus_id')
                ->select('travel.date','travel.price','travel.type','travel.classe','paths.departure','paths.arrival','agencies.name','buses.number_of_places')
                ->where('travel.type','like',"%$type%")
                ->where('paths.departure','like',"%$departure%")
                ->where('path.arrival','like',"%$arrival%")
                ->where('travel.date','like',"%$datedeparture%")
                ->where('buses.number_of_places','like',"%$number_of_places%")
                ->get();
    }
}
