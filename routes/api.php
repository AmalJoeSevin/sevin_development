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

//Route::apiResource('drivers', DriverController::class);

//Route::middleware('auth:sanctum')->group(function () {
//    Route::apiResource('drivers', DriverController::class);
//});

Route::get('drivers-explain', [DriverController::class,'explainTest']);

Route::prefix('drivers')->group(function () {

    Route::get('/', [DriverController::class, 'index']);        // List all drivers
    Route::post('/', [DriverController::class, 'store']);       // Create driver
    Route::get('/{id}', [DriverController::class, 'show']);     // Single driver
    Route::put('/{id}', [DriverController::class, 'update']);   // Update driver
    Route::delete('/{id}', [DriverController::class, 'destroy']); // Delete driver

});