<?php

namespace App\Http\Controllers\API;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
     public function index(Request $request)
    {
        // اللغة المطلوبة، افتراضيًا 'ar'
        $locale = $request->get('lang', 'ar');

        // جلب كل الأماكن مع ترجمتها والمنطقة التابعة لها
        $places = Place::with(['region', 'translations' => function($q) use ($locale) {
            $q->where('locale', $locale);
        }])->get();

        // إعادة البيانات بصيغة JSON
        return response()->json($places);
    }

}
