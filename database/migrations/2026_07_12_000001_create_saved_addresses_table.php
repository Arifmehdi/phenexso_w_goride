<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Saved "home / work / other" shortcut addresses for riders.
 * Matches App\Models\SavedAddress and Api\SavedAddressController.
 * Idempotent — safe to run multiple times.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('saved_addresses')) {
            return;
        }

        Schema::create('saved_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('label', 50);                 // 'home' | 'work' | 'other'
            $table->string('title', 255);                // user-facing name, e.g. "Home"
            $table->string('address', 500);              // full formatted address
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('icon_name', 50)->nullable(); // icon shown in the app list
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index('user_id');
            $table->index(['user_id', 'is_default']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_addresses');
    }
};
