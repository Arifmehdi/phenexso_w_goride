<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->unique(); // e.g., 'home', 'about', 'services', 'fleet', 'tours'
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable(); // For additional content like paragraphs
            $table->json('highlights')->nullable(); // For about highlights or other lists
            $table->json('meta')->nullable(); // For hero sections, stats, etc.
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_contents');
    }
};
