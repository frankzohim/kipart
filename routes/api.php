<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\PathController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\TravelController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\NotificationController;

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
    //All endpoints for users
    Route::apiResource('/users', UsersController::class);
    Route::post('login',[UsersController::class,'login']);
    Route::get('logout',[UsersController::class,'logout']);


        //All endpoints for roles
        Route::apiResource('/roles', RoleController::class);


        Route::apiResource('schedule',ScheduleController::class);
        Route::apiResource('bus',BusController::class);
        Route::apiResource('path',PathController::class);
        Route::apiResource('travel',TravelController::class);
        Route::apiResource('agency',AgencyController::class);
        Route::apiResource('notification',NotificationController::class);

Route::middleware('auth:api')->prefix('v1')->group(function(){

    Route::get('/user', function(Request $request){
        return $request->user();
    });








});

Route::get('/test', function(Request $request){
    return "Authenticated";
});

