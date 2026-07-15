<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backing tables for the new_api.txt feature set:
 * support tickets, referrals, surge pricing, driver payouts, ride pooling.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── Support Tickets ──
        if (!Schema::hasTable('support_tickets')) {
            Schema::create('support_tickets', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('owner_type')->default('user'); // 'user' | 'driver' | 'corporate'
                $table->string('subject');
                $table->text('message');
                $table->string('category')->nullable(); // ride, payment, account, other
                $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
                $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
                $table->unsignedBigInteger('ride_request_id')->nullable();
                $table->timestamps();
                $table->index(['user_id', 'owner_type']);
                $table->index('status');
            });
        }

        if (!Schema::hasTable('support_ticket_replies')) {
            Schema::create('support_ticket_replies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ticket_id');
                $table->unsignedBigInteger('sender_id');
                $table->string('sender_type'); // 'user' | 'driver' | 'corporate' | 'admin'
                $table->text('message');
                $table->timestamps();
                $table->foreign('ticket_id')->references('id')->on('support_tickets')->onDelete('cascade');
                $table->index('ticket_id');
            });
        }

        // ── Referrals ──
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code', 12)->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('users', 'referred_by')) {
                $table->unsignedBigInteger('referred_by')->nullable()->after('referral_code');
            }
            if (!Schema::hasColumn('users', 'referral_credited')) {
                $table->boolean('referral_credited')->default(false)->after('referred_by');
            }
        });

        // ── Surge Pricing ──
        if (!Schema::hasTable('surge_zones')) {
            Schema::create('surge_zones', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('center_lat', 10, 7);
                $table->decimal('center_lng', 10, 7);
                $table->unsignedInteger('radius_km')->default(3);
                $table->decimal('multiplier', 4, 2)->default(1.0); // e.g. 1.5x
                $table->boolean('is_active')->default(true);
                $table->timestamp('expires_at')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
                $table->index('is_active');
            });
        }

        // ── Driver Payouts ──
        if (!Schema::hasTable('driver_payouts')) {
            Schema::create('driver_payouts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('driver_id');
                $table->date('period_from');
                $table->date('period_to');
                $table->decimal('gross_earnings', 10, 2)->default(0);
                $table->decimal('commission', 10, 2)->default(0);
                $table->decimal('net_amount', 10, 2)->default(0);
                $table->enum('status', ['pending', 'processing', 'paid', 'failed'])->default('pending');
                $table->string('payout_method')->nullable(); // bkash, nagad, bank
                $table->string('reference')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->unsignedBigInteger('processed_by')->nullable();
                $table->timestamps();
                $table->index(['driver_id', 'status']);
            });
        }

        // ── Ride Pooling ──
        if (!Schema::hasTable('ride_pools')) {
            Schema::create('ride_pools', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ride_request_id')->unique();
                $table->unsignedTinyInteger('max_passengers')->default(3);
                $table->unsignedTinyInteger('current_passengers')->default(1);
                $table->boolean('is_open')->default(true);
                $table->timestamps();
            });

            Schema::create('ride_pool_passengers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ride_pool_id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('ride_request_id'); // that passenger's own ride_request row
                $table->decimal('pickup_lat', 10, 7);
                $table->decimal('pickup_lng', 10, 7);
                $table->decimal('dest_lat', 10, 7);
                $table->decimal('dest_lng', 10, 7);
                $table->timestamps();
                $table->foreign('ride_pool_id')->references('id')->on('ride_pools')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_pool_passengers');
        Schema::dropIfExists('ride_pools');
        Schema::dropIfExists('driver_payouts');
        Schema::dropIfExists('surge_zones');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['referral_code', 'referred_by', 'referral_credited']);
        });
        Schema::dropIfExists('support_ticket_replies');
        Schema::dropIfExists('support_tickets');
    }
};
