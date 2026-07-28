<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Corporate module: correctness fix + employee directory.
 *
 * 1. `ride_requests.user_id` points at the `users` table, but corporate
 *    bookings were storing a CORPORATE id there. Users and corporates are
 *    separate guards with separate id spaces, so that silently attributes a
 *    company's trip to whichever rider happens to share that id (showing it
 *    in their history and earning them loyalty points). Making the column
 *    nullable lets a corporate booking identify itself purely by
 *    `corporate_id`, which is what every corporate query already uses.
 *
 * 2. `corporate_employees` — the staff a company books rides for, so bookings
 *    can reference a saved person instead of retyping name + mobile.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Needed by doctrine/dbal for ->change() on some Laravel 9 setups; if
        // the raw statement is unavailable we fall back to the schema builder.
        try {
            \DB::statement('ALTER TABLE ride_requests MODIFY user_id BIGINT UNSIGNED NULL');
        } catch (\Throwable $e) {
            Schema::table('ride_requests', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            });
        }

        if (!Schema::hasTable('corporate_employees')) {
            Schema::create('corporate_employees', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('corporate_id');
                $table->string('name');
                $table->string('mobile', 30);
                $table->string('email')->nullable();
                $table->string('department')->nullable();
                $table->string('employee_code', 50)->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index('corporate_id');
            });
        }

        // Repoint any corporate rides that were written with the corporate id
        // in user_id — they are identifiable by corporate_id being set.
        \DB::table('ride_requests')
            ->whereNotNull('corporate_id')
            ->whereColumn('user_id', 'corporate_id')
            ->update(['user_id' => null]);
    }

    public function down(): void
    {
        Schema::dropIfExists('corporate_employees');
        // user_id is intentionally left nullable — reverting could fail on
        // rows that legitimately have no rider.
    }
};
