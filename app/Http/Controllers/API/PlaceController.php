<?php

namespace App\Http\Controllers\API;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends Controller
{public function index(Request $request)
{
    // ✅ تحديد اللغة (افتراضي ar)
    $locale = $request->query('lang', 'ar');

    // ✅ جلب رقم المحافظة إن وجد
    $regionId = $request->query('region_id');

    // ✅ بناء الاستعلام مع العلاقات
    $query = Place::with([
        'region',
        'translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }
    ]);

    // ✅ فلترة حسب المحافظة إذا تم إرسالها
    if ($regionId) {
        $query->where('region_id', $regionId);
    }

    // ✅ جلب البيانات
    $places = $query->get();

    // ✅ تنسيق النتيجة النهائية مثل ما طلبت
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

    // ✅ إرسال الاستجابة بنفس التنسيق المطلوب
    return response()->json([
        'success' => true,
        'count'   => $data->count(),
        'data'    => $data
    ], 200, [], JSON_UNESCAPED_UNICODE);
}
}
  /*public function index(Request $request)
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
/*namespace App\Http\Controllers\API;
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

}*/
