<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Admin-configurable driver-matching radius (km). When a rider requests a ride,
 * only drivers within this many km of the pickup receive the call. Editable from
 * the admin "Website Settings" page. Falls back to 10 km if unset. Idempotent.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('website_parameters')
            && !Schema::hasColumn('website_parameters', 'matching_radius_km')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                $table->unsignedSmallInteger('matching_radius_km')->default(10)->after('commission_rate');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('website_parameters', 'matching_radius_km')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                $table->dropColumn('matching_radius_km');
            });
        }
    }
};
