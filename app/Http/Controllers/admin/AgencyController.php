<?php

namespace App\Http\Controllers\admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Support\Facades\Http;
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
            return view('admin.agencies.index',compact('datas'));
            //return $accessToken;
            //return $datas;
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
            'headquarters' =>'required'
        ]);

        try{

            // $accessToken=(new AccessTokenAdminService())->accessToken();


                    $accessToken=Session::get('token');
                    // $client = new Client();
                    // $accessToken=Session::get('token');
                    // $p = $request->logo;
                    // $result= $client->request('POST','http://kipart.stillforce.tech/api/admin/v1/agencies', [
                    //     'query' =>[
                    //         'email'=>$request->email,
                    //         'name' =>$request->name,
                    //         'logo'=>$p,
                    //         'headquarters'=>$request->headquarters,
                    //         'password'=>$request->password,
                    //         'phone_number'=>$request->phone_number,
                    //         'state'=>$request->state,
                    //     ],'headers' => [
                    //         'Content-Type' => 'application/json',
                    //         'Accept' => 'application/json',
                    //         'Authorization' => "Bearer $accessToken",
                    //     ],'multipart' => [
                    //         [
                    //             'name'     => 'logo',
                    //             'contents' => $request->file('logo'),
                    //             'bucketName' => 'test',
                    //         ],]

                    // ]);


                    //$datas=json_decode($result->getBody());
                    // return to_route('admin.agencies.index');
                    //return $datas;
                    $photo = fopen($request->file('logo'), 'r');
                $response = Http::withToken($accessToken)
                        ->attach('logo',$photo,'logo')
                        ->post('http://kipart.stillforce.tech/api/admin/v1/agencies',[
                            'email'=>$request->email,
                            'name' =>$request->name,
                            'headquarters'=>$request->headquarters,
                            'password'=>$request->password,
                            'phone_number'=>$request->phone_number,
                            'state'=>$request->state,

                ]);


                return to_route('admin.agencies.index')->with('success','Agence Ajoutée avec success');
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
        try {
            $accessToken=Session::get('token');
                    $response = Http::withToken($accessToken)
                            ->get('http://kipart.stillforce.tech/api/admin/v1/agencies/'.$id);
                    $datas=json_decode($response->getBody());

                    //return $response;
                } catch (GuzzleException $e) {
                    return "Exception!: " . $e->getMessage();
                }
        return view('admin.agencies.edit',compact('datas'));
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
        try {


        $accessToken=Session::get('token');
                Http::withToken($accessToken)
                        ->put('http://kipart.stillforce.tech/api/admin/v1/agencies/'. $id,[
                            'email'=>'Bramslevel129@gmail.com',
                            'name' =>$request->name,
                            'headquarters'=>$request->headquarters,
                            'phone_number'=>$request->phone_number,
                            'state'=>$request->state,
                            'logo'=>$request->logo,

                ]);

                return to_route('admin.agencies.index')->with('success','Agence mis a jour avec success');
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
                        ->delete('http://kipart.stillforce.tech/api/admin/v1/agencies/'. $id);

                return to_route('admin.agencies.index')->with('fail','Agence suprimé avec success');
    }


}
