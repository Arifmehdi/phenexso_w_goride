<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Driver;
use App\Models\RideRequest;
use App\Models\User;
use App\Models\Wallet;

class ReferralController extends Controller
{
    /** Loyalty tiers, unlocked by points. Shared by app + admin. */
    public const TIERS = [
        ['name' => 'Bronze',   'min' => 0],
        ['name' => 'Silver',   'min' => 500],
        ['name' => 'Gold',     'min' => 2000],
        ['name' => 'Platinum', 'min' => 5000],
    ];

    /** ৳ of fare that earns 1 point (admin-settable, default ৳10 = 1 point). */
    public static function takaPerPoint(): float
    {
        $v = (float) AppSetting::getValue('taka_per_point', 10);
        return $v > 0 ? $v : 10.0;
    }

    /** Referral bonus paid to the referrer (admin-settable). */
    public static function referralBonus(): float
    {
        return (float) AppSetting::getValue('referral_bonus', 50);
    }

    /** Welcome bonus paid to the NEW user who used a code (admin-settable). */
    public static function refereeBonus(): float
    {
        return (float) AppSetting::getValue('referee_bonus', 50);
    }

    /** Resolves {tier, next} for a points total. */
    public static function tierFor(int $points): array
    {
        $tier = 'Bronze';
        $next = null;
        foreach (self::TIERS as $i => $t) {
            if ($points >= $t['min']) {
                $tier = $t['name'];
                $next = self::TIERS[$i + 1] ?? null;
            }
        }
        return ['tier' => $tier, 'next' => $next];
    }

    /**
     * GET /api/rewards — loyalty points + tier + referral stats for the app's
     * "Rewards & Invite" screen. Role-aware:
     *   • rider  — points from fares they PAID on completed rides
     *   • driver — points from fares they EARNED on completed rides
     * Both roles can refer and see their own code/stats.
     */
    public function rewards()
    {
        $user = auth()->user();

        // GoRide has FOUR auth guards (users / drivers / corporates / admins),
        // each its own table with its own id space. Never branch on id alone —
        // resolve the audience from the model itself, or a corporate with id 5
        // would be served rider #5's rides.
        $audience = notificationAudience($user);

        $ridesQuery = match ($audience) {
            'driver'    => RideRequest::where('driver_id', $user->id),
            'corporate' => RideRequest::where('corporate_id', $user->id),
            'user'      => RideRequest::where('user_id', $user->id),
            // Admins ride nothing — force an empty set rather than leaking.
            default     => RideRequest::whereRaw('1 = 0'),
        };

        $totalFare  = (float) (clone $ridesQuery)->where('status', 'completed')->sum('fare');
        $totalRides = (int) (clone $ridesQuery)->where('status', 'completed')->count();

        $perPoint = self::takaPerPoint();
        $points   = (int) floor($totalFare / $perPoint);

        $resolved = self::tierFor($points);
        $next     = $resolved['next'];

        // Referral stats — only riders and drivers own referral codes
        // (corporates/admins have no referral columns, so this stays null and
        // the app simply hides the invite section).
        $referralCode  = $user->referral_code ?? null;
        $referredCount = 0;
        $referralEarned = 0.0;
        if ($referralCode && in_array($audience, ['user', 'driver'], true)) {
            // Count everyone this person invited, across BOTH tables, matched
            // on the referrer's type so ids from another guard can't collide.
            $referredCount = User::where('referred_by', $user->id)
                    ->where('referred_by_type', $audience)->count()
                + Driver::where('referred_by', $user->id)
                    ->where('referred_by_type', $audience)->count();

            $credited = User::where('referred_by', $user->id)
                    ->where('referred_by_type', $audience)
                    ->where('referral_credited', true)->count()
                + Driver::where('referred_by', $user->id)
                    ->where('referred_by_type', $audience)
                    ->where('referral_credited', true)->count();

            $referralEarned = $credited * self::referralBonus();
        }

        return response()->json([
            'success'          => true,
            'role'             => $audience === 'user' ? 'rider' : $audience,
            'points'           => $points,
            'points_rate'      => $perPoint,   // ৳ per 1 point, so the app can explain it
            'tier'             => $resolved['tier'],
            'next_tier'        => $next['name'] ?? null,
            'next_tier_points' => $next['min'] ?? null,
            'total_rides'      => $totalRides,
            'total_fare'       => $totalFare,
            'referral_code'    => $referralCode,
            'referral_link'    => $referralCode ? url('/register?ref=' . $referralCode) : null,
            'referral_bonus'   => self::referralBonus(),
            'total_referred'   => $referredCount,
            'referral_earned'  => $referralEarned,
        ]);
    }

    /**
     * GET /api/referrals — the current user's referral code, link, and the
     * list of people they invited. Works for riders and drivers alike.
     */
    public function stats()
    {
        $user = auth()->user();
        // Same four-guard rule as rewards(): resolve the audience from the
        // model, never from the id alone.
        $audience = notificationAudience($user);

        if (empty($user->referral_code) || !in_array($audience, ['user', 'driver'], true)) {
            return response()->json([
                'success' => true,
                'referral_code' => null,
                'total_referred' => 0,
                'total_earned' => 0,
                'referred_users' => [],
            ]);
        }

        // People invited by this person live in EITHER table — match on the
        // referrer's type so ids from another guard can't collide.
        $cols = ['id', 'name', 'created_at', 'referral_credited'];
        $referred = User::where('referred_by', $user->id)
            ->where('referred_by_type', $audience)->get($cols)
            ->concat(
                Driver::where('referred_by', $user->id)
                    ->where('referred_by_type', $audience)->get($cols)
            )
            ->sortByDesc('created_at')
            ->values();

        $wallet = Wallet::where('user_id', $user->id)->where('owner_type', $audience)->first();
        $totalEarned = $referred->where('referral_credited', true)->count() * self::referralBonus();

        return response()->json([
            'success'        => true,
            'referral_code'  => $user->referral_code,
            'referral_link'  => url('/register?ref=' . $user->referral_code),
            'referral_bonus' => self::referralBonus(),
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
