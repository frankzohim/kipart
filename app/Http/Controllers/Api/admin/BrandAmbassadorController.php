<?php

namespace App\Http\Controllers\Api\admin;

use Illuminate\Http\Request;
use App\Models\brandAmbassador;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BrandAmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand=brandAmbassador::all();

        return response()->json(['brandAmbassadors'=>$brand],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brandStore=brandAmbassador::create([
            'name'=>$request->name
        ]);

        return response()->json(['statut'=>'created success'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand=brandAmbassador::find($id);

        return response()->json(['brandAmbassador'=>$brand],200);
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
        $brand=brandAmbassador::find($id);

        $brand->update([
            'name'=>$request->name
        ]);

        return response()->json(['statut'=>'update success'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(brandAmbassador $brand)
    {
        $brand->delete();

        return response()->json(['statut'=>'deleted successfuly'],204);
    }

    public function details(){
        $brands=DB::table('users')
        ->join('brand_ambassadors','users.brand_ambassadors_id','brand_ambassadors.id')->select(


            DB::raw('COUNT(users.id) as count'),
            DB::raw('brand_ambassadors.name as nameB'),
            )->groupBy('nameB')
            ->get();

            return response()->json(['brandGirls'=>$brands],200);
    }
}
