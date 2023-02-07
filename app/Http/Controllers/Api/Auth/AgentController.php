<?php

namespace App\Http\Controllers\Api\Auth;


use App\Models\Agent;
use App\Models\SubAgency;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth\LoginRequest;

class AgentController extends Controller
{
    public function login(Request $request ){

        $valid = validator($request->only('email','password'), [
            'email' => 'required|string|exists:sub_agencies',
            'password' => 'required|string',
        ]);
        $data = request()->only('email','password');
        $admin=SubAgency::where("email",$data["email"])->first();
        $client = Client::where('id', 5)->first();
        if ($valid->fails()) {
            return response()->json(['error'=>$valid->errors()], 422);

        }
        if($admin){
                         // And created user until here.
    // Is this $request the same request? I mean Request $request? Then wouldn't it mess the other $request stuff? Also how did you pass it on the $request in $proxy? Wouldn't Request::create() just create a new thing?

    $request->request->add([
        'grant_type'    => 'password',
        'client_id'     => $client->id,
        'client_secret' => $client->secret,
        'username'      => $admin->email,
        'password'      => $data['password'],
        'scope'         => null,
    ]);

    // Fire off the internal request.
    $token = Request::create(
        'oauth/token',
        'POST'
    );
    return Route::dispatch($token);
        }

        else{
            return response()->json(['error'=>"Incorrect email"]);
        }




    }

    public function register(){

    }

    public function loginAgent(Request $request){
        $valid = validator($request->only('email','password'), [
            'email' => 'required|string|exists:Agents',
            'password' => 'required|string',
        ]);

        $data = request()->only('email','password');
        $agent=Agent::where("email",$data["email"])->first();
        $subAgency=SubAgency::where('id',$agent->sub_agency_id)->first();

        $client = Client::where('id', 5)->first();
        if ($valid->fails()) {
            return response()->json(['error'=>$valid->errors()], 422);

        }
        if($agent){
            // And created user until here.
        // Is this $request the same request? I mean Request $request? Then wouldn't it mess the other $request stuff? Also how did you pass it on the $request in $proxy? Wouldn't Request::create() just create a new thing?

        $request->request->add([
        'grant_type'    => 'password',
        'client_id'     => $client->id,
        'client_secret' => $client->secret,
        'username'      => $subAgency->email,
        'password'      => $data['password'],
        'scope'         => null,
        ]);

        // Fire off the internal request.
        $token = Request::create(
        'oauth/token',
        'POST'
        );
        return Route::dispatch($token);
        }

        else{
        return response()->json(['error'=>"Incorrect email"]);
        }


    }

    public function logout(){
        $user = Auth::guard('api-agent')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }
}
