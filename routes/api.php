<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PathController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\TravelController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\Auth\AdminController;
use App\Http\Controllers\Api\Auth\AgentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\Auth\CustomerController;

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
    Route::post('customer/login',[CustomerController::class,'login']);
    Route::post('admin/login',[AdminController::class,'login']);
    Route::post('agent/login',[AgentController::class,'login']);


    Route::middleware('auth:api-admin')->prefix('v1')->group(function(){


    });

    Route::middleware('auth:api-agent')->prefix('v1')->group(function(){


    });

    Route::middleware('auth:api-customer')->prefix('v1')->group(function(){


    });





Route::middleware('auth:api')->prefix('v1')->group(function(){

    Route::get('agency',[AgencyController::class,'index']);
});


Route::get('bus',[BusController::class,'index']);
Route::get('path',[PathController::class,'index']);
Route::get('travel',[TravelController::class,'index']);

Route::get('/test', function(Request $request){
    return "Authenticated";
});

