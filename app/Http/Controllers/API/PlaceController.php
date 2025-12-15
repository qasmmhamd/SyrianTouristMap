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
                'image_url'=>$place->image_url,
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
      public function search(Request $request)
      {
            $keyword = $request->query('keyword');
            $locale  = $request->query('locale', 'ar');
            $type    = $request->query('type'); 
            $places = Place::query()
                ->when($type, function ($q) use ($type) {
                $q->where('type', $type);
            })

                ->whereHas('translations', function ($q) use ($keyword, $locale) {
                $q->where('locale', $locale)
                ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%");
             });
             })

                ->with(['translations' => function ($q) use ($locale) {
              $q->where('locale', $locale);
             }])->get();

            return response()->json([
               'data' => $places
            ]);
  
      }

}
  
