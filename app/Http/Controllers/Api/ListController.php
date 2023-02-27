<?php

namespace App\Http\Controllers\Api;

use App\Models\Bus;
use App\Models\Path;
use App\Models\User;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\Schedule;
use App\Models\SubAgency;
use Illuminate\Http\Request;
use App\Models\brandAmbassador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\Path\PathResource;
use App\Http\Resources\Travel\TimeResource;
use App\Http\Resources\Agency\AgencyResource;
use App\Http\Resources\Path\ListTownResource;
use App\Http\Resources\Travel\TravelResource;
use App\Http\Resources\Path\ListArrivalResource;
use App\Http\Resources\schedule\ScheduleResource;
use App\Http\Resources\Path\ListDepartureResource;
use App\Http\Resources\Agency\SubAgency\SubAgencyResource;

class ListController extends Controller
{
    public function listAgency($paginate){

        return AgencyResource::collection(Agency::paginate($paginate));
    }

    public function listPath($paginate){
        return PathResource::collection(Path::paginate($paginate));
    }

    public function listBus(){

        return BusResource::collection(Bus::all());
    }

    public function listSchedule($paginate){

        return ScheduleResource::collection(Schedule::paginate($paginate));
    }

    public function listTravel($paginate){

        return TravelResource::collection(Travel::paginate($paginate));
    }

    public function listTown(){


        return ListTownResource::collection(Path::Select("departure")
        ->groupBy('departure')
        ->get());
    }


    public function listTime(){

        return TimeResource::collection(Schedule::all());
    }

    public function listPlaces($travel_id){
        $bus=Bus::where('travel_id',$travel_id)->first();
        $numberOfPlace=$bus->number_of_places;
        return response()->json(['number_of_place'=>$numberOfPlace]);
    }

    public function listAgencyWithPath($departure,$arrival){

        $agencies=\Illuminate\Support\Facades\DB::table('agencies')

        ->join('buses','buses.agency_id','=','agencies.id')
        ->join('travel','travel.bus_id','=','buses.id')
        ->join('paths','paths.id','=','travel.path_id')
            ->select('agencies.id','agencies.state','agencies.name','agencies.logo','agencies.headquarters','paths.departure','paths.arrival')
            ->groupBy('agencies.id','agencies.state','agencies.name','agencies.logo','agencies.headquarters','paths.departure','paths.arrival')
            ->where('paths.departure','=',$departure)
            ->where('paths.arrival','=',$arrival)
            ->get();

            foreach($agencies as $agency){
                if($agency->logo){
                    $agency->logo = URL($agency->logo);
                }
                if($agency->id){
                    $agency->id=intval($agency->id);
                }
            }

            return response()->json(['data'=>$agencies]);
    }

    public function listSubagencies($id){

        $subAgencies=SubAgencyResource::collection(SubAgency::where('agency_id',$id)->get());

        return response()->json(['subAgencies'=>$subAgencies],200);
    }

    public function listAmbassadors(){

        $ambassadors=brandAmbassador::all();

        return response()->json(["brand_ambassadors"=>$ambassadors],200);
    }

    public function ambassadorsWithUser($AmbassadorId){
        $users=User::where('brand_ambassadors_id',$AmbassadorId)->get();


        return response()->json(['usersWithAmbassador'=>$users],200);
    }
}
