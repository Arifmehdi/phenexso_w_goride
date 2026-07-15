<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create driver_ratings table
        if (!Schema::hasTable('driver_ratings')) {
            Schema::create('driver_ratings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ride_request_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
                $table->tinyInteger('rating')->unsigned()->comment('Rating from 1 to 5');
                $table->text('review')->nullable();
                $table->timestamps();

                // Ensure one rating per ride request
                $table->unique('ride_request_id');
            });
        }

        // Add rating fields to drivers table
        if (Schema::hasTable('drivers')) {
            Schema::table('drivers', function (Blueprint $table) {
                if (!Schema::hasColumn('drivers', 'average_rating')) {
                    $table->decimal('average_rating', 3, 2)->default(0)->after('status');
                }
                if (!Schema::hasColumn('drivers', 'total_ratings')) {
                    $table->integer('total_ratings')->default(0)->after('average_rating');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('driver_ratings');

        if (Schema::hasTable('drivers')) {
            Schema::table('drivers', function (Blueprint $table) {
                if (Schema::hasColumn('drivers', 'average_rating')) {
                    $table->dropColumn(['average_rating', 'total_ratings']);
                }
            });
        }
    }
};
