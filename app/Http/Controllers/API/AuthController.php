<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // الحصول على اللغة المطلوبة من الطلب، الافتراضية "ar"
        $locale = $request->get('lang', 'ar');

        // جلب كل المحافظات مع الترجمة المطلوبة
        $regions = Region::with(['translations' => function($q) use ($locale) {
            $q->where('locale', $locale);
        }])->get();

        // إعادة الاستجابة بشكل يحتوي على مفتاح "data" كما يتوقع الفرونتند
        return response()->json([
            'data' => $regions
        ]);
    }
}
