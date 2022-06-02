<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routing User 
Route::apiResource('user', UserController::class);
Route::delete('/user/{id}', [UserController::class, 'destroy']); //Menghapus Data




// Routing Controller AirCraft Mutation
Route::get('/aircraft', [AircraftController::class, 'index']); //Cek Data
// Route::get('/aircraft/{id}', [AircraftController::class, 'show']); //Tampil Data
Route::post('/delivery', [AircraftController::class, 'storeDelivery']); //Simpan Data
Route::post('/redelivery', [AircraftController::class, 'storeRedelivery']); //Simpan Data
// Route::put('/aircraft/{id}', [AircraftController::class, 'update']); //Update Data
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']); //Menghapus Data
// Route::resource('/aircraft', AircraftController::class)->except(['<creat></creat>e', 'edit']);
Route::get('/aircraft/data', [AircraftController::class, 'data']);
