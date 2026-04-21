<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        if (Auth::check()) {
            return new UserResource($request->user());
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // You would add your login, register, and logout methods here.
    // For example, a simple logout:
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Or 'api' depending on your guard configuration

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
