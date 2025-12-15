<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {       

        $locale = $request->get('lang', 'ar');

        $regions = Region::with(['translations' => function($q) use ($locale) {
            $q->where('locale', $locale);
        }])->get();

        return response()->json([
            'data' => $regions
        ]);
    }
}
