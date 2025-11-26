<?php 



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserController extends Controller
{
    // register user
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create token for the user
        $token = $user->createToken('api-token')->plainTextToken;

        return response()
            ->json([
                'message' => 'تم التسجيل بنجاح',
                'user' => $user
            ], 201)
            ->cookie(
                'token',           // cockie name
                $token,            // token value
                60 * 24 * 7,       // duration (7 days)
                '/',               // path
                null,              
                false,              // secure (شغّلها إذا عندك https)
                true               // httpOnly
            );
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['بيانات تسجيل الدخول غير صحيحة.'],
            ]);
        }

        // إنشاء توكن
        $token = $user->createToken('api-token')->plainTextToken;

        return response()
            ->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'user' => $user,
                 'token' => $token,
            'token_type' => 'Bearer',
            ]);
           // ->cookie(
           //     'token',
           //   $token,
           //     60 * 24 * 7,
           //     '/',
           //     null,
          //      false,
            //    true
          //  );
    }

    // جلب المستخدم الحالي
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        // حذف التوكن من السيرفر
        $request->user()->currentAccessToken()->delete();

        // حذف الكوكي من المتصفح
        return response()
            ->json(['message' => 'تم تسجيل الخروج بنجاح']);
            //->cookie('token', null, -1);
    }
}




















// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\ValidationException;
// use App\Models\User;

// class UserController extends Controller
// {
//     // 🔹 تسجيل مستخدم جديد
//     public function register(Request $request)
//     {
//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|string|min:8|confirmed',
//         ]);

//         $user = User::create([
//             'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//         ]);

//         // إنشاء توكن للمستخدم
//         $token = $user->createToken('api-token')->plainTextToken;

//         return response()->json([
//             'user'  => $user,
//             'token' => $token,
//             'token_type' => 'Bearer',
//         ], 201);
//     }

//     // 🔹 تسجيل الدخول
//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|string',
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (! $user || ! Hash::check($request->password, $user->password)) {
//             throw ValidationException::withMessages([
//                 'email' => ['بيانات تسجيل الدخول غير صحيحة.'],
//             ]);
//         }

//                 $token = $user->createToken('api_token')->plainTextToken;

//         return response()->json([
//             'user'  => $user,
//             'token' => $token,
//             'token_type' => 'Bearer',
//         ]);
//     }

//     // 🔹 عرض المستخدم الحالي
//     public function user(Request $request)
//     {
//         return response()->json($request->user());
//     }

//     // 🔹 تسجيل الخروج
//     public function logout(Request $request)
//     {
//         $request->user()->currentAccessToken()->delete();

//         return response()->json(['message' => 'تم تسجيل الخروج بنجاح.']);
//     }
// }
