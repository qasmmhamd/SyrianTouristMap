<?php
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/region',[AuthController::class,"index"]);
Route::get('/places', [PlaceController::class, 'index']);
