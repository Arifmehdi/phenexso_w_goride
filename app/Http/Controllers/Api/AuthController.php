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

        $user = null;
        $activeGuard = null;

        if ($request->role) {
            // Admin credentials always sign in as admin, whatever tab was
            // picked — so an admin reaches the admin dashboard without needing
            // a dedicated Admin tab. (Passenger/rider/corporate credentials are
            // not in the admins table, so they're unaffected.)
            if (Auth::guard('admin')->attempt($credentials)) {
                $user = Auth::guard('admin')->user();
                $activeGuard = 'admin';
            }

            // Otherwise use the guard for the selected tab.
            $requestedGuard = $request->role === 'user' ? 'web' : $request->role;
            if (!$user && Auth::guard($requestedGuard)->attempt($credentials)) {
                $user = Auth::guard($requestedGuard)->user();
                $activeGuard = $requestedGuard;
            }
            
            // If not found and it's a mobile login, try with formatted mobile
            if (!$user && $login_type === 'mobile') {
                $formattedMobile = bdMobile($login_value);
                if ($formattedMobile !== $login_value) {
                    $formattedCredentials = [
                        'mobile' => $formattedMobile,
                        'password' => $request->input('password'),
                    ];
                    if (Auth::guard($requestedGuard)->attempt($formattedCredentials)) {
                        $user = Auth::guard($requestedGuard)->user();
                        $activeGuard = $requestedGuard;
                    }
                }
            }
        } else {
            // No role specified: try all guards (backward compatibility)
            $guards = ['web', 'admin', 'driver', 'corporate'];
            
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->attempt($credentials)) {
                    $user = Auth::guard($guard)->user();
                    $activeGuard = $guard;
                    break;
                }
            }

            // If it fails and it's a mobile login, try with formatted mobile
            if (!$user && $login_type === 'mobile') {
                $formattedMobile = bdMobile($login_value);
                if ($formattedMobile !== $login_value) {
                    $formattedCredentials = [
                        'mobile' => $formattedMobile,
                        'password' => $request->input('password'),
                    ];
                    foreach ($guards as $guard) {
                        if (Auth::guard($guard)->attempt($formattedCredentials)) {
                            $user = Auth::guard($guard)->user();
                            $activeGuard = $guard;
                            break;
                        }
                    }
                }
            }
        }

        if (!$user) {
            // Role-specific message so the user knows which login they failed.
            $roleLabels = [
                'user'      => 'passenger',
                'driver'    => 'rider',
                'corporate' => 'corporate',
                'admin'     => 'admin',
            ];
            $label = $roleLabels[$request->role] ?? null;
            $message = $label
                ? "As a {$label}, your email or password is invalid."
                : 'Invalid email or password.';

            return response()->json([
                'success' => false,
                'message' => $message,
            ], 401);
        }

        // Determine approval status
        $status = $user->status ?? null;
        $isApprove = $user->is_approve ?? null;
        $isActive = true;

        if ($status !== null) {
            if (in_array($status, ['pending', 0, '0', 'suspended', 'rejected'])) {
                $isActive = false;
            }
        }

        if ($isActive && $isApprove !== null) {
            if ($isApprove == 0 || $isApprove === false) {
                $isActive = false;
            }
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
            'success'      => true,
            'token'        => $token,
            'user'         => $user,
            'role'         => $role,
            'guard'        => $activeGuard,
            'is_approved'  => $isActive,
        ]);
    }



    public function register(Request $request)
    {
        // Admin kill-switch — System Settings > "Registration Open"
        // (stored on website_parameters, same place the admin app saves it).
        try {
            $wp = \App\Models\WebsiteParameter::first();
            if ($wp && isset($wp->registration_open) && !(bool) $wp->registration_open) {
                return response()->json([
                    'success' => false,
                    'message' => 'New registrations are temporarily closed. Please try again later.',
                ], 403);
            }
        } catch (\Throwable $e) {
            // Settings unavailable — never block registration because of it.
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'mobile'       => 'required|string',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'nullable|string|in:user,driver,owner,corporate,solo',
            'company_name' => 'nullable|string|max:255',
            'vehicle_type' => 'nullable|string|max:255',
            'referral_code' => 'nullable|string|max:12',
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
            // The users.role column is an enum ('admin','corporate','owner',
            // 'driver','solo') with NO 'user'. The Passenger tab sends 'user',
            // so store it as the equivalent 'solo' to avoid a truncation error.
            $userData['role'] = ($role === 'user') ? 'solo' : $role;
            $userData['company_name'] = $request->company_name;
            $userData['vehicle_type'] = $request->vehicle_type;
            // Referral support: every new user gets their own code; if they
            // signed up with someone's code, record who referred them.
            $userData['referral_code'] = $this->generateReferralCode();
            if ($request->filled('referral_code')) {
                $referrer = User::where('referral_code', strtoupper($request->referral_code))->first();
                if ($referrer) {
                    $userData['referred_by'] = $referrer->id;
                }
            }
            $user = User::create($userData);
        }

        $isPending = false;
        if ($user->status === 'pending' || $user->status === 0 || $user->status === '0') {
            $isPending = true;
        }

        if ($isPending) {
            // Issue a token so the pending driver can complete their verification
            // profile (NID, license, photos) while waiting for admin approval.
            $token = $user->createToken('flutter')->plainTextToken;
            return response()->json([
                'success'     => true,
                'message'     => 'Registration successful! Complete your verification, then wait for admin approval.',
                'token'       => $token,
                'user'        => $user,
                'role'        => $role,
                'is_approved' => false,
                'pending'     => true,
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

    /** Unique short referral code, e.g. GR3F9A2C. */
    private function generateReferralCode(): string
    {
        do {
            $code = 'GR' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
        } while (User::where('referral_code', $code)->exists());
        return $code;
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

        // Build the email link from the domain this request came in on, so the
        // same codebase works on any domain (includes subfolder installs).
        \App\Notifications\ApiResetPasswordNotification::$resetBaseUrl = $request->root();

        $response = Password::broker('users')->sendResetLink(
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
