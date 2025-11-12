<?php

namespace App\Http\Controllers\Api;

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
          "latitude"=>"required|numeric",
          "longitude"=>"required|numeric",
          "google_map_url"=>"required|string",
          "imegs_url"=>"required|image|mimes:jpg,jpeg,png|max:2048",

      ]);
          $imagePath = $request->file('imegs_url')->store('images', 'public');
            $place=Place::create([  
               'name' => $ViewData['name'],
               'description' => $ViewData['description'] ?? null,
               'location' => $ViewData['location'] ?? null,
               'region_id' => $ViewData['region_id'],
               'type' => $ViewData['type'],
               'latitude' => $ViewData['latitude'],
               'longitude' => $ViewData['longitude'],
               'google_map_url' => $ViewData['google_map_url'],
               'imegs_url' => $imagePath, 
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
                     "latitude"=>"required|numeric",
                     "longitude"=>"required|numeric",
                     "google_map_url"=>"required|string",
                     "imegs_url"=>"required|string",
         
                 ]);
                 $place->update($ViewData);
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
}
