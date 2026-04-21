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
        Schema::create('blog_post_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_post_id')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_ext')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_original_name')->nullable();
            $table->string('file_mime')->nullable();
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
        Schema::dropIfExists('blog_post_files');
    }
};
