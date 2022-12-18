<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([], function(){
    Route::post('login',    [AuthController::class, 'process_login']);
    Route::post('register', [AuthController::class, 'process_register']);
    
    /**
     * Authenticated Routes
     */
    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::get('events', [EventsController::class, 'index']);
        Route::get('events/filter', [EventsController::class, 'filter']);
    });
});