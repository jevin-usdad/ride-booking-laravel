<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RideController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    Route::get('/rides', [RideController::class, 'index']);
    Route::get('/rides/{ride}', [RideController::class, 'show']);
});
