<?php

namespace App\Http\Controllers\Api\admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersResource;
use Illuminate\Contracts\Validation\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UsersResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'email_verified_at' => now(),
            'role_id' => $request->input('role_id'),
            'phone_number' => $request->input('phone_number')
        ]);

        return new UsersResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UsersResource($user);
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
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->input('name')
            ]);

        return new UsersResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(null,204);
    }

    public function login(Request $request){
        $user=$request->validate([
            'email'=>["email","required"],
            'password'=>["required","string",]
        ]);

        $userc=User::where("email",$user["email"])->first();

        if(!$userc) return response(["message"=>"Aucun utilisateur"],401);
        if(!Hash::check($user["password"],$userc->password)){
            return response(['aucun utilisateur trouver avec ce mot de passe'],401);
        }
        $token=$userc->createToken("CLE_SECRETE_KIPART")->accessToken;

        return response([
            'utilisateur'=>$userc,
            "token"=>$token
        ],200);

    }

    public function register(Request $request){

        $user=$request->validate([
            'name'=>'required',
            'email'=>["email","required"],
            'password'=>["required","string",],
            'phone_number'=>["required","max:20"]
        ]);

        $user=User::create([
            "name"=>$user["name"],
            "email"=>$user["email"],
            "password"=>bcrypt($user["password"]),
            "phone_number"=>$user["phone_number"],
            "role_id"=>3,
        ]);

        return response($user,201);
    }


}
