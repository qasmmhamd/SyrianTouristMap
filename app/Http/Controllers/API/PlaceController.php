<?php

namespace App\Http\Controllers\API;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
      {
          $locale = $request->query('lang', 'ar');
          $regionId = $request->query('region_id');
      
          $query = Place::with([
               'region',
               'translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
                }
           ]);
    

           if ($regionId) {
                 $query->where('region_id', $regionId);
           }

             $places = $query->get();
             $data = $places->map(function ($place) {
             return [
                'id' => $place->id,
                'type' => $place->type,
                'google_map_url' => $place->google_map_url,
                'region' => $place->region,
                'name' => $place->translations->first()->name ?? null,
                'description' => $place->translations->first()->description ?? null,
                'location' => $place->translations->first()->location ?? null,
                'created_at' => $place->created_at,
                'updated_at' => $place->updated_at,
             ];
            });
            return response()->json([
                'success' => true,
                'count'   => $data->count(),
                'data'    => $data
             ], 200, [], JSON_UNESCAPED_UNICODE);
      }
    public function getplaces()
     {
    $places = Place::with('translations')->get();

         return response()->json([
        'places' => $places
        ]);
     }

}
  
