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
        Route::apiResource('agencer',AgencyController::class,['except' => ['create', 'edit']]);

        Route::fallback(function () {
            abort(404);
        });
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

