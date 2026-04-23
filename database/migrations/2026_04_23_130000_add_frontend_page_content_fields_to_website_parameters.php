<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('website_parameters')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                if (!Schema::hasColumn('website_parameters', 'home_hero_badge')) {
                    $table->string('home_hero_badge')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_hero_title')) {
                    $table->string('home_hero_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_hero_span')) {
                    $table->string('home_hero_span')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_hero_subtitle')) {
                    $table->text('home_hero_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_hero_cta_text')) {
                    $table->string('home_hero_cta_text')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_hero_cta_link')) {
                    $table->string('home_hero_cta_link')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_stats_customers')) {
                    $table->string('home_stats_customers')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_stats_fleet')) {
                    $table->string('home_stats_fleet')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_stats_districts')) {
                    $table->string('home_stats_districts')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'home_stats_corporate')) {
                    $table->string('home_stats_corporate')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'why_section_title')) {
                    $table->string('why_section_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'why_section_subtitle')) {
                    $table->text('why_section_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_page_title')) {
                    $table->string('about_page_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_page_subtitle')) {
                    $table->text('about_page_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_page_paragraph_1')) {
                    $table->text('about_page_paragraph_1')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_page_paragraph_2')) {
                    $table->text('about_page_paragraph_2')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_page_paragraph_3')) {
                    $table->text('about_page_paragraph_3')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_highlight_1')) {
                    $table->string('about_highlight_1')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_highlight_2')) {
                    $table->string('about_highlight_2')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_highlight_3')) {
                    $table->string('about_highlight_3')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_highlight_4')) {
                    $table->string('about_highlight_4')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'about_highlight_5')) {
                    $table->string('about_highlight_5')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'services_page_title')) {
                    $table->string('services_page_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'services_page_subtitle')) {
                    $table->text('services_page_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'services_page_description')) {
                    $table->text('services_page_description')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'fleet_page_title')) {
                    $table->string('fleet_page_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'fleet_page_subtitle')) {
                    $table->text('fleet_page_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'fleet_page_description')) {
                    $table->text('fleet_page_description')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'tours_page_title')) {
                    $table->string('tours_page_title')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'tours_page_subtitle')) {
                    $table->text('tours_page_subtitle')->nullable();
                }
                if (!Schema::hasColumn('website_parameters', 'tours_page_description')) {
                    $table->text('tours_page_description')->nullable();
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('website_parameters')) {
            Schema::table('website_parameters', function (Blueprint $table) {
                $dropColumns = [
                    'home_hero_badge',
                    'home_hero_title',
                    'home_hero_span',
                    'home_hero_subtitle',
                    'home_hero_cta_text',
                    'home_hero_cta_link',
                    'home_stats_customers',
                    'home_stats_fleet',
                    'home_stats_districts',
                    'home_stats_corporate',
                    'why_section_title',
                    'why_section_subtitle',
                    'about_page_title',
                    'about_page_subtitle',
                    'about_page_paragraph_1',
                    'about_page_paragraph_2',
                    'about_page_paragraph_3',
                    'about_highlight_1',
                    'about_highlight_2',
                    'about_highlight_3',
                    'about_highlight_4',
                    'about_highlight_5',
                    'services_page_title',
                    'services_page_subtitle',
                    'services_page_description',
                    'fleet_page_title',
                    'fleet_page_subtitle',
                    'fleet_page_description',
                    'tours_page_title',
                    'tours_page_subtitle',
                    'tours_page_description',
                ];

                foreach ($dropColumns as $column) {
                    if (Schema::hasColumn('website_parameters', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
