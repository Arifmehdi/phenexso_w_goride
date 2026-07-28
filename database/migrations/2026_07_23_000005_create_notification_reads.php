<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Per-recipient read state for BROADCAST notifications.
 *
 * A broadcast row has `user_id = null` (it belongs to everyone in an
 * audience), so its single `is_read` flag can't represent "read" for one
 * person without hiding it from everyone else. Without this table the bell
 * badge could never reach zero once any broadcast existed.
 *
 * Personal notifications keep using `notifications.is_read`.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('notification_reads')) {
            Schema::create('notification_reads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('notification_id');
                $table->unsignedBigInteger('user_id');
                // users / drivers / corporates / admins share id spaces.
                $table->string('owner_type', 10)->default('user');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();

                $table->unique(['notification_id', 'user_id', 'owner_type'], 'notif_read_unique');
                $table->index(['user_id', 'owner_type']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_reads');
    }
};
