<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Supports a corporate account booking a ride on behalf of an employee.
 * There is no "employee" model in this app, so we store the employee's
 * name/phone directly rather than requiring a fake User account per employee.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('ride_requests', 'corporate_id')) {
                $table->unsignedBigInteger('corporate_id')->nullable()->after('user_id');
                $table->index('corporate_id');
            }
            if (!Schema::hasColumn('ride_requests', 'booked_for_name')) {
                $table->string('booked_for_name')->nullable();
            }
            if (!Schema::hasColumn('ride_requests', 'booked_for_mobile')) {
                $table->string('booked_for_mobile')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            $table->dropColumn(['corporate_id', 'booked_for_name', 'booked_for_mobile']);
        });
    }
};
