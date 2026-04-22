<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $blueprint) {
            if (!Schema::hasColumn('users', 'role')) {
                $blueprint->enum('role', ['admin', 'corporate', 'owner', 'driver', 'solo'])->default('solo')->after('email');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $blueprint->enum('status', ['pending', 'active', 'suspended', 'rejected'])->default('active')->after('role');
            }
            if (!Schema::hasColumn('users', 'otp_verified_at')) {
                $blueprint->timestamp('otp_verified_at')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['role', 'status', 'otp_verified_at']);
        });
    }
};
