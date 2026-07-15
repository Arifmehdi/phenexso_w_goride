<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Task 21: Wallet
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 10, 2);
            $table->string('description');
            $table->string('reference')->nullable();
            $table->decimal('balance_after', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Task 24: Promo Codes
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['flat', 'percent']);
            $table->decimal('value', 8, 2);
            $table->decimal('min_fare', 8, 2)->default(0);
            $table->decimal('max_discount', 8, 2)->nullable();
            $table->unsignedInteger('max_uses')->nullable();
            $table->unsignedInteger('used_count')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Task 25: Dynamic Banners
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image_url');
            $table->string('link')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // Task 20: Rider ratings
        Schema::create('rider_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ride_request_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('rider_id');
            $table->unsignedTinyInteger('rating');
            $table->text('review')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->unique(['ride_request_id', 'driver_id']);
        });

        // Task 19: Add tags to driver_ratings
        Schema::table('driver_ratings', function (Blueprint $table) {
            $table->json('tags')->nullable()->after('review');
        });
    }

    public function down(): void
    {
        Schema::table('driver_ratings', fn($t) => $t->dropColumn('tags'));
        Schema::dropIfExists('rider_ratings');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('promo_codes');
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallets');
    }
};
