<?php

namespace App\Http\Controllers\Api;

use App\Models\Path;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Path\PathResource;
use App\Http\Resources\Agency\AgencyResource;
use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\schedule\ScheduleResource;
use App\Http\Resources\Travel\TravelResource;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\Travel;

class ListController extends Controller
{
    public function listAgency(){

        return AgencyResource::collection(Agency::all());
    }

    public function listPath(){
        return PathResource::collection(Path::all());
    }

    public function listBus(){

        return BusResource::collection(Bus::all());
    }

    public function listSchedule(){

        return ScheduleResource::collection(Schedule::all());
    }

    public function listTravel(){

        return TravelResource::collection(Travel::all());
    }
}
