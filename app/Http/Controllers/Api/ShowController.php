<?php

namespace App\Http\Controllers\Api;

use App\Models\Bus;
use App\Models\Path;
use App\Models\Agency;
use App\Models\Travel;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Bus\BusDetailResource;
use App\Http\Resources\Path\PathDetailResource;
use App\Http\Resources\schedule\ScheduleResource;
use App\Http\Resources\Agency\AgencyDetailResource;
use App\Http\Resources\Travel\TravelDetailResource;

class ShowController extends Controller
{
    public function detailAgency($id){
        $agency=Agency::find($id);


        if($agency){
            return new AgencyDetailResource($agency);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'agency not found']);
        }
    }

    public function detailBus($id){
        $bus=Bus::find($id);;
        if($bus){
            return new BusDetailResource($bus);
        }else{
            return response()->json(['status'=>'fail!','message'=>'bus not found']);
        }
    }

    public function detailPath($id){
        $path=Path::find($id);

        if($path){
            return new PathDetailResource($path);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'path not found']);
        }
    }

    public function detailSchedule($id){
        $schedule=Schedule::find($id);

        if($schedule){
            return new ScheduleResource($schedule);
        }else{
            return response()->json(['status'=>'fail!','message'=>'schedule not found']);
        }
    }

    public function detailTravel($id){
        $travel=Travel::find($id);

        if($travel){
            return new TravelDetailResource($travel);
        }else{
            return response()->json(['status'=>'fail!','message'=>'travel not found']);
        }
    }
}
