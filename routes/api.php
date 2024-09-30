<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users/login', [HomeController::class, 'login']);
Route::post('/users/reset', [HomeController::class, 'sendPasswordResetLink']);
Route::post('/users/check-email', [HomeController::class, 'checkEmailAvailability']);
Route::apiResource('users', HomeController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('reservation', ReservationController::class);
Route::get('/images/{imageName}', [EventController::class, 'getImageByName']);


