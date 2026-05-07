<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\CartController; // Add this import
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use NotificationTrait;
    public function login(Request $request, CartController $cartController) // Inject CartController
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        
        $credentials = [
            $login_type => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        // Check if user is active
        if ($user->status !== 'active') {
            Auth::logout();
            return response()->json([
                'message' => 'Your account is ' . $user->status . '. Please contact support.'
            ], 403);
        }

        // Merge guest cart items
        $guestSessionId = $request->header('X-Session-ID') ?: $request->session_id;
        if ($guestSessionId) {
            $cartController->mergeGuestCart($user->id, $guestSessionId);
        }

        // delete old tokens
        $user->tokens()->delete();

        $token = $user->createToken('flutter')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($user)
        ]);
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'nullable|string|in:user,driver,owner,corporate,solo',
            'company_name' => 'nullable|string|max:255',
            'vehicle_type' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $role = $request->input('role', 'solo');

        $user = User::create([
            'company_name' => $request->company_name,
            'vehicle_type' => $request->vehicle_type,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $role,
            'status'       => ($role === 'solo' || $role === 'user') ? 'active' : 'pending',
        ]);

        // Create API token (Sanctum)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ]
        ], 201);
    }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name'     => 'required|string|max:255',
    //         'email'    => 'required|email|unique:users,email',
    //         'mobile'   => 'required|string|unique:users,mobile',
    //         'password' => 'required|string|min:8',
    //         'role'     => 'nullable|string|in:user,driver,owner,corporate,solo',
    //     ]);

    //     $role = $request->input('role', 'solo');

    //     $user = User::create([
    //         'name'       => $request->name,
    //         'email'      => $request->email,
    //         'mobile'     => $request->mobile,
    //         'password'   => bcrypt($request->password),
    //         'role'       => $role,
    //         'status'     => ($role === 'solo' || $role === 'user') ? 'active' : 'pending',
    //         'ip_address' => $request->ip(),
    //         'is_approve' => ($role === 'solo' || $role === 'user') ? 1 : 0
    //     ]);

    //     // Notification for admin
    //     $this->createNotification(
    //         'New User Registration',
    //         $user->name.' registered as '.$role.' from IP '.$request->ip(),
    //         null,
    //         $request->ip(),
    //         'register'
    //     );

    //     $token = $user->createToken('flutter')->plainTextToken;

    //     return response()->json([
    //         'token' => $token,
    //         'user' => new UserResource($user)
    //     ], 201);
    // }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => trans($response)], 200);
        }

        return response()->json(['message' => trans($response)], 400);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return response()->json(['message' => trans($response)], 200);
        }

        return response()->json(['message' => trans($response)], 400);
    }
}
