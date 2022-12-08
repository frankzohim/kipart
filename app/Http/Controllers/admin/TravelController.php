<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessToken=Session::get('token');

        $travels=Http::withToken($accessToken)
            ->get('http://kipart.stillforce.tech/api/admin/v1/travels');

        $datas=json_decode($travels->getBody());

        return view('admin.travels.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $accessToken=Session::get('token');
                $responseAgency= Http::withToken($accessToken)
                        ->get('http://kipart.stillforce.tech/api/admin/v1/agencies');

                $responsePath=Http::withToken($accessToken)
                ->get('http://kipart.stillforce.tech/api/admin/v1/paths');

                $dataAgency=json_decode($responseAgency->getBody());
                $dataPath=json_decode($responsePath->getBody());

                return view('admin.travels.create',compact('dataAgency', 'dataPath'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'=>"required",
            'path_id'=>"required",
            'class'=>"required",
            'price'=>"required",
            'state'=>"required"
        ]);
        $accessToken=Session::get('token');

        Http::withToken($accessToken)
                        ->post('http://kipart.stillforce.tech/api/admin/v1/travels',[
                            'date'=>$request->date,
                            'path_id' =>$request->path_id,
                            'agency_id'=>$request->agency_id,
                            'price'=>$request->price,
                            'class'=>$request->class,
                            'state'=>$request->state,

                ]);

                return to_route('admin.travels.index')->with('success','Voyage Ajoutée avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $accessToken=Session::get('token');

            $responseAgency= Http::withToken($accessToken)
                        ->get('http://kipart.stillforce.tech/api/admin/v1/agencies');

                $responsePath=Http::withToken($accessToken)
                ->get('http://kipart.stillforce.tech/api/admin/v1/paths');

                $dataAgency=json_decode($responseAgency->getBody());
                $dataPath=json_decode($responsePath->getBody());

                    $response = Http::withToken($accessToken)
                            ->get('http://kipart.stillforce.tech/api/admin/v1/travels/'.$id);
                    $datas=json_decode($response->getBody());

                    //return $response;
                } catch (GuzzleException $e) {
                    return "Exception!: " . $e->getMessage();
                }
        return view('admin.travels.edit',compact('datas','dataPath','dataAgency'));
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

        $request->validate([
            'date'=>"required",
            'path_id'=>"required",
            'agency_id'=>"required",
            'class'=>"required",
            'price'=>"required",
            'state'=>"required"
        ]);

        $accessToken=Session::get('token');

        try {
                Http::withToken($accessToken)
                        ->put('http://kipart.stillforce.tech/api/admin/v1/travels/'. $id,[
                            'date'=>$request->date,
                            'path_id' =>$request->path_id,
                            'agency_id'=>$request->agency_id,
                            'price'=>$request->price,
                            'class'=>$request->class,
                            'state'=>$request->state,

                ]);

                return to_route('admin.travels.index')->with('success','Voyage mis a jour avec success');
            } catch (GuzzleException $e) {
                return "Exception!: " . $e->getMessage();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
