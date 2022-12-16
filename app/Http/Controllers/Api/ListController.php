<?php

namespace App\Http\Controllers\Api;

use App\Models\Bus;
use App\Models\Path;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\Path\PathResource;
use App\Http\Resources\Agency\AgencyResource;
use App\Http\Resources\Path\ListArrivalResource;
use App\Http\Resources\Travel\TravelResource;
use App\Http\Resources\schedule\ScheduleResource;
use App\Http\Resources\Path\ListDepartureResource;
use App\Http\Resources\Travel\TimeResource;

class ListController extends Controller
{
    public function listAgency($paginate){

        return AgencyResource::collection(Agency::paginate($paginate));
    }

    public function listPath($paginate){
        return PathResource::collection(Path::paginate($paginate));
    }

    public function listBus($paginate){

        return BusResource::collection(Bus::paginate($paginate));
    }

    public function listSchedule($paginate){

        return ScheduleResource::collection(Schedule::paginate($paginate));
    }

    public function listTravel($paginate){

        return TravelResource::collection(Travel::paginate($paginate));
    }

    public function listDeparture(){

        return ListDepartureResource::collection(Path::all());
    }

    public function listArrival(){

        return ListArrivalResource::collection(Path::all());
    }

    public function listTime(){

        return TimeResource::collection(Travel::all());
    }
}
