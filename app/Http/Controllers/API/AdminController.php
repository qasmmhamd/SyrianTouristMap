<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
     public function login(Request $request)
    {
        $request->validate([
            'username ' => 'required|max:255',
            'password' => 'required|string',
        ]);

        $Admin = Admin::where('email', $request->email)->first();

        if (! $Admin || ! Admin::check($request->password, $Admin->password)) {
            throw ValidationException::withMessages([
                'username ' => ['بيانات تسجيل الدخول غير صحيحة.'],
            ]);
        }

        $token = $Admin->createToken('api_token')->plainTextToken;

        return response()->json([
            'Admin'  => $Admin,
            'token' => $token,
        ])->cookie(
            'token',
            $token,
            60*24*7,
            '/',
            null,
            false,
            true
        );
    }
     public function Admin(Request $request)
    {
        return response()->json($request->Admin());
    }
    public function getadmin(Request $request)
    {
        $Admin=Admin::all();
        return response()->json([
            'admin' => $Admin
        ]);
    }
}
