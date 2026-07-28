<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Rent a Car — the fleet the admin lists, and the bookings customers make.
 *
 * Kept separate from `vehicles` (driver-owned cars used for ride-hailing);
 * a rental car is inventory the business rents out by the day, with its own
 * pricing and availability.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('rental_cars')) {
            Schema::create('rental_cars', function (Blueprint $table) {
                $table->id();
                $table->string('name');                       // e.g. Toyota Corolla
                $table->string('type')->default('sedan');     // sedan / suv / microbus
                $table->string('image')->nullable();
                $table->unsignedTinyInteger('seats')->default(4);
                $table->string('transmission')->default('Manual');
                $table->string('fuel')->default('Petrol');
                $table->string('plate_number')->nullable();
                // Two headline prices, matching what the app already shows.
                $table->decimal('price_one_way', 10, 2)->default(0);
                $table->decimal('price_with_return', 10, 2)->default(0);
                $table->text('features')->nullable();         // comma-separated
                $table->boolean('is_available')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('rental_bookings')) {
            Schema::create('rental_bookings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                // Four separate auth guards share id spaces — record which one.
                $table->string('owner_type', 10)->default('user');
                $table->unsignedBigInteger('rental_car_id')->nullable();

                $table->boolean('with_return')->default(false);
                $table->date('pickup_date');
                $table->string('pickup_time', 20)->nullable();
                $table->date('return_date')->nullable();

                $table->string('pickup_district')->nullable();
                $table->string('pickup_thana')->nullable();
                $table->string('dest_district')->nullable();
                $table->string('dest_thana')->nullable();

                $table->string('contact_name')->nullable();
                $table->string('contact_phone')->nullable();

                $table->decimal('total_price', 10, 2)->default(0);
                // pending → confirmed → ongoing → completed | cancelled
                $table->string('status', 20)->default('pending');
                $table->text('note')->nullable();
                $table->timestamps();

                $table->index(['user_id', 'owner_type']);
                $table->index('status');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_bookings');
        Schema::dropIfExists('rental_cars');
    }
};
