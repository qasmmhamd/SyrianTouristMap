<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        $redion=Region::all();
        return response()->json([
            "data"=>$redion,
            "error"=>""
        ]);
    }
}
