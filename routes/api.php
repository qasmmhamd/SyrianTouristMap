<?php

use App\Http\Controllers\API\TasksSuperadminController;
use Illuminate\Support\Facades\Route;

//TasksSuperadmin
Route::post('/storeplace',[TasksSuperadminController::class,'storeplace']);
Route::post('/deleteplace/{id}',[TasksSuperadminController::class,'deleteplace']);
Route::post('/updateplace/{id}',[TasksSuperadminController::class,'updateplace']);
Route::post('/deleteuser/{id}',[TasksSuperadminController::class,'deleteuser']);
Route::post('/deletecomment/{id}',[TasksSuperadminController::class,'deletecomment']);
Route::post('/createadmin',[TasksSuperadminController::class,'createadmin']);
