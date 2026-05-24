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
                'description' => 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh.',
                'description_bn' => 'গো-রাইড বাংলাদেশ একটি স্পষ্ট লক্ষ্য নিয়ে প্রতিষ্ঠিত হয়েছিল: বাংলাদেশের প্রতিটি মানুষের জন্য যাতায়াতকে নির্ভরযোগ্য, সহজলভ্য এবং দক্ষ করে তোলা।',
                'content' => 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh — from corporate executives to everyday commuters.',
                'content_bn' => 'গো-রাইড বাংলাদেশ একটি স্পষ্ট লক্ষ্য নিয়ে প্রতিষ্ঠিত হয়েছিল: বাংলাদেশের প্রতিটি মানুষের জন্য — কর্পোরেট এক্সিকিউটিভ থেকে শুরু করে সাধারণ যাত্রী পর্যন্ত — যাতায়াতকে নির্ভরযোগ্য, সহজলভ্য এবং দক্ষ করে তোলা।',
                'highlights' => ['Founded 2026', 'All 64 Districts', 'Bilingual Platform', 'Mobile-First', 'Verified Drivers'],
                'highlights_bn' => ['২০২৬ সালে প্রতিষ্ঠিত', '৬৪টি জেলায় সেবা', 'দ্বিভাষিক প্ল্যাটফর্ম', 'মোবাইল-ফার্স্ট', 'ভেরিফাইড চালক'],
                'meta' => [
                    'paragraph_2' => 'As a bilingual marketplace serving both English and Bangla speakers, we have eliminated communication barriers.',
                    'paragraph_3' => 'Our mobile-first approach means GoRide is always right in your pocket — ready when you need it.',
                    'vm_cards' => [
                        ['icon' => 'fas fa-eye', 'title' => 'Our Vision', 'description' => 'To become the backbone of Bangladesh\'s transport industry through technology and trust.', 'title_bn' => 'আমাদের ভিশন', 'description_bn' => 'প্রযুক্তি এবং বিশ্বাসের মাধ্যমে বাংলাদেশের পরিবহন শিল্পের মেরুদণ্ড হয়ে ওঠা।'],
                        ['icon' => 'fas fa-bullseye', 'title' => 'Our Mission', 'description' => 'To empower vehicle owners while giving safe, professional car rental services nationwide.', 'title_bn' => 'আমাদের মিশন', 'description_bn' => 'দেশব্যাপী নিরাপদ, পেশাদার গাড়ি ভাড়া সেবা প্রদানের মাধ্যমে যানবাহন মালিকদের ক্ষমতায়ন করা।'],
                        ['icon' => 'fas fa-heart', 'title' => 'Our Values', 'description' => 'Safety first. Transparency always. Customer satisfaction guaranteed.', 'title_bn' => 'আমাদের মূল্যবোধ', 'description_bn' => 'নিরাপত্তা প্রথম। স্বচ্ছতা সর্বদা। গ্রাহক সন্তুষ্টি গ্যারান্টিযুক্ত।'],
                    ]
                ],
                'meta_bn' => [
                    'paragraph_2' => 'ইংরেজি এবং বাংলা উভয় ভাষীদের জন্য একটি দ্বিভাষিক মার্কেটপ্লেস হিসাবে, আমরা যোগাযোগের বাধা দূর করেছি।',
                    'paragraph_3' => 'আমাদের মোবাইল-ফার্স্ট পদ্ধতির অর্থ হলো গো-রাইড সর্বদা আপনার পকেটেই রয়েছে — যখনই আপনার প্রয়োজন তখনই প্রস্তুত।',
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
                        ['icon' => 'fas fa-plane-arrival', 'title' => 'Airport Pickup & Drop', 'desc' => 'Hassle-free transfers to and from Hazrat Shahjalal International Airport.', 'title_bn' => 'এয়ারপোর্ট পিকআপ ও ড্রপ', 'desc_bn' => 'হযরত শাহজালাল আন্তর্জাতিক বিমানবন্দর থেকে ঝামেলামুক্ত যাতায়াত।', 'btn_text' => 'Book Now', 'btn_text_bn' => 'বুক করুন', 'link' => '/login'],
                        ['icon' => 'fas fa-briefcase', 'title' => 'Corporate Fleet', 'desc' => 'Customised transport for businesses — monthly rentals and executive vehicles.', 'title_bn' => 'কর্পোরেট ফ্লিট', 'desc_bn' => 'ব্যবসার জন্য কাস্টমাইজড ট্রান্সপোর্ট — মাসিক ভাড়া এবং এক্সিকিউটিভ গাড়ি।', 'btn_text' => 'Join Now', 'btn_text_bn' => 'যোগ দিন', 'link' => '/registration/corporate'],
                        ['icon' => 'fas fa-heart', 'title' => 'Event & Wedding', 'desc' => 'Make your special occasions unforgettable with our luxury fleet.', 'title_bn' => 'ইভেন্ট ও ওয়েডিং', 'desc_bn' => 'আমাদের লাক্সারি ফ্লিট দিয়ে আপনার বিশেষ অনুষ্ঠানগুলোকে স্মরণীয় করে তুলুন।', 'btn_text' => 'View Fleet', 'btn_text_bn' => 'ফ্লিট দেখুন', 'link' => '/fleet'],
                        ['icon' => 'fas fa-route', 'title' => 'Inter-City Travel', 'desc' => 'Safe, comfortable long-distance travel across all 64 districts.', 'title_bn' => 'আন্তঃজেলা ভ্রমণ', 'desc_bn' => '৬৪টি জেলা জুড়ে নিরাপদ এবং আরামদায়ক দূরপাল্লার ভ্রমণ।', 'btn_text' => 'Book Trip', 'btn_text_bn' => 'ট্রিপ বুক করুন', 'link' => '/login'],
                        ['icon' => 'fas fa-clock', 'title' => 'Hourly Rentals', 'desc' => 'Flexible hourly booking for city running and multiple meetings.', 'title_bn' => 'ঘণ্টা ভিত্তিক ভাড়া', 'desc_bn' => 'শহরের ভেতর মিটিং বা ব্যক্তিগত কাজের জন্য নমনীয় ঘণ্টা ভিত্তিক বুকিং।', 'btn_text' => 'Rent Now', 'btn_text_bn' => 'ভাড়া করুন', 'link' => '/login'],
                        ['icon' => 'fas fa-umbrella-beach', 'title' => 'Tours & Travels', 'desc' => 'Explore Bangladesh\'s most beautiful destinations with curated packages.', 'title_bn' => 'ট্যুর ও ট্রাভেলস', 'desc_bn' => 'কিউরেটেড প্যাকেজের মাধ্যমে বাংলাদেশের সবচেয়ে সুন্দর স্থানগুলো ঘুরে দেখুন।', 'btn_text' => 'View Tours', 'btn_text_bn' => 'ট্যুর দেখুন', 'link' => '/tours'],
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
                    'fleet_items' => [
                        ['image' => 'goride/assets/car.png', 'title' => 'Standard Sedan', 'title_bn' => 'স্ট্যান্ডার্ড সেডান', 'desc' => 'Toyota Allion, Premier, or Axio. Perfect for 4 passengers.', 'desc_bn' => 'টয়োটা অ্যালিয়ন, প্রিমিয়ার বা এক্সিও। ৪ জন যাত্রীর জন্য উপযুক্ত।', 'specs' => ['4 Seats', '2 Bags', 'AC', 'WiFi'], 'specs_bn' => ['৪ সিট', '২ ব্যাগ', 'এসি', 'ওয়াইফাই']],
                        ['image' => 'goride/assets/rent_car.png', 'title' => 'Family MPV (Noah)', 'title_bn' => 'ফ্যামিলি এমপিভি (নোহ)', 'desc' => 'Toyota Noah or Voxy. Ideal for families and groups.', 'desc_bn' => 'টয়োটা নোহ বা ভক্সি। পরিবার এবং গ্রুপের জন্য আদর্শ।', 'specs' => ['7 Seats', '4 Bags', 'AC'], 'specs_bn' => ['৭ সিট', '৪ ব্যাগ', 'এসি']],
                        ['image' => 'goride/assets/motor.png', 'title' => 'Microbus (Hiace)', 'title_bn' => 'মাইক্রোবাস (হাইয়েস)', 'desc' => 'Toyota Hiace Grand Cabin. Best for large groups.', 'desc_bn' => 'টয়োটা হাইয়েস গ্র্যান্ড ক্যাবিন। বড় গ্রুপের জন্য সেরা।', 'specs' => ['12 Seats', '6 Bags', 'Dual AC'], 'specs_bn' => ['১২ সিট', '৬ ব্যাগ', 'ডুয়াল এসি']],
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
                    'tour_items' => [
                        ['image' => 'goride/assets/banner/banner_02.jpg', 'title' => 'Cox\'s Bazar Beach Getaway', 'title_bn' => 'কক্সবাজার সমুদ্র সৈকত ভ্রমণ', 'price' => '12,000', 'meta' => '3 Days 2 Nights', 'meta_bn' => '৩ দিন ২ রাত', 'badge' => 'Most Popular', 'badge_bn' => 'জনপ্রিয়', 'desc' => 'Relax at the world\'s longest natural sea beach.', 'desc_bn' => 'বিশ্বের দীর্ঘতম প্রাকৃতিক সমুদ্র সৈকতে আরাম করুন।'],
                        ['image' => 'goride/assets/banner/banner_03.jpg', 'title' => 'Sylhet Tea Garden Adventure', 'title_bn' => 'সিলেট চা বাগান অ্যাডভেঞ্চার', 'price' => '8,500', 'meta' => '2 Days 1 Night', 'meta_bn' => '২ দিন ১ রাত', 'badge' => 'Best Value', 'badge_bn' => 'সেরা মূল্য', 'desc' => 'Visit lush green tea gardens and crystal-clear lakes.', 'desc_bn' => 'সবুজ চা বাগান এবং স্বচ্ছ লেকগুলো ঘুরে দেখুন।'],
                        ['image' => 'goride/assets/banner/banner_01.jpg', 'title' => 'Sajek Valley Cloud Journey', 'title_bn' => 'সাজেক ভ্যালি মেঘের যাত্রা', 'price' => '15,000', 'meta' => '3 Days 2 Nights', 'meta_bn' => '৩ দিন ২ রাত', 'badge' => 'Premium', 'badge_bn' => 'প্রিমিয়াম', 'desc' => 'Experience the queen of hills and spectacular sunrises.', 'desc_bn' => 'পাহাড়ের রানী এবং চমৎকার সূর্যোদয়ের অভিজ্ঞতা নিন।'],
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
