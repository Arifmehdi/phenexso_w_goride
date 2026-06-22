<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('website_parameters')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                if (!Schema::hasColumn('website_parameters', 'per_km_rate')) {
                    $table->decimal('per_km_rate', 10, 2)->default(20.00)->after('shipping_charge');
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('website_parameters')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                if (Schema::hasColumn('website_parameters', 'per_km_rate')) {
                    $table->dropColumn('per_km_rate');
                }
            });
        }
    }
};
