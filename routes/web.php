<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/events', [HomeController::class, 'index']);

Route::post('/add_event', [AdminController::class, 'add_event']);

Route::get('/create_event', [AdminController::class, 'create_event']);

Route::get('/show_event', [AdminController::class, 'show_event']);

Route::get('/delete_event/{id}', [AdminController::class, 'delete_event']);

Route::get('/event_details/{id}', [HomeController::class, 'event_details']);

Route::post('/addreservation/{id}',[HomeController::class,'addreservation']);

Route::get('/show_reservation',[AdminController::class,'show_reservation']);

Route::get('/graph', [ChartController::class, 'user_chart']);