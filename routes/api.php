<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [App\Http\Controllers\UserController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('people', App\Http\Controllers\PersonController::class);
    Route::resource('drugs', App\Http\Controllers\DrugController::class);
    Route::get('schedules', [App\Http\Controllers\ScheduleController::class, 'index']);
    Route::get('/who-more-expend', [App\Http\Controllers\DrugController::class, 'getWhoMoreExpend']);
    Route::get('/more-used-drugs', [App\Http\Controllers\DrugController::class, 'getMoreUsedDrugs']);
    Route::get('/people-use-same-drugs', [App\Http\Controllers\DrugController::class, 'getPeopleUseSameDrugs']);

});
