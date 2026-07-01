<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Fixes a critical bug: wallets.user_id had a foreign key to `users` only,
 * but drivers authenticate as a separate `Driver` model with its own id
 * space. A driver's wallet could silently fail to create (FK violation)
 * or, worse, collide with an unrelated User of the same numeric id.
 *
 * This adds an `owner_type` column ('user' | 'driver' | 'corporate' | 'admin')
 * so wallets are scoped per-audience, exactly like notifications.recipient_type.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── wallets ──
        Schema::table('wallets', function (Blueprint $table) {
            if (!Schema::hasColumn('wallets', 'owner_type')) {
                $table->string('owner_type')->default('user')->after('user_id');
            }
        });

        // Drop the FK that wrongly assumed every wallet belongs to `users`.
        $fk = collect(DB::select("
            SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'wallets'
              AND COLUMN_NAME = 'user_id' AND REFERENCED_TABLE_NAME = 'users'
        "))->first();
        if ($fk) {
            Schema::table('wallets', function (Blueprint $table) use ($fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            });
        }

        // Replace the old single-column unique with a composite one.
        $uniqueExists = collect(DB::select("
            SELECT INDEX_NAME FROM information_schema.STATISTICS
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'wallets'
              AND NON_UNIQUE = 0 AND COLUMN_NAME = 'user_id'
        "))->pluck('INDEX_NAME')->unique();
        foreach ($uniqueExists as $indexName) {
            if ($indexName !== 'wallets_user_id_owner_type_unique') {
                Schema::table('wallets', function (Blueprint $table) use ($indexName) {
                    $table->dropUnique($indexName);
                });
            }
        }
        if (!$this->indexExists('wallets', 'wallets_user_id_owner_type_unique')) {
            Schema::table('wallets', function (Blueprint $table) {
                $table->unique(['user_id', 'owner_type'], 'wallets_user_id_owner_type_unique');
            });
        }

        // ── wallet_transactions ──
        Schema::table('wallet_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('wallet_transactions', 'owner_type')) {
                $table->string('owner_type')->default('user')->after('user_id');
            }
        });

        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->index(['user_id', 'owner_type'], 'wallet_txn_owner_idx');
        });
    }

    public function down(): void
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropIndex('wallet_txn_owner_idx');
            $table->dropColumn('owner_type');
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->dropUnique('wallets_user_id_owner_type_unique');
            $table->unique('user_id');
            $table->dropColumn('owner_type');
        });
    }

    private function indexExists(string $table, string $indexName): bool
    {
        return collect(DB::select("
            SELECT INDEX_NAME FROM information_schema.STATISTICS
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND INDEX_NAME = ?
        ", [$table, $indexName]))->isNotEmpty();
    }
};
