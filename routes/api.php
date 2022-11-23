<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->prefix('v1')->group(function(){
    
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    //All endpoints for users
    Route::apiResource('/users', UsersController::class);

    //All endpoints for roles
    Route::apiResource('/roles', RoleController::class);
});


//user/{userid}
//Route for a specific User

Route::get('/test', function(Request $request){
    return "Authenticated";
});
