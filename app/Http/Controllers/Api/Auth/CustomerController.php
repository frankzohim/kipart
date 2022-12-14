<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

use App\Models\VerificationCode;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Client as OClient;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\services\sms\SendSmsService;
use ErrorException;

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
        'phone_number' => 'required|max:9|unique:users',
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

    $sendOtp=$this->sendOtp($data['phone_number']);
    return Route::dispatch($token);
}

    public function logout(){
        $user = Auth::guard('api')->user();
        $user->token()->revoke();
        return response()->json(['message'=>"Deconnexion Reussit"]);
    }


    public function sendOtp($mobile){

        $otp = rand(100000, 999999);
        $message=$otp." est votre code de connexion kipart";
        $user = User::where('phone_number', $mobile)->first();
        $sms=(new SendSmsService())->sendSms("delanofofe@gmail.com","test1234",$mobile,$message,"Kipart","2022-12-09 17:20:02");

        $smsResponse=json_decode($sms->getBody(),true);

        if($smsResponse["responsecode"]==1){

            VerificationCode::create([
                'user_id' => $user->id,
                'otp'=>$otp,
                'expire_at' => Carbon::now()->addMinutes(15)
            ]);
            return response()->json(["status"=>"success","message"=>"message envoyé avec success au $mobile"],200);
        }else{
            return response()->json(["status"=>"fail!","message"=>"une erreur s'est produite"],401);
        }
    }

    public function verifyOtp(Request $request,$id){

        $rules = Validator::make($request->all(), [
            'otp' => 'required|exists:verification_codes,otp',
            'phone_number' =>'required|exists:users,phone_number',
        ]);

        if ($rules->fails()) {
            return response()->json(["message"=>"Code Invalide ou informations incorrecte"],400);
        }
        $enteredOtp = $request->input('otp');
        $verificationCode   = VerificationCode::where('otp', $request->otp)->first();
        $user = User::find($id);
        try{
            if($enteredOtp==$verificationCode->otp && $request->phone_number==$user->phone_number){

                //Removing Session variable
                // Expire The OTP
                $verificationCode->update([
                    'expire_at' => Carbon::now()
                ]);
                $verificationCode->delete();

               return response()->json(["message"=>"Votre numéro viens d'etre verifier"],200);
            }else if($verificationCode !== $enteredOtp){

            }
        }catch(ErrorException $e){
            return response()->json(["message"=>$e->getMessage()],404);
        }

    }

}
