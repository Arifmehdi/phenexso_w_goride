<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(Request $request)
    {
        $guard = $request->query('guard', 'web');
        return view('goride.auth.passwords.email', compact('guard'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'guard' => 'required|string|in:web,admin,driver,corporate'
        ]);

        $guard = $request->guard;
        $email = $request->email;

        // Verify if user exists in the specific guard's table
        $provider = config("auth.guards.$guard.provider");
        $model = config("auth.providers.$provider.model");
        $user = $model::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => "We can't find a user with that email address in the $guard section."]);
        }

        // Create token
        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Send Email (You can use Laravel's Notification or Mailable)
        // For simplicity, we use Mail::send here
        $resetLink = route('password.reset', ['token' => $token, 'email' => $email, 'guard' => $guard]);

        Mail::send('goride.auth.passwords.reset_email_template', ['link' => $resetLink, 'user' => $user], function($message) use($email) {
            $message->to($email);
            $message->subject('Reset Password Notification - GoRide');
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }
}
