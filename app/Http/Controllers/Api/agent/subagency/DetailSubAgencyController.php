<?php

namespace App\Http\Controllers\Api\agent\subagency;

use App\Models\Agency;
use App\Models\SubAgency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Agency\SubAgency\DetailSubAgencyResource;

class DetailSubAgencyController extends Controller
{
    public function detailSubAgency(){

        $subAgent=Auth::guard('api-agent')->user();

        // $id=$subAgent->id;
        // $agencyId=$subAgent->agency_id;

        // $detailSubAgency=DetailSubAgencyResource::collection(SubAgency::where('id',$id)->where('agency_id',$agencyId)->get());

        return $subAgent;
    }

    public function detailAgencyBySubAgency(){

        $agency=Agency::where('id',Auth::guard('api-agent')->user()->agency_id)->first();

        return $agency;
    }
}
