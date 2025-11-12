<?php
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SuperadminController;
use App\Http\Controllers\Api\TasksSuperadminController;
use App\Models\SuperAdmin;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/region',[AuthController::class,"index"]);
Route::get('/places', [PlaceController::class, 'index']);

Route::prefix('api')->group(function () { 
    Route::post('/user/register', [UserController::class, 'register']); 
    Route::post('/user/login', [UserController::class, 'login']);
       Route::middleware('auth:sanctum')->group(function () { 
    Route::get('/user', [UserController::class, 'user']);
    Route::post('/user/logout', [UserController::class, 'logout']); 
       });
    

     Route::post('/superadmin/register',[SuperadminController::class,'register']);
     Route::post('/superadmin/login',[SuperadminController::class,'login']);
      Route::middleware('auth:sanctum')->group(function () {
        Route::post('/superadmin/logout',[SuperadminController::class,'logout']);
      });
    });
//TasksSuperadmin
//Route::post('/deleteplace',[TasksSuperadminController::class,'deleteplace']);
//Route::post('/updateplace',[TasksSuperadminController::class,'updateplace']);
//Route::post('/deleteuser',[TasksSuperadminController::class,'deleteuser']);
//Route::post('/deletecomment',[TasksSuperadminController::class,'deletecomment']);
//Route::post('/createadmin',[TasksSuperadminController::class,'createadmin']);

