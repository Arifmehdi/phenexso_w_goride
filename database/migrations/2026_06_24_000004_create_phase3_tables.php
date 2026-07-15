<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Task 30: Driver documents
        Schema::create('driver_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('document_type'); // nid_front, nid_back, license_front, license_back, vehicle_registration, selfie
            $table->string('file_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'document_type']);
        });

        // Task 35: OTP verification
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('otp', 6);
            $table->string('purpose')->default('registration'); // registration, login, reset
            $table->boolean('is_used')->default(false);
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->index(['mobile', 'purpose']);
        });

        // Task 33: acceptance_rate on drivers
        Schema::table('drivers', function (Blueprint $table) {
            $table->decimal('acceptance_rate', 5, 2)->default(100)->after('average_rating');
            $table->unsignedInteger('total_offers')->default(0)->after('acceptance_rate');
            $table->unsignedInteger('accepted_offers')->default(0)->after('total_offers');
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['acceptance_rate', 'total_offers', 'accepted_offers']);
        });
        Schema::dropIfExists('otp_verifications');
        Schema::dropIfExists('driver_documents');
    }
};
