<?php

namespace App\Http\Controllers\Api;

use App\Models\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;


class SuperadminController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $superadmin = SuperAdmin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $superadmin->createToken('api-token')->plainTextToken;

        return response()->json([
            'superadmin'  => $superadmin,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }
   public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $superadmin = SuperAdmin::where('email', $request->email)->first();

        if (! $superadmin || ! Hash::check($request->password, $superadmin->password)) {
            throw ValidationException::withMessages([
                'email' => ['بيانات تسجيل الدخول غير صحيحة.'],
            ]);
        }

        $token = $superadmin->createToken('api_token')->plainTextToken;

        return response()->json([
            'superadmin'  => $superadmin,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'تم تسجيل الخروج بنجاح.']);
    }
}
