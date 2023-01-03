<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessToken=Session::get('token');

        $paths=Http::withToken($accessToken)
            ->get('http://kipart.stillforce.tech/api/admin/v1/paths');

        $datas=json_decode($paths->getBody());

        return view('admin.path.index',compact('datas','paths'));
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
                $dataAgency=json_decode($responseAgency->getBody());
                return view('admin.path.create',compact('dataAgency'));

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
            'departure'=>"required",
            'arrival'=>"required",
            'agency_id'=>"required",
            'state'=>"required"
        ]);
        $accessToken=Session::get('token');
        Http::withToken($accessToken)
                        ->post('http://kipart.stillforce.tech/api/admin/v1/paths',[
                            'departure'=>$request->departure,
                            'arrival' =>$request->arrival,
                            'agency_id'=>$request->agency_id,
                            'state'=>$request->state,

                ]);
                return to_route('admin.paths.index')->with('success','Trajet Ajouté avec success');
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
                $dataAgency=json_decode($responseAgency->getBody());


                    $response = Http::withToken($accessToken)
                            ->get('http://kipart.stillforce.tech/api/admin/v1/paths/'.$id);
                    $datas=json_decode($response->getBody());

                    //return $response;
                } catch (GuzzleException $e) {
                    return "Exception!: " . $e->getMessage();
                }
        return view('admin.path.edit',compact('datas','dataAgency'));
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
            'departure'=>"required",
            'arrival'=>"required",
            'agency_id'=>"required",
            'state'=>"required"
        ]);

        $accessToken=Session::get('token');

        try {
                Http::withToken($accessToken)
                        ->put('http://kipart.stillforce.tech/api/admin/v1/paths/'. $id,[
                            'departure'=>$request->departure,
                            'arrival' =>$request->arrival,
                            'agency_id'=>$request->agency_id,
                            'state'=>$request->state,

                ]);

                return to_route('admin.paths.index')->with('success','trajet mis a jour avec success');
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
        $accessToken=Session::get('token');
                Http::withToken($accessToken)
                        ->delete('http://kipart.stillforce.tech/api/admin/v1/paths/'. $id);

                return to_route('admin.paths.index')->with('fail','Trajet suprimé avec success');
    }
}
