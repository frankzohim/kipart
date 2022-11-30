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
use App\Http\Controllers\Api\AuthController;
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

    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[UsersController::class,'register']);

    Route::post('customer/login',[AuthController::class,'login']);

