<?php

use App\Http\Controllers\Api\DriverController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API Working Successfully'
    ]);
});

Route::get('/driver', [DriverController::class, 'index']);
Route::post('/drivers', [DriverController::class, 'store']);