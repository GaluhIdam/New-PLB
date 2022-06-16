<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomsController;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\ActivityHistoryController;
use App\Http\Traits\ActivityHistoryTrait;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routing User 
Route::apiResource('user', UserController::class);
Route::get('profile', [UserController::class, 'profile']);
Route::put('profile', [UserController::class, 'updateProfile']);


Route::get('/customs/inbound-document', [CustomsController::class, 'inboundDocument']);
Route::get('/customs/outbound-document', [CustomsController::class, 'outboundDocument']);

Route::get('/outbound/transaction-1', [OutboundController::class, 'outbound1']);
Route::get('/outbound/transaction-2', [OutboundController::class, 'outbound2']);
Route::get('/outbound/transaction-3', [OutboundController::class, 'outbound3']);
Route::get('/outbound/summary', [OutboundController::class, 'summary']);

Route::get('/aircraft', [AircraftController::class, 'index']);
Route::post('/aircraft/delivery', [AircraftController::class, 'delivery']);
Route::post('/aircraft/redelivery', [AircraftController::class, 'redelivery']);
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']);
Route::get('/aircraft/data', [AircraftController::class, 'data']);

//Login History
Route::get('/login-history', [LoginHistoryController::class, 'index']);
Route::get('/login-history/{id}', [LoginHistoryController::class, 'index']);

//Activity History
Route::get('/activity-history', [ActivityHistoryController::class, 'index']);
