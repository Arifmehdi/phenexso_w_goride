<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Admin-configurable platform commission. Stored as a PERCENT (e.g. 15.00 = 15%)
 * on website_parameters, editable from the admin "Website Settings" page.
 * Falls back to 15% if unset. Idempotent.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('website_parameters')
            && !Schema::hasColumn('website_parameters', 'commission_rate')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                $table->decimal('commission_rate', 5, 2)->default(15.00)->after('per_km_rate');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('website_parameters', 'commission_rate')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                $table->dropColumn('commission_rate');
            });
        }
    }
};
