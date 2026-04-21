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
        Schema::create('website_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('logo_alt')->nullable();
            $table->string('favicon')->nullable();
            $table->string('website_title')->nullable();
            $table->text('google_analytics_code')->nullable();
            $table->text('google_search_console')->nullable();
            $table->text('facebook_pixel_code')->nullable();
            $table->string('meta_author')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('footer_copyright')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_creator')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();

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
        Schema::dropIfExists('website_parameters');
    }
};
