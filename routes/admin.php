<?php

use App\Http\Controllers\admin\AgencyController as AdminAgencyController;
use App\Http\Controllers\admin\ScheduleController;
use App\Http\Controllers\admin\TravelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\admin\AdminController;


Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('login','auth.admin.login')->name('login');
        Route::post('login',[AdminController::class,'login'])->name('login');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){

        Route::resource('agencies',AdminAgencyController::class);
        Route::post('logout',[AdminController::class,'logout'])->name('logout');

    });
    Route::view('dashboard','admin.dashboard')->name('dashboard');

    Route::resource('schedules',ScheduleController::class);

    Route::resource('travels', TravelController::class);
    Route::resource('path', PathController::class);

});
