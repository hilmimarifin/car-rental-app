<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/', [App\Http\Controllers\CarController::class, 'getCars']);
    Route::get('/car/add', [App\Http\Controllers\CarController::class, 'add']);
    Route::post('/car/add', [App\Http\Controllers\CarController::class, 'store']);

    Route::post('/reservation/{car_id}', [App\Http\Controllers\ReservationController::class, 'add']);
    Route::put('/reservation/{reservation_id}', [App\Http\Controllers\ReservationController::class, 'returnCar']);
    Route::get('/reservation', [App\Http\Controllers\ReservationController::class, 'get']);
    Route::get('/reservation/completed', [App\Http\Controllers\ReservationController::class, 'getCompleted']);



    Route::get('/my-reservations', function () {
        return view('my_reservations');
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');