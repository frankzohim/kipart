<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\admin\BusController;

use App\Http\Controllers\Api\admin\PathController;
use App\Http\Controllers\Api\Auth\AgentController;
use App\Http\Controllers\Api\admin\UsersController;
use App\Http\Controllers\Api\admin\AgencyController;
use App\Http\Controllers\Api\admin\TravelController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\Auth\CustomerController;
use App\Http\Controllers\Api\admin\ScheduleController;
use App\Http\Controllers\Api\agent\AgencyController as AgentAgencyController;
use App\Http\Controllers\Api\agent\BusController as AgentBusController;
use App\Http\Controllers\Api\agent\PathController as AgentPathController;
use App\Http\Controllers\Api\agent\ScheduleController as AgentScheduleController;
use App\Http\Controllers\Api\Auth\AdminController;

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
    //All endpoints for unauth user
    Route::post('login',[CustomerController::class,'login']);
    Route::post('login/admin',[AdminController::class,'login']);
    Route::post('agent/login',[AgentController::class,'login']);



    // All endpoints for admin
    Route::middleware('auth:api-admin')->prefix('v1')->group(function(){

        Route::apiResource('travels',TravelController::class);
        Route::apiResource('agencies',AgencyController::class);
        Route::apiResource('buses',BusController::class);
        Route::apiResource('Schedules',ScheduleController::class);
        Route::apiResource('paths',PathController::class);
        Route::apiResource('users',UsersController::class);
        Route::post('logout/adn/private',[AdminController::class,'logout']);
    });


    // All endpoints for agents
    Route::middleware('auth:api-agent')->prefix('v1')->group(function(){

        //endPoint agent-agencies
        Route::get('list/agencies',[AgentAgencyController::class,'list']);
        Route::patch('update/MyOwnAgency/{id}',[AgentAgencyController::class,'update']);

        //endPoint agent-buses
        Route::get('list/buses',[AgentBusController::class,'list']);
        Route::patch('update/MyOwnBuses/{id}',[AgentBusController::class,'update']);
        Route::post('store/bus',[AgentBusController::class,'store']);
        Route::delete('destroy/MyOwnbus/{id}',[AgentBusController::class,'destroy']);

        //endPoint agent-paths
        Route::get('list/paths',[AgentPathController::class,'list']);
        Route::patch('update/MyOwnPaths/{id}',[AgentPathController::class,'update']);
        Route::post('store/path',[AgentPathController::class,'store']);
        Route::delete('destroy/MyOwnPath/{id}',[AgentPathController::class,'destroy']);

        //endPoint agent-schedules

        Route::get('list/schedules',[AgentScheduleController::class,'index']);
        Route::patch('update/MyOwnSchedule/{id}',[AgentScheduleController::class,'update']);
        Route::post('store/MyOwnSchedule',[AgentScheduleController::class,'store']);
        Route::delete('destroy/MyOwnSchedule/{id}',[AgentScheduleController::class,'destroy']);


        //endPoint agent-travel

        Route::get('list/travels',[AgentController::class,'index']);
        Route::patch('update/MyOwnTravel/{id}',[AgentController::class,'update']);
        Route::post('store/MyOwnTravel',[AgentController::class,'store']);
        Route::delete('destroy/MyOwnTravel/{id}',[AgentController::class,'destroy']);

    });


    // All endpoints for users
    Route::middleware('auth:api')->prefix('v1')->group(function(){

        Route::get('travel',[TravelController::class,'index']);
        Route::post('logout',[CustomerController::class,'logout']);
    });





Route::middleware('auth:api')->prefix('v1')->group(function(){


});


// Route::get('bus',[BusController::class,'index']);
// Route::get('path',[PathController::class,'index']);
// Route::get('travel',[TravelController::class,'index']);

Route::get('/test', function(Request $request){
    return "Authenticated";
});

