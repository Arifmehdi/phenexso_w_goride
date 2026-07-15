<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * App-level admin toggles surfaced on the System Settings screen:
 * maintenance mode and whether new registrations are open. Idempotent.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('website_parameters')) {
            return;
        }
        Schema::table('website_parameters', function (Blueprint $table) {
            if (!Schema::hasColumn('website_parameters', 'maintenance_mode')) {
                $table->boolean('maintenance_mode')->default(false);
            }
            if (!Schema::hasColumn('website_parameters', 'registration_open')) {
                $table->boolean('registration_open')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            foreach (['maintenance_mode', 'registration_open'] as $c) {
                if (Schema::hasColumn('website_parameters', $c)) {
                    $table->dropColumn($c);
                }
            }
        });
    }
};
