<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\TestingController;
use App\Http\Controllers\HoardingTimeController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\MutationReportController;
use App\Http\Controllers\ActivityHistoryController;
use App\Http\Controllers\MutationPeriodicController;
use App\Http\Controllers\MovementAllotmentController;
use App\Http\Controllers\API\Costums\InboundController;
// Fix API
use App\Http\Controllers\API\Costums\OutboundController;
use App\Http\Controllers\OutboundController as Outbound;
use App\Http\Controllers\API\Allotment\InventoryController;
use App\Http\Controllers\API\Reports\OutboundOneController;
use App\Http\Controllers\API\Reports\OutboundTwoController;
use App\Http\Controllers\API\Reports\OutboundThreeController;

// API For Testing 
Route::get('/testing', [TestingController::class, 'index']); // TODO: Will be deleted

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
Route::get('/customs/inbound', [InboundController::class, 'index']);
Route::get('/customs/outbound', [OutboundController::class, 'index']);

// Outbound
Route::get('/outbound-transaction-1', [OutboundOneController::class, 'OutboundOne']);
Route::get('/outbound-transaction-2', [OutboundTwoController::class, 'OutboundTwo']);
Route::get('/outbound-transaction-3', [OutboundThreeController::class, 'OutboundThree']);
Route::get('/outbound/summary', [Outbound::class, 'summary']);

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
Route::get('/mutation-report', [MutationReportController::class, 'index']);

// Mutasi -> Periodic Mutations (Report Mutasi Berkala)
Route::get('/mutation-periodic', [MutationPeriodicController::class, 'index']);
Route::post('/mutation-periodic-report', [MutationPeriodicController::class, 'searchDate']);

// Masa Timbun (Hoarding Time)
Route::get('/hoarding-time', [HoardingTimeController::class, 'index']);

// Allotment
Route::get('inventory-allotment', [InventoryController::class, 'inventoryAllotment']);
Route::get('movement-allotment', [MovementAllotmentController::class, 'index']);

//Dashboard
Route::get('dashboard/one', [DashboardController::class, 'dashboardSatu']);
Route::get('dashboard/two', [DashboardController::class, 'dashboardDua']);
Route::get('dashboard/three', [DashboardController::class, 'dashboardTiga']);
Route::get('dashboard/four', [DashboardController::class, 'dashboardEmpat']);
Route::get('dashboard/five', [DashboardController::class, 'dashboardLima']);