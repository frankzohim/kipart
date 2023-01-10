<?php

namespace App\Http\Controllers\Api\agent\subagency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Agency\SubAgency\DetailSubAgencyResource;
use App\Models\SubAgency;
use Illuminate\Support\Facades\Auth;

class DetailSubAgencyController extends Controller
{
    public function detailSubAgency(){

        $subAgent=Auth::guard('api-agent')->user();

        $id=$subAgent->id;
        $agencyId=$subAgent->agency_id;

        $detailSubAgency=DetailSubAgencyResource::collection(SubAgency::where('id',$id)->where('agency_id',$agencyId)->get());

        return $detailSubAgency;
    }
}
