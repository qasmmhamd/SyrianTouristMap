<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuperadminController;
use App\Http\Controllers\API\TasksSuperadminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PlaceController;




   Route::get('/region',[AuthController::class,"index"]);
   Route::get('/places', [PlaceController::class, 'index']);
//User
  Route::post('/register', [UserController::class, 'register']); 
  Route::post('/login', [UserController::class, 'login']);  
       Route::middleware('auth:sanctum')->group(function () { 
           Route::get('/user', [UserController::class, 'user']);
            Route::post('/logout', [UserController::class, 'logout']); 
       });
    
//Superadmin
  Route::post('/superadmin/register',[SuperadminController::class,'register']);
  Route::post('/superadmin/login',[SuperadminController::class,'login']);
      Route::middleware('auth:sanctum')->group(function () {
        Route::post('/superadmin/logout',[SuperadminController::class,'logout']);
      });
      //TasksSuperadmin
  Route::middleware(['auth:sanctum', 'SuperAdmin'])->group(function () {
    Route::post('/storeplace',[TasksSuperadminController::class,'storeplace']);
    Route::delete('/deleteplace/{id}',[TasksSuperadminController::class,'deleteplace']);
    Route::post('/updateplace/{id}',[TasksSuperadminController::class,'updateplace']);
    Route::post('/deleteuser/{id}',[TasksSuperadminController::class,'deleteuser']);
    Route::post('/deletecomment/{id}',[TasksSuperadminController::class,'deletecomment']);
    Route::post('/createadmin',[TasksSuperadminController::class,'createadmin']);
  });
