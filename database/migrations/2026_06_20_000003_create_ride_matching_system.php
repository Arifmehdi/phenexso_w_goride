<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Add location & availability fields to drivers table ──
        if (!Schema::hasColumn('drivers', 'vehicle_type')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->decimal('latitude', 10, 8)->nullable()->after('address');
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
                $table->timestamp('last_location_update')->nullable()->after('longitude');
                $table->string('vehicle_type')->nullable()->after('status');
                $table->boolean('is_online')->default(false)->after('vehicle_type');
            });
        }

        // ── 2. Create ride_offers table ──
        if (!Schema::hasTable('ride_offers')) {
            Schema::create('ride_offers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ride_request_id')->constrained('ride_requests')->onDelete('cascade');
                $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
                $table->enum('status', ['pending', 'accepted', 'declined', 'expired'])->default('pending');
                $table->timestamp('offered_at')->nullable();
                $table->timestamp('responded_at')->nullable();
                $table->integer('priority_order')->default(0); // 1st, 2nd, 3rd... driver offered
                $table->timestamps();

                // A driver can only be offered the same ride once
                $table->unique(['ride_request_id', 'driver_id']);
            });
        }

        // ── 3. Add extra columns to ride_requests for tracking & history ──
        if (!Schema::hasColumn('ride_requests', 'cancelled_by')) {
            Schema::table('ride_requests', function (Blueprint $table) {
                $table->enum('cancelled_by', ['rider', 'driver', 'system'])->nullable()->after('status');
                $table->text('cancellation_reason')->nullable()->after('cancelled_by');
                $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending')->after('cancellation_reason');
                $table->string('payment_method')->nullable()->after('payment_status');
                $table->decimal('actual_fare', 10, 2)->nullable()->after('fare');
                $table->decimal('distance_km', 8, 2)->nullable()->after('actual_fare');
                $table->integer('duration_minutes')->nullable()->after('distance_km');
                $table->text('notes')->nullable()->after('duration_minutes');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_offers');

        if (Schema::hasColumn('ride_requests', 'cancelled_by')) {
            Schema::table('ride_requests', function (Blueprint $table) {
                $table->dropColumn([
                    'cancelled_by',
                    'cancellation_reason',
                    'payment_status',
                    'payment_method',
                    'actual_fare',
                    'distance_km',
                    'duration_minutes',
                    'notes',
                ]);
            });
        }

        if (Schema::hasColumn('drivers', 'latitude')) {
            Schema::table('drivers', function (Blueprint $table) {
                $table->dropColumn([
                    'latitude',
                    'longitude',
                    'last_location_update',
                    'vehicle_type',
                    'is_online',
                ]);
            });
        }
    }
};
