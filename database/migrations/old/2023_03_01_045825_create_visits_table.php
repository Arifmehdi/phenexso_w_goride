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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('bisesoggo_category_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('patient_age')->nullable();
            $table->string('gender')->nullable();
            $table->string('patient_mobile')->nullable();
            $table->text('patient_details')->nullable();
            $table->decimal('visit_fee',8,2)->nullable();
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();
            $table->string('chember_serial_no')->nullable();
            $table->string('chember_room')->nullable();
            $table->string('visit_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->decimal('agent_paid',8,2)->nullable();
            $table->integer('sms_sent')->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
