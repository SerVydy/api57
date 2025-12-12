<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');





Route::get('/', function() {
        return 'Hello World';
    });


Route::get('/countries/{country}', [CountryController::class, 'show'])
    ->missing(function () {
        return response()->json([
            'message' => 'not found'
        ],404);
    });
Route::put('/countries/{country}', [CountryController::class, 'update']);
Route::delete('/countries/{country}', [CountryController::class, 'destroy'])
    ->missing(function () {
        return response()->json([
            'message' => 'not found'
        ],404);
    });
Route::get('/countries', [CountryController::class, 'index']);
Route::post('/countries', [CountryController::class, 'store']);



Route::apiResource('/cars', CarController::class);

Route::fallback(function() {
    return 'Not found';
});


