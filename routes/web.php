<?php
use App\Http\Controllers\API\PlaceController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TasksSuperadminController;
use App\Models\SuperAdmin;

Route::get('/', function () {
    return view('welcome');
});


