<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class SimpleTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak ditemukan'
            ], 401);
        }

        try {
            // Decode token (format: base64(user_id:email:timestamp))
            $decoded = base64_decode($token);
            list($userId, $email) = explode(':', $decoded);

            // Cari user
            $user = User::find($userId);
            if (!$user || $user->email !== $email) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token tidak valid'
                ], 401);
            }

            // Set user ke request
            auth()->login($user);
            return $next($request);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak valid'
            ], 401);
        }
    }
} 