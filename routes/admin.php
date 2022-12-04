<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\admin\AdminController;
use App\Http\Controllers\Auth\admin\AgencyController;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('login','auth.admin.login')->name('login');
        Route::post('login',[AdminController::class,'login'])->name('login');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('dashboard','admin.dashboard')->name('dashboard');
        Route::resource('agencies',AgencyController::class);
        Route::post('logout',[AdminController::class,'logout'])->name('logout');

    });
});
