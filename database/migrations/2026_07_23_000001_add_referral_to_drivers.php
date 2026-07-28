<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Drivers can invite people too (mirrors the columns already on `users`),
 * so the rewards/referral screen works for both roles.
 *
 * Also adds `referred_by_type` to BOTH tables. Users and drivers are separate
 * auth guards with separate id spaces, so `referred_by` alone is ambiguous —
 * without the type we could credit the referral bonus to the wrong person's
 * wallet (user #5 instead of driver #5).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'referral_code')) {
                $table->string('referral_code', 12)->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('drivers', 'referred_by')) {
                $table->unsignedBigInteger('referred_by')->nullable()->after('referral_code');
            }
            if (!Schema::hasColumn('drivers', 'referred_by_type')) {
                $table->string('referred_by_type', 10)->nullable()->after('referred_by');
            }
            if (!Schema::hasColumn('drivers', 'referral_credited')) {
                $table->boolean('referral_credited')->default(false)->after('referred_by_type');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referred_by_type')) {
                $table->string('referred_by_type', 10)->nullable()->after('referred_by');
            }
        });

        // Existing rows were all rider-referred-by-rider, so backfill 'user'.
        if (Schema::hasColumn('users', 'referred_by_type')) {
            \DB::table('users')->whereNotNull('referred_by')
                ->whereNull('referred_by_type')->update(['referred_by_type' => 'user']);
        }
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $cols = array_filter(
                ['referral_code', 'referred_by', 'referred_by_type', 'referral_credited'],
                fn ($c) => Schema::hasColumn('drivers', $c)
            );
            if ($cols) $table->dropColumn($cols);
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referred_by_type')) {
                $table->dropColumn('referred_by_type');
            }
        });
    }
};
