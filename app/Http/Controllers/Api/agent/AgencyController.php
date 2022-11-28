<?php

namespace App\Http\Controllers\Api\agent;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Agency\AgencyResource;
use App\Services\agencies\UpdateAgencyService;
use App\Http\Resources\Agency\AgencyDetailResource;

class AgencyController extends Controller
{


    public function details(){
        return AgencyDetailResource::collection(Agency::all());
    }

    public function update($id,AgencyRequest $request)
    {

        if(Auth::guard('api-agent')->user()->id==$id){
           return (new UpdateAgencyService($id,$request));
        }else{
            return response()->json(['status'=>'fail!','message'=>'Unauthorized'],403);
        }

    }
}
