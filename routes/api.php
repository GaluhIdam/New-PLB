<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\UserController;

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


// Routing Controller AirCraft Mutation
Route::get('/aircraft', [AircraftController::class, 'index']); //Cek Data
// Route::get('/aircraft/{id}', [AircraftController::class, 'show']); //Tampil Data
Route::post('/delivery', [AircraftController::class, 'storeDelivery']); //Simpan Data
Route::post('/redelivery', [AircraftController::class, 'storeRedelivery']); //Simpan Data
// Route::put('/aircraft/{id}', [AircraftController::class, 'update']); //Update Data
Route::delete('/aircraft/{id}', [AircraftController::class, 'destroy']); //Menghapus Data
// Route::resource('/aircraft', AircraftController::class)->except(['<creat></creat>e', 'edit']);
Route::get('/aircraft/data', [AircraftController::class, 'data']);
