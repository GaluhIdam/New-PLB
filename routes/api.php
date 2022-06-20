<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomsController;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\MutationPeriodicController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\ActivityHistoryController;
use App\Http\Controllers\HoardingTimeController;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routing User 
Route::apiResource('user', UserController::class);

// Dokumen Kepabeanan
Route::get('/customs/inbound-document', [CustomsController::class, 'inboundDocument']);
Route::get('/customs/outbound-document', [CustomsController::class, 'outboundDocument']);

// Outbound
Route::get('/outbound/transaction-1', [OutboundController::class, 'outbound1']);
Route::get('/outbound/transaction-2', [OutboundController::class, 'outbound2']);
Route::get('/outbound/transaction-3', [OutboundController::class, 'outbound3']);
Route::get('/outbound/summary', [OutboundController::class, 'summary']);

// Aircraft Mutation (Mutasi Pesawat)
Route::get('/aircraft', [AircraftController::class, 'index']);
Route::post('/aircraft/delivery', [AircraftController::class, 'delivery']);
Route::post('/aircraft/redelivery', [AircraftController::class, 'redelivery']);
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']);
Route::get('/aircraft/data', [AircraftController::class, 'data']);

// Log -> Login History
Route::get('/login-history', [LoginHistoryController::class, 'index']);
Route::get('/login-history/{id}', [LoginHistoryController::class, 'index']);

//Log - > Activity History
Route::get('/activity-history', [ActivityHistoryController::class, 'index']);

// Mutasi - > (Report Mutasi)
Route::get('/mutation', [MutationController::class, 'index']);

// Mutasi -> Periodic Mutations (Report Mutasi Berkala)
Route::get('/mutation-periodic', [MutationPeriodicController::class, 'index']);
Route::delete('/mutation-periodic/{id}', [MutationPeriodicController::class, 'destroy']);

// Masa Timbun (Hoarding Time)
Route::get('/hoarding-time', [HoardingTimeController::class, 'index']);
