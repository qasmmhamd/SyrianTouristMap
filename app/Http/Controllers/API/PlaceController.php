<?php

namespace App\Http\Controllers\API;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
  public function index(Request $request)
    {
        $regionId = $request->query('region_id');
        $query = Place::query()->with('region');
        if ($regionId) {
            $query->where('region_id', $regionId);
        }
        $places = $query->get();
        return response()->json([
            'success' => true,
            'count' => $places->count(),
            'data' => $places
        ], 200, [], JSON_UNESCAPED_UNICODE); 
    }

}
