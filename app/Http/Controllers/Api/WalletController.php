<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    private function wallet(): Wallet
    {
        return Wallet::firstOrCreate(['user_id' => auth()->id()], ['balance' => 0]);
    }

    public function balance()
    {
        $wallet = $this->wallet();
        return response()->json(['success' => true, 'balance' => $wallet->balance]);
    }

    public function transactions()
    {
        $txns = WalletTransaction::where('user_id', auth()->id())
            ->orderByDesc('created_at')->paginate(20);
        return response()->json(['success' => true, 'transactions' => $txns]);
    }

    public function topUp(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:10|max:50000']);
        DB::transaction(function () use ($request) {
            $wallet = $this->wallet();
            $wallet->increment('balance', $request->amount);
            WalletTransaction::create([
                'user_id'       => auth()->id(),
                'type'          => 'credit',
                'amount'        => $request->amount,
                'description'   => 'Wallet top-up',
                'reference'     => $request->reference ?? null,
                'balance_after' => $wallet->fresh()->balance,
            ]);
        });
        return response()->json(['success' => true, 'balance' => $this->wallet()->balance]);
    }

    public function payForRide(Request $request, $rideId)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);
        $wallet = $this->wallet();

        if ($wallet->balance < $request->amount) {
            return response()->json(['success' => false, 'message' => 'Insufficient wallet balance'], 422);
        }

        DB::transaction(function () use ($request, $rideId, $wallet) {
            $wallet->decrement('balance', $request->amount);
            WalletTransaction::create([
                'user_id'       => auth()->id(),
                'type'          => 'debit',
                'amount'        => $request->amount,
                'description'   => "Ride payment #$rideId",
                'reference'     => "ride_$rideId",
                'balance_after' => $wallet->fresh()->balance,
            ]);
        });

        return response()->json(['success' => true, 'balance' => $this->wallet()->balance]);
    }
}
