<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\admin\AdminController;
use App\Http\Controllers\Auth\agent\AgentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api-kipart', function () {
    return view('api.api-kipart');
})->name('api');

Route::get('/',function(){
    return view('homepage');
})->name('homepage');





Route::prefix('user')->name('user.')->group(function(){

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('login','auth.admin.login')->name('login');
        Route::post('login',[AdminController::class,'login'])->name('login');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('dashboard','admin.dashboard')->name('dashboard');
        Route::post('logout',[AdminController::class,'logout'])->name('logout');

    });
});

Route::prefix('agent')->name('agent.')->group(function(){

    Route::middleware(['guest:agent'])->group(function(){

        Route::view('login','auth.agent.login')->name('login');
        Route::post('login',[AgentController::class,'login'])->name('login');
    });

    Route::middleware(['auth:agent'])->group(function(){

    });
});


Route::get('test',[TestController::class,'testResponse']);

require __DIR__.'/auth.php';
