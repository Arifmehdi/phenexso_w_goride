<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;

class ReferralController extends Controller
{
    /**
     * GET /api/referrals — the current user's referral code, link, and stats.
     */
    public function stats()
    {
        $user = auth()->user();

        if (!($user instanceof User) || empty($user->referral_code)) {
            return response()->json([
                'success' => true,
                'referral_code' => null,
                'total_referred' => 0,
                'total_earned' => 0,
                'referred_users' => [],
            ]);
        }

        $referred = User::where('referred_by', $user->id)
            ->select('id', 'name', 'created_at', 'referral_credited')
            ->orderByDesc('created_at')
            ->get();

        $wallet = Wallet::where('user_id', $user->id)->where('owner_type', 'user')->first();
        $totalEarned = $referred->where('referral_credited', true)->count() * 50;

        return response()->json([
            'success'        => true,
            'referral_code'  => $user->referral_code,
            'referral_link'  => url('/register?ref=' . $user->referral_code),
            'total_referred' => $referred->count(),
            'total_earned'   => (float) $totalEarned,
            'wallet_balance' => (float) ($wallet->balance ?? 0),
            'referred_users' => $referred->map(fn ($u) => [
                'name' => $u->name,
                'joined_at' => $u->created_at,
                'bonus_credited' => (bool) $u->referral_credited,
            ]),
        ]);
    }
}
