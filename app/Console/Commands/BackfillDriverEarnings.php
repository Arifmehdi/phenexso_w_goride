<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\WalletController;
use App\Models\RideRequest;
use Illuminate\Console\Command;

/**
 * One-time (idempotent) backfill: credit drivers their earnings for every
 * ride that was already PAID before the settlement logic existed. Safe to run
 * repeatedly — settleDriverEarnings() skips rides already settled.
 *
 *   php artisan wallet:backfill-earnings
 */
class BackfillDriverEarnings extends Command
{
    protected $signature = 'wallet:backfill-earnings';
    protected $description = 'Credit driver wallets for past paid rides that were never settled';

    public function handle(): int
    {
        $rides = RideRequest::where('payment_status', 'paid')
            ->whereNotNull('driver_id')
            ->get();

        $this->info("Found {$rides->count()} paid rides to check...");
        $bar = $this->output->createProgressBar($rides->count());

        foreach ($rides as $ride) {
            WalletController::settleDriverEarnings($ride);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Done. Driver wallets are now up to date.');
        return self::SUCCESS;
    }
}
