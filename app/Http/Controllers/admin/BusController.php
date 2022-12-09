<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;
class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessToken=Session::get('token');

        $bus=Http::withToken($accessToken)
            ->get('http://kipart.stillforce.tech/api/admin/v1/bus');

        $datas=json_decode($bus->getBody());

        return view('admin.bus.index',compact('datas'));
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

        return view('admin.bus.create',compact('dataAgency', 'dataPath'));
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
            'registration'=>"required",
            'number_of_places'=>"required",
            'class'=>"required",
            'agency_id'=>"required",
            'path_id' =>"required",
            'plan'=>"required",
            'state'=>"required"
        ]);
        $accessToken=Session::get('token');

        Http::withToken($accessToken)
                        ->post('http://kipart.stillforce.tech/api/admin/v1/bus',[
                            'registration'=>$request->registration,
                            'number_of_places'=>$request->number_of_places,
                            'class' =>$request->class,
                            'path_id' =>$request->path_id,
                            'agency_id'=>$request->agency_id,
                            'plan'=>$request->plan,
                            'state'=>$request->state,

                ]);

                return to_route('admin.bus.index')->with('success','Bus Ajoutée avec success');
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
                            ->get('http://kipart.stillforce.tech/api/admin/v1/bus/'.$id);
                    $datas=json_decode($response->getBody());

                    //return $response;
                } catch (GuzzleException $e) {
                    return "Exception!: " . $e->getMessage();
                }
        return view('admin.bus.edit',compact('datas','dataPath','dataAgency'));
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
            'registration'=>"required",
            'number_of_places'=>"required",
            'class'=>"required",
            'agency_id'=>"required",
            'path_id' =>"required",
            'plan'=>"required",
            'state'=>"required"
        ]);

        $accessToken=Session::get('token');

        try {
                Http::withToken($accessToken)
                        ->put('http://kipart.stillforce.tech/api/admin/v1/bus/'. $id,[
                            'registration'=>$request->registration,
                            'number_of_places'=>$request->number_of_places,
                            'class' =>$request->class,
                            'path_id' =>$request->path_id,
                            'agency_id'=>$request->agency_id,
                            'plan'=>$request->plan,
                            'state'=>$request->state,

                ]);

                return to_route('admin.bus.index')->with('success','bus mis a jour avec success');
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
