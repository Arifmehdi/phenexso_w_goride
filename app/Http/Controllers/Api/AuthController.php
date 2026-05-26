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
            'role'     => 'nullable|string|in:user,admin,driver,corporate'
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $login_value = $request->input('login');
        
        $credentials = [
            $login_type => $login_value,
            'password' => $request->input('password'),
        ];

        $guards = ['web', 'admin', 'driver', 'corporate'];
        if ($request->role) {
            $requestedGuard = $request->role === 'user' ? 'web' : $request->role;
            // Move requested guard to the front of the array to prioritize it
            $guards = array_unique(array_merge([$requestedGuard], $guards));
        }

        $user = null;
        $activeGuard = null;

        // 1. Try attempting login with provided credentials across relevant guards
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($credentials)) {
                $user = Auth::guard($guard)->user();
                $activeGuard = $guard;
                break;
            }
        }

        // 2. If it fails and it's a mobile login, try with formatted mobile
        if (!$user && $login_type === 'mobile') {
            $formattedMobile = bdMobile($login_value);
            if ($formattedMobile !== $login_value) {
                $credentials['mobile'] = $formattedMobile;
                foreach ($guards as $guard) {
                    if (Auth::guard($guard)->attempt($credentials)) {
                        $user = Auth::guard($guard)->user();
                        $activeGuard = $guard;
                        break;
                    }
                }
            }
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if user is active/approved
        $status = $user->status ?? null;
        $isApprove = $user->is_approve ?? null;
        $isActive = true;

        if ($status !== null) {
            // Handle both string ('active', 'approved') and integer (1) status
            // Non-active: 'pending', 0, '0', 'suspended', 'rejected'
            if (in_array($status, ['pending', 0, '0', 'suspended', 'rejected'])) {
                $isActive = false;
            }
        }

        // Also check is_approve if it exists (some models use this)
        if ($isActive && $isApprove !== null) {
            if ($isApprove == 0 || $isApprove === false) {
                $isActive = false;
            }
        }

        if (!$isActive) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is pending approval or inactive. Please contact support.'
            ], 403);
        }

        // Merge guest cart items only for web users
        if ($activeGuard === 'web') {
            $guestSessionId = $request->header('X-Session-ID') ?: $request->session_id;
            if ($guestSessionId) {
                $cartController->mergeGuestCart($user->id, $guestSessionId);
            }
        }

        // Delete old tokens to ensure single session if desired, or just create new one
        $user->tokens()->delete();

        $token = $user->createToken('flutter')->plainTextToken;

        // Determine the role for the response
        $role = $activeGuard === 'web' ? 'user' : $activeGuard;

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => $user,
            'role'    => $role,
            'guard'   => $activeGuard
        ]);
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'mobile'       => 'required|string',
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
        
        // Customers (solo/user) are active by default, others are pending
        $isCustomer = ($role === 'solo' || $role === 'user');
        $status = $isCustomer ? 'active' : 'pending';

        $userData = [
            'name'         => $request->name,
            'email'        => $request->email,
            'mobile'       => $request->mobile,
            'password'     => Hash::make($request->password),
            'status'       => $status,
        ];

        if ($role === 'driver') {
            if (\App\Models\Driver::where('email', $request->email)->exists()) {
                return response()->json(['success' => false, 'message' => 'Driver with this email already exists'], 400);
            }
            $userData['status'] = 0; // Drivers use tinyInteger status
            $user = \App\Models\Driver::create($userData);
        } elseif ($role === 'corporate') {
            if (\App\Models\Corporate::where('email', $request->email)->exists()) {
                return response()->json(['success' => false, 'message' => 'Corporate user with this email already exists'], 400);
            }
            $userData['company_name'] = $request->company_name;
            $user = \App\Models\Corporate::create($userData);
        } else {
            if (\App\Models\User::where('email', $request->email)->exists()) {
                return response()->json(['success' => false, 'message' => 'User with this email already exists'], 400);
            }
            $userData['role'] = $role;
            $userData['company_name'] = $request->company_name;
            $userData['vehicle_type'] = $request->vehicle_type;
            $user = User::create($userData);
        }

        $isPending = false;
        if ($user->status === 'pending' || $user->status === 0 || $user->status === '0') {
            $isPending = true;
        }

        if ($isPending) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Your account is pending approval. You will be able to login once approved.',
                'user'    => $user,
                'pending' => true
            ], 201);
        }

        // Create API token (Sanctum) for active users
        $token = $user->createToken('flutter')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'token'   => $token,
            'user'    => $user,
            'role'    => $role
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

    public function me(Request $request)
    {
        $user = $request->user();
        
        // Determine role based on the model class or role attribute
        $role = 'user';
        if ($user instanceof \App\Models\Admin) {
            $role = 'admin';
        } elseif ($user instanceof \App\Models\Driver) {
            $role = 'driver';
        } elseif ($user instanceof \App\Models\Corporate) {
            $role = 'corporate';
        } elseif (isset($user->role)) {
            $role = $user->role;
        }

        return response()->json([
            'success' => true,
            'user'    => $user,
            'role'    => $role
        ]);
    }

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
