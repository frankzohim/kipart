<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Services\Auth\LoginService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client as OClient;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;



class CustomerController extends Controller
{
    public function login(LoginRequest $request){
        $customerRequest=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);
        $customer=User::where("email",$customerRequest["email"])->first();

        if(!$customer) return response(["message"=>"Aucun client trouvé"],401);
        if(!Hash::check($request["password"],$customer->password)){
            return response(['aucun utilisateur trouver avec ce mot de passe'],401);
        }
          // And created user until here.

    $client = Client::where('id', 2)->first();

    // Is this $request the same request? I mean Request $request? Then wouldn't it mess the other $request stuff? Also how did you pass it on the $request in $proxy? Wouldn't Request::create() just create a new thing?

    $request->request->add([
        'grant_type'    => 'password',
        'client_id'     => $client->id,
        'client_secret' => $client->secret,
        'username'      => $customer->email,
        'password'      => $customer->password,
        'scope'         => null,
    ]);

    // Fire off the internal request.
    $token = Request::create(
        'oauth/token',
        'POST'
    );
    return Route::dispatch($token);
    }

    // User Register
    function register(Request $request)
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    $valid = validator($request->only('email', 'name', 'password','phone_number'), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'phone_number' => 'required',
    ]);

    if ($valid->fails()) {
        return response()->json(['error'=>$valid->errors()], 422);

    }

    $data = request()->only('email','name','password','phone_number');

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'phone_number' => $data['phone_number']
    ]);

    // And created user until here.

    $client = Client::where('id', 2)->first();

    // Is this $request the same request? I mean Request $request? Then wouldn't it mess the other $request stuff? Also how did you pass it on the $request in $proxy? Wouldn't Request::create() just create a new thing?

    $request->request->add([
        'grant_type'    => 'password',
        'client_id'     => $client->id,
        'client_secret' => $client->secret,
        'username'      => $data['email'],
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
        $user = Auth::guard('api')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }


    public function generate(Request $request){
        # Validate Data
        $request->validate([
            'number' => 'required|exists:users,number'
        ]);

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->mobile_no);
    }


}
