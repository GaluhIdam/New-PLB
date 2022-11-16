<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoardingTimeController;
use App\Http\Controllers\MutationReportController;
use App\Http\Controllers\MutationPeriodicController;
use App\Http\Controllers\MovementAllotmentController;

// Authenticated Controller
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
// Login History & Activity Log Controller 
use App\Http\Controllers\ActivityHistoryController;
use App\Http\Controllers\LoginHistoryController;
// Dashboard Controller
use App\Http\Controllers\API\DashboardController;
// Module Aircraft Controller
use App\Http\Controllers\API\Aircraft\AircraftController;
// Dokumen Kepabeanan Controller 
use App\Http\Controllers\API\Costums\InboundController;
use App\Http\Controllers\API\Costums\OutboundController;
use App\Http\Controllers\API\Allotment\InventoryController;
// Outbound Controller
use App\Http\Controllers\API\Outbound\OutboundOneController;
use App\Http\Controllers\API\Outbound\OutboundSummaryController;
use App\Http\Controllers\API\Outbound\OutboundTwoController;
use App\Http\Controllers\API\Outbound\OutboundThreeController;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Routing User
Route::get('user/export', [UserController::class, 'export']);
Route::apiResource('user', UserController::class);

// Dokumen Kepabeanan
Route::get('/customs/inbound', [InboundController::class, 'index']); // Dokumen Kepabeanan Pemasukan (Inbound)
Route::get('/customs/inbound-csv', [InboundController::class, 'exportCsv']); // Dokumen Kepabeanan Pemasukan (Inbound) - Export CSV
Route::get('/customs/inbound-excel', [InboundController::class, 'exportExcel']); // Dokumen Kepabeanan Pemasukan (Inbound) - Export Excel
Route::get('/customs/outbound', [OutboundController::class, 'index']); // Dokumen Kepabeanan Pengeluaran (Outbound)
Route::get('/customs/outbound-csv', [OutboundController::class, 'exportCsv']); // Dokumen Kepabeanan Pengeluaran (Outbound) - Outbound - Export CSV
Route::get('/customs/outbound-excel', [OutboundController::class, 'exportExcel']); // Dokumen Kepabeanan Pengeluaran (Outbound) - Outbound - Export Excel

// Outbound Transaction
Route::get('/outbound-transaction-1', [OutboundOneController::class, 'index']); // Outbound Transaction 1
Route::get('/outbound-transaction-1-csv', [OutboundOneController::class, 'exportCsv']); // Outbound Transaction 1 - Export CSV
Route::get('/outbound-transaction-1-excel', [OutboundOneController::class, 'exportExcel']); // Outbound Transaction 1 - Export Excel
Route::get('/outbound-transaction-2', [OutboundTwoController::class, 'index']); // Outbound Transaction 2
Route::get('/outbound-transaction-2-csv', [OutboundTwoController::class, 'exportCsv']); // Outbound Transaction 2 - Export CSV
Route::get('/outbound-transaction-2-excel', [OutboundTwoController::class, 'exportExcel']); // Outbound Transaction 2 - Export Excel
Route::get('/outbound-transaction-3', [OutboundThreeController::class, 'index']); // Outbound Transaction 3
Route::get('/outbound-transaction-3-csv', [OutboundThreeController::class, 'exportCsv']); // Outbound Transaction 3 - Export CSV
Route::get('/outbound-transaction-3-excel', [OutboundThreeController::class, 'exportExcel']); // Outbound Transaction 3 - Export Excel
// Outbound Summary // TODO : Will be Development soon
Route::get('/outbound-summary', [OutboundSummaryController::class, 'index']); // Outbound Summary
Route::get('/outbound-summary-csv', [OutboundSummaryController::class, 'exportCsv']); // Outbound Summary - Export CSV
Route::get('/outbound-summary-excel', [OutboundSummaryController::class, 'exportExcel']); // Outbound Summary - Export Excel


// Aircraft Mutation (Mutasi Pesawat)
Route::get('/aircraft-mutation', [AircraftController::class, 'index']); // Aircraft Mutation
Route::get('/aircraft-mutation-csv', [AircraftController::class, 'exportCsv']); // Aircraft Mutation - Export CSV
Route::get('/aircraft-mutation-excel', [AircraftController::class, 'exportExcel']); // Aircraft Mutation - Export Excel
Route::get('/aircraft-data', [AircraftController::class, 'store']); // Aircraft Data
Route::post('/aircraft-delivery', [AircraftController::class, 'createDelivery']); // Aircraft Delivery
Route::post('/aircraft-redelivery', [AircraftController::class, 'createRedelivery']); // Aircraft Redivery
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']); //Delete Aircraft Data

// Login History & Activity History
Route::get('/login-history', [LoginHistoryController::class, 'index']);
Route::get('/login-history/{id}', [LoginHistoryController::class, 'index']);
Route::get('/activity-history', [ActivityHistoryController::class, 'index']);

// Dashboard
Route::get('dashboard-one', [DashboardController::class, 'chartOne']);
Route::get('dashboard-two', [DashboardController::class, 'chartTwo']);
Route::get('dashboard-three', [DashboardController::class, 'chartThree']);

// Mutasi - > (Report Mutasi) // TODO : Will be Development soon
Route::get('/mutation-report', [MutationReportController::class, 'index']);

// Mutasi -> Periodic Mutations (Report Mutasi Berkala) // TODO : Will be Development soon
Route::get('/mutation-periodic', [MutationPeriodicController::class, 'index']);
Route::post('/mutation-periodic-report', [MutationPeriodicController::class, 'searchDate']);

// Masa Timbun (Hoarding Time) // TODO : Will be Development soon
Route::get('/hoarding-time', [HoardingTimeController::class, 'index']);

// Allotment // TODO : Will be Development soon
Route::get('inventory-allotment', [InventoryController::class, 'inventoryAllotment']);
Route::get('movement-allotment', [MovementAllotmentController::class, 'index']);