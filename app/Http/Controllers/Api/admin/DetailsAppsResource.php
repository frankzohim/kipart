<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;

class DetailsAppsResource extends Controller
{
    public function CountResource(){

        $countAgencies=Agency::where('state',1)->count();
        $countUsers=User::where('isVerifiedOtp',1)->count();
        $countTicket=Passenger::where('isCheckPayment',1)->count();

        return response()->json(['agencies'=>$countAgencies,'users'=>$countUsers,'tickets'=>$countTicket]);
    }
}
