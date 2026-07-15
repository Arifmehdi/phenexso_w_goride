<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\User;
use App\Models\Wallet;

class ReferralController extends Controller
{
    /**
     * GET /api/rewards — loyalty points + tier + referral stats, combined
     * for the app's "Rewards & Invite" screen. Points are earned from
     * completed rides (1 point per ৳10 of fare); tiers unlock by points.
     */
    public function rewards()
    {
        $user = auth()->user();

        $totalFare = (float) RideRequest::where('user_id', $user->id)
            ->where('status', 'completed')->sum('fare');
        $totalRides = RideRequest::where('user_id', $user->id)
            ->where('status', 'completed')->count();
        $points = (int) floor($totalFare / 10);

        $tiers = [
            ['name' => 'Bronze', 'min' => 0],
            ['name' => 'Silver', 'min' => 500],
            ['name' => 'Gold',   'min' => 2000],
            ['name' => 'Platinum', 'min' => 5000],
        ];
        $tier = 'Bronze';
        $next = null;
        foreach ($tiers as $i => $t) {
            if ($points >= $t['min']) {
                $tier = $t['name'];
                $next = $tiers[$i + 1] ?? null;
            }
        }

        // Referral stats (users table only — drivers don't refer riders).
        $referralCode = ($user instanceof User) ? $user->referral_code : null;
        $referredCount = 0;
        $referralEarned = 0.0;
        if ($referralCode) {
            $referred = User::where('referred_by', $user->id)->get(['id', 'referral_credited']);
            $referredCount = $referred->count();
            $referralEarned = $referred->where('referral_credited', true)->count() * 50.0;
        }

        return response()->json([
            'success'          => true,
            'points'           => $points,
            'tier'             => $tier,
            'next_tier'        => $next['name'] ?? null,
            'next_tier_points' => $next['min'] ?? null,
            'total_rides'      => $totalRides,
            'referral_code'    => $referralCode,
            'referral_link'    => $referralCode ? url('/register?ref=' . $referralCode) : null,
            'total_referred'   => $referredCount,
            'referral_earned'  => $referralEarned,
        ]);
    }

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
