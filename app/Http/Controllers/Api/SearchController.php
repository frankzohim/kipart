<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Travel;
use App\Models\Passenger;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchFulRequest;
use function PHPUnit\Framework\isEmpty;
use App\Http\Resources\Travel\SearchResource;

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
                ->join('schedules','schedules.id','travel.schedule_id')
                ->select('travel.date','travel.price','travel.classe','paths.departure','paths.arrival','agencies.name','buses.number_of_places','schedules.hours')
                ->where('paths.departure','=',$request->departure)
                ->where('paths.arrival','=',$request->arrival)
                ->where('schedules.hours','>',$request->departure_time)
                // ->where('travel.date','>',$request->dateDeparture)
                // ->where('travel.classe','=',$request->classe)
                ->where('buses.number_of_places','>',$request->number_of_places)
                ->get();


                    return response()->json(['type'=>$request->type,'DataArrival'=>$request->DataArrival,'hourArrival'=>$request->hourArrival,'data'=> $travel],200);


                    return response()->json(['message'=>'aucun voyage trouvé']);



    }

    public function searchByAgency(SearchFulRequest $request,$id){
        $jsonTravel=[];
        $arrayTravel=[];
        $now = Carbon::now();
        $date=$request->dateDeparture;
        $now->setTimezone('Africa/Douala');
        $now=Carbon::parse($now)->format('H:i');
        $dayNow=Carbon::parse($now)->format('d');
        $date=Carbon::parse($date)->format('d');
        $classe="";

        if($request->classe=="Classic"){
            $classe="Classique";
        }else{
            $classe="Classique";
        }
        if($date===$dayNow){



            $travels=\Illuminate\Support\Facades\DB::table('agencies')

                ->join('buses','buses.agency_id','=','agencies.id')
                ->join('travel','travel.bus_id','=','buses.id')
                ->join('paths','paths.id','=','travel.path_id')

                ->join('schedules','schedules.id','travel.schedule_id')
                ->select('travel.id','travel.date','travel.price','travel.classe','agencies.name','buses.agency_id','travel.path_id','paths.arrival','paths.departure','schedules.hours','buses.number_of_places')

                ->where('buses.agency_id','=',$id)
                ->where('paths.departure','=',$request->departure)
                ->where('paths.arrival','=',$request->arrival)
                ->where('travel.date','=',$request->dateDeparture)
                ->where('travel.classe',$classe)
                ->where('schedules.hours','>=',$now)
                ->get();

                foreach($travels as $travel){

                    $placeBusy=[];
                    $listPlace=[];
                    $t=Passenger::where('travel_id',$travel->id)
                    ->where('isCheckPayment',1)
                    ->get();
                    $travel_search=Travel::find($travel->id);
                    $bus=Bus::find($travel_search->bus_id);

                    // for($i=1;$i<=$bus->number_of_places;$i++){
                    //     array_push($listPlace,$i);
                    // }

                        foreach($t as $tr){
                            array_push($placeBusy,$tr->seatNumber);
                        }

                             //return count($travelArray);
                        $placeAvailable=$bus->number_of_places - count($placeBusy);

                                $jsonTravel=[
                                    'id'=>$travel->id,
                                    'date'=>$travel->date,
                                    'price'=>$travel->price,
                                    'classe'=>$travel->classe,
                                    'name'=>$travel->name,
                                    'agency_id'=>$travel->agency_id,
                                    'path_id'=>$travel->path_id,
                                    'arrival'=>$travel->arrival,
                                    'departure'=>$travel->departure,
                                    'hours'=>$travel->hours,
                                    'number_of_places'=>$travel->number_of_places,
                                    'placeAvailable'=>$placeAvailable
                                ];

                                array_push($arrayTravel,$jsonTravel);

                            }
                // $travel=SearchResource::collection(Travel::join('buses','buses.id','travel.bus_id')
                // ->join('agencies','agencies.id','buses.agency_id')
                // ->join('paths','paths.id','=','travel.path_id')->join('schedules','schedules.id','travel.schedule_id')->select('travel.id','agencies.name','travel.price','buses.agency_id','buses.number_of_places','paths.departure','paths.id','paths.arrival','travel.date','travel.classe','schedules.hours')

                // ->where('buses.agency_id','=',$id)
                // ->where('paths.departure','=',$request->departure)
                // ->where('paths.arrival','=',$request->arrival)
                // ->where('travel.date','=',$request->dateDeparture)
                // ->where('travel.classe',$request->classe)
                // ->where('schedules.hours','>=',$now)
                // ->get());
                return response()->json(['type'=>$request->type,'DataArrival'=>$request->DataArrival,'hourArrival'=>$request->hourArrival,'data'=> $arrayTravel],200);
        }

            $travels=\Illuminate\Support\Facades\DB::table('agencies')

            ->join('buses','buses.agency_id','=','agencies.id')
            ->join('travel','travel.bus_id','=','buses.id')
            ->join('paths','paths.id','=','travel.path_id')

            ->join('schedules','schedules.id','travel.schedule_id')
                ->select('travel.id','travel.date','travel.price','travel.classe','agencies.name','buses.agency_id','travel.path_id','paths.arrival','paths.departure','schedules.hours','buses.number_of_places')

                ->where('buses.agency_id','=',$id)
                ->where('paths.departure','=',$request->departure)
                ->where('paths.arrival','=',$request->arrival)
                ->where('travel.date','=',$request->dateDeparture)
                ->where('travel.classe',$classe)
                ->where('schedules.hours','>=',$request->departure_time)
                ->get();

                foreach($travels as $travel){

        $placeBusy=[];
        $listPlace=[];
        $t=Passenger::where('travel_id',$travel->id)
        ->where('isCheckPayment',1)
        ->get();
        $travel_search=Travel::find($travel->id);
        $bus=Bus::find($travel_search->bus_id);

        // for($i=1;$i<=$bus->number_of_places;$i++){
        //     array_push($listPlace,$i);
        // }

            foreach($t as $tr){
                array_push($placeBusy,$tr->seatNumber);
            }

                 //return count($travelArray);
            $placeAvailable=$bus->number_of_places - count($placeBusy);
            $classe="";

            if($request->classe=="Classic"){
                $classe="Classique";
            }else{

            }
                    $jsonTravel=[
                        'id'=>$travel->id,
                        'date'=>$travel->date,
                        'price'=>$travel->price,
                        'classe'=>$travel->classe,
                        'name'=>$travel->name,
                        'agency_id'=>$travel->agency_id,
                        'path_id'=>$travel->path_id,
                        'arrival'=>$travel->arrival,
                        'departure'=>$travel->departure,
                        'hours'=>$travel->hours,
                        'number_of_places'=>$travel->number_of_places,
                        'placeAvailable'=>$placeAvailable
                    ];

                    array_push($arrayTravel,$jsonTravel);

                }
                // $travel=SearchResource::collection(Travel::join('buses','buses.id','travel.bus_id')
                // ->join('agencies','agencies.id','buses.agency_id')
                // ->join('paths','paths.id','=','travel.path_id')->join('schedules','schedules.id','travel.schedule_id')->select('travel.id','agencies.name','buses.number_of_places','buses.agency_id','paths.departure','paths.arrival','paths.id','travel.date','travel.classe','schedules.hours')
                // ->where('buses.agency_id','=',$id)
                // ->where('paths.departure','=',$request->departure)
                // ->where('paths.arrival','=',$request->arrival)
                // ->where('travel.date','=',$request->dateDeparture)
                // ->where('travel.classe',$request->classe)
                // ->where('schedules.hours','>=',$request->departure_time)
                // ->get());


                return response()->json(['type'=>$request->type,'DataArrival'=>$request->DataArrival,'hourArrival'=>$request->hourArrival,'data'=> $arrayTravel],200);












    }


}
