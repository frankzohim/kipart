<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\agent\AgentController;



Route::prefix('agent')->name('agent.')->group(function(){

    Route::middleware(['guest:agent','PreventBackHistory'])->group(function(){

        Route::view('login','auth.agent.login')->name('login');
        Route::post('login',[AgentController::class,'login'])->name('login');
    });

    Route::middleware(['auth:agent','PreventBackHistory'])->group(function(){
        Route::view('dashboard','agent.dashboard')->name('dashboard');
        Route::post('logout',[AgentController::class,'logout'])->name('logout');
    });
});
