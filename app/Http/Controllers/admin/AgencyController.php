<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\GuzzleException;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        try{

    // $accessToken=(new AccessTokenAdminService())->accessToken();


            $accessToken=Session::get('token');

            $result = $client->request('GET','http://kipart.stillforce.tech/api/admin/v1/agencies',[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $accessToken",
                ]
            ]);


            $datas=json_decode($result->getBody());
            // return view('admin.agencies.index',compact('datas'));
            return $datas;
        } catch (GuzzleException $e) {
            return "Exception!: " . $e->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agencies.create');
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
            'email'=>'required|email|',
            'name'=>'required|unique:agencies,name',
            'logo'=>'required|mimes:png,jpg,jpeg',
            'phone_number' =>'required|max:10',
            'password' =>'required',
            'headquarters' =>'required'
        ]);

        try{

            // $accessToken=(new AccessTokenAdminService())->accessToken();



                    $client = new Client();
                    $accessToken=Session::get('token');

                    $result = $client->request('POST','http://kipart.stillforce.tech/api/admin/v1/agencies', [
                        'form_params' =>[
                            'email'=>$request->email,
                            'name' =>$request->name,
                            'logo'=>$request->logo,
                            'headquarters'=>$request->headquarters,
                            'password'=>$request->password,
                            'phone_number'=>$request->phone_number
                        ],'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer $accessToken",
                        ],

                    ]);


                    //$datas=json_decode($result->getBody());
                    //return view('admin.agencies.index',compact('datas'));
                    //return $datas;
                } catch (GuzzleException $e) {
                    return "Exception!: " . $e->getMessage();
                }
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
        //
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
        //
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
