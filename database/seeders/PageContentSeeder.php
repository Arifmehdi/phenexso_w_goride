<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;
use Illuminate\Support\Facades\DB;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records
        DB::table('page_contents')->truncate();

        $contents = [
            [
                'page_slug' => 'home',
                'title' => 'GoRide Bangladesh Home',
                'title_bn' => 'গো-রাইড বাংলাদেশ হোম',
                'subtitle' => 'Premium Car Rental Marketplace',
                'subtitle_bn' => 'প্রিমিয়াম গাড়ি ভাড়া মার্কেটপ্লেস',
                'description' => 'The leading transport marketplace for individuals, corporates & tour groups.',
                'description_bn' => 'ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস।',
                'meta' => [
                    'hero_badge' => 'Trusted by 5,000+ Customers Nationwide',
                    'hero_title' => 'Reliable Car Rental',
                    'hero_span' => 'Across Bangladesh',
                    'hero_subtitle' => 'The leading transport marketplace for individuals, corporates & tour groups. Mobile-first, bilingual, and always on time.',
                    'hero_cta_text' => 'Book a Ride Now',
                    'hero_cta_link' => '#',
                    'stats_customers' => '5,000+',
                    'stats_fleet' => '1,200+',
                    'stats_districts' => '64',
                    'stats_corporate' => '150+',
                    'why_title' => 'The Smarter Way to Travel',
                    'why_subtitle' => 'We combine local expertise with modern technology to deliver a transport experience that\'s reliable, affordable, and friction-free.',
                    'why_items' => [
                        ['icon' => 'fas fa-shield-halved', 'title' => 'Verified Drivers & Vehicles', 'desc' => 'Every driver and vehicle on our platform is thoroughly verified for safety.'],
                        ['icon' => 'fas fa-mobile-screen-button', 'title' => 'Mobile-First Booking', 'desc' => 'Book, track, and manage rides entirely from your phone.'],
                        ['icon' => 'fas fa-bangladeshi-taka-sign', 'title' => 'Transparent Pricing', 'desc' => 'No hidden fees. Know the full fare before you confirm.'],
                        ['icon' => 'fas fa-clock', 'title' => '24/7 Availability', 'desc' => 'Early morning flights or late night events — we are available round the clock.'],
                        ['icon' => 'fas fa-route', 'title' => 'All 64 Districts', 'desc' => 'From Dhaka to Teknaf — our network spans every district of Bangladesh.'],
                        ['icon' => 'fas fa-headset', 'title' => 'Dedicated Support', 'desc' => 'A real support team available via phone and WhatsApp.'],
                    ]
                ],
                'meta_bn' => [
                    'hero_badge' => 'সারাদেশে ৫,০০০+ গ্রাহকের বিশ্বস্ত',
                    'hero_title' => 'নির্ভরযোগ্য গাড়ি ভাড়া',
                    'hero_span' => 'সারা বাংলাদেশে',
                    'hero_subtitle' => 'ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস। মোবাইল-ফার্স্ট, দ্বিভাষিক এবং সব সময় সঠিক সময়ে।',
                    'hero_cta_text' => 'রাইড বুক করুন',
                    'stats_customers' => '৫,০০০+',
                    'stats_fleet' => '১,২০০+',
                    'stats_districts' => '৬৪',
                    'stats_corporate' => '১৫০+',
                    'why_title' => 'ভ্রমণের স্মার্ট উপায়',
                    'why_subtitle' => 'একটি নির্ভরযোগ্য এবং সাশ্রয়ী পরিবহন অভিজ্ঞতা প্রদানের জন্য আমরা আধুনিক প্রযুক্তির সাথে স্থানীয় দক্ষতাকে একত্রিত করি।',
                    'why_items' => [
                        ['icon' => 'fas fa-shield-halved', 'title' => 'ভেরিফাইড চালক ও যানবাহন', 'desc' => 'আমাদের প্ল্যাটফর্মের প্রতিটি চালক এবং যানবাহন নিরাপত্তা যাচাই করা হয়।'],
                        ['icon' => 'fas fa-mobile-screen-button', 'title' => 'মোবাইল-ফার্স্ট বুকিং', 'desc' => 'আপনার ফোন থেকে সরাসরি রাইড বুক করুন এবং পরিচালনা করুন।'],
                        ['icon' => 'fas fa-bangladeshi-taka-sign', 'title' => 'স্বচ্ছ মূল্য নির্ধারণ', 'desc' => 'কোনো লুকানো ফি নেই। নিশ্চিত করার আগে সম্পূর্ণ ভাড়া জানুন।'],
                        ['icon' => 'fas fa-clock', 'title' => '২৪/৭ প্রাপ্যতা', 'desc' => 'ভোরবেলার ফ্লাইট বা গভীর রাতের ইভেন্ট — আমরা চব্বিশ ঘণ্টা আছি।'],
                        ['icon' => 'fas fa-route', 'title' => 'সব ৬৪টি জেলা', 'desc' => 'ঢাকা থেকে টেকনাফ — আমাদের নেটওয়ার্ক বাংলাদেশের প্রতিটি জেলায় বিস্তৃত।'],
                        ['icon' => 'fas fa-headset', 'title' => 'ডেডিকেটেড সাপোর্ট', 'desc' => 'ফোন এবং হোয়াটসঅ্যাপের মাধ্যমে সার্বক্ষণিক সাপোর্ট টিম।'],
                    ]
                ],
                'active' => true,
            ],
            [
                'page_slug' => 'about',
                'title' => 'About GoRide Bangladesh',
                'title_bn' => 'গো-রাইড বাংলাদেশ সম্পর্কে',
                'subtitle' => 'Our story, mission, and the values that drive us forward every day.',
                'subtitle_bn' => 'আমাদের গল্প, লক্ষ্য এবং সেই মূল্যবোধ যা আমাদের প্রতিদিন এগিয়ে নিয়ে যায়।',
                'content' => 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh — from corporate executives to everyday commuters.',
                'content_bn' => 'গো-রাইড বাংলাদেশ একটি স্পষ্ট লক্ষ্য নিয়ে প্রতিষ্ঠিত হয়েছিল: বাংলাদেশের প্রতিটি মানুষের জন্য — কর্পোরেট এক্সিকিউটিভ থেকে শুরু করে সাধারণ যাত্রী পর্যন্ত — যাতায়াতকে নির্ভরযোগ্য, সহজলভ্য এবং দক্ষ করে তোলা।',
                'highlights' => ['Founded 2026', 'All 64 Districts', 'Bilingual Platform', 'Mobile-First', 'Verified Drivers'],
                'highlights_bn' => ['২০২৬ সালে প্রতিষ্ঠিত', '৬৪টি জেলায় সেবা', 'দ্বিভাষিক প্ল্যাটফর্ম', 'মোবাইল-ফার্স্ট', 'ভেরিফাইড চালক'],
                'meta' => [
                    'paragraph_2' => 'As a bilingual marketplace serving both English and Bangla speakers, we have eliminated communication barriers.',
                    'paragraph_3' => 'Our mobile-first approach means GoRide is always right in your pocket — ready when you need it.',
                    'vision_title' => 'Our Vision',
                    'vision_desc' => 'To become the backbone of Bangladesh\'s transport industry through technology and trust.',
                    'mission_title' => 'Our Mission',
                    'mission_desc' => 'To empower vehicle owners while giving safe, professional car rental services nationwide.',
                    'values_title' => 'Our Values',
                    'values_desc' => 'Safety first. Transparency always. Customer satisfaction guaranteed.',
                    'tech_title' => 'Technology Focus',
                    'tech_desc' => 'From GPS tracking to OTP-verified bookings — our tech stack makes journeys smoother.',
                ],
                'meta_bn' => [
                    'paragraph_2' => 'ইংরেজি এবং বাংলা উভয় ভাষীদের জন্য একটি দ্বিভাষিক মার্কেটপ্লেস হিসাবে, আমরা যোগাযোগের বাধা দূর করেছি।',
                    'paragraph_3' => 'আমাদের মোবাইল-ফার্স্ট পদ্ধতির অর্থ হলো গো-রাইড সর্বদা আপনার পকেটেই রয়েছে — যখনই আপনার প্রয়োজন তখনই প্রস্তুত।',
                    'vision_title' => 'আমাদের লক্ষ্য',
                    'vision_desc' => 'প্রযুক্তি এবং বিশ্বাসের মাধ্যমে বাংলাদেশের পরিবহন শিল্পের মেরুদণ্ড হয়ে ওঠা।',
                    'mission_title' => 'আমাদের মিশন',
                    'mission_desc' => 'দেশব্যাপী নিরাপদ, পেশাদার গাড়ি ভাড়া সেবা প্রদানের মাধ্যমে যানবাহন মালিকদের ক্ষমতায়ন করা।',
                    'values_title' => 'আমাদের মূল্যবোধ',
                    'values_desc' => 'নিরাপত্তা প্রথম। স্বচ্ছতা সর্বদা। গ্রাহক সন্তুষ্টি গ্যারান্টিযুক্ত।',
                    'tech_title' => 'প্রযুক্তি ফোকাস',
                    'tech_desc' => 'জিপিএস ট্র্যাকিং থেকে ওটিপি-ভেরিফাইড বুকিং — আমাদের প্রযুক্তি যাত্রাকে আরও সহজ করে তোলে।',
                ],
                'active' => true,
            ],
            [
                'page_slug' => 'services',
                'title' => 'Our Premium Services',
                'title_bn' => 'আমাদের প্রিমিয়াম সার্ভিসসমূহ',
                'subtitle' => 'A full range of transport solutions built for every need across Bangladesh.',
                'subtitle_bn' => 'সারা বাংলাদেশে প্রতিটি প্রয়োজনের জন্য তৈরি ট্রান্সপোর্ট সলিউশন।',
                'description' => 'From airport pickups to corporate fleets and curated tours — GoRide has a service that fits your journey.',
                'description_bn' => 'এয়ারপোর্ট পিকআপ থেকে শুরু করে কর্পোরেট ফ্লিট এবং কিউরেটেড ট্যুর — গো-রাইড-এ এমন সার্ভিস রয়েছে যা আপনার ভ্রমণের সাথে মানানসই।',
                'meta' => [
                    'services_list' => [
                        ['icon' => 'fas fa-plane-arrival', 'title' => 'Airport Pickup & Drop', 'desc' => 'Hassle-free transfers to and from Hazrat Shahjalal International Airport.'],
                        ['icon' => 'fas fa-briefcase', 'title' => 'Corporate Fleet', 'desc' => 'Customised transport for businesses — monthly rentals and executive vehicles.'],
                        ['icon' => 'fas fa-heart', 'title' => 'Event & Wedding', 'desc' => 'Make your special occasions unforgettable with our luxury fleet.'],
                        ['icon' => 'fas fa-route', 'title' => 'Inter-City Travel', 'desc' => 'Safe, comfortable long-distance travel across all 64 districts.'],
                        ['icon' => 'fas fa-clock', 'title' => 'Hourly Rentals', 'desc' => 'Flexible hourly booking for city running and multiple meetings.'],
                        ['icon' => 'fas fa-umbrella-beach', 'title' => 'Tours & Travels', 'desc' => 'Explore Bangladesh\'s most beautiful destinations with curated packages.'],
                    ]
                ],
                'meta_bn' => [
                    'services_list' => [
                        ['icon' => 'fas fa-plane-arrival', 'title' => 'এয়ারপোর্ট পিকআপ ও ড্রপ', 'desc' => 'হযরত শাহজালাল আন্তর্জাতিক বিমানবন্দর থেকে ঝামেলামুক্ত যাতায়াত।'],
                        ['icon' => 'fas fa-briefcase', 'title' => 'কর্পোরেট ফ্লিট', 'desc' => 'ব্যবসার জন্য কাস্টমাইজড ট্রান্সপোর্ট — মাসিক ভাড়া এবং এক্সিকিউটিভ গাড়ি।'],
                        ['icon' => 'fas fa-heart', 'title' => 'ইভেন্ট ও ওয়েডিং', 'desc' => 'আমাদের লাক্সারি ফ্লিট দিয়ে আপনার বিশেষ অনুষ্ঠানগুলোকে স্মরণীয় করে তুলুন।'],
                        ['icon' => 'fas fa-route', 'title' => 'আন্তঃজেলা ভ্রমণ', 'desc' => '৬৪টি জেলা জুড়ে নিরাপদ এবং আরামদায়ক দূরপাল্লার ভ্রমণ।'],
                        ['icon' => 'fas fa-clock', 'title' => 'ঘণ্টা ভিত্তিক ভাড়া', 'desc' => 'শহরের ভেতর মিটিং বা ব্যক্তিগত কাজের জন্য নমনীয় ঘণ্টা ভিত্তিক বুকিং।'],
                        ['icon' => 'fas fa-umbrella-beach', 'title' => 'ট্যুর ও ট্রাভেলস', 'desc' => 'কিউরেটেড প্যাকেজের মাধ্যমে বাংলাদেশের সবচেয়ে সুন্দর স্থানগুলো ঘুরে দেখুন।'],
                    ]
                ],
                'active' => true,
            ],
            [
                'page_slug' => 'fleet',
                'title' => 'Our Diverse Fleet',
                'title_bn' => 'আমাদের বৈচিত্র্যময় যানবাহন',
                'subtitle' => 'From economical city sedans to luxury SUVs — the perfect ride for every journey.',
                'subtitle_bn' => 'সাশ্রয়ী সিটি সেডান থেকে শুরু করে লাক্সারি এসইউভি — প্রতিটি ভ্রমণের জন্য উপযুক্ত রাইড।',
                'description' => 'All vehicles are regularly serviced, verified, and driven by licensed professionals.',
                'description_bn' => 'প্রতিটি যানবাহন নিয়মিত সার্ভিসিং করা হয়, ভেরিফাইড এবং লাইসেন্সপ্রাপ্ত পেশাদারদের দ্বারা চালিত হয়।',
                'meta' => [
                    'fleet_list' => [
                        ['image' => 'goride/assets/car.png', 'title' => 'Standard Sedan', 'desc' => 'Toyota Allion, Premier, or Axio. Perfect for 4 passengers.', 'specs' => ['4 Seats', '2 Bags', 'AC', 'WiFi']],
                        ['image' => 'goride/assets/rent_car.png', 'title' => 'Family MPV (Noah)', 'desc' => 'Toyota Noah or Voxy. Ideal for families and groups.', 'specs' => ['7 Seats', '4 Bags', 'AC']],
                        ['image' => 'goride/assets/motor.png', 'title' => 'Microbus (Hiace)', 'desc' => 'Toyota Hiace Grand Cabin. Best for large groups.', 'specs' => ['12 Seats', '6 Bags', 'Dual AC']],
                        ['image' => 'goride/assets/car.png', 'title' => 'Premium SUV', 'desc' => 'Toyota Prado or Harrier. Experience luxury comfort.', 'specs' => ['5 Seats', '4 Bags', 'Luxury']],
                    ]
                ],
                'meta_bn' => [
                    'fleet_list' => [
                        ['image' => 'goride/assets/car.png', 'title' => 'স্ট্যান্ডার্ড সেডান', 'desc' => 'টয়োটা অ্যালিয়ন, প্রিমিয়ার বা এক্সিও। ৪ জন যাত্রীর জন্য উপযুক্ত।', 'specs' => ['৪ সিট', '২ ব্যাগ', 'এসি', 'ওয়াইফাই']],
                        ['image' => 'goride/assets/rent_car.png', 'title' => 'ফ্যামিলি এমপিভি (নোহ)', 'desc' => 'টয়োটা নোহ বা ভক্সি। পরিবার এবং গ্রুপের জন্য আদর্শ।', 'specs' => ['৭ সিট', '৪ ব্যাগ', 'এসি']],
                        ['image' => 'goride/assets/motor.png', 'title' => 'মাইক্রোবাস (হাইয়েস)', 'desc' => 'টয়োটা হাইয়েস গ্র্যান্ড ক্যাবিন। বড় গ্রুপের জন্য সেরা।', 'specs' => ['১২ সিট', '৬ ব্যাগ', 'ডুয়াল এসি']],
                        ['image' => 'goride/assets/car.png', 'title' => 'প্রিমিয়াম এসইউভি', 'desc' => 'টয়োটা প্রাডো বা হ্যারিয়ার। লাক্সারি আরাম অনুভব করুন।', 'specs' => ['৫ সিট', '৪ ব্যাগ', 'লাক্সারি']],
                    ]
                ],
                'active' => true,
            ],
            [
                'page_slug' => 'tours',
                'title' => 'Explore Beautiful Bangladesh',
                'title_bn' => 'সুন্দর বাংলাদেশ এক্সপ্লোর করুন',
                'subtitle' => 'Curated travel packages with premium transport for your perfect getaway.',
                'subtitle_bn' => 'আপনার নিখুঁত ভ্রমণের জন্য প্রিমিয়াম ট্রান্সপোর্ট সহ কিউরেটেড ট্রাভেল প্যাকেজ।',
                'description' => 'Every package includes premium transport, experienced local drivers, and a stress-free journey.',
                'description_bn' => 'প্রতিটি প্যাকেজে প্রিমিয়াম ট্রান্সপোর্ট, অভিজ্ঞ স্থানীয় চালক এবং চাপমুক্ত ভ্রমণের ব্যবস্থা রয়েছে।',
                'meta' => [
                    'tours_list' => [
                        ['image' => 'goride/assets/banner/banner_02.jpg', 'title' => 'Cox\'s Bazar Beach Getaway', 'price' => '12,000', 'meta' => '3 Days 2 Nights', 'badge' => 'Most Popular', 'desc' => 'Relax at the world\'s longest natural sea beach.'],
                        ['image' => 'goride/assets/banner/banner_03.jpg', 'title' => 'Sylhet Tea Garden Adventure', 'price' => '8,500', 'meta' => '2 Days 1 Night', 'badge' => 'Best Value', 'desc' => 'Visit lush green tea gardens and crystal-clear lakes.'],
                        ['image' => 'goride/assets/banner/banner_01.jpg', 'title' => 'Sajek Valley Cloud Journey', 'price' => '15,000', 'meta' => '3 Days 2 Nights', 'badge' => 'Premium', 'desc' => 'Experience the queen of hills and spectacular sunrises.'],
                    ]
                ],
                'meta_bn' => [
                    'tours_list' => [
                        ['image' => 'goride/assets/banner/banner_02.jpg', 'title' => 'কক্সবাজার সমুদ্র সৈকত ভ্রমণ', 'price' => '১২,০০০', 'meta' => '৩ দিন ২ রাত', 'badge' => 'জনপ্রিয়', 'desc' => 'বিশ্বের দীর্ঘতম প্রাকৃতিক সমুদ্র সৈকতে আরাম করুন।'],
                        ['image' => 'goride/assets/banner/banner_03.jpg', 'title' => 'সিলেট চা বাগান অ্যাডভেঞ্চার', 'price' => '৮,৫০০', 'meta' => '২ দিন ১ রাত', 'badge' => 'সেরা মূল্য', 'desc' => 'সবুজ চা বাগান এবং স্বচ্ছ লেকগুলো ঘুরে দেখুন।'],
                        ['image' => 'goride/assets/banner/banner_01.jpg', 'title' => 'সাজেক ভ্যালি মেঘের যাত্রা', 'price' => '১৫,০০০', 'meta' => '৩ দিন ২ রাত', 'badge' => 'প্রিমিয়াম', 'desc' => 'পাহাড়ের রানী এবং চমৎকার সূর্যোদয়ের অভিজ্ঞতা নিন।'],
                    ]
                ],
                'active' => true,
            ],
        ];

        foreach ($contents as $content) {
            PageContent::create($content);
        }
    }
}
