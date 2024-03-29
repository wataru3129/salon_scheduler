<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VueController;
use App\Models\Reservation;

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
        Route::get('/daily/{day}', [ReservationController::class, 'daily'])->name('daily');
        Route::get('reservations/list', [ReservationController::class, 'list'])->name('list');
        Route::get('reservations/past', [ReservationController::class, 'past'])->name('past');
        Route::resource('reservations', ReservationController::class)->except(['index']);
    });


// Route::get('vue', [VueController::class, 'index'])->name('vue.index');
