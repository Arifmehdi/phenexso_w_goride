-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 05:06 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phenexso_goride`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `page_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtitle_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `highlights` json DEFAULT NULL,
  `highlights_bn` json DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `meta_bn` json DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `page_slug`, `title`, `title_bn`, `subtitle`, `subtitle_bn`, `description`, `description_bn`, `content`, `content_bn`, `highlights`, `highlights_bn`, `meta`, `meta_bn`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'home', 'GoRide Bangladesh Home', 'গো-রাইড বাংলাদেশ হোম', 'Premium Car Rental Marketplace', 'প্রিমিয়াম গাড়ি ভাড়া মার্কেটপ্লেস', 'The leading transport marketplace for individuals, corporates & tour groups.', 'ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস।', NULL, NULL, NULL, NULL, '{\"hero_span\": \"Across Bangladesh\", \"why_items\": [{\"desc\": \"Every driver and vehicle on our platform is thoroughly verified for safety.\", \"icon\": \"fas fa-shield-halved\", \"title\": \"Verified Drivers & Vehicles\"}, {\"desc\": \"Book, track, and manage rides entirely from your phone.\", \"icon\": \"fas fa-mobile-screen-button\", \"title\": \"Mobile-First Booking\"}, {\"desc\": \"No hidden fees. Know the full fare before you confirm.\", \"icon\": \"fas fa-bangladeshi-taka-sign\", \"title\": \"Transparent Pricing\"}, {\"desc\": \"Early morning flights or late night events — we are available round the clock.\", \"icon\": \"fas fa-clock\", \"title\": \"24/7 Availability\"}, {\"desc\": \"From Dhaka to Teknaf — our network spans every district of Bangladesh.\", \"icon\": \"fas fa-route\", \"title\": \"All 64 Districts\"}, {\"desc\": \"A real support team available via phone and WhatsApp.\", \"icon\": \"fas fa-headset\", \"title\": \"Dedicated Support\"}], \"why_title\": \"The Smarter Way to Travel\", \"hero_badge\": \"Trusted by 5,000+ Customers Nationwide\", \"hero_title\": \"Reliable Car Rental\", \"stats_fleet\": \"1,200+\", \"why_subtitle\": \"We combine local expertise with modern technology to deliver a transport experience that\'s reliable, affordable, and friction-free.\", \"hero_cta_link\": \"#\", \"hero_cta_text\": \"Book a Ride Now\", \"hero_subtitle\": \"The leading transport marketplace for individuals, corporates & tour groups. Mobile-first, bilingual, and always on time.\", \"stats_corporate\": \"150+\", \"stats_customers\": \"5,000+\", \"stats_districts\": \"64\"}', '{\"hero_span\": \"সারা বাংলাদেশে\", \"why_items\": [{\"desc\": \"আমাদের প্ল্যাটফর্মের প্রতিটি চালক এবং যানবাহন নিরাপত্তা যাচাই করা হয়।\", \"icon\": \"fas fa-shield-halved\", \"title\": \"ভেরিফাইড চালক ও যানবাহন\"}, {\"desc\": \"আপনার ফোন থেকে সরাসরি রাইড বুক করুন এবং পরিচালনা করুন।\", \"icon\": \"fas fa-mobile-screen-button\", \"title\": \"মোবাইল-ফার্স্ট বুকিং\"}, {\"desc\": \"কোনো লুকানো ফি নেই। নিশ্চিত করার আগে সম্পূর্ণ ভাড়া জানুন।\", \"icon\": \"fas fa-bangladeshi-taka-sign\", \"title\": \"স্বচ্ছ মূল্য নির্ধারণ\"}, {\"desc\": \"ভোরবেলার ফ্লাইট বা গভীর রাতের ইভেন্ট — আমরা চব্বিশ ঘণ্টা আছি।\", \"icon\": \"fas fa-clock\", \"title\": \"২৪/৭ প্রাপ্যতা\"}, {\"desc\": \"ঢাকা থেকে টেকনাফ — আমাদের নেটওয়ার্ক বাংলাদেশের প্রতিটি জেলায় বিস্তৃত।\", \"icon\": \"fas fa-route\", \"title\": \"সব ৬৪টি জেলা\"}, {\"desc\": \"ফোন এবং হোয়াটসঅ্যাপের মাধ্যমে সার্বক্ষণিক সাপোর্ট টিম।\", \"icon\": \"fas fa-headset\", \"title\": \"ডেডিকেটেড সাপোর্ট\"}], \"why_title\": \"ভ্রমণের স্মার্ট উপায়\", \"hero_badge\": \"সারাদেশে ৫,০০০+ গ্রাহকের বিশ্বস্ত\", \"hero_title\": \"নির্ভরযোগ্য গাড়ি ভাড়া\", \"stats_fleet\": \"১,২০০+\", \"why_subtitle\": \"একটি নির্ভরযোগ্য এবং সাশ্রয়ী পরিবহন অভিজ্ঞতা প্রদানের জন্য আমরা আধুনিক প্রযুক্তির সাথে স্থানীয় দক্ষতাকে একত্রিত করি।\", \"hero_cta_text\": \"রাইড বুক করুন\", \"hero_subtitle\": \"ব্যক্তি, কর্পোরেট এবং ট্যুর গ্রুপের জন্য শীর্ষস্থানীয় ট্রান্সপোর্ট মার্কেটপ্লেস। মোবাইল-ফার্স্ট, দ্বিভাষিক এবং সব সময় সঠিক সময়ে।\", \"stats_corporate\": \"১৫০+\", \"stats_customers\": \"৫,০০০+\", \"stats_districts\": \"৬৪\"}', 1, NULL, NULL, '2026-05-06 12:50:40', '2026-05-06 12:50:40'),
(2, 'about', 'About GoRide Bangladesh', 'গো-রাইড বাংলাদেশ সম্পর্কে', 'Our story, mission, and the values that drive us forward every day.', 'আমাদের গল্প, লক্ষ্য এবং সেই মূল্যবোধ যা আমাদের প্রতিদিন এগিয়ে নিয়ে যায়।', NULL, NULL, 'GoRide Bangladesh was founded with a single, clear mission: to make transportation reliable, accessible, and efficient for every person in Bangladesh — from corporate executives to everyday commuters.', 'গো-রাইড বাংলাদেশ একটি স্পষ্ট লক্ষ্য নিয়ে প্রতিষ্ঠিত হয়েছিল: বাংলাদেশের প্রতিটি মানুষের জন্য — কর্পোরেট এক্সিকিউটিভ থেকে শুরু করে সাধারণ যাত্রী পর্যন্ত — যাতায়াতকে নির্ভরযোগ্য, সহজলভ্য এবং দক্ষ করে তোলা।', '[\"Founded 2026\", \"All 64 Districts\", \"Bilingual Platform\", \"Mobile-First\", \"Verified Drivers\"]', '[\"২০২৬ সালে প্রতিষ্ঠিত\", \"৬৪টি জেলায় সেবা\", \"দ্বিভাষিক প্ল্যাটফর্ম\", \"মোবাইল-ফার্স্ট\", \"ভেরিফাইড চালক\"]', '{\"tech_desc\": \"From GPS tracking to OTP-verified bookings — our tech stack makes journeys smoother.\", \"tech_title\": \"Technology Focus\", \"paragraph_2\": \"As a bilingual marketplace serving both English and Bangla speakers, we have eliminated communication barriers.\", \"paragraph_3\": \"Our mobile-first approach means GoRide is always right in your pocket — ready when you need it.\", \"values_desc\": \"Safety first. Transparency always. Customer satisfaction guaranteed.\", \"vision_desc\": \"To become the backbone of Bangladesh\'s transport industry through technology and trust.\", \"mission_desc\": \"To empower vehicle owners while giving safe, professional car rental services nationwide.\", \"values_title\": \"Our Values\", \"vision_title\": \"Our Vision\", \"mission_title\": \"Our Mission\"}', '{\"tech_desc\": \"জিপিএস ট্র্যাকিং থেকে ওটিপি-ভেরিফাইড বুকিং — আমাদের প্রযুক্তি যাত্রাকে আরও সহজ করে তোলে।\", \"tech_title\": \"প্রযুক্তি ফোকাস\", \"paragraph_2\": \"ইংরেজি এবং বাংলা উভয় ভাষীদের জন্য একটি দ্বিভাষিক মার্কেটপ্লেস হিসাবে, আমরা যোগাযোগের বাধা দূর করেছি।\", \"paragraph_3\": \"আমাদের মোবাইল-ফার্স্ট পদ্ধতির অর্থ হলো গো-রাইড সর্বদা আপনার পকেটেই রয়েছে — যখনই আপনার প্রয়োজন তখনই প্রস্তুত।\", \"values_desc\": \"নিরাপত্তা প্রথম। স্বচ্ছতা সর্বদা। গ্রাহক সন্তুষ্টি গ্যারান্টিযুক্ত।\", \"vision_desc\": \"প্রযুক্তি এবং বিশ্বাসের মাধ্যমে বাংলাদেশের পরিবহন শিল্পের মেরুদণ্ড হয়ে ওঠা।\", \"mission_desc\": \"দেশব্যাপী নিরাপদ, পেশাদার গাড়ি ভাড়া সেবা প্রদানের মাধ্যমে যানবাহন মালিকদের ক্ষমতায়ন করা।\", \"values_title\": \"আমাদের মূল্যবোধ\", \"vision_title\": \"আমাদের লক্ষ্য\", \"mission_title\": \"আমাদের মিশন\"}', 1, NULL, NULL, '2026-05-06 12:50:40', '2026-05-06 12:50:40'),
(3, 'services', 'Our Premium Services', 'আমাদের প্রিমিয়াম সার্ভিসসমূহ', 'A full range of transport solutions built for every need across Bangladesh.', 'সারা বাংলাদেশে প্রতিটি প্রয়োজনের জন্য তৈরি ট্রান্সপোর্ট সলিউশন।', 'From airport pickups to corporate fleets and curated tours — GoRide has a service that fits your journey.', 'এয়ারপোর্ট পিকআপ থেকে শুরু করে কর্পোরেট ফ্লিট এবং কিউরেটেড ট্যুর — গো-রাইড-এ এমন সার্ভিস রয়েছে যা আপনার ভ্রমণের সাথে মানানসই।', NULL, NULL, NULL, NULL, '{\"services_list\": [{\"desc\": \"Hassle-free transfers to and from Hazrat Shahjalal International Airport.\", \"icon\": \"fas fa-plane-arrival\", \"title\": \"Airport Pickup & Drop\"}, {\"desc\": \"Customised transport for businesses — monthly rentals and executive vehicles.\", \"icon\": \"fas fa-briefcase\", \"title\": \"Corporate Fleet\"}, {\"desc\": \"Make your special occasions unforgettable with our luxury fleet.\", \"icon\": \"fas fa-heart\", \"title\": \"Event & Wedding\"}, {\"desc\": \"Safe, comfortable long-distance travel across all 64 districts.\", \"icon\": \"fas fa-route\", \"title\": \"Inter-City Travel\"}, {\"desc\": \"Flexible hourly booking for city running and multiple meetings.\", \"icon\": \"fas fa-clock\", \"title\": \"Hourly Rentals\"}, {\"desc\": \"Explore Bangladesh\'s most beautiful destinations with curated packages.\", \"icon\": \"fas fa-umbrella-beach\", \"title\": \"Tours & Travels\"}]}', '{\"services_list\": [{\"desc\": \"হযরত শাহজালাল আন্তর্জাতিক বিমানবন্দর থেকে ঝামেলামুক্ত যাতায়াত।\", \"icon\": \"fas fa-plane-arrival\", \"title\": \"এয়ারপোর্ট পিকআপ ও ড্রপ\"}, {\"desc\": \"ব্যবসার জন্য কাস্টমাইজড ট্রান্সপোর্ট — মাসিক ভাড়া এবং এক্সিকিউটিভ গাড়ি।\", \"icon\": \"fas fa-briefcase\", \"title\": \"কর্পোরেট ফ্লিট\"}, {\"desc\": \"আমাদের লাক্সারি ফ্লিট দিয়ে আপনার বিশেষ অনুষ্ঠানগুলোকে স্মরণীয় করে তুলুন।\", \"icon\": \"fas fa-heart\", \"title\": \"ইভেন্ট ও ওয়েডিং\"}, {\"desc\": \"৬৪টি জেলা জুড়ে নিরাপদ এবং আরামদায়ক দূরপাল্লার ভ্রমণ।\", \"icon\": \"fas fa-route\", \"title\": \"আন্তঃজেলা ভ্রমণ\"}, {\"desc\": \"শহরের ভেতর মিটিং বা ব্যক্তিগত কাজের জন্য নমনীয় ঘণ্টা ভিত্তিক বুকিং।\", \"icon\": \"fas fa-clock\", \"title\": \"ঘণ্টা ভিত্তিক ভাড়া\"}, {\"desc\": \"কিউরেটেড প্যাকেজের মাধ্যমে বাংলাদেশের সবচেয়ে সুন্দর স্থানগুলো ঘুরে দেখুন।\", \"icon\": \"fas fa-umbrella-beach\", \"title\": \"ট্যুর ও ট্রাভেলস\"}]}', 1, NULL, NULL, '2026-05-06 12:50:40', '2026-05-06 12:50:40'),
(4, 'fleet', 'Our Diverse Fleet', 'আমাদের বৈচিত্র্যময় যানবাহন', 'From economical city sedans to luxury SUVs — the perfect ride for every journey.', 'সাশ্রয়ী সিটি সেডান থেকে শুরু করে লাক্সারি এসইউভি — প্রতিটি ভ্রমণের জন্য উপযুক্ত রাইড।', 'All vehicles are regularly serviced, verified, and driven by licensed professionals.', 'প্রতিটি যানবাহন নিয়মিত সার্ভিসিং করা হয়, ভেরিফাইড এবং লাইসেন্সপ্রাপ্ত পেশাদারদের দ্বারা চালিত হয়।', NULL, NULL, NULL, NULL, '{\"fleet_list\": [{\"desc\": \"Toyota Allion, Premier, or Axio. Perfect for 4 passengers.\", \"image\": \"goride/assets/car.png\", \"specs\": [\"4 Seats\", \"2 Bags\", \"AC\", \"WiFi\"], \"title\": \"Standard Sedan\"}, {\"desc\": \"Toyota Noah or Voxy. Ideal for families and groups.\", \"image\": \"goride/assets/rent_car.png\", \"specs\": [\"7 Seats\", \"4 Bags\", \"AC\"], \"title\": \"Family MPV (Noah)\"}, {\"desc\": \"Toyota Hiace Grand Cabin. Best for large groups.\", \"image\": \"goride/assets/motor.png\", \"specs\": [\"12 Seats\", \"6 Bags\", \"Dual AC\"], \"title\": \"Microbus (Hiace)\"}, {\"desc\": \"Toyota Prado or Harrier. Experience luxury comfort.\", \"image\": \"goride/assets/car.png\", \"specs\": [\"5 Seats\", \"4 Bags\", \"Luxury\"], \"title\": \"Premium SUV\"}]}', '{\"fleet_list\": [{\"desc\": \"টয়োটা অ্যালিয়ন, প্রিমিয়ার বা এক্সিও। ৪ জন যাত্রীর জন্য উপযুক্ত।\", \"image\": \"goride/assets/car.png\", \"specs\": [\"৪ সিট\", \"২ ব্যাগ\", \"এসি\", \"ওয়াইফাই\"], \"title\": \"স্ট্যান্ডার্ড সেডান\"}, {\"desc\": \"টয়োটা নোহ বা ভক্সি। পরিবার এবং গ্রুপের জন্য আদর্শ।\", \"image\": \"goride/assets/rent_car.png\", \"specs\": [\"৭ সিট\", \"৪ ব্যাগ\", \"এসি\"], \"title\": \"ফ্যামিলি এমপিভি (নোহ)\"}, {\"desc\": \"টয়োটা হাইয়েস গ্র্যান্ড ক্যাবিন। বড় গ্রুপের জন্য সেরা।\", \"image\": \"goride/assets/motor.png\", \"specs\": [\"১২ সিট\", \"৬ ব্যাগ\", \"ডুয়াল এসি\"], \"title\": \"মাইক্রোবাস (হাইয়েস)\"}, {\"desc\": \"টয়োটা প্রাডো বা হ্যারিয়ার। লাক্সারি আরাম অনুভব করুন।\", \"image\": \"goride/assets/car.png\", \"specs\": [\"৫ সিট\", \"৪ ব্যাগ\", \"লাক্সারি\"], \"title\": \"প্রিমিয়াম এসইউভি\"}]}', 1, NULL, NULL, '2026-05-06 12:50:40', '2026-05-06 12:50:40'),
(5, 'tours', 'Explore Beautiful Bangladesh', 'সুন্দর বাংলাদেশ এক্সপ্লোর করুন', 'Curated travel packages with premium transport for your perfect getaway.', 'আপনার নিখুঁত ভ্রমণের জন্য প্রিমিয়াম ট্রান্সপোর্ট সহ কিউরেটেড ট্রাভেল প্যাকেজ।', 'Every package includes premium transport, experienced local drivers, and a stress-free journey.', 'প্রতিটি প্যাকেজে প্রিমিয়াম ট্রান্সপোর্ট, অভিজ্ঞ স্থানীয় চালক এবং চাপমুক্ত ভ্রমণের ব্যবস্থা রয়েছে।', NULL, NULL, NULL, NULL, '{\"tours_list\": [{\"desc\": \"Relax at the world\'s longest natural sea beach.\", \"meta\": \"3 Days 2 Nights\", \"badge\": \"Most Popular\", \"image\": \"goride/assets/banner/banner_02.jpg\", \"price\": \"12,000\", \"title\": \"Cox\'s Bazar Beach Getaway\"}, {\"desc\": \"Visit lush green tea gardens and crystal-clear lakes.\", \"meta\": \"2 Days 1 Night\", \"badge\": \"Best Value\", \"image\": \"goride/assets/banner/banner_03.jpg\", \"price\": \"8,500\", \"title\": \"Sylhet Tea Garden Adventure\"}, {\"desc\": \"Experience the queen of hills and spectacular sunrises.\", \"meta\": \"3 Days 2 Nights\", \"badge\": \"Premium\", \"image\": \"goride/assets/banner/banner_01.jpg\", \"price\": \"15,000\", \"title\": \"Sajek Valley Cloud Journey\"}]}', '{\"tours_list\": [{\"desc\": \"বিশ্বের দীর্ঘতম প্রাকৃতিক সমুদ্র সৈকতে আরাম করুন।\", \"meta\": \"৩ দিন ২ রাত\", \"badge\": \"জনপ্রিয়\", \"image\": \"goride/assets/banner/banner_02.jpg\", \"price\": \"১২,০০০\", \"title\": \"কক্সবাজার সমুদ্র সৈকত ভ্রমণ\"}, {\"desc\": \"সবুজ চা বাগান এবং স্বচ্ছ লেকগুলো ঘুরে দেখুন।\", \"meta\": \"২ দিন ১ রাত\", \"badge\": \"সেরা মূল্য\", \"image\": \"goride/assets/banner/banner_03.jpg\", \"price\": \"৮,৫০০\", \"title\": \"সিলেট চা বাগান অ্যাডভেঞ্চার\"}, {\"desc\": \"পাহাড়ের রানী এবং চমৎকার সূর্যোদয়ের অভিজ্ঞতা নিন।\", \"meta\": \"৩ দিন ২ রাত\", \"badge\": \"প্রিমিয়াম\", \"image\": \"goride/assets/banner/banner_01.jpg\", \"price\": \"১৫,০০০\", \"title\": \"সাজেক ভ্যালি মেঘের যাত্রা\"}]}', 1, NULL, NULL, '2026-05-06 12:50:40', '2026-05-06 12:50:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_contents_page_slug_unique` (`page_slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
