<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds `referred_by_type` to users + drivers.
 *
 * Users and drivers are separate auth guards with separate id spaces, so
 * `referred_by` on its own is ambiguous — without knowing the type we could
 * credit a referral bonus to the wrong person's wallet (user #5 vs driver #5).
 *
 * Split out from ...000001_add_referral_to_drivers so it applies cleanly on
 * databases where that migration had already been recorded as run.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('drivers', 'referred_by_type')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->string('referred_by_type', 10)->nullable()->after('referred_by');
            });
        }

        if (!Schema::hasColumn('users', 'referred_by_type')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('referred_by_type', 10)->nullable()->after('referred_by');
            });
        }

        // Everyone referred before this point was referred by a rider.
        \DB::table('users')->whereNotNull('referred_by')
            ->whereNull('referred_by_type')->update(['referred_by_type' => 'user']);
        \DB::table('drivers')->whereNotNull('referred_by')
            ->whereNull('referred_by_type')->update(['referred_by_type' => 'user']);
    }

    public function down(): void
    {
        foreach (['drivers', 'users'] as $t) {
            if (Schema::hasColumn($t, 'referred_by_type')) {
                Schema::table($t, function (Blueprint $table) {
                    $table->dropColumn('referred_by_type');
                });
            }
        }
    }
};
