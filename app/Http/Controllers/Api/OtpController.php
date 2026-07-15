<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OtpController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'mobile'  => 'required|string|min:10|max:15',
            'purpose' => 'in:registration,login,reset',
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpVerification::updateOrCreate(
            ['mobile' => $request->mobile, 'purpose' => $request->purpose ?? 'registration'],
            ['otp' => $otp, 'is_used' => false, 'expires_at' => Carbon::now()->addMinutes(5)]
        );

        // TODO: Replace this log with a real SMS gateway call
        // e.g., SSL Wireless: POST https://...
        \Log::info("OTP for {$request->mobile}: $otp");

        // For development, return the OTP directly (REMOVE in production)
        $devResponse = config('app.env') !== 'production' ? ['dev_otp' => $otp] : [];

        return response()->json(array_merge(['success' => true, 'message' => 'OTP sent'], $devResponse));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile'  => 'required|string',
            'otp'     => 'required|string|size:6',
            'purpose' => 'in:registration,login,reset',
        ]);

        $record = OtpVerification::where('mobile', $request->mobile)
            ->where('purpose', $request->purpose ?? 'registration')
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$record || $record->otp !== $request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP'], 422);
        }

        $record->update(['is_used' => true]);

        return response()->json(['success' => true, 'message' => 'OTP verified']);
    }
}
