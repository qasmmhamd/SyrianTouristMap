<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
   public function handle(Request $request, Closure $next)
{
    // تحقق أن المستخدم مسجل دخول
    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // تحقق من الدور
    if (Auth::user()->role !== 'superadmin') {
        return response()->json(['message' => 'Access denied: not superadmin'], 403);
    }

    return $next($request);
}

}
