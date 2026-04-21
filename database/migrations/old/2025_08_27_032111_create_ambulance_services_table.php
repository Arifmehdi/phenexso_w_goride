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
        Schema::create('ambulance_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->nullable();                
            $table->string('tagline', 180)->nullable(); 
            $table->string('mobile', 30)->nullable();        
            $table->string('email', 120)->nullable();
            $table->string('image', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('editor')->default(1);
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
        Schema::dropIfExists('ambulance_services');
    }
};
