<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\API\LevelController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('usersrole', [LevelController::class, 'index']);


// Routing Controller AirCraft Mutation
Route::get('/aircraft', [AircraftController::class, 'index']); //Cek Data
// Route::get('/aircraft/{id}', [AircraftController::class, 'show']); //Tampil Data
Route::post('/delivery', [AircraftController::class, 'storeDelivery']); //Simpan Data
Route::post('/redelivery', [AircraftController::class, 'storeRedelivery']); //Simpan Data
// Route::put('/aircraft/{id}', [AircraftController::class, 'update']); //Update Data
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']); //Menghapus Data
// Route::resource('/aircraft', AircraftController::class)->except(['create', 'edit']);