<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    // public function login(LoginRequest $request){

    //     (new LoginService())->login($request,'admin');
    // }

    public function register(){

    }

    public function login(Request $request){
        $valid = validator($request->only('email','password'), [
            'email' => 'required|string|exists:admins',
            'password' => 'required|string',
        ]);
        $data = request()->only('email','password');
        $admin=Admin::where("email",$data["email"])->first();
        $client = Client::where('id', 4)->first();
        if ($valid->fails()) {
            return response()->json(['error'=>$valid->errors()], 422);

        }



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

    public function logout(){
        $user = Auth::guard('api-admin')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }
}
