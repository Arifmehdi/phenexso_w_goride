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
        // Update drivers table to support authentication
        Schema::table('drivers', function (Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'email')) {
                $table->string('email')->unique()->nullable()->after('name');
            }
            if (!Schema::hasColumn('drivers', 'password')) {
                $table->string('password')->after('mobile');
            }
            if (!Schema::hasColumn('drivers', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });

        // Create corporates table
        if (!Schema::hasTable('corporates')) {
            Schema::create('corporates', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('company_name')->nullable();
                $table->string('email')->unique();
                $table->string('mobile')->unique();
                $table->string('password');
                $table->string('address')->nullable();
                $table->string('status')->default('active');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Create admins table
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'remember_token']);
        });
        Schema::dropIfExists('corporates');
        Schema::dropIfExists('admins');
    }
};
