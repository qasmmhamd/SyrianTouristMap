<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Place;
use App\Models\PlaceTranslation;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TasksSuperadminController extends Controller
{
    // ✅ إضافة مكان جديد مع ترجمتين عربي + إنجليزي
    public function storeplace(Request $request)
    {
        $ViewData = $request->validate([
            "name_ar" => "required|string|max:255",
            "description_ar" => "required|string",
            "location_ar" => "required|string",

            "name_en" => "required|string|max:255",
            "description_en" => "required|string",
            "location_en" => "required|string",

            "region_id" => "required|integer|exists:regions,id",
            "type" => "required|in:historical,entertainment,service",
            "google_map_url" => "required|string",
            "image_url" => "required|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        // ✅ رفع الصورة
        $imagePath = $request->file('image_url')->store('images', 'public');

        // ✅ إنشاء المكان
        $place = Place::create([
            'region_id' => $ViewData['region_id'],
            'type' => $ViewData['type'],
            'google_map_url' => $ViewData['google_map_url'],
            'image_url' => $imagePath,
        ]);

        // ✅ الترجمة العربية
        PlaceTranslation::create([
            'place_id' => $place->id,
            'locale' => 'ar',
            'name' => $ViewData['name_ar'],
            'description' => $ViewData['description_ar'],
            'location' => $ViewData['location_ar'],
        ]);

        // ✅ الترجمة الإنجليزية
        PlaceTranslation::create([
            'place_id' => $place->id,
            'locale' => 'en',
            'name' => $ViewData['name_en'],
            'description' => $ViewData['description_en'],
            'location' => $ViewData['location_en'],
        ]);

        return response()->json([
            "message" => "Place created successfully with translations",
            "place" => $place
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    // ✅ تحديث مكان + ترجمته
    public function updateplace(Request $request, $id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(["message" => "Place not found"], 404);
        }

        $ViewData = $request->validate([
            "name_ar" => "required|string|max:255",
            "description_ar" => "required|string",
            "location_ar" => "required|string",

            "name_en" => "required|string|max:255",
            "description_en" => "required|string",
            "location_en" => "required|string",

            "region_id" => "required|integer|exists:regions,id",
            "type" => "required|in:historical,entertainment,service",
            "google_map_url" => "required|string",
            "image_url" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        // ✅ تحديث الصورة إن وُجدت
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('images', 'public');
            $place->image_url = $imagePath;
        }

        // ✅ تحديث جدول places
        $place->update([
            'region_id' => $ViewData['region_id'],
            'type' => $ViewData['type'],
            'google_map_url' => $ViewData['google_map_url'],
        ]);

        // ✅ تحديث الترجمة العربية
        PlaceTranslation::updateOrCreate(
            ['place_id' => $place->id, 'locale' => 'ar'],
            [
                'name' => $ViewData['name_ar'],
                'description' => $ViewData['description_ar'],
                'location' => $ViewData['location_ar'],
            ]
        );

        // ✅ تحديث الترجمة الإنجليزية
        PlaceTranslation::updateOrCreate(
            ['place_id' => $place->id, 'locale' => 'en'],
            [
                'name' => $ViewData['name_en'],
                'description' => $ViewData['description_en'],
                'location' => $ViewData['location_en'],
            ]
        );

        return response()->json([
            "message" => "Place updated successfully",
            "place" => $place
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    // ✅ حذف مكان
    public function deleteplace($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(["message" => "Place not found"], 404);
        }

        $place->delete();

        return response()->json(["message" => "Place deleted successfully"]);
    }

    // ✅ حذف مستخدم
    public function deleteuser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }

        $user->delete();

        return response()->json(["message" => "User deleted successfully"]);
    }

    // ✅ حذف تعليق
    public function deletecomment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(["message" => "Comment not found"], 404);
        }

        $comment->delete();

        return response()->json(["message" => "Comment deleted successfully"]);
    }

    // ✅ إنشاء أدمن
    public function createadmin(Request $request)
    {
        $ViewData = $request->validate([
            'username' => 'required|string|max:255',
            'super_admin_id' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'username' => $ViewData['username'],
            'super_admin_id' => $ViewData['super_admin_id'],
            'password' => Hash::make($ViewData['password']),
        ]);

        return response()->json([
            "message" => "Admin created successfully",
            "data" => $admin,
        ], 201);
    }
}

/*
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Middleware\regions;
use App\Models\Admin;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;


class TasksSuperadminController extends Controller
{
   public function storeplace(Request $request){
      $ViewData = $request->validate([
          "name" => "required|string|max:255",
          "description" => "required|nullable|string",
          "location"=>"required|nullable|string",
          "region_id"=>"required|integer",
          "type"=>"required|string",
          "google_map_url"=>"required|string",
          "image_url"=>"required|image|mimes:jpg,jpeg,png|max:2048",

      ]);
          $imagePath = $request->file('image_url')->store('images', 'public');
            $place=Place::create([  
               'name' => $ViewData['name'],
               'description' => $ViewData['description'] ?? null,
               'location' => $ViewData['location'] ?? null,
               'region_id' => $ViewData['region_id'],
               'type' => $ViewData['type'],
               'google_map_url' => $ViewData['google_map_url'],
               'image_url' => $imagePath, 
            ]);
            return response()->json([
                "message"=>"Place created successfully",
                "place"=>$place
            ],201);
   }
        public function deleteplace($id){
            $place=Place::find($id);
            if(!$place){
                  return response()->json([
                     "message"=>"Place not found"
                  ],404);}
                  $place->delete();
                  return response()->json([
                     "message"=>"Place deleted successfully"
                  ]);
            }
            public function updateplace(Request $request,$id){
               $place=Place::find($id);
               if(!$place){
                  return response()->json([
                     "message"=>"Place not found"
                  ],404);}
                  $ViewData = $request->validate([
                     "name" => "required|string|max:255",
                     "description" => "required|nullable|string",
                     "location"=>"required|nullable|string",
                     "region_id"=>"required|integer",
                     "type"=>"required|string",
                     "google_map_url"=>"required|string",
                     "image_url"=>"required|image|mimes:jpg,jpeg,png|max:2048",
         
                 ]);
                 $imagePath = $request->file('image_url')->store('images', 'public');

                 $place->update([  
               'name' => $ViewData['name'],
               'description' => $ViewData['description'] ?? null,
               'location' => $ViewData['location'] ?? null,
               'region_id' => $ViewData['region_id'],
               'type' => $ViewData['type'],
               'google_map_url' => $ViewData['google_map_url'],
               'image_url' => $imagePath, 
            ]);
                 return response()->json([
                  "message"=>"Place updated successfully",
                  "place"=>$place
                 ]);
            }
            public function deleteuser($id){
               $user=User::find($id);
               if(!$user){
                  return response()->json([
                     "message"=>"User not found"
                  ],404);}
                  $user->delete();
                  return response()->json([
                     "message"=>"User deleted successfully"
                  ]);
            }
            public function deletecomment($id){
               $comment=Comment::find($id);
               if(!$comment){
                  return response()->json([
                     "message"=>"comment not found"
                  ]);
               }
               $comment->delete();
               return response()->json([
                  "message"=>"comment deleted succssfully"
               ]);
            }
           public function createadmin(Request $request){
                 $ViewData = $request->validate([
                      'username' => 'required|string|max:255',
                      'super_admin_id' => 'required|integer',
                      'password' => 'required|string|min:8|confirmed',
                     ]);

                   $admin = Admin::create([
                     'username' => $ViewData['username'],
                     'super_admin_id' => $ViewData['super_admin_id'],
                     'password' => Hash::make($ViewData['password']),
                    ]);

                  return response()->json([
                     "message" => "Admin created successfully",
                     "data" => $admin,
                  ], 201);
              }
              
}*/
