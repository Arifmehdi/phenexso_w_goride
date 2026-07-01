<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        // decimal:2 casts serialize as strings — force a real JSON number.
        return response()->json(['success' => true, 'balance' => (float) $wallet->balance]);
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

        if ($wallet->balance < $request->amount) {
            return response()->json(['success' => false, 'message' => 'Insufficient wallet balance'], 422);
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
        });

        return response()->json(['success' => true, 'balance' => (float) $this->wallet()->balance]);
    }

    /**
     * Credit a driver's wallet after a completed cash/online ride
     * (called internally by ride-completion logic, not a public route).
     */
    public static function creditDriverEarnings($driver, float $amount, string $description, ?string $reference = null): void
    {
        DB::transaction(function () use ($driver, $amount, $description, $reference) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $driver->id, 'owner_type' => 'driver'],
                ['balance' => 0]
            );
            $wallet->increment('balance', $amount);
            WalletTransaction::create([
                'user_id'       => $driver->id,
                'owner_type'    => 'driver',
                'type'          => 'credit',
                'amount'        => $amount,
                'description'   => $description,
                'reference'     => $reference,
                'balance_after' => $wallet->fresh()->balance,
            ]);
        });
    }
}
