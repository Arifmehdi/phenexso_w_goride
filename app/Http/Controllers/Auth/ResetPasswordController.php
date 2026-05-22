<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('goride.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'guard' => $request->guard]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'guard' => 'required|string|in:web,admin,driver,corporate'
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid token or email!']);
        }

        $guard = $request->guard;
        $provider = config("auth.guards.$guard.provider");
        $model = config("auth.providers.$provider.model");
        
        $user = $model::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'User not found!']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully! Please login with your new password.');
    }
}
