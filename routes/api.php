<?php

use App\Http\Controllers\TrajetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/trajets', [TrajetController::class, 'index']);
Route::get('/trajets/{id}', [TrajetController::class, 'show']);
Route::get('/trajets/search/{name}', [TrajetController::class, 'search']);

Route::post('/trajets', [TrajetController::class, 'store']);


Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::get('/cars/search/{marque}', [CarController::class, 'search']);

Route::post('/cars', [CarController::class, 'store']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::put('/trajets/{id}', [TrajetController::class, 'update']);
    Route::delete('/trajets/{id}', [TrajetController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});