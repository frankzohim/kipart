<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchFulRequest;
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

    public function searchFull(SearchFulRequest $request){

            $travel=\Illuminate\Support\Facades\DB::table('travel')
                ->join('paths','paths.id','=','travel.path_id')
                ->join('agencies','agencies.id','=','travel.agency_id')
                ->join('buses','travel.id','=','buses.travel_id')
                ->select('travel.date','travel.price','travel.classe','travel.departure_time','paths.departure','paths.arrival','agencies.name','buses.number_of_places')
                ->where('paths.departure','=',$request->departure)
                ->where('paths.arrival','=',$request->arrival)
                ->where('travel.departure_time','=',$request->departure_time)
                ->OrWhere('travel.date','>',$request->dateDeparture)
                ->where('travel.classe',$request->classe)
                ->where('buses.number_of_places','>',$request->number_of_places)
                ->get();

                return response()->json(['type'=>$request->type,'DataArrival'=>$request->DataArrival,'hourArrival'=>$request->hourArrival,'data'=> $travel],200);

    }

    public function searchByAgency(SearchFulRequest $request,$id){

        $travel=\Illuminate\Support\Facades\DB::table('agencies')
                ->join('buses','buses.agency_id','=','agencies.id')
                ->join('travel','travel.agency_id','=','agencies.id')
                ->join('paths','paths.id','=','travel.path_id')
                ->select('travel.id','travel.date','travel.price','travel.classe','travel.departure_time','agencies.name','travel.agency_id','buses.number_of_places','buses.agency_id','travel.path_id','paths.arrival','paths.departure')
                ->where('travel.agency_id','=',$id)
                ->where('buses.number_of_places','>',$request->number_of_places)

                ->where('travel.date','>',$request->dateDeparture)
                ->get();

                return response()->json(['type'=>$request->type,'DataArrival'=>$request->DataArrival,'hourArrival'=>$request->hourArrival,'data'=> $travel],200);
    }
}
