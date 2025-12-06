<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuperadminController;
use App\Http\Controllers\Api\TasksSuperadminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlaceController;


/* ------------------ Public Routes ------------------ */
Route::get('/region', [AuthController ::class, "index"]);
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/getplaces', [PlaceController::class,'getplaces']);

// User Auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Super Admin Auth
Route::post('/superadmin/register', [SuperadminController::class,'register']);
Route::post('/superadmin/login', [SuperadminController::class,'login']);

// Admin Auth
Route::post('/admin/login', [AdminController::class,'login']);

/* ------------------ Protected User Routes ------------------ */
Route::middleware('auth:sanctum')->group(function () {

    //Admin
    Route::get('/admin', [AdminController::class,'Admin']);
    Route::get('/getadmin', [AdminController::class,'getadmin']);


    // User Info & Logout
    Route::get('/user', [UserController::class,'user']);
    Route::post('/logout', [UserController::class,'logout']);
    Route::get('/getusers', [UserController::class,'getusers']);

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
    Route::delete('/deleteadmin/{id}', [TasksSuperadminController::class,'deleteadmin']);
    Route::post('/createadmin', [TasksSuperadminController::class,'createadmin']);
});
