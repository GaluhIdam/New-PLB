<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Traits\ActivityHistoryTrait;
use App\Http\Controllers\CustomsController;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;
<<<<<<< HEAD
=======
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\MutationPeriodicController;
>>>>>>> 3faa9dbe2c7e15a4c652f3e8e63e6f2fed6457e1
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\ActivityHistoryController;

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

<<<<<<< HEAD

=======
// Dokumen Kepabeanan
>>>>>>> 3faa9dbe2c7e15a4c652f3e8e63e6f2fed6457e1
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

<<<<<<< HEAD
//Activity History
Route::get('/activity-history', [ActivityHistoryController::class, 'index']);
Route::post('/activity-history', [ActivityHistoryTrait::class, 'recordActivity']);
=======
// Mutations
Route::get('/mutation', [MutationController::class, 'index']);

// Periodic Mutations
Route::get('/mutation-periodic', [MutationPeriodicController::class, 'index']);
Route::delete('/mutation-periodic/{id}', [MutationPeriodicController::class, 'destroy']);
>>>>>>> 3faa9dbe2c7e15a4c652f3e8e63e6f2fed6457e1
