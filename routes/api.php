<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassengerRideController;
use App\Http\Controllers\Api\DriverController;

/*
|--------------------------------------------------------------------------
| Passenger APIs
|--------------------------------------------------------------------------
*/

Route::prefix('passenger')->group(function () {

    // Create ride request
    Route::post('/ride', [PassengerRideController::class, 'store']);

    // Approve a driver for a ride
    Route::post('/ride/{ride}/approve-driver', [PassengerRideController::class, 'approveDriver']);

    // Passenger marks ride completed
    Route::post('/ride/{ride}/complete', [PassengerRideController::class, 'completeRide']);
});

/*
|--------------------------------------------------------------------------
| Driver APIs
|--------------------------------------------------------------------------
*/

Route::prefix('driver')->group(function () {

    // Update driver current location
    Route::post('/location', [DriverController::class, 'updateLocation']);

    // Fetch nearby pending rides
    Route::get('/rides/nearby', [DriverController::class, 'nearbyRides']);

    // Driver requests / claims a ride
    Route::post('/ride/{ride}/request', [DriverController::class, 'requestRide']);

    // Driver marks ride completed
    Route::post('/ride/{ride}/complete', [DriverController::class, 'completeRide']);
});
