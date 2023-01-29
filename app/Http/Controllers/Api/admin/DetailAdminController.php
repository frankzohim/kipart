<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\User;
use App\Models\Agency;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailAdminController extends Controller
{
    public function infosAdmin(){

        $admin=Auth::guard('api-admin')->user();
        return $admin;
    }
    public function CountResource(){

        $countAgencies=Agency::where('state',1)->count();
        $countUsers=User::where('isVerifiedOtp',1)->count();
        $countTicket=Passenger::where('isCheckPayment',1)->count();

        return response()->json(['agencies'=>$countAgencies,'users'=>$countUsers,'tickets'=>$countTicket]);
    }
}
