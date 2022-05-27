<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
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



Route::middleware('can:user-higher')
    ->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
    });
