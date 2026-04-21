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

        Schema::create('vehicle_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->constrained();

            $table->foreignId('product_id')->constrained();
            $table->foreignId('farmer_id')->constrained('users');

            $table->decimal('quantity', 10, 2);
            $table->string('delivery_location');
            $table->dateTime('delivery_time');

            $table->tinyInteger('status')->default(1); 
            // 1=assigned, 2=on_the_way, 3=delivered

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
        Schema::dropIfExists('vehicle_assignments');
    }
};
