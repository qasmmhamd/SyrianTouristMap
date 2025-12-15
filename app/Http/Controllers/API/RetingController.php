<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
class RetingController extends Controller
{
    public function storReting(Request $request)
{
    $request->validate([
        'value' => 'required|integer|min:1|max:5',
        'place_id' => 'required|exists:places,id',
    ]);

    $rating = Rating::create([
        'value' => $request->value,
        'user_id' => $request->user()->id,
        'place_id' => $request->place_id,
    ]);

    return response()->json([
        'message' => 'تم إضافة التقييم بنجاح',
        'data' => $rating
    ], 201);
}
 

           public function getRatings(Request $request)
            {
               $placeId = $request->query('place_id');

    $ratings = Rating::with('user:id,name')
        ->where('place_id', $placeId)
        ->get();

    $averageRating = Rating::where('place_id', $placeId)->avg('value');

    return response()->json([
        'message' => 'تم إحضار التقييمات بنجاح',
        'average_rating' => round($averageRating, 2),
        'count' => $ratings->count(),
        'data' => $ratings
    ]);
}

}
