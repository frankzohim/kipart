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
                ->select('travel.date','travel.price','travel.type','travel.classe','paths.departure','paths.arrival','agencies.name','buses.number_of_places')
                ->where('paths.departure','=',$request->departure)
                ->where('paths.arrival','=',$request->arrival)
                ->OrWhere('travel.date','>',$request->dateDeparture)
                ->where('travel.classe',$request->classe)
                ->where('buses.number_of_places','>',$request->number_of_places)
                ->get();

                return response()->json(['data'=> $travel,'type'=>$request->type,'DateArrival'=>$request->dateArrival,'heure Arrivéé'=>$request->hourArrival],200);

    }
}
