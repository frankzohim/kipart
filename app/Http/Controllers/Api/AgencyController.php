<?php

namespace App\Http\Controllers\Api;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyRequest;
use App\Http\Resources\AgencyResource;
use Illuminate\Support\Facades\Validator;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AgencyResource::collection(Agency::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {

        $agency=Agency::create([
            'name'=>$request->name,
            'headquarters'=>$request->headquarters,
            'logo'=>$request->logo,
            'numberOfBus'=>$request->numberOfBus,
            'state'=>1
        ]);

        return new AgencyResource($agency);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency=Agency::find($id);

        if($agency){
            return new AgencyResource($agency);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'agency not found']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $agency=Agency::find($id);

        if($agency){
            $agency->update([
                'name'=>$request->name,
                'headquarters'=>$request->headquarters,
                'logo'=>$request->logo,
                'numberOfBus'=>$request->numberOfBus,
                'state'=>1
            ]);

            return response()->json(['status'=>'success','message'=>'Agency update','data'=>$agency]);
        }
        else{
            return response()->json(['status'=>'fail!','message'=>'agency not found']);
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        if($agency){
            $agency->delete();
        return response()->json(["message"=>"Agency deleted"],204);
        }else{
            return response()->json(["message"=>"Agency not found"],404);
        }



    }
}
