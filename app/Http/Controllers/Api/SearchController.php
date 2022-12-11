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
                ->select('travel.date','travel.price','travel.class','paths.departure','paths.arrival','agencies.name')
                ->orWhere('agencies.name','like',"%$term%")
                ->orWhere('paths.arrival','like',"%$term%")
                ->orWhere('travel.price','like',"%$term%")
                ->orWhere('paths.arrival','like',"%$term%")
                ->get();

        if(isEmpty($travel)){

            return response()->json(['status'=>0,'message'=>"Aucun voyage trouvé"],404);
        }else{
            return response()->json(['status'=>1,'data'=> $travel]);
        }
    }
}
