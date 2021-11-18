<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TyresServiceController;
use App\Http\Middleware\ApiMiddleware;

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
Route::group(['middleware' => '\App\Http\Middleware\ApiMiddleware'], function () {
    Route::post('/tyres-service', [TyresServiceController::class, 'store']);
    Route::get('/tyres-service', [TyresServiceController::class, 'index']);
    Route::delete('/tyres-service/{id}', [TyresServiceController::class, 'destroy']);
    Route::get('/tyres-service/{id}', [TyresServiceController::class, 'show']);
    Route::get('/tyres-service-busy', [TyresServiceController::class, 'show_busy']);
});

Route::get('/tyres-service-free', [TyresServiceController::class, 'show_free']);
Route::patch('/tyres-service/{id}', [TyresServiceController::class, 'update']);
Route::patch('/tyres-service-cancel-visit', [TyresServiceController::class, 'cancel']);
Route::patch('/tyres-service-first-free', [TyresServiceController::class, 'bookFirst']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
