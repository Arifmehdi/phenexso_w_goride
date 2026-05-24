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
        Schema::table('page_contents', function (Blueprint $table) {
            $table->string('title_bn')->nullable()->after('title');
            $table->text('subtitle_bn')->nullable()->after('subtitle');
            $table->text('description_bn')->nullable()->after('description');
            $table->text('content_bn')->nullable()->after('content');
            $table->json('highlights_bn')->nullable()->after('highlights');
            $table->json('meta_bn')->nullable()->after('meta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->dropColumn([
                'title_bn',
                'subtitle_bn',
                'description_bn',
                'content_bn',
                'highlights_bn',
                'meta_bn'
            ]);
        });
    }
};
