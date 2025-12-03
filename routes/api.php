<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuperadminController;
use App\Http\Controllers\Api\TasksSuperadminController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlaceController;


/* ------------------ Public Routes ------------------ */
Route::get('/region', [AuthController ::class, "index"]);
Route::get('/places', [PlaceController::class, 'index']);

// User Auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Super Admin Auth
Route::post('/superadmin/register', [SuperadminController::class,'register']);
Route::post('/superadmin/login', [SuperadminController::class,'login']);



/* ------------------ Protected User Routes ------------------ */
Route::middleware('auth:sanctum')->group(function () {

    // User Info & Logout
    Route::get('/user', [UserController::class,'user']);
    Route::post('/logout', [UserController::class,'logout']);

    // Super admin Info & logout
    Route::get('/superadmin', [UserController::class,'superadmin']);
    Route::post('/superadmin/logout',[SuperadminController::class,'logout']);
});



/* ------------------ Super Admin Control Panel ------------------ */
Route::middleware(['auth:sanctum', 'SuperAdmin'])->group(function () {

    Route::post('/storeplace', [TasksSuperadminController::class,'storeplace']);
    Route::delete('/deleteplace/{id}', [TasksSuperadminController::class,'deleteplace']);
    Route::post('/updateplace/{id}', [TasksSuperadminController::class,'updateplace']);
    Route::delete('/deleteuser/{id}', [TasksSuperadminController::class,'deleteuser']);
    Route::delete('/deletecomment/{id}', [TasksSuperadminController::class,'deletecomment']);
    Route::post('/createadmin', [TasksSuperadminController::class,'createadmin']);
});
