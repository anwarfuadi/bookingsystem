<?php

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
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
    'confirm' => false,
]);

Route::middleware(['auth'])->group(function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('booking/room', 'BookingController@getRoom')->name('booking.getRoom');

    Route::resources([
        'user' => UserController::class,
        'category' => CategoryController::class,
        'customer' => CustomerController::class,
        'room' => RoomController::class,
        'booking' => BookingController::class
    ]);

});

