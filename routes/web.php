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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('events/list', [EventsController::class, 'index'])->name('events.list');
    Route::get('events/calender', [EventsController::class, 'index'])->name('events');
    Route::get('events/edit/{event_id}', [EventsController::class, 'edit'])->name('event.edit');
    Route::post('events/update/{event_id}', [EventsController::class, 'update'])->name('event.update');
    Route::post('events', [EventsController::class, 'store'])->name('event.post');

    Route::get('profile', [HomeController::class, 'index'])->name('change.password');
});
Route::get('logout',    [HomeController::class, 'index'])->name('logout');
