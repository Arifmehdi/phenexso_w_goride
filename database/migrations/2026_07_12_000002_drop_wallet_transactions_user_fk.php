<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Completes the wallet fix: the earlier 2026_06_28 migration dropped the bad
 * `user_id -> users` foreign key on `wallets`, but MISSED the identical FK on
 * `wallet_transactions`. That leftover constraint made every DRIVER wallet
 * credit fail (a driver's id lives in `drivers`, not `users`), so driver
 * earnings/payouts silently never landed. This drops it. Idempotent.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('wallet_transactions')) {
            return;
        }

        $fk = collect(DB::select("
            SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'wallet_transactions'
              AND COLUMN_NAME = 'user_id' AND REFERENCED_TABLE_NAME = 'users'
        "))->first();

        if ($fk) {
            Schema::table('wallet_transactions', function (Blueprint $table) use ($fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            });
        }
    }

    public function down(): void
    {
        // Intentionally not re-adding the FK — it was wrong (breaks driver wallets).
    }
};
