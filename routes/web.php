<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/q', [WalletsController::class, 'index'])->name('q');
Route::get('/create-address', [WalletsController::class, 'create'])->name('create');
Route::get('/list', [WalletsController::class, 'listTransfers'])->name('list');
