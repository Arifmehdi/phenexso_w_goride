<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Personal
            if (!Schema::hasColumn('drivers', 'father_name'))       $table->string('father_name')->nullable();
            if (!Schema::hasColumn('drivers', 'mother_name'))       $table->string('mother_name')->nullable();
            if (!Schema::hasColumn('drivers', 'dob'))               $table->date('dob')->nullable();
            if (!Schema::hasColumn('drivers', 'blood_group'))       $table->string('blood_group', 5)->nullable();
            if (!Schema::hasColumn('drivers', 'present_address'))   $table->string('present_address')->nullable();
            if (!Schema::hasColumn('drivers', 'permanent_address')) $table->string('permanent_address')->nullable();
            if (!Schema::hasColumn('drivers', 'emergency_contact_name'))  $table->string('emergency_contact_name')->nullable();
            if (!Schema::hasColumn('drivers', 'emergency_contact_phone')) $table->string('emergency_contact_phone')->nullable();

            // Documents / images
            if (!Schema::hasColumn('drivers', 'profile_image'))     $table->string('profile_image')->nullable();
            if (!Schema::hasColumn('drivers', 'nid_front_image'))   $table->string('nid_front_image')->nullable();
            if (!Schema::hasColumn('drivers', 'nid_back_image'))    $table->string('nid_back_image')->nullable();
            if (!Schema::hasColumn('drivers', 'license_image'))     $table->string('license_image')->nullable();
            if (!Schema::hasColumn('drivers', 'license_expiry'))    $table->date('license_expiry')->nullable();

            // Vehicle (vehicle_type may already exist from ride-matching migration)
            if (!Schema::hasColumn('drivers', 'vehicle_type'))      $table->string('vehicle_type')->nullable();
            if (!Schema::hasColumn('drivers', 'vehicle_model'))     $table->string('vehicle_model')->nullable();
            if (!Schema::hasColumn('drivers', 'vehicle_plate'))     $table->string('vehicle_plate')->nullable();
            if (!Schema::hasColumn('drivers', 'vehicle_color'))     $table->string('vehicle_color')->nullable();
            if (!Schema::hasColumn('drivers', 'vehicle_year'))      $table->string('vehicle_year', 4)->nullable();

            // Verification tracking
            if (!Schema::hasColumn('drivers', 'profile_completion')) $table->unsignedTinyInteger('profile_completion')->default(0);
            if (!Schema::hasColumn('drivers', 'verification_status')) {
                $table->enum('verification_status', ['incomplete', 'pending', 'verified', 'rejected'])->default('incomplete');
            }
            if (!Schema::hasColumn('drivers', 'rejection_reason'))   $table->string('rejection_reason')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'father_name', 'mother_name', 'dob', 'blood_group', 'present_address', 'permanent_address',
                'emergency_contact_name', 'emergency_contact_phone',
                'profile_image', 'nid_front_image', 'nid_back_image', 'license_image', 'license_expiry',
                'vehicle_model', 'vehicle_plate', 'vehicle_color', 'vehicle_year',
                'profile_completion', 'verification_status', 'rejection_reason',
            ]);
        });
    }
};
