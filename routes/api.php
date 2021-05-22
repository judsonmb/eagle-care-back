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
    Route::resource('schedules', App\Http\Controllers\ScheduleController::class);
    Route::resource('drugs', App\Http\Controllers\DrugController::class);
});
