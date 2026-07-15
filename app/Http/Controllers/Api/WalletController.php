<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Resolve (and create if missing) the wallet for the currently
     * authenticated entity — scoped by BOTH id and owner_type so a
     * User #3 and a Driver #3 never share a wallet.
     */
    private function wallet(): Wallet
    {
        $user = auth()->user();
        $ownerType = notificationAudience($user);

        return Wallet::firstOrCreate(
            ['user_id' => $user->id, 'owner_type' => $ownerType],
            ['balance' => 0]
        );
    }

    public function balance()
    {
        $wallet = $this->wallet();
        $balance = (float) $wallet->balance;
        // decimal:2 casts serialize as strings — force a real JSON number.
        return response()->json([
            'success' => true,
            'balance' => $balance,
            // PayLater context for the app: how much credit is available and
            // any outstanding due (negative balance shown positively).
            'pay_later_limit' => (float) \App\Models\AppSetting::getValue('pay_later_limit', 0),
            'due' => $balance < 0 ? -$balance : 0,
        ]);
    }

    public function transactions()
    {
        $user = auth()->user();
        $ownerType = notificationAudience($user);

        $txns = WalletTransaction::where('user_id', $user->id)
            ->where('owner_type', $ownerType)
            ->orderByDesc('created_at')
            ->paginate(20);

        // Force decimal fields to real JSON numbers (not strings) for every row.
        $txns->getCollection()->transform(function ($t) {
            $t->amount = (float) $t->amount;
            $t->balance_after = (float) $t->balance_after;
            return $t;
        });

        return response()->json(['success' => true, 'transactions' => $txns]);
    }

    public function topUp(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:10|max:50000']);

        $user = auth()->user();
        $ownerType = notificationAudience($user);

        DB::transaction(function () use ($request, $user, $ownerType) {
            $wallet = $this->wallet();
            $wallet->increment('balance', $request->amount);
            WalletTransaction::create([
                'user_id'       => $user->id,
                'owner_type'    => $ownerType,
                'type'          => 'credit',
                'amount'        => $request->amount,
                'description'   => 'Wallet top-up',
                'reference'     => $request->reference ?? null,
                'balance_after' => $wallet->fresh()->balance,
            ]);
        });

        return response()->json(['success' => true, 'balance' => (float) $this->wallet()->balance]);
    }

    public function payForRide(Request $request, $rideId)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);

        $user = auth()->user();
        $ownerType = notificationAudience($user);
        $wallet = $this->wallet();

        // PayLater: riders may ride now and settle later — the wallet can go
        // negative down to the admin-set limit (0 = feature off). The due is
        // recovered automatically by their next top-up.
        $payLaterLimit = (float) \App\Models\AppSetting::getValue('pay_later_limit', 0);
        if (($wallet->balance - $request->amount) < -$payLaterLimit) {
            return response()->json([
                'success' => false,
                'message' => $payLaterLimit > 0
                    ? "Insufficient balance — PayLater limit is ৳{$payLaterLimit}."
                    : 'Insufficient wallet balance',
            ], 422);
        }

        DB::transaction(function () use ($request, $rideId, $wallet, $user, $ownerType) {
            $wallet->decrement('balance', $request->amount);
            WalletTransaction::create([
                'user_id'       => $user->id,
                'owner_type'    => $ownerType,
                'type'          => 'debit',
                'amount'        => $request->amount,
                'description'   => "Ride payment #$rideId",
                'reference'     => "ride_$rideId",
                'balance_after' => $wallet->fresh()->balance,
            ]);
            RideRequest::where('id', $rideId)->update([
                'payment_status' => 'paid',
                'payment_method' => 'wallet',
            ]);
        });

        // Pay the driver their share now that the ride is paid.
        static::settleDriverEarnings(RideRequest::find($rideId));

        return response()->json(['success' => true, 'balance' => (float) $this->wallet()->balance]);
    }

    /**
     * Credit a driver's wallet after a completed cash/online ride
     * (called internally by ride-completion logic, not a public route).
     */
    public static function creditDriverEarnings($driver, float $amount, string $description, ?string $reference = null): void
    {
        static::creditWallet($driver->id, 'driver', $amount, $description, $reference);
    }

    /**
     * Settle a PAID ride: credit the assigned driver their earnings
     * (fare minus the platform commission). Idempotent — safe to call from
     * every payment path (cash, wallet, card); it credits at most once per
     * ride, guarded by a unique transaction reference.
     */
    public static function settleDriverEarnings(?RideRequest $ride): void
    {
        if (!$ride || $ride->payment_status !== 'paid' || empty($ride->driver_id)) {
            return;
        }

        try {
            $reference = "ride_earning_{$ride->id}";
            if (WalletTransaction::where('reference', $reference)->exists()) {
                return; // already settled
            }

            $gross = (float) ($ride->actual_fare ?? $ride->fare);
            if ($gross <= 0) {
                return;
            }

            // Commission is admin-configurable (website_parameters.commission_rate,
            // stored as a percent). Fall back to the config default if unset.
            $commissionPercent = \App\Models\WebsiteParameter::query()->value('commission_rate');
            $commissionRate = $commissionPercent !== null
                ? ((float) $commissionPercent / 100)
                : (float) config('services.goride.commission_rate', 0.15);

            $earnings = round($gross * (1 - $commissionRate), 2);

            static::creditWallet($ride->driver_id, 'driver', $earnings,
                "Ride earnings #{$ride->id}", $reference);

            // In-app notification so the earning shows in the driver's bell list.
            \App\Models\Notification::create([
                'user_id'        => $ride->driver_id,
                'recipient_type' => 'driver',
                'title'          => '💰 Ride Earnings',
                'message'        => "You earned ৳{$earnings} from ride #{$ride->id}.",
                'type'           => 'earnings',
                'data'           => ['ride_request_id' => $ride->id],
                'all_show'       => false,
            ]);
        } catch (\Throwable $e) {
            // Never let a wallet-credit failure break the payment flow. Most
            // likely cause if this fires: the drop-FK migration hasn't been run
            // on this server yet (see 2026_07_12_000002).
            \Illuminate\Support\Facades\Log::error(
                "settleDriverEarnings failed for ride {$ride->id}: " . $e->getMessage()
            );
        }
    }

    /**
     * Generic wallet credit for any owner type ('user'|'driver'|'corporate'|'admin').
     * Used by payouts, referral bonuses, and refunds.
     */
    public static function creditWallet(int $ownerId, string $ownerType, float $amount, string $description, ?string $reference = null): void
    {
        DB::transaction(function () use ($ownerId, $ownerType, $amount, $description, $reference) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $ownerId, 'owner_type' => $ownerType],
                ['balance' => 0]
            );
            $wallet->increment('balance', $amount);
            WalletTransaction::create([
                'user_id'       => $ownerId,
                'owner_type'    => $ownerType,
                'type'          => 'credit',
                'amount'        => $amount,
                'description'   => $description,
                'reference'     => $reference,
                'balance_after' => $wallet->fresh()->balance,
            ]);
        });
    }
}
