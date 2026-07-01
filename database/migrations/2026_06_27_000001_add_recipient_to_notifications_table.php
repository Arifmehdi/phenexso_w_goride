<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // 'all' | 'user' | 'driver'  — who the notification is meant for
            if (!Schema::hasColumn('notifications', 'recipient_type')) {
                $table->string('recipient_type')->default('user')->after('user_id');
            }
            // Extra payload for FCM deep-linking (e.g. ride_id, screen)
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->nullable()->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['recipient_type', 'data']);
        });
    }
};
