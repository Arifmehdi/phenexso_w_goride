<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageContent;

class PageContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Welcome to GoRide Bangladesh',
                'subtitle' => 'Your Trusted Transport Partner Across Bangladesh',
                'description' => 'Experience seamless transportation with our premium fleet and professional drivers.',
                'content' => 'GoRide Bangladesh connects you with verified drivers and quality vehicles for all your transportation needs.',
                'highlights' => json_encode(['Safe & Reliable', 'Professional Drivers', 'All Districts Covered', '24/7 Support']),
                'meta' => json_encode([
                    'hero_title' => 'Welcome to GoRide Bangladesh',
                    'hero_subtitle' => 'Your Trusted Transport Partner Across Bangladesh',
                    'stats_passengers' => '50000+',
                    'stats_trips' => '100000+',
                    'stats_drivers' => '2000+',
                    'stats_districts' => '64'
                ]),
                'active' => true,
                'addedby_id' => 1
            ],
            [
                'page_slug' => 'about',
                'title' => 'About GoRide Bangladesh',
                'subtitle' => 'Our story, mission, and the values that drive us forward every day.',
                'description' => 'Transforming Transport in Bangladesh Since 2026',
                'content' => 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh — from corporate executives to everyday commuters.',
                'highlights' => json_encode(['Founded 2026', 'All 64 Districts', 'Bilingual Platform', 'Mobile-First', 'Verified Drivers']),
                'meta' => json_encode([
                    'paragraph_2' => 'As a bilingual marketplace serving both English and Bangla speakers, we have eliminated communication barriers and brought together vehicle owners, professional drivers, and customers on one seamless platform.',
                    'paragraph_3' => 'Our mobile-first approach means GoRide is always right in your pocket — ready when you need to book a quick city trip or a week-long inter-district journey.'
                ]),
                'active' => true,
                'addedby_id' => 1
            ],
            [
                'page_slug' => 'services',
                'title' => 'Our Services',
                'subtitle' => '',
                'description' => 'From quick city rides to long-distance journeys, we provide reliable transportation across all 64 districts of Bangladesh.',
                'content' => 'Comprehensive Transport Solutions',
                'highlights' => json_encode([]),
                'meta' => json_encode([]),
                'active' => true,
                'addedby_id' => 1
            ],
            [
                'page_slug' => 'fleet',
                'title' => 'Our Fleet',
                'subtitle' => '',
                'description' => 'All vehicles are regularly serviced, verified, and driven by licensed professionals. Pick the one that suits your trip.',
                'content' => 'Vehicles for Every Need & Budget',
                'highlights' => json_encode([]),
                'meta' => json_encode([]),
                'active' => true,
                'addedby_id' => 1
            ],
            [
                'page_slug' => 'tours',
                'title' => 'Tours & Travels',
                'subtitle' => '',
                'description' => 'Every package includes premium transport, experienced local drivers, and a stress-free journey to Bangladesh\'s finest destinations.',
                'content' => 'Handpicked Tour Packages',
                'highlights' => json_encode([]),
                'meta' => json_encode([]),
                'active' => true,
                'addedby_id' => 1
            ]
        ];

        foreach ($pages as $page) {
            PageContent::create($page);
        }
    }
}
