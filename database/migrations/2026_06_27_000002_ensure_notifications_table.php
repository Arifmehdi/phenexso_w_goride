<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Bulletproof, idempotent notifications table for the ride-share app.
 * - Creates the table if it does not exist.
 * - Adds any missing columns if it already exists.
 * Safe to run multiple times.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();   // recipient id (user OR driver); null = broadcast
                $table->string('recipient_type')->default('user');   // 'all' | 'user' | 'driver'
                $table->string('title');
                $table->text('message')->nullable();
                $table->string('type')->nullable();                  // category: ride_request, account_approved, payment, promo, announcement...
                $table->json('data')->nullable();                    // deep-link payload (e.g. {"ride_id": 12})
                $table->string('ip_address')->nullable();
                $table->boolean('all_show')->default(false);         // true = broadcast to the audience
                $table->boolean('is_read')->default(false);
                $table->timestamp('read_at')->nullable();
                $table->timestamps();

                $table->index(['recipient_type', 'all_show']);
                $table->index(['user_id', 'recipient_type']);
                $table->index('is_read');
            });
            return;
        }

        // Table exists — add any columns that are missing.
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'recipient_type')) {
                $table->string('recipient_type')->default('user')->after('user_id');
            }
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->nullable()->after('message');
            }
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->nullable()->after('type');
            }
            if (!Schema::hasColumn('notifications', 'ip_address')) {
                $table->string('ip_address')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'all_show')) {
                $table->boolean('all_show')->default(false);
            }
            if (!Schema::hasColumn('notifications', 'is_read')) {
                $table->boolean('is_read')->default(false);
            }
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Only drop the columns this migration may have added; keep the base table.
        if (Schema::hasTable('notifications')) {
            Schema::table('notifications', function (Blueprint $table) {
                foreach (['read_at'] as $col) {
                    if (Schema::hasColumn('notifications', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};
