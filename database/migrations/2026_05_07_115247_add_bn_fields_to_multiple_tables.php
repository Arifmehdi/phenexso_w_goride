<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->longText('description_bn')->nullable()->after('description');
            $table->text('excerpt_bn')->nullable()->after('excerpt');
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('designation_bn')->nullable()->after('designation');
            // text_en and text_bn already exist based on tinker check
        });

        Schema::table('front_sliders', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('description_bn')->nullable()->after('description');
        });
        
        Schema::table('departments', function (Blueprint $table) {
            // Check if name_bn already exists to avoid errors
            if (!Schema::hasColumn('departments', 'name_bn')) {
                $table->string('name_bn')->nullable()->after('name_en');
            }
            if (!Schema::hasColumn('departments', 'excerpt_bn')) {
                $table->text('excerpt_bn')->nullable()->after('excerpt_en');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn', 'excerpt_bn']);
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['name_bn']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['designation_bn']);
        });

        Schema::table('front_sliders', function (Blueprint $table) {
            $table->dropColumn(['title_bn', 'description_bn']);
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'excerpt_bn']);
        });
    }
};
