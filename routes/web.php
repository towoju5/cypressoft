<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WalletsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('event/list', [EventsController::class, 'list'])->name('events.list');
    Route::get('events/calender', [EventsController::class, 'index'])->name('events');
    Route::get('event/edit/{event_id}', [EventsController::class, 'edit'])->name('event.edit');
    Route::post('event/update/{event_id}', [EventsController::class, 'update'])->name('event.update');
    Route::post('events', [EventsController::class, 'store'])->name('event.post');

    Route::get('event/edit/{id}', [EventsController::class, 'edit'])->name('event.edit');
    Route::post('event/update/{id}', [EventsController::class, 'update'])->name('event.update');
    Route::get('event/delete/{id}', [EventsController::class, 'destroy'])->name('event.delete');
});
Route::get('logout',    [HomeController::class, 'logout'])->name('logout');
