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
-- Table structure for table `ambulance_services`
--

CREATE TABLE `ambulance_services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagline` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `editor` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulance_services`
--

INSERT INTO `ambulance_services` (`id`, `name`, `tagline`, `mobile`, `email`, `image`, `address`, `excerpt`, `description`, `active`, `editor`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'CityCare Ambulance', '24/7 Emergency', '01711-111111', 'cityCare@gmail.com', '1756267306.png', 'Dhaka', 'CityCare Ambulance', '<p>CityCare Ambulance</p>', 1, 1, 1, 1, '2025-08-26 22:01:46', '2025-08-26 22:13:05'),
(2, 'SafeRide Ambulance', 'Long Distance', '01644-444444', 'safeRide@gmail.com', '1756523712.jpg', 'Dhaka', 'Dhaka', '<p>Dhaka</p>', 1, 1, 1, NULL, '2025-08-29 21:15:13', '2025-08-29 21:15:13'),
(3, 'HealthLine Ambulance', 'ICU Support', '01933-333333', 'healthLine@gmail.com', '1756523827.jpeg', 'Dhaka', 'Dhaka', '<p>Dhaka</p>', 1, 1, 1, NULL, '2025-08-29 21:17:07', '2025-08-29 21:17:07'),
(4, 'Rapid Response', 'AC / Non-AC', '01822-222222', 'rapid@gmail.com', '1756523882.jpeg', 'Dhaka', 'Dhaka', '<p>Dhaka</p>', 1, 1, 1, NULL, '2025-08-29 21:18:02', '2025-08-29 21:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `addedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Rakib (Engineer)', 1, '2023-02-19 04:45:43', '2023-02-19 04:45:43'),
(2, 'Masud(EEE)', 1, '2023-02-19 04:45:43', '2023-02-19 04:45:43'),
(3, 'Murrtoza(CSE)', 1, '2023-02-19 04:51:11', '2023-02-19 04:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `bisesoggo_categories`
--

CREATE TABLE `bisesoggo_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `drag_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bisesoggo_categories`
--

INSERT INTO `bisesoggo_categories` (`id`, `name_en`, `name_bn`, `excerpt_en`, `excerpt_bn`, `drag_id`, `image`, `active`, `featured`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Milk & Desert', 'দুধ ও দুগ্ধজাত পন্য', 'Pure milk from cows raised on natural food in a rural environment near your home in Dhaka. The calf\'s mouth is not placed in a deep bowl, so there is no possibility of saliva or dirt from the calf\'s mouth mixing with the milk. Our skilled delivery men go to your home within 2 hours of milking. All our yogurt, sweets, incense, ghee, butter are made from this excellent milk.', 'ঢাকার মধ্যে আপনার বাসার পাশে গ্রামীন পরিবেশে ন্যাচারাল খাদ্যে পালিত গাভীর বিশুদ্ধ দুধ। গভীর বাটে বাছুরের মুখ লাগানো হয় না, তাই বাছুরের মুখের লালা বা ময়লা দুধে মিশে যাবার সম্ভবনা নাই। দুধ দোয়ানোর ২ ঘন্টার মধ্যে  আপনার বাসায় চলে যায় আমাদের দক্ষ ডেলিভারী ম্যানরা। আমাদের দই, মিষ্টি, লাবান, ঘি, বাটার সকল কিছুই এই উৎকৃষ্ট দুধ থেকে তৈরী৷', 0, '1761142241.png', 1, 1, 1, 1, '2023-02-28 06:12:08', '2025-10-23 00:24:57'),
(2, 'Meat and eggs', NULL, 'Local bulls, sheep, local geese and pigeons raised on local food and golden chicken meat. In addition, local duck and layer chicken eggs.', NULL, 0, '1761142230.png', 1, 1, 1, 1, '2023-02-28 06:44:59', '2025-10-22 08:10:30'),
(3, 'Spices', NULL, 'We are marketing 11 types of spices including the best turmeric and chili selected from North Bengal such as: turmeric powder, chili powder, cumin powder, coriander powder, whole coriander, whole cumin, whole cinnamon, whole cardamom, whole cloves, whole pepper, whole black cumin. We request you to check our North Bengal Dairy\'s powdered spices for daily delicious cooking.', NULL, 0, '1761141460.webp', 1, 1, 1, 1, '2023-03-22 03:48:20', '2025-10-22 07:57:40'),
(8, 'Mustard oil', NULL, 'A wooden mill in the heart of Dhaka, that too next to your home. Here, mustard oil is made by crushing local red mustard in a cold press. Avoid risks in cooking and use our mustard oil without fear.', NULL, 0, '1761139912.jpeg', 1, 1, 1, 1, '2023-03-22 04:07:52', '2025-10-22 07:31:52'),
(25, 'aa', 'bb', 'ccc', 'dd', 0, '1761154448.png', 1, 0, 1, NULL, '2025-10-22 11:34:08', '2025-10-22 11:34:08'),
(26, 'ডিপার্টমেন্ট নাম (বাংলা) aa', 'ডিপার্টমেন্ট নাম (বাংলা) bb', 'ডিপার্টমেন্ট নাম (বাংলা)  cc', 'ডিপার্টমেন্ট নাম (বাংলা) dd', 0, '1761154657.png', 1, 1, 1, NULL, '2025-10-22 11:37:37', '2025-10-22 11:37:37'),
(27, 'BisesoggoCategory', 'দুধ ও দুগ্ধজাত পন্য', 'Pure milk from cows raised on natural food in a rural environment near your home in Dhaka. The calf\'s mouth is not placed in a deep bowl, so there is no possibility of saliva or dirt from the calf\'s mouth mixing with the milk. Our skilled delivery men go to your home within 2 hours of milking. All our yogurt, sweets, incense, ghee, butter are made from this excellent milk.', 'ঢাকার মধ্যে আপনার বাসার পাশে গ্রামীন পরিবেশে ন্যাচারাল খাদ্যে পালিত গাভীর বিশুদ্ধ দুধ। গভীর বাটে বাছুরের মুখ লাগানো হয় না, তাই বাছুরের মুখের লালা বা ময়লা দুধে মিশে যাবার সম্ভবনা নাই। দুধ দোয়ানোর ২ ঘ 36ন্টার মধ্যে  আপনার বাসায় চলে যায় আমাদের দক্ষ ডেলিভারী ম্যানরা। আমাদের দই, মিষ্টি, লাবান, ঘি, বাটার সকল কিছুই এই উৎকৃষ্ট দুধ থেকে তৈরী৷ 036', 0, '1761200802.webp', 1, 0, 1, NULL, '2025-10-23 00:26:43', '2025-10-23 00:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(7, 'Category-10', 1, 1, 1, '2023-01-27 23:32:20', '2025-11-18 14:10:32'),
(9, 'category 2', 1, 1, 1, '2023-02-16 00:37:20', '2023-03-07 05:36:22'),
(10, 'category 3', 1, 1, 1, '2023-02-16 00:37:26', '2023-03-07 05:36:31'),
(11, 'category 4', 1, 1, 1, '2023-02-16 00:37:32', '2023-03-07 05:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `feature_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `editor` tinyint NOT NULL DEFAULT '1',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `featured_slider` tinyint(1) NOT NULL DEFAULT '1',
  `view_count` int NOT NULL DEFAULT '0',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `description`, `excerpt`, `tags`, `feature_image`, `active`, `editor`, `status`, `featured_slider`, `view_count`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(54, 9, 'Changing Lives, One Volunteer at a Time', '<p data-start=\"5022\" data-end=\"5302\">Behind every child educated, every family helped, and every life improved, there is a volunteer giving their time selflessly. North Bangla Foundation thrives because of these dedicated individuals who believe in the power of compassion and collective action.</p>\r\n<p data-start=\"5304\" data-end=\"5687\">Volunteers work in schools, health camps, disaster relief programs, and community development initiatives. They teach, organize resources, distribute aid, and inspire hope in the communities they serve. One volunteer shared, <em data-start=\"5529\" data-end=\"5685\">“Seeing children learn, families smile, and communities rebuild gives me more joy than I could ever imagine. It’s a privilege to be part of this mission.”</em></p>\r\n<p data-start=\"5689\" data-end=\"5964\">The diversity of volunteers—students, professionals, and retirees—brings unique perspectives and energy to our programs. Their dedication enables North Bangla Foundation to reach remote villages, organize impactful events, and maintain consistent support for those in need.</p>\r\n<p data-start=\"5966\" data-end=\"6252\">By fostering a culture of service, North Bangla Foundation encourages others to join in and make a difference. Every volunteer contributes to the foundation’s mission of creating lasting change, proving that when people come together, even the smallest efforts can have a huge impact.</p>\r\n<hr data-start=\"6254\" data-end=\"6257\">\r\n<p data-start=\"6259\" data-end=\"6496\">If you want, I can <strong data-start=\"6278\" data-end=\"6309\">create 6–10 more long blogs</strong>, including <strong data-start=\"6321\" data-end=\"6404\">realistic stories, donor highlights, event updates, and beneficiary experiences</strong>, so your website’s blog/news section looks <strong data-start=\"6448\" data-end=\"6493\">fully active, professional, and authentic</strong>.</p>', 'Volunteers are at the core of North Bangla Foundation’s mission, contributing their time, energy, and skills to transform communities across Northern Bangladesh.', NULL, '260107070849.jpg', 1, 1, 'published', 1, 103, 1, 1, '2023-01-28 00:37:55', '2026-04-01 10:44:12'),
(57, 10, 'Standing Strong During Floods and Emergencies', '<p data-start=\"3559\" data-end=\"3840\">Floods, storms, and other natural disasters often hit Northern Bangladesh with little warning, leaving families vulnerable and communities in crisis. North Bangla Foundation responds swiftly during these emergencies, providing essential aid to those affected.</p>\r\n<p data-start=\"3842\" data-end=\"4201\">Our disaster relief teams distribute food packages, clean water, clothing, and temporary shelters to ensure that families can survive the immediate aftermath. But our support goes beyond immediate aid. We help communities recover by rebuilding homes, repairing schools, and restoring livelihoods, ensuring that the path to normalcy is as smooth as possible.</p>\r\n<p data-start=\"4203\" data-end=\"4471\">Every emergency teaches us the power of community. Volunteers, donors, and local leaders work hand-in-hand to coordinate efforts efficiently and effectively. The gratitude and hope we see in the faces of those we help are a constant reminder of why our work matters.</p>\r\n<p data-start=\"4473\" data-end=\"4671\">North Bangla Foundation’s disaster relief programs are not just about responding—they are about preparing communities to face future challenges, build resilience, and recover stronger than before.</p>', 'North Bangla Foundation provides emergency relief to families affected by natural disasters, delivering food, water, and shelter while helping communities rebuild.', NULL, '260107070713.webp', 1, 1, 'published', 1, 134, 1, 1, '2023-01-28 00:56:11', '2026-04-08 16:09:24'),
(58, 10, 'Empowering Children Through Learning', '<p data-start=\"2000\" data-end=\"2250\">Education is more than learning letters and numbers—it is the key to breaking the cycle of poverty. North Bangla Foundation believes every child deserves a chance to build a bright future, regardless of their economic situation.</p>\r\n<p data-start=\"2252\" data-end=\"2529\">Through our education programs, we provide school materials, organize tutoring sessions, and run workshops that help children develop both academic and life skills. We work closely with local teachers and volunteers to ensure that every child receives personalized attention.</p>\r\n<p data-start=\"2531\" data-end=\"2833\">Beyond traditional education, we focus on creativity, critical thinking, and confidence-building. Many children in remote communities have never had access to books, computers, or extracurricular activities. Our programs aim to fill this gap, giving children the tools to not just survive but thrive.</p>\r\n<p data-start=\"2835\" data-end=\"3076\">Parents and community members are also engaged in our initiatives. By raising awareness about the importance of education, we encourage families to support their children’s schooling, creating a community-wide culture that values learning.</p>\r\n<p data-start=\"3078\" data-end=\"3216\">Through education, North Bangla Foundation is planting seeds of hope that will grow into a brighter, more empowered Northern Bangladesh.</p>', 'North Bangla Foundation focuses on providing quality education to children in underprivileged communities, giving them opportunities to dream, learn, and grow.', NULL, '260107070551.jpg', 1, 1, 'published', 1, 46, 1, 1, '2023-01-28 01:03:36', '2026-04-01 10:41:39'),
(59, 9, 'Bringing Healthcare to Every Corner', '<p data-start=\"498\" data-end=\"900\">In many remote areas of Northern Bangladesh, families struggle to access even basic medical care. North Bangla Foundation has made it our mission to bring healthcare to those who need it the most. Through our mobile health camps, we deploy doctors, nurses, and volunteers directly into villages, providing free medical checkups, medications, and guidance on hygiene and nutrition.</p>\r\n<p data-start=\"902\" data-end=\"1396\">Our healthcare initiatives don’t stop at treating illnesses. We educate communities about preventive care, sanitation, and maternal-child health, equipping families with knowledge to lead healthier lives. In the past year alone, over 500 families have benefited from our health camps, receiving life-saving assistance and reassurance. By combining immediate care with education, we aim to reduce disease, improve wellbeing, and give communities the tools to sustain good health independently.</p>\r\n<p data-start=\"1398\" data-end=\"1658\">With each mobile camp, we see hope return to faces that had once known despair. Volunteers and donors play a critical role in making this possible. Together, we are bridging the gap between healthcare access and those who need it most, one village at a time.</p>', 'North Bangla Foundation organizes mobile health camps to provide essential medical care, medicines, and health education to underserved communities in Northern Bangladesh.', NULL, '260107070420.jpg', 1, 1, 'published', 1, 48, 1, 1, '2023-01-28 01:24:47', '2026-04-04 22:31:03'),
(68, 7, 'How North Bangla Foundation is Transforming Communities', '<p data-start=\"551\" data-end=\"575\"><strong data-start=\"551\" data-end=\"573\">Full Blog Content:</strong></p>\r\n<p data-start=\"577\" data-end=\"997\">In the heart of Northern Bangladesh, countless families face challenges that many of us can hardly imagine—children without access to education, families struggling with poverty, and communities vulnerable to disease and natural disasters. For these communities, hope can often feel distant. This is where <strong data-start=\"883\" data-end=\"910\">North Bangla Foundation</strong> steps in, transforming lives through compassion, dedication, and actionable support.</p>\r\n<p data-start=\"999\" data-end=\"1629\"><strong data-start=\"999\" data-end=\"1028\">Education for Every Child</strong><br data-start=\"1028\" data-end=\"1031\">\r\nEducation is the cornerstone of progress. North Bangla Foundation firmly believes that every child deserves a chance to learn, grow, and pursue their dreams. Through our education initiatives, we provide school supplies, scholarships, and interactive learning workshops for children who cannot afford basic education. In remote villages, we partner with local teachers and volunteers to ensure that learning reaches even the most marginalized children. By fostering curiosity, skill development, and confidence, we aim to break the cycle of poverty and create opportunities for a brighter future.</p>\r\n<p data-start=\"1631\" data-end=\"2198\"><strong data-start=\"1631\" data-end=\"1668\">Healthcare and Medical Assistance</strong><br data-start=\"1668\" data-end=\"1671\">\r\nHealth is a fundamental human right, yet access to proper medical care is often limited in Northern Bangladesh. North Bangla Foundation organizes mobile health camps, free medical checkups, and awareness sessions on hygiene and nutrition. Over the past year alone, our healthcare programs have reached hundreds of families, providing essential medicines and life-saving advice. By focusing on preventive care and community health education, we help reduce illnesses and improve the overall quality of life for those we serve.</p>\r\n<p data-start=\"2200\" data-end=\"2733\"><strong data-start=\"2200\" data-end=\"2237\">Humanitarian Relief During Crises</strong><br data-start=\"2237\" data-end=\"2240\">\r\nNatural disasters like floods and storms can devastate communities overnight. North Bangla Foundation responds swiftly during emergencies, delivering food, clean water, temporary shelters, and essential supplies to affected families. Beyond immediate relief, we help communities rebuild homes, restore livelihoods, and recover emotionally, ensuring that support continues long after the disaster has passed. Our goal is to provide not only immediate assistance but also long-term resilience.</p>\r\n<p data-start=\"2735\" data-end=\"3221\"><strong data-start=\"2735\" data-end=\"2776\">Community Development and Empowerment</strong><br data-start=\"2776\" data-end=\"2779\">\r\nSustainable change requires empowerment. North Bangla Foundation invests in skill development programs, vocational training, and women’s empowerment projects. These initiatives help community members generate income, build confidence, and actively participate in improving their own lives. By promoting self-reliance and community involvement, we aim to create stronger, healthier, and more resilient communities across Northern Bangladesh.</p>\r\n<p data-start=\"3223\" data-end=\"3640\"><strong data-start=\"3223\" data-end=\"3274\">Volunteers and Donors: The Heart of Our Mission</strong><br data-start=\"3274\" data-end=\"3277\">\r\nThe impact of North Bangla Foundation is made possible by our dedicated volunteers and generous donors. Volunteers work tirelessly, teaching, distributing aid, and organizing events, while donors provide the necessary resources to sustain our programs. Together, they embody the spirit of compassion, proving that collective effort can create meaningful change.</p>\r\n<p data-start=\"3642\" data-end=\"4112\"><strong data-start=\"3642\" data-end=\"3659\">Looking Ahead</strong><br data-start=\"3659\" data-end=\"3662\">\r\nThe journey to transform lives is ongoing. North Bangla Foundation is committed to expanding our reach, developing new programs, and touching even more lives in Northern Bangladesh. With continued support, we can bring education, healthcare, and hope to those who need it most. Every contribution, every volunteer hour, and every act of kindness brings us closer to a world where no child is deprived of opportunity, and no family is left helpless.</p>\r\n<p data-start=\"4114\" data-end=\"4501\"><strong data-start=\"4114\" data-end=\"4129\">Conclusion:</strong><br data-start=\"4129\" data-end=\"4132\">\r\nAt North Bangla Foundation, we believe in turning compassion into action. We are more than a charity—we are a movement to uplift communities, empower individuals, and transform lives. Join us in our mission to bring hope, opportunity, and a brighter future to Northern Bangladesh. Together, we can make a difference—one child, one family, and one community at a time.</p>', 'North Bangla Foundation is committed to creating lasting change in Northern Bangladesh by providing education, healthcare, and humanitarian aid to underprivileged communities.', NULL, '260107070117.jpg', 1, 1, 'published', 1, 96, 1, 1, '2023-02-19 04:45:43', '2026-03-27 13:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `book_appointments`
--

CREATE TABLE `book_appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_fee` decimal(10,2) DEFAULT NULL,
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `paid_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `chambar_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chamber_schedule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL,
  `appointment_date` timestamp NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_appointments`
--

INSERT INTO `book_appointments` (`id`, `name`, `email`, `mobile`, `whatsapp_number`, `doctor_fee`, `order_status`, `payment_status`, `paid_amount`, `chambar_location`, `chamber_schedule`, `transaction_id`, `department_id`, `doctor_id`, `appointment_date`, `message`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'rakib', 'hasanrr092@gmail.com', '0198009329', '0198009329', 800.00, 'confirmed', 'paid', '800.00', 'Dhaka', NULL, NULL, 3, 28, '2025-08-31 18:00:00', '১১১১১১', NULL, NULL, '2025-09-01 11:16:18', '2025-09-01 11:21:47'),
(2, 'arif', 'mehediarif.du@gmail.com', '01925923276', '01925923276', 800.00, 'pending', 'unpaid', '0.00', 'Dhanmondi', 'Monday - 10.00-1.00 pm', NULL, 1, 30, '1994-02-28 18:00:00', 'Want to test', NULL, NULL, '2025-09-24 02:37:55', '2025-09-24 02:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `goal_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `raised_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `title`, `slug`, `image`, `short_description`, `description`, `active`, `addedby_id`, `editedby_id`, `goal_amount`, `raised_amount`, `created_at`, `updated_at`) VALUES
(1, 'Women & Child Welfare', 'women-child-welfare', 'causes/8Qvbh07wiWrPjlqDmJNyJen41WlNJlVRhRsNWjrL.jpg', 'We work to protect, support, and empower women and children through awareness programs, basic assistance, and community-based support initiatives.', 'Women and children are often the most vulnerable members of society. North Bengal Foundation works to protect their rights, provide basic support, and promote awareness about health, safety, and education. We support poor mothers, children in need, and families facing social or financial difficulties. Our mission is to create a safer and more supportive environment where women and children can live with dignity and opportunity.', 1, NULL, NULL, 100.00, 50.00, '2026-01-06 11:14:39', '2026-01-06 22:47:10'),
(2, 'Clean Water & Sanitation', 'clean-water-sanitation', 'causes/h6BHfKk1HyYiMK06S7BgZbV75UHSCgien4MITKNp.jpg', 'We promote access to clean drinking water and hygiene facilities to prevent disease and improve health in underserved communities.', 'Clean water and proper sanitation are essential for a healthy life, yet many communities still lack access to these basic necessities. North Bengal Foundation works to improve access to safe drinking water and promotes hygiene and sanitation awareness. These efforts help prevent disease, improve overall health, and create healthier living conditions for underserved communities.', 1, NULL, NULL, 150.00, 50.00, '2026-01-06 12:05:14', '2026-01-06 22:46:03'),
(3, 'Education for Underprivileged Children', 'education-for-underprivileged-children', 'causes/T11mBeNgloEkkrI8EYQw28rYJq1XHbxmKzAjQRLN.jpg', 'We support children from poor families by providing school supplies, scholarships, tuition support, and learning materials so they can continue their education and build a better future.', 'Education is the foundation of a strong and self-reliant society, yet many children in North Bengal are forced to drop out of school due to poverty. North Bengal Foundation works to ensure that no child is deprived of learning opportunities because of financial hardship. We provide school supplies, tuition support, scholarships, and learning materials to underprivileged students. We also support families so children can continue their education without being forced into child labor. Our goal is to break the cycle of poverty through quality education and long-term support.', 1, NULL, NULL, 250.00, 30.00, '2026-01-06 22:48:57', '2026-01-06 22:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_locations`
--

CREATE TABLE `chamber_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL,
  `chamber_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chamber_locations`
--

INSERT INTO `chamber_locations` (`id`, `doctor_id`, `chamber_title`, `schedules`, `address`, `created_at`, `updated_at`) VALUES
(1, 30, 'Dhanmondi', '[{\"day\": \"Monday\", \"time\": \"10.00-1.00 pm\"}]', '43, Mitali Road , Dhaka -1209', '2025-09-24 02:36:52', '2025-09-24 02:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `img`, `address`, `phone`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'aa10', 'companies/6N7qafUTGRGjA0tHSRhc9apfLJaLl83LDS6ZqYwQ.png', 'bbb', 'ccc', 1, 1, 1, '2026-01-06 07:43:56', '2026-01-06 07:59:39'),
(2, 'bb', 'companies/AC14LcoVUYrKzXJ3gljuEtrBqIDviwJoRLaaYOkV.png', 'bb', '0111', 1, 1, NULL, '2026-01-06 07:59:57', '2026-01-06 07:59:57'),
(3, 'cc', 'companies/ZVw0XiIUjhbKT80XNgQ7jFAQxfP1kHfB1bjrPRYr.png', 'cc', '01832', 1, 1, NULL, '2026-01-06 08:00:15', '2026-01-06 08:00:15'),
(4, 'dd', 'companies/6wK1v6rSTrIgXfPMfpK1OHYJ3UueFsTEqHQdNevd.png', 'dd', '896510', 1, 1, NULL, '2026-01-06 08:00:45', '2026-01-06 08:00:45'),
(5, 'tt', 'companies/5Yyk95FVvTq6wXq9KKwf1s3ABH9TMMgf8scCQHWG.png', 'tt', '01234656', 1, 1, NULL, '2026-01-06 11:38:56', '2026-01-06 11:38:56'),
(6, 'yy', 'companies/aTJny71hKBeCNg3LtnyukEOqck5iAd5N3ZCYSZCR.png', 'yy', '0125986', 1, 1, NULL, '2026-01-06 11:39:18', '2026-01-06 11:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `agree`, `created_at`, `updated_at`) VALUES
(1, 'dgsds', 'mehediarif.du56@gmail.com', NULL, 'sdfsdfs', 'test 025', 0, '2025-10-10 14:58:54', '2025-10-10 14:58:54'),
(2, 'modibiod', 'admin@gmail.com', NULL, 'test subject', 'test message', 0, '2025-10-10 15:01:21', '2025-10-10 15:01:21'),
(3, 'admina', 'mehediarif.du56@gmail.com', NULL, 'test message', 'rest rt 9i', 0, '2025-10-10 15:19:56', '2025-10-10 15:19:56'),
(4, 'admina', 'mehediarif.du56@gmail.com', NULL, 'test message', 'rest rt 9i', 0, '2025-10-10 15:20:38', '2025-10-10 15:20:38'),
(5, 'Arif', 'mehediarif.du@gmail.com', '01925923276', 'Product Delay', 'jogags', 1, '2025-11-18 02:50:07', '2025-11-18 02:50:07'),
(6, 'Arif', 'mehediarif.du@gmail.com', '01925923276', 'Product Delay', 'nam', 1, '2025-11-18 02:52:17', '2025-11-18 02:52:17'),
(7, 'Arif', 'mehediarif.du@gmail.com', '01925923276', 'Transport', 'test', 1, '2025-11-18 02:54:04', '2025-11-18 02:54:04'),
(8, 'arif  mehedi', 'mehediarif.du@gmail.com', '014925656', 'hubli', 'raserl', 1, '2026-01-03 07:10:36', '2026-01-03 07:10:36'),
(9, 'dgsds', 'mehediarif.du@gmail.com', '01925923276', 'test', 'test', 1, '2026-01-03 07:11:12', '2026-01-03 07:11:12'),
(10, 'testr', 'mehediarif.du@gmail.com', '01925923276', 'test', 'test 02', 1, '2026-01-03 07:14:18', '2026-01-03 07:14:18'),
(11, 'test', 'mehediarif.du@gmail.com', '01925923276', 'test', 'test', 1, '2026-01-03 07:25:49', '2026-01-03 07:25:49'),
(12, 'rasel', 'mehediarif.du8556@gmail.com', '01925923276', 'test sub', 'test message', 1, '2026-01-03 07:38:07', '2026-01-03 07:38:07'),
(13, 'Nikita Joshi', 'nikitajoshi.sale@gmail.com', '7532833829', 'Improve Your Google Rankings & Organic Traffic', 'Hi http://northbengalfoundation.com,\r\n\r\nJust had a look at your site – it’s well-designed, but not performing well in search engines.\r\n\r\nWould you be interested in improving your SEO and getting more traffic?\r\n\r\nI can send over a detailed proposal with affordable packages.\r\n\r\nWarm regards,\r\nNikita', 1, '2026-01-07 13:32:57', '2026-01-07 13:32:57'),
(14, 'Nikita Joshi', 'nikita.sale01@gmail.com', '7532833829', 'Re Improve Traffic To Your Website', 'Hi http://northbengalfoundation.com,\r\n\r\nCould you please tell me if you want to show your website on top in Google searches and to increase organic traffic on your website.\r\n\r\nWe are a digital marketing company that deals in SEO and we can bring your website to the first page of Google as we are helping more than 100+ websites to get them top in Google.\r\n\r\nPlease let me know if you would like to discuss this opportunity.\r\n\r\nIf you are interested, I can send you our past work, pricing and proposals.\r\n\r\nThank you,\r\nNikita', 1, '2026-01-08 04:34:52', '2026-01-08 04:34:52'),
(15, 'Maybell Doolan', 'indexing@searches-northbengalfoundation.com', '8125557772', 'northbengalfoundation.com', 'Enlist northbengalfoundation.com in GoogleSearchIndex to have it displayed in search results!\r\n\r\nSubmit northbengalfoundation.com now at https://searchregister.info', 1, '2026-01-21 15:58:28', '2026-01-21 15:58:28'),
(16, 'Terry Pruitt', 'better@ai-northbengalfoundation.com', '353172073', 'northbengalfoundation.com and A.I.', 'Users search using AI more & more.\r\n\r\nAdd northbengalfoundation.com to our AI-optimized directory now to increase your chances of being recommended / mentioned.\r\n\r\nList it here:  https://AIREG.pro', 1, '2026-01-22 16:52:23', '2026-01-22 16:52:23'),
(17, 'Sid', 'sid.99seosolutionworld@gmail.com', '8468088599', 'Want to Rank Your Website on Google’s First Page?', 'Hi http://northbengalfoundation.com,\r\n\r\nJust had a look at your site – it’s well-designed, but not performing well in search engines.\r\n\r\nWould you be interested in improving your SEO and getting more traffic?\r\n\r\nI can send over a detailed proposal with affordable packages.\r\n\r\nWarm regards,\r\nSid', 1, '2026-01-30 12:06:10', '2026-01-30 12:06:10'),
(18, 'Sonam Prajapati', 'sonam.websolution12@gmail.com', NULL, 'Quick question about your Google traffic', 'Dear Web Owner http://northbengalfoundation.com, \r\n\r\nWant more clients and better online visibility? \r\n\r\nWe help websites rank higher on major search engines with proven SEO strategies.We’re offering affordable packages for growing businesses.\r\n\r\nReply with your WhatsApp or contact number to receive a quick proposal.\r\n\r\nBest regards, \r\nSonam', 1, '2026-02-02 09:47:32', '2026-02-02 09:47:32'),
(19, 'Anaya Prajapati', 'anaya.dgtlsolution@gmail.com', '9266141479', 'A modern design with solid SEO — your next step forward', 'Hi http://northbengalfoundation.com,\r\n \r\nI help businesses get more traffic and better visibility on Google with simple, effective SEO strategies. If you can share your Keywords and target locations, I’ll take a quick look and send you a short summary of what can be improved — including key issues and easy recommendations to boost your results.\r\n \r\nLooking forward to checking it out!\r\n \r\nThank You,\r\nAnaya', 1, '2026-02-03 23:44:11', '2026-02-03 23:44:11'),
(20, 'Sonam Prajapati', 'sonam.websolution12@gmail.com', '3067842936', 'Improve Your Google Rankings Strategically', 'Hello http://northbengalfoundation.com, \r\n\r\nWe can place your website on Google 1st page. \r\n\r\nI can give you our Complete SEO Action Plan along with a customary reach and add great value to your product/ service. \r\n\r\nI may send you a SEO Packages & price list. If interested. \r\n\r\nBest Regards, \r\nSonam', 1, '2026-02-06 06:53:34', '2026-02-06 06:53:34'),
(21, 'Deepak Parcha', 'parchad78@gmail.com', NULL, 'Enhancing Your Website Design to Attract More Clients', 'Hello http://northbengalfoundation.com,\r\n\r\nI design modern, user-friendly websites for small businesses and help improve their online presence.\r\n\r\nI wanted to check if you’re considering any updates to your current website—such as improving the design, usability, or adding features to better support your business.\r\n\r\nIf you’re planning a new website or a redesign, feel free to share your requirements and  reference website link. \r\n\r\nI’d be happy to discuss.\r\n\r\nKind regards,\r\nDeepak Parcha', 1, '2026-02-06 06:53:44', '2026-02-06 06:53:44'),
(22, 'Sonam Prajapati', 'sonam.rocketdigitaltech@gmail.com', '447900362', 'Proven SEO Strategies to Rank on Google’s First Page.', 'Hello http://northbengalfoundation.com, \r\n\r\nIf you’re looking to boost your website’s visibility, I can help you achieve top Google rankings. \r\n\r\nI’ll prepare a complete SEO plan with actionable steps and potential growth insights for your products or services. \r\n\r\nOnce you share your target keywords and target market, I’ll send a full proposal. \r\n\r\nBest Regards, \r\nSonam', 1, '2026-02-11 16:44:55', '2026-02-11 16:44:55'),
(23, 'Anaya Gupta', 'anaya.dgtlsolution@gmail.com', '9266141479', 'Want to Rank Your Website on Google’s First Page?', 'Hello http://northbengalfoundation.com,\r\n\r\nI wanted to reach out to see if you’re open to exploring ways to grow your website traffic and boost online performance.\r\n\r\nWe offer customized SEO services that deliver measurable improvements.\r\n\r\nOnce you share your target keywords and target market, I’ll send a full proposal.\r\n\r\nBest Regards,\r\nAnaya', 1, '2026-02-12 14:29:14', '2026-02-12 14:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint UNSIGNED NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

CREATE TABLE `delivery_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`id`, `user_id`, `name`, `mobile`, `email`, `address_title`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', '83 West Clarendon Boulevard', NULL, '2025-08-30 22:01:34', '2025-08-30 22:01:34'),
(2, 1, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Tangail', NULL, '2025-09-01 03:25:01', '2025-09-11 07:18:26'),
(3, 164, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'dhaka', NULL, '2025-09-03 22:47:45', '2025-09-03 22:47:45'),
(4, 163, 'Sultan Ahmmed', '01717000000', 'admin01@gmail.com', 'Building # 01, Road # 01,  Block# 1, Flat # 01,  Mohanagar project.  West  Rampura. Dhaka', NULL, '2025-09-03 22:58:34', '2025-09-03 22:58:34'),
(5, 166, 'Rasel', '01925923278', 'rasel93.ict@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', NULL, '2025-09-11 07:31:11', '2025-09-11 07:31:11'),
(6, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Faridpur Sadar, Faridpur', NULL, '2025-09-23 09:02:15', '2025-09-26 05:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `drag_id` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_en`, `name_bn`, `excerpt_en`, `excerpt_bn`, `drag_id`, `image`, `active`, `featured`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Education Support for Every Child', NULL, 'Providing learning opportunities and essential resources to underprivileged children for a brighter future.', NULL, 0, '1767618807.PNG', 1, 1, 1, 1, '2023-02-28 06:12:08', '2026-01-06 22:41:52'),
(2, 'Healthcare for Communities', NULL, 'Ensuring access to medical care, treatment, and health awareness for vulnerable populations.', NULL, 0, '1767618838.PNG', 1, 1, 1, 1, '2023-02-28 06:44:59', '2026-01-06 22:42:40'),
(3, 'Disaster Relief & Emergency Aid', NULL, 'Responding quickly with food, shelter, and medical support during crises and natural disasters.', NULL, 0, '1767619811.PNG', 1, 1, 1, 1, '2023-03-22 03:48:20', '2026-01-06 22:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int UNSIGNED NOT NULL,
  `division_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `addedby_id` int UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(5, 8, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(10, 8, 'Mymensingh', 'ময়মনসিং', 0, 0, 'www.mymensingh.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(13, 8, 'Netrokona', 'নেত্রকোনা', 24.870955, 90.727887, 'www.netrokona.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(16, 8, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(18, 5, 'Bogra', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(22, 5, 'Nawabganj', 'নবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(35, 1, 'Barisal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(43, 2, 'Chittagong', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(44, 2, 'Comilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(47, 2, 'Khagrachari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(52, 7, 'Maulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(57, 4, 'Jessore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `addedby_id` int UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Barisal', 'বরিশাল', 1, 1, '2018-08-14 08:10:15', '2018-09-15 06:01:57'),
(2, 'Chittagong', 'চট্টগ্রাম', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(3, 'Dhaka', 'ঢাকা', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(4, 'Khulna', 'খুলনা', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(5, 'Rajshahi', 'রাজশাহী', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(6, 'Rangpur', 'রংপুর', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(7, 'Sylhet', 'সিলেট', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(8, 'Mymensingh', 'ময়মনসিংহ', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_fee` decimal(10,2) DEFAULT NULL,
  `chambar_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `name_en`, `name_bn`, `excerpt_en`, `excerpt_bn`, `description_en`, `description_bn`, `email`, `mobile`, `whatsapp_number`, `doctor_fee`, `chambar_location`, `designation_en`, `designation_bn`, `doctor_image`, `active`, `gender`, `department_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(25, 108, 'Door Delivery', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br></p>', NULL, 'rahat@gmail.com', '01976009329', NULL, 800.00, 'Dhaka', NULL, NULL, '1759592617.webp', 1, 'male', 1, 1, 1, '2023-03-19 00:16:57', '2025-10-04 09:43:37'),
(26, 109, 'Natural Feed', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br></p>', NULL, 'rakib@gmail.com', '01976009328', NULL, 600.00, 'Dhaka', NULL, NULL, '1758993065.jpg', 1, 'male', 1, 1, 1, '2023-03-21 06:29:58', '2025-09-27 11:11:05'),
(28, 115, 'Top Quality', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'sultan@gmail.com', '01970000000', NULL, 900.00, 'Dhaka', NULL, NULL, '1758993036.png', 1, 'male', 3, 1, 1, '2025-08-24 01:27:19', '2025-09-27 11:10:36'),
(29, 116, 'Big Milk Farm', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'jaon@gmail.com', '01970000000', NULL, 1000.00, 'Dhaka', NULL, NULL, '1758992988.png', 1, 'male', 4, 1, 1, '2025-08-24 01:28:09', '2025-09-27 11:09:48'),
(30, 117, 'Best Ingredients', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'masum@gmail.com', '0197600000', NULL, 800.00, 'Dhaka', NULL, NULL, '1758992902.jpg', 1, 'male', 1, 1, 1, '2025-08-24 01:35:28', '2025-09-27 11:08:22'),
(32, NULL, 'aaa', 'আকলিমা বেগম yy', 'gggh hhh', NULL, '<p>hhh uuu jjj ihshsha das</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1761153755.png', 1, NULL, NULL, 1, 1, '2025-10-22 11:22:35', '2025-10-22 11:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_hospitals`
--

CREATE TABLE `doctor_hospitals` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `schedule` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` double DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_hospitals`
--

INSERT INTO `doctor_hospitals` (`id`, `doctor_id`, `hospital_id`, `schedule`, `fee`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(16, 12, 1, NULL, NULL, 1, NULL, NULL, NULL),
(19, 13, 1, NULL, NULL, 1, NULL, NULL, NULL),
(20, 13, 2, NULL, NULL, 1, NULL, NULL, NULL),
(21, 14, 1, NULL, NULL, 1, NULL, NULL, NULL),
(22, 17, 5, NULL, NULL, 1, NULL, NULL, NULL),
(23, 15, 2, NULL, NULL, 1, NULL, NULL, NULL),
(24, 18, 2, NULL, NULL, 1, NULL, NULL, NULL),
(25, 19, 2, NULL, NULL, 1, NULL, NULL, NULL),
(26, 19, 3, NULL, NULL, 1, NULL, NULL, NULL),
(29, 20, 4, NULL, NULL, 1, NULL, NULL, NULL),
(30, 20, 5, NULL, NULL, 1, NULL, NULL, NULL),
(31, 21, 3, NULL, NULL, 1, NULL, NULL, NULL),
(32, 21, 4, NULL, NULL, 1, NULL, NULL, NULL),
(33, 22, 2, NULL, NULL, 1, NULL, NULL, NULL),
(46, 23, 2, NULL, NULL, 1, NULL, NULL, NULL),
(51, 24, 2, NULL, NULL, 1, NULL, NULL, NULL),
(55, 27, 2, NULL, NULL, 1, NULL, NULL, NULL),
(56, 27, 3, NULL, NULL, 1, NULL, NULL, NULL),
(57, 27, 4, NULL, NULL, 1, NULL, NULL, NULL),
(58, 27, 6, NULL, NULL, 1, NULL, NULL, NULL),
(73, 30, 2, NULL, NULL, 1, NULL, NULL, NULL),
(74, 29, 2, NULL, NULL, 1, NULL, NULL, NULL),
(75, 28, 2, NULL, NULL, 1, NULL, NULL, NULL),
(76, 26, 2, NULL, NULL, 1, NULL, NULL, NULL),
(77, 25, 2, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `mobile`, `license_no`, `nid`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rrr ss', '01213456789910', '12134566879810', '98756322510', 'dgsyh10', 0, '2025-12-23 16:12:48', '2025-12-23 16:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `feature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_sliders`
--

CREATE TABLE `front_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `addedBy_id` bigint UNSIGNED DEFAULT NULL,
  `editedBy_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_sliders`
--

INSERT INTO `front_sliders` (`id`, `title`, `description`, `link`, `featured_image`, `active`, `addedBy_id`, `editedBy_id`, `created_at`, `updated_at`) VALUES
(1, 'Together, We Can Change Lives', 'Join us in serving humanity', '#', 'go-bangladesh1767595277.webp', 1, 1, 1, '2023-03-19 03:30:07', '2026-01-07 21:41:59'),
(2, 'Education is the Key', 'Help underprivileged children get access to learning', '#', 'go-bangladesh1767595263.webp', 1, 1, 1, '2023-03-19 03:30:23', '2026-01-06 22:39:20'),
(3, 'For a Better Tomorrow', 'Works to support education, healthcare, and emergency relief .', '#', 'go-bangladesh1767595141.png', 1, 1, 1, '2023-03-19 03:30:44', '2026-01-06 22:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `thumbnail_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `addedby_id` int DEFAULT NULL,
  `editedby_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `file_type`, `priority`, `thumbnail_image`, `featured_image`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(3, 'Fresh Cow', 'image', 2, 'thumb_1761491681.png', '1767698966.jpg', 1, 1, 1, '2023-02-27 06:11:23', '2026-01-06 05:29:26'),
(7, 'Pure Milk', 'image', 1, 'thumb_1761498712.jpeg', '1767698931.jpg', 1, 1, 1, '2025-09-01 00:01:04', '2026-01-06 05:28:51'),
(8, 'Delivary Man', 'image', 4, 'thumb_1761499013.jpeg', '1767699279.jpg', 1, 1, 1, '2025-09-01 00:01:53', '2026-01-06 05:34:39'),
(9, 'Ajaj Add', 'image', 3, 'thumb_1761498851.jpeg', '1767699173.jpg', 1, 1, 1, '2025-09-01 00:02:16', '2026-01-06 05:32:53'),
(11, 'obuj sisu', 'image', 5, 'thumb_1761499278.jpeg', '1767699292.jpg', 1, 1, 1, '2025-10-26 11:21:18', '2026-01-06 05:34:52'),
(12, 'Galib', 'image', 9, NULL, '1767698876.jpg', 1, 1, 1, '2025-10-26 11:26:21', '2026-01-06 05:34:13'),
(13, 'Galib 02', 'image', 2, NULL, '1767699136.jpg', 1, 1, 1, '2025-10-26 11:26:36', '2026-01-06 05:32:16'),
(14, 'aa', 'image', 0, NULL, '1767619033.jpg', 1, 1, NULL, '2026-01-05 07:17:13', '2026-01-05 07:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint UNSIGNED NOT NULL,
  `gallery_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int DEFAULT NULL,
  `editedby_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `gallery_id`, `image`, `description`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(6, 3, '7613841677499909.jpg', 'gallery1', 1, NULL, '2023-02-27 06:11:49', '2023-02-27 06:11:49'),
(7, 3, '7317241677499909.jpg', 'gallery1', 1, NULL, '2023-02-27 06:11:49', '2023-02-27 06:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_contacts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `division_id` bigint UNSIGNED DEFAULT NULL,
  `district_id` bigint UNSIGNED DEFAULT NULL,
  `upazila_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name_en`, `name_bn`, `description_en`, `description_bn`, `excerpt_en`, `excerpt_bn`, `address_en`, `address_bn`, `hospital_contacts`, `image`, `active`, `division_id`, `district_id`, `upazila_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(3, 'Quality Manage', NULL, '<p>Enam Hospital<br></p>', NULL, 'We ensure high-quality milk production through sustainable farming practices and healthy cattle management.', NULL, 'Enam Hospital', NULL, '01700000000', '1758992079.jpg', 1, 5, 19, 336, 1, 1, '2023-03-04 00:56:13', '2025-09-27 10:54:39'),
(4, 'Care Cattles', NULL, '<p>Delta hospital<br></p>', NULL, 'Expert advice on optimizing your dairy farm operations, from herd health to facility management.', NULL, 'Delta hospital', NULL, NULL, '1758992021.jpg', 1, 6, 28, 414, 1, 1, '2023-03-04 01:08:13', '2025-10-04 09:08:56'),
(5, 'Feed Manage', NULL, '<p>norjann hospital<br></p>', NULL, 'Rigorous testing and quality control measures at every stage to guarantee the safety and purity of our products.', NULL, 'norjann hospital', NULL, '01960000000', '1758991984.jpg', 1, 5, 23, 367, 1, 1, '2023-03-04 04:39:07', '2025-09-27 10:53:04'),
(6, 'Pure Milk', NULL, '<p>Health care<br></p>', NULL, 'We ensure high-quality milk production through sustainable farming practices and healthy cattle management.', NULL, 'Health care', NULL, '01970000111', '1758991922.jpg', 1, 3, 1, 523, 1, 1, '2023-03-15 23:46:56', '2025-09-27 10:52:02'),
(7, 'Quality Feed', NULL, '<p>moon hospital, comilla</p>', NULL, 'Customized nutrition plans and high-quality feed to ensure the health and productivity of your dairy cattle.', NULL, 'Comilla', NULL, '01970000000', '1758991827.jpg', 1, 2, 44, 90, 1, 1, '2023-05-22 04:42:43', '2025-09-27 10:50:27'),
(8, 'Home Delivery', NULL, '<p>test 1</p>', NULL, 'name excert', NULL, NULL, NULL, NULL, '1759592266.jpg', 1, NULL, NULL, NULL, 1, 1, '2025-10-04 08:12:37', '2025-10-04 09:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `id_cards`
--

CREATE TABLE `id_cards` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issued_at` timestamp NULL DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `id_cards`
--

INSERT INTO `id_cards` (`id`, `user_id`, `file_name`, `issued_at`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 148, 'idcards/idcard_148_1756897479.pdf', '2007-11-14 18:00:00', NULL, NULL, '2025-09-03 05:04:42', '2025-09-03 05:04:42'),
(2, 151, 'idcards/idcard_151_1756898430.pdf', '2013-12-05 18:00:00', NULL, NULL, '2025-09-03 05:20:32', '2025-09-03 05:20:32'),
(3, 152, 'idcards/idcard_152_1756898561.pdf', '1992-11-29 18:00:00', NULL, NULL, '2025-09-03 05:22:44', '2025-09-03 05:22:44'),
(4, 153, 'idcards/idcard_153_1756898632.pdf', '1978-06-08 18:00:00', NULL, NULL, '2025-09-03 05:23:55', '2025-09-03 05:23:55'),
(5, 154, 'idcards/idcard_154_1756898688.pdf', '1998-05-28 18:00:00', NULL, NULL, '2025-09-03 05:24:52', '2025-09-03 05:24:52'),
(6, 155, 'idcards/idcard_155_1756898766.pdf', '1993-06-29 18:00:00', NULL, NULL, '2025-09-03 05:26:10', '2025-09-03 05:26:10'),
(7, 156, 'idcards/idcard_156_1756898895.pdf', '1971-12-19 18:00:00', NULL, NULL, '2025-09-03 05:28:18', '2025-09-03 05:28:18'),
(8, 157, 'idcards/idcard_157_1756899033.pdf', '2018-08-17 18:00:00', NULL, NULL, '2025-09-03 05:30:38', '2025-09-03 05:30:38'),
(9, 158, 'idcards/idcard_158_1756899198.pdf', '2012-06-07 18:00:00', NULL, NULL, '2025-09-03 05:33:24', '2025-09-03 05:33:24'),
(10, 159, 'idcards/idcard_159_1756899302.pdf', '2019-03-20 18:00:00', NULL, NULL, '2025-09-03 05:35:06', '2025-09-03 05:35:06'),
(11, 160, 'idcards/idcard_160_1756899377.pdf', '2002-02-28 18:00:00', NULL, NULL, '2025-09-03 05:36:22', '2025-09-03 05:36:22'),
(12, 161, 'idcards/idcard_161_1756899539.pdf', '1999-03-07 18:00:00', NULL, NULL, '2025-09-03 05:39:04', '2025-09-03 05:39:04'),
(13, 162, 'idcards/idcard_162_1756899610.pdf', '1999-11-09 18:00:00', NULL, NULL, '2025-09-03 05:40:14', '2025-09-03 05:40:14'),
(14, 163, 'idcards/idcard_163_1756959781.pdf', '2025-09-02 18:00:00', NULL, NULL, '2025-09-03 22:23:02', '2025-09-03 22:23:02'),
(15, 164, 'idcards/idcard_164_1756961245.pdf', '2025-09-03 18:00:00', NULL, NULL, '2025-09-03 22:47:26', '2025-09-03 22:47:26'),
(16, 165, 'idcards/idcard_165_1757597019.pdf', '2025-08-31 18:00:00', NULL, NULL, '2025-09-11 07:23:39', '2025-09-11 07:23:39'),
(17, 166, 'idcards/idcard_166_1757866945.pdf', '2025-09-10 18:00:00', NULL, NULL, '2025-09-11 07:30:47', '2025-09-14 10:22:29'),
(18, 167, 'idcards/idcard_167_1757678633.pdf', '2025-09-11 18:00:00', NULL, NULL, '2025-09-12 06:03:58', '2025-09-12 06:03:58'),
(19, 168, 'idcards/idcard_168_1757790988.pdf', '2025-09-13 18:00:00', NULL, NULL, '2025-09-13 13:16:33', '2025-09-13 13:16:33'),
(20, 169, 'idcards/idcard_169_1757860277.pdf', '2025-09-13 18:00:00', NULL, NULL, '2025-09-14 08:31:18', '2025-09-14 08:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ext` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_profiles`
--

CREATE TABLE `member_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `speciality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eyes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_social_links`
--

CREATE TABLE `member_social_links` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `drag_id` int NOT NULL DEFAULT '0',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name_en`, `name_bn`, `slug`, `type`, `link`, `active`, `drag_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Service', NULL, 'service', 'header_menu', NULL, 1, 0, 1, NULL, '2025-08-25 02:08:00', '2025-08-25 02:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_pages`
--

CREATE TABLE `menu_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED DEFAULT NULL,
  `page_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_pages`
--

INSERT INTO `menu_pages` (`id`, `menu_id`, `page_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 1, NULL, NULL, NULL),
(2, 1, 9, 1, NULL, NULL, NULL),
(3, 1, 10, 1, NULL, NULL, NULL),
(4, 1, 11, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2019_08_19_000000_create_failed_jobs_table', 1),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(43, '2022_12_19_160129_create_roles_table', 1),
(44, '2022_12_24_131347_create_menus_table', 1),
(45, '2022_12_24_131412_create_pages_table', 1),
(46, '2022_12_24_131509_create_page_items_table', 1),
(47, '2022_12_24_131535_create_menu_pages_table', 1),
(48, '2022_12_27_084900_create_blog_categories_table', 1),
(49, '2022_12_27_084918_create_blog_sub_categories_table', 1),
(50, '2022_12_27_104758_create_blog_posts_table', 1),
(51, '2022_12_28_074350_create_blog_category_posts_table', 1),
(52, '2022_12_28_074445_create_blog_subcategory_posts_table', 1),
(53, '2023_01_01_032228_create_user_locations_table', 1),
(54, '2023_01_10_073648_create_memberships_table', 2),
(61, '2023_01_14_060232_create_members_table', 3),
(62, '2023_01_15_061001_create_membership_packages_table', 3),
(64, '2023_01_23_094941_create_member_payements_table', 4),
(67, '2023_01_25_091506_create_media_table', 5),
(68, '2023_01_29_111331_create_website_parameters_table', 6),
(71, '2023_01_30_050518_create_website_parameters_table', 7),
(72, '2023_02_15_042916_create_blog_post_files_table', 8),
(75, '2023_02_19_054848_create_tags_table', 9),
(76, '2023_02_19_102431_create_authors_table', 10),
(95, '2023_02_20_044510_create_front_sliders_table', 11),
(96, '2023_02_20_044611_create_galleries_table', 11),
(97, '2023_02_20_044622_create_gallery_items_table', 11),
(102, '2023_02_28_054903_create_bisesoggo_categories_table', 12),
(103, '2023_02_28_084150_create_hospitals_table', 12),
(104, '2023_02_28_084203_create_doctors_table', 12),
(105, '2023_02_28_084214_create_doctor_hospitals_table', 12),
(107, '2023_03_01_045825_create_visits_table', 13),
(108, '2023_03_19_100815_create_contact_us_table', 14),
(110, '2025_08_26_031805_create_book_appointments_table', 15),
(112, '2025_08_27_032111_create_ambulance_services_table', 16),
(113, '2025_08_31_053607_create_product_reviews_table', 17),
(114, '2025_09_03_052631_create_id_cards_table', 18),
(115, '2025_09_03_084112_create_shipping_methods_table', 19),
(116, '2025_10_10_203413_create_contacts_table', 20),
(117, '2025_10_23_170820_create_testimonials_table', 21),
(118, '2025_11_18_043627_create_contact_forms_table', 22),
(119, '2025_11_20_032506_create_wishlists_table', 23),
(120, '2025_12_23_134330_create_vehicles_table', 24),
(121, '2025_12_23_134419_create_drivers_table', 25),
(122, '2025_12_23_135314_create_vehicle_assignments_table', 26),
(123, '2025_12_23_154323_create_product_stock_requests_table', 27),
(124, '2026_01_05_041653_create_members_table', 28),
(125, '2026_01_05_041816_create_member_profiles_table', 29),
(126, '2026_01_05_041901_create_member_social_links_table', 30),
(127, '2022_12_21_053411_create_companies_table', 31),
(128, '2026_01_06_160831_create_causes_table', 32),
(131, '2026_04_09_114817_create_sections_table', 33),
(132, '2026_04_09_114827_create_titles_table', 34),
(133, '2026_04_09_114836_create_sub_titles_table', 35),
(134, '2026_04_09_114846_create_contents_table', 36),
(135, '2026_04_09_114855_create_features_table', 37),
(136, '2026_04_09_114904_create_pricings_table', 38),
(137, '2026_04_09_114914_create_sections_setups_table', 39),
(138, '2026_04_09_114930_create_session_setup_features_table', 40),
(139, '2026_04_23_012005_add_role_and_status_to_users_table', 41),
(140, '2026_04_23_140000_create_page_contents_table', 42),
(142, '2026_05_06_174737_add_bangla_fields_to_page_contents_table', 43);

-- --------------------------------------------------------

--
-- Table structure for table `mosques`
--

CREATE TABLE `mosques` (
  `id` int UNSIGNED NOT NULL,
  `division_id` int UNSIGNED NOT NULL,
  `district_id` int UNSIGNED NOT NULL,
  `upazila_id` int UNSIGNED NOT NULL,
  `union_id` bigint UNSIGNED DEFAULT NULL,
  `village_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foundation_year` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `imam_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretary_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mosques`
--

INSERT INTO `mosques` (`id`, `division_id`, `district_id`, `upazila_id`, `union_id`, `village_id`, `name`, `foundation_year`, `address`, `imam_name`, `secretary_name`, `reg_number`, `phone`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 27, 407, 1, 2, 'তরফকামাল জামে মসজিদ', 'মোঘল আমল', 'তরফকামাল', '-', '-', '-', '-', 'mosques/WDxee2wZOBm2HRbITebmFcFcgrJjxmwgeT1Is8tv.jpg', '-', 1, NULL, '2026-01-20 22:04:36'),
(2, 6, 27, 407, 1, 2, 'তরফ কামাল দক্ষিণপাড়া জামে মসজিদ', '১৯৬৩', 'তরফকামাল', '-', '-', '-', '-', 'mosques/KctsbUGf704XfFhkAxdys4KTsYPiokU1UJSXjqab.jpg', '-', 1, '2026-01-13 01:06:24', '2026-01-20 21:07:02'),
(3, 6, 27, 407, 1, 1, 'চক নারায়ন জামে মসজিদ', '২০০০', 'চক নারায়ন', '-', '-', '-', '-', 'mosques/K3KBMCJX3D4khJdAWi1AVN6ObxwwR4KXOi4BWwNJ.jpg', 'ee', 1, '2026-01-20 04:58:01', '2026-01-20 21:06:48'),
(4, 6, 27, 407, 1, 1, 'চক নারায়ন ডাক্তারবাড়ী জামে মসজিদ', '১৯৮৬', 'চক নারায়ন', '-', NULL, NULL, '-', 'mosques/fStTixl47sSPqf0wrp46G7jexOSAlW5JcBMiyArJ.jpg', '-', 1, '2026-01-20 05:52:53', '2026-01-20 05:55:44'),
(5, 6, 27, 407, 1, 2, 'তরফ কামাল মসজিদ', '২০০৩', 'তরফকামাল', '-', '-', NULL, '-', 'mosques/I2AvAVV5AlWTR7m9KbyooR4TLrs0pZTSOFeT3jIK.jpg', '-', 1, '2026-01-20 06:36:03', '2026-01-20 21:05:13'),
(6, 6, 27, 407, 1, 2, 'তরফ কামাল মসজিদ', '১৯৯৭', 'তরফকামাল', '-', NULL, NULL, '-', 'mosques/RnAkFuHbDnyDGRNNuiWiJWrKJNqBu0qt43T0arDb.jpg', '-', 1, '2026-01-20 06:41:06', '2026-01-20 06:50:29'),
(7, 6, 27, 407, 1, 2, 'তরফকামাল পশ্চিমপাড়া জামে মসজিদ', '১৯৯৭', 'তরফকামাল', '-', NULL, NULL, '-', 'mosques/sBSY3eGwoE0RUpo6WWowrUzvZ5UoZEKSpIyLzFLd.jpg', '-', 1, '2026-01-20 06:48:17', '2026-01-20 06:48:17'),
(8, 6, 27, 407, 1, 3, 'জয়দেব জামে মসজিদ', '২০০২', 'জয়দেব', '-', NULL, NULL, '-', 'mosques/HSu6MF6ss8IbwyqOJqOrzJqE8OI0sK44AG6V38Zm.jpg', '-', 1, '2026-01-20 06:52:37', '2026-01-20 06:52:37'),
(9, 6, 27, 407, 1, 3, 'জয়দেব পূর্বপাড়া জামে মসজিদ', '১৯৪৫', 'জয়দেব', '-', NULL, NULL, '-', 'mosques/Z6qCeW3IB5VGGPCwleKfU3ctkUIKOx2J8uqpUYk9.jpg', '-', 1, '2026-01-20 06:55:45', '2026-01-20 06:55:45'),
(10, 6, 27, 407, 1, 3, 'জয়দেব পূর্বপাড়া জামে মসজিদ', '1945', 'জয়দেব', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(11, 6, 27, 407, 1, 4, 'দাউদপুর বেপারী বাড়ী জামে মসজিদ', '1942', 'দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(12, 6, 27, 407, 1, 4, 'দাউদপুর সরকারপাড়া জামে মসজিদ', '1999', 'দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(13, 6, 27, 407, 1, 4, 'দাউদপুর খান বাড়ী জামে মসজিদ', '1968', 'দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(14, 6, 27, 407, 1, 4, 'দাউদপুর চেয়ারম্যান বাড়ী জামে মসজিদ', '1998', 'দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(15, 6, 27, 407, 1, 24, 'বড়দাউদপুর কাসারী পাড়া জামে মসজিদ', '1998', 'বড়দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(16, 6, 27, 407, 1, 24, 'বড় দাউদপুর মুন্সীপাড়া জামে মসজিদ', '1900', 'বড়দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(17, 6, 27, 407, 1, 24, 'বড়দাউদপুর সরকারপাড়া জামে মসজিদ', '1980', 'বড়দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(18, 6, 27, 407, 1, 24, 'বড়দাউদপুর কছির হাজীরবাড়ী জামে মসজিদ', '1935', 'বড়দাউদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(19, 6, 27, 407, 1, 25, 'কিশামত তাজপুর ডিলার বাড়ী জামে মসজিদ', '1900', 'কিশামততাজপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(20, 6, 27, 407, 1, 25, 'কিশামত তাজপুর মিয়াবাড়ী জামে মসজিদ', '1980', 'কিশামততাজপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(21, 6, 27, 407, 1, 26, 'মহিষবান্দি পূর্বপাড়া জামে মসজিদ', '1857', 'মহিষবান্দি', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(22, 6, 27, 407, 1, 26, 'মহিষবান্দিপূর্ব পাড়া জামে মসজিদ(মাঝখানে)', '1957', 'মহিষবান্দি', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(23, 6, 27, 407, 1, 26, 'মহিষবান্দি বাজার জামে মসজিদ', '1907', 'মহিষবান্দি', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(24, 6, 27, 407, 1, 27, 'মহিষবান্দি জানপাড়া জামে মসজিদ', '1995', 'জানপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(25, 6, 27, 407, 1, 27, 'মহিষ বান্দি জানপাড়া জামে মসজিদ', '2000', 'জানপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(26, 6, 27, 407, 1, 28, 'ফারাজী ছান্দিয়াপুর খামারপাড়া জামে মসজিদ', '1998', 'খামারীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(27, 6, 27, 407, 1, 28, 'ফারাজী ছান্দিয়াপুর খামারপাড়া জামে মসজিদ', '1920', 'খামারীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(28, 6, 27, 407, 1, 29, 'বৈষ্ণবদাস পূর্বপাড়া জামে মসজিদ', '1905', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(29, 6, 27, 407, 1, 29, 'বৈষ্ণবদাস গাছপাড়া জামে মসজিদ', '2003', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(30, 6, 27, 407, 1, 29, 'বৈষ্ণবদাস মাঠের বাজার জামে মসজিদ', '1970', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(31, 6, 27, 407, 1, 29, 'বৈষ্ণবদাস দক্ষিণপাড়া জামে মসজিদ', '1890', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(32, 6, 27, 407, 1, 29, 'বৈষ্ণবদাস পশ্চিমপাড়া জামে মসজিদ', '1895', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(33, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর দক্ষিণপাড়া জামে মসজিদ', '1950', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(34, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর বাজার জামে মসজিদ', '1995', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(35, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর উত্তরপাড়া জামে মসজিদ', '1870', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(36, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর উত্তরপাড়া জামে মসজিদ', '1975', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(37, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর সোনিয়াপাড়া জামে মসজিদ', '1975', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(38, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর পশ্চিমপাড়া ওয়াক্তিয়া জামে মসজিদ', '1997', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(39, 6, 27, 407, 1, 33, 'ছান্দিয়াপুর দক্ষিণপাড়া পাঞ্জেগানা জামে মসজিদ', '1975', 'ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:16:46', '2026-01-20 13:16:46'),
(40, 6, 27, 407, 1, 34, 'রসুলপুর আকড়া পাড়ামাদ্রাসা প্রাঙ্গন জামে মসজিদ', '2000', 'আকড়া পাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(41, 6, 27, 407, 1, 34, 'রসুলপুর আকড়াপাড়া পুরাতন জামে মসজিদ', '1930', 'আকড়া পাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(42, 6, 27, 407, 1, 34, 'রসুলপুর পন্ডিতপাড়া জামে মসজিদ', '1932', 'আকড়া পাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(43, 6, 27, 407, 1, 34, 'রসুলপুর চর পাড়া জামে মসজিদ', '1996', 'আকড়া পাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(44, 6, 27, 407, 1, 34, 'রসুলপুর কাজীপাড়া জামে মসজিদ', '1938', 'আকড়া পাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(45, 6, 27, 407, 1, 35, 'রসুলপুর মধ্য কাজীপাড়া জামে মসজিদ', '1964', 'মধ্য কাজীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(46, 6, 27, 407, 1, 35, 'রসুলপুর কুঠিপাড়া জামে মসজিদ', '1940', 'মধ্য কাজীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(47, 6, 27, 407, 1, 35, 'রসুলপুর কুঠিপাড়া নুতন জামে মসজিদ', '2000', 'মধ্য কাজীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(48, 6, 27, 407, 1, NULL, 'রসুলপুর মধ্যপাড়া জামে মসজিদ', '1985', 'মধ্যপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(49, 6, 27, 407, 1, 36, 'রসুলপুর ফকিরপাড়া জামে মসজিদ', '1937', 'ফকিরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(50, 6, 27, 407, 1, 36, 'রসুলপুর শাহপাড়া জামে মসজিদ', NULL, 'ফকিরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(51, 6, 27, 407, 1, 29, 'রসুলপুর আরাজী ছান্দিয়াপুর বটতলা জামে মসজিদ', '2006', 'আরাজী ছান্দিয়াপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(52, 6, 27, 407, 1, 37, 'রসুলপুর আরাজী তরফকামাল জামে মসজিদ', '1962', 'আরাজী তরফকামাল', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(53, 6, 27, 407, 1, 38, 'রসুলপুর তরফ ফাজিল নামাপাড়া জামে মসজিদ', '1972', 'নামাপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(54, 6, 27, 407, 1, 38, 'রসুলপুর তরফ ফাজিল নামাপাড়া জামে মসজিদ', '1970', 'নামাপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(55, 6, 27, 407, 1, NULL, 'রসুলপুর মধ্যপাড়া জামে মসজিদ', '2007', 'মধ্যপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(56, 6, 27, 407, 1, 40, 'রসুলপুর কুমিদপুর জামে মসজিদ', '1995', 'কুমিদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(57, 6, 27, 407, 1, 40, 'রসুলপুর কুমিদপুর জামে মসজিদ', '1998', 'কুমিদপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(58, 6, 27, 407, 1, 42, 'শ্রীরামপুর দক্ষিণপাড়া জামে মসজিদ', '1926', 'শ্রীরামপুর দক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(59, 6, 27, 407, 1, 41, 'শ্রীরামপুর পরামানিকপাড়া জামে মসজিদ', '1945', 'শ্রীরামপুর পশ্চিমপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(60, 6, 27, 407, 1, 42, 'শ্রীরামপুর লাহিরীর ছড়া জামে মসজিদ', '1950', 'শ্রীরামপুর দক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(61, 6, 27, 407, 1, 43, 'শ্রীরামপুর বগুড়াপাড়া জামে মসজিদ', '1985', 'শ্রীরামপুর বগুড়াপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(62, 6, 27, 407, 1, 44, 'শ্রীরামপুর মিয়াপাড়া জামে মসজিদ', '1935', 'শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(63, 6, 27, 407, 1, 44, 'শ্রীরামপুর নতুন বাড়ী জামে মসজিদ', '1995', 'শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(64, 6, 27, 407, 1, 45, 'শ্রীরামপুর হাজীবাড়ী জামে মসজিদ', '1940', 'উত্তর শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(65, 6, 27, 407, 1, 45, 'শ্রীরামপুর মন্তজপাড়া জামে মসজিদ', '1950', 'উত্তর শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(66, 6, 27, 407, 1, 46, 'শ্রীরামপুর হাফিজিয়া মসজিদ', '2001', 'মধ্য শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(67, 6, 27, 407, 1, 46, 'পূর্বশ্রীরামপুর মধ্যপাড়ানুর জামে মসজিদ', '1997', 'মধ্য শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(68, 6, 27, 407, 1, 47, 'পূর্বশ্রীরামপুর আকন্দপাড়া জামে মসজিদ', '1336', 'পূর্ব শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(69, 6, 27, 407, 1, 47, 'পূর্বশ্রীরামপুর মুত্তালিব মাস্টার বাড়ী জামে মসজিদ', '1995', 'পূর্ব শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(70, 6, 27, 407, 1, 48, 'দক্ষিণশ্রীরামপুর জ্ঞানহাজীর বাড়ী জামে মসজিদ', NULL, 'দক্ষিণ শ্রীরামপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:21:06', '2026-01-20 13:21:06'),
(71, 6, 27, 407, 2, 50, 'পশ্চিমকুটিপাড়া জামে মসজিদ', '1974', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(72, 6, 27, 407, 2, 50, 'মধ্যকুটিপাড়া জামে মসজিদ', '1940', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(73, 6, 27, 407, 2, 50, 'পূর্বকুটিপাড়া জামে মসজিদ', '1968', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(74, 6, 27, 407, 2, 50, 'খামারদশলিয়া পাঞ্জেগানা (মা:) মসজিদ', '2000', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(75, 6, 27, 407, 2, 50, 'খামারদশলিয়া সরকারবাড়ী জামে মসজিদ', '1936', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(76, 6, 27, 407, 2, 50, 'পূর্ব খামারদশরিয়া জামে মসজিদ', '1932', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(77, 6, 27, 407, 2, 50, 'পূর্ব খামারদশলিয়া ব্যাপারীপাড়া পাঞ্জেগানা মসজিদ', '1930', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(78, 6, 27, 407, 2, 50, 'পূর্ব খামারদশলিয়া (ষোলঘর) জামে মসজিদ', '1928', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(79, 6, 27, 407, 2, 50, 'পূর্ব খামারদশলিয়া (ষোলঘর) মিয়াবাড়ী জামে মসজিদ', '1939', 'খামারদশরিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(80, 6, 27, 407, 2, 51, 'পশ্চিম খামারদশরিয়া নয়াবাড়ী জামে মসজিদ', '1942', 'নলডাঙ্গা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(81, 6, 27, 407, 2, 51, 'পশ্চিম খামারদশলিয়া দশানীপাড়া জামে মসজিদ', '1915', 'নলডাঙ্গা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(82, 6, 27, 407, 2, 51, 'নলডাঙ্গা কাচারীবাজার জামে মসজিদ', '1985', 'নলডাঙ্গা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(83, 6, 27, 407, 2, 52, 'কিশামতহামিদ নূরানী পাঞ্জেগানা মসজিদ', '2003', 'কিশামতহামিদ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(84, 6, 27, 407, 2, 52, 'উত্তর কিশামতহামিদ কালের মামুদ আকন্দ বাড়ী জামে মসজিদ', '1805', 'কিশামতহামিদ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(85, 6, 27, 407, 2, 52, 'মধ্য কিশামতহামিদ মধ্যপাড়া জামে মসজিদ', '1907', 'কিশামতহামিদ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(86, 6, 27, 407, 2, 52, 'কিশামতহামিদ মধ্যপাড়া জামে মসজিদ', '1905', 'কিশামতহামিদ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(87, 6, 27, 407, 2, 52, 'পশ্চিম কিশামতহামিদ জামে মসজিদ', '1900', 'কিশামতহামিদ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(88, 6, 27, 407, 2, 53, 'নলডাঙ্গা টুপামারী দারুসছালাম জামে মসজিদ', '1935', 'টুপামারীনলডাঙ্গা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(89, 6, 27, 407, 2, 54, 'দক্ষিণমন্দুয়ারপাড়া জামে মসজিদ', '1985', 'দক্ষিণমন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(90, 6, 27, 407, 2, 54, 'দক্ষিণমন্দুয়ারপাড়া পাঞ্জেগানা মসজিদ', '2005', 'দক্ষিণমন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(91, 6, 27, 407, 2, 55, 'মধ্যমন্দুয়ারপাড়া জামে মসজিদ', '1921', 'মন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(92, 6, 27, 407, 2, 55, 'জয়নাল মেম্বার বাড়ী পাঞ্জেগানা মসজিদ', '2002', 'মন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(93, 6, 27, 407, 2, 55, 'রিয়াজুল মেম্বার বাড়ী জামে মসজিদ', '1992', 'মন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(94, 6, 27, 407, 2, 56, 'মন্দুয়ারপাড়া মন্ডল বাড়ী জামে মসজিদ', '1972', 'মন্ডলপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(95, 6, 27, 407, 2, 57, 'মধ্যমন্দুয়ারপাড়া জামে মসজিদ', '1982', 'মধ্যমন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(96, 6, 27, 407, 2, 58, 'দশলিয়া গুচ্ছগ্রামপাড়া জামে মসজিদ', '1990', 'দশলিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(97, 6, 27, 407, 2, 58, 'দশলিয়া রেলগেট পাঞ্জেগানা মসজিদ', '1983', 'দশলিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(98, 6, 27, 407, 2, 59, 'স্টেশন জামে মসজিদ', '1935', 'প্রতাব', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(99, 6, 27, 407, 2, 59, 'মিয়াবাড়ী জামে মসজিদ', '1971', 'প্রতাব', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(100, 6, 27, 407, 2, 60, 'শাহার বাড়ী পাঞ্জেগানা মসজিদ', '1965', 'পূর্বপ্রতাপ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(101, 6, 27, 407, 2, 61, 'মিয়াবাড়ী পাঞ্জেগানা মসজিদ', '1985', 'প্রতাপ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(102, 6, 27, 407, 2, 62, 'ফুলপাড়া জামে মসজিদ', '1942', 'ফুলপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(103, 6, 27, 407, 2, 63, 'পূর্বপ্রতাব জামে মসজিদ', '1869', 'পূর্বপ্রতাব', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(104, 6, 27, 407, 2, 64, 'শোলাগাড়ী জামে মসজিদ', '1925', 'শোলাগাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(105, 6, 27, 407, 2, 65, 'পূর্বমন্দুয়ারপাড়া জামে মসজিদ', '1845', 'পূর্বমন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(106, 6, 27, 407, 2, 66, 'পশ্চিমমন্দুয়ারপাড়া জামে মসজিদ', '1995', 'পশ্চিমমন্দুয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:25:29', '2026-01-20 13:25:29'),
(107, 6, 27, 407, 3, 101, 'সরদারপাড়া জামে মসজিদ', '1945', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(108, 6, 27, 407, 3, 101, 'ধংগাপাড়া জামে মসজিদ', '1950', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(109, 6, 27, 407, 3, 101, 'ছড়ারবাতা জামে মসজিদ', '1910', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(110, 6, 27, 407, 3, 101, 'মুন্সিপাড়া জামে মসজিদ', '1985', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(111, 6, 27, 407, 3, 101, 'উত্তরভাঙ্গামোড় কুটিপাড়া জামে মসজিদ', '1908', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(112, 6, 27, 407, 3, 101, 'উত্তরভাঙ্গামোড় কুটিপাড়া জামে মসজিদ', '1952', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(113, 6, 27, 407, 3, 101, 'বামনপাড়া জামে মসজিদ', '1908', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(114, 6, 27, 407, 3, 101, 'অজ্ঞাত পাড়া জামে মসজিদ', '1920', 'উত্তরভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(115, 6, 27, 407, 3, 106, 'উত্তরভাঙ্গামোড় প্রামানিকপাড়া জামে মসজিদ', '1910', 'মধ্যভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(116, 6, 27, 407, 3, 106, 'মধ্যভাঙ্গামোড় জামে মসজিদ', '1910', 'মধ্যভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(117, 6, 27, 407, 3, 106, 'মধ্যভাঙ্গামোড় ছবিরবাড়ী জামে মসজিদ', '1980', 'মধ্যভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(118, 6, 27, 407, 3, 106, 'কান্তনগর বাজার জামে মসজিদ', '1985', 'কান্তনগরবাজার', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(119, 6, 27, 407, 3, 106, 'কিশামতদশলিয়া জামে মসজিদ', '1988', 'মধ্যভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(120, 6, 27, 407, 3, NULL, 'দক্ষিণভাঙ্গামোড় জামে মসজিদ', '1910', 'দক্ষিণভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(121, 6, 27, 407, 3, 103, 'জামুডাঙ্গা জুনিয়ারপাড়া জামে মসজিদ', '1905', 'জুনিয়ারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(122, 6, 27, 407, 3, 106, 'ইন্তাজসিয়া জামে মসজিদ', '1988', 'মধ্যভাঙ্গামোড়', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(123, 6, 27, 407, 3, 106, 'কান্তনগর ফকিরের জামে মসজিদ', '1990', 'কান্তনগর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(124, 6, 27, 407, 3, 105, 'দামোদরপুর বুড়িরভিটা জামে মসজিদ', '1905', 'বুড়িরভিটা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(125, 6, 27, 407, 3, 105, 'দামোদরপুর কলারবাগান জামে মসজিদ', '1890', 'কলারবাগান', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(126, 6, 27, 407, 3, 105, 'দামোদরপুর সরকারবাড়ী জামে মসজিদ', '1992', 'সরকারবাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(127, 6, 27, 407, 3, 106, 'মধ্যহাট বামুনী জামে মসজিদ', '2000', 'হাটবামুনী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(128, 6, 27, 407, 3, 106, 'পূর্ব দামোদরপুর জামে মসজিদ', '1910', 'পূর্বদামোদরপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(129, 6, 27, 407, 3, 101, 'সর্দারপাড়া জামে মসজিদ', '1968', 'সরদারপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(130, 6, 27, 407, 3, 106, 'উত্তর দামোদরপুর শিংগিরখামার জামে মসজিদ', '1947', 'শিংগিরখামার', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(131, 6, 27, 407, 3, 106, 'দামোদরপুর দেবেত্তর জামে মসজিদ', '1888', 'দেবেত্তর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(132, 6, 27, 407, 3, 106, 'দামোদরপুর কাজীপাড়া জামে মসজিদ', '1926', 'কাজীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(133, 6, 27, 407, 3, 107, 'কিশামতদশলিয়া জামে মসজিদ', '2003', 'কিশামতদশলিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(134, 6, 27, 407, 3, 107, 'কিশামতদশলিয়া দক্ষিণপাড়া জিন্নাতবাড়ী জামে মসজিদ', '1935', 'কিশামতদশলিয়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(135, 6, 27, 407, 3, 106, 'দামোদরপুর ফুলমন ব্যাপারীপাড়া জামে মসজিদ', '1904', 'ব্যাপারীপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(136, 6, 27, 407, 3, 101, 'দামোদরপুর উত্তরপাড়া জামে মসজিদ', '1985', 'উত্তরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(137, 6, 27, 407, 3, 101, 'দামোদরপুর পশ্চিমপাড়া জামে মসজিদ', '1999', 'পশ্চিমপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(138, 6, 27, 407, 3, 101, 'পশ্চিম দামোদরপুর টেংনারভিটা জামে মসজিদ', '1975', 'টেংনারভিটা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(139, 6, 27, 407, 3, 101, 'দামোদরপুর মাতারহাট জামে মসজিদ', '1984', 'মাতারহাট', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(140, 6, 27, 407, 3, NULL, 'দামোদরপুর নাড়িয়াসাবু জামে মসজিদ', '1955', 'দামোদরপুর', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(141, 6, 27, 407, 3, 101, 'পশ্চিম দামোদরপুর তালওয়ালা পাড়া জামে মসজিদ', '1995', 'তালওয়ালাপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(142, 6, 27, 407, 3, 101, 'পশ্চিম দামোদরপুর জালারবাড়ী জামে মসজিদ', '1963', 'জালারবাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(143, 6, 27, 407, 3, 107, 'কিশামতদশলিয়া কচুবাড়ী জামে মসজিদ', '2005', 'কচুবাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(144, 6, 27, 407, 3, 101, 'দামোদরপুর জামে মসজিদ', '1976', 'দুলামাস্টারবাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(145, 6, 27, 407, 3, 101, 'টেংনারভিটা জামে মসজিদ', '1959', 'টেংনারভিটা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:30:12', '2026-01-20 13:30:12'),
(146, 6, 27, 407, 3, 94, 'কিশামতবড়বাড়ীপূর্বপাড়াজামেমসজিদ', '1955', 'কিশামতবড়বাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(147, 6, 27, 407, 3, 94, 'কিশামতবড়বাড়ীদক্ষিণপাড়াজামেমসজিদ', '1980', 'কিশামতবড়বাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(148, 6, 27, 407, 3, 94, 'কিশামতবড়বাড়ীপশ্চিমপাড়াজামেমসজিদ', '1930', 'কিশামতবড়বাড়ী', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(149, 6, 27, 407, 3, 95, 'মরুয়াদহদক্ষিণপাড়াজামেমসজিদ', '2007', 'মরুয়াদহদক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(150, 6, 27, 407, 3, 96, 'জামুডাঙ্গাসরকারপাড়াজামেমসজিদ', '1807', 'জামুডাঙ্গাদক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(151, 6, 27, 407, 3, 97, 'জামুডাঙ্গামন্ডলপাড়াজামেমসজিদ', '1960', 'জামুডাঙ্গামন্ডলপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(152, 6, 27, 407, 3, 98, 'চিটজামুডাঙ্গাকোবাজউদ্দিনমুন্সিরবাড়ীজামেমসজিদ', '1880', 'চিটজামুডাঙ্গা', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(153, 6, 27, 407, 3, 99, 'চিটজামুডাঙ্গাজামেমসজিদ', '1990', 'চিটজামুডাঙ্গাপশ্চিমপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(154, 6, 27, 407, 3, 100, 'মরুয়াদহজহিরসরকারবাড়ীজামেমসজিদ', '1970', 'মরুয়াদহউত্তরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(155, 6, 27, 407, 3, 101, 'ভাঙ্গামোড়খনিয়ারপাড়াদক্ষিণপাড়াজামেমসজিদ', '2004', 'ভাঙ্গামোড়দক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(156, 6, 27, 407, 3, 102, 'ভাঙ্গামোড়খনিয়ারপাড়াউত্তরপাড়াজামেমসজিদ', '1870', 'ভাঙ্গামোড়উত্তরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(157, 6, 27, 407, 3, 103, 'জামুডাঙ্গাবাছিয়াপাড়াজামেমসজিদ', '1995', 'জামুডাঙ্গাবাছিয়াপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(158, 6, 27, 407, 3, 104, 'জামুডাঙ্গালালবাজারজামেমসজিদ', '1806', 'জামুডাঙ্গালালবাজার', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(159, 6, 27, 407, 3, 96, 'জামুডাঙ্গালালবাজারদক্ষিণপাড়াজামেমসজিদ', '1960', 'জামুডাঙ্গাদক্ষিণপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(160, 6, 27, 407, 3, 105, 'জামুডাঙ্গাবকশিরভিটাজামেমসজিদ', '1940', 'জামুডাঙ্গাউত্তরপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(161, 6, 27, 407, 3, 106, 'মরুয়াদহব্যাপারীপাড়াজামেমসজিদ', '1935', 'মরুয়াদহমধ্যপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(162, 6, 27, 407, 3, 107, 'কিশামতখেজুউত্তরপাড়াজামেমসজিদ', '1970', 'কিশামতখেজু', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(163, 6, 27, 407, 3, 107, 'কিশামতখেঝুহাজীবাড়ীজামেমসজিদ', '1990', 'কিশামতখেজু', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(164, 6, 27, 407, 3, 107, 'কিশামতখেজুমধ্যপাড়াজামেমসজিদ', '1980', 'কিশামতখেজু', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(165, 6, 27, 407, 3, 106, 'কিশামতখেজুবাজারপাঞ্জেগানামসজিদ', '1996', 'মরুয়াদহমধ্যপাড়া', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-20 13:42:19', '2026-01-20 13:42:19'),
(166, 6, 27, 407, 1, 3, 'কিশামত তাজপুর ডিলার বাড়ী জামে মসজিদ', '১৯৪০', 'কিশামত তাজপুর', 'তাজ', '-', '02135675645656', '01320685365332', 'mosques/IWO1b88FNgfRI6CEWZXQcDfOTzOvlnfOCtYk2KAz.jpg', 'কিশামত তাজপুর', 1, '2026-01-20 22:50:23', '2026-01-20 22:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_trx_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `order_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `ready_to_ship_at` timestamp NULL DEFAULT NULL,
  `shiped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `mobile`, `email`, `address_title`, `delivery_cost`, `subtotal`, `grand_total`, `paid_amount`, `order_status`, `payment_status`, `payment_method`, `payment_gateway`, `payment_trx_id`, `pending_at`, `order_note`, `confirmed_at`, `ready_to_ship_at`, `shiped_at`, `delivered_at`, `canceled_at`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 2800.00, 2800.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:28:39', '2025-09-01 11:28:39'),
(2, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:30:30', '2025-09-01 11:30:30'),
(3, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:34:42', '2025-09-01 11:34:42'),
(4, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:37:35', '2025-09-01 11:37:35'),
(5, 1, 'Admin', '0198009329', 'admin@gmail.com', 'dhaka', 0.00, 4704.00, 4704.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-03 22:07:53', '2025-09-03 22:07:53'),
(6, 1, 'Admin', NULL, 'admin@gmail.com', 'Dhaka', 0.00, 729.00, 729.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-03 22:09:01', '2025-09-03 22:09:01'),
(7, 164, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 620.00, 620.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, '2025-09-03 22:47:52', '2025-09-03 22:47:52'),
(8, 163, 'Sultan Ahmmed', '01717000000', 'admin01@gmail.com', 'Dhaka', 0.00, 4595.00, 4595.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 163, NULL, '2025-09-03 22:59:04', '2025-09-03 22:59:04'),
(9, 1, 'Admin', '0198009329', 'admin@gmail.com', 'dhaka', 150.00, 2125.00, 2275.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(10, 1, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Tangail', 150.00, 1375.00, 1525.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-11 07:18:49', '2025-09-11 07:18:49'),
(11, 166, 'Rasel', '01925923278', 'rasel93.ict@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 369.00, 519.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166, NULL, '2025-09-11 07:31:27', '2025-09-11 07:31:27'),
(12, 166, 'Rasel', '01925923278', 'rasel93.ict@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 109.00, 259.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166, NULL, '2025-09-13 14:04:46', '2025-09-13 14:04:46'),
(13, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 1028.00, 1178.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-23 09:02:41', '2025-09-23 09:02:41'),
(14, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 109.00, 259.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-23 09:07:44', '2025-09-23 09:07:44'),
(15, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 1860.00, 2010.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 09:00:09', '2025-09-24 09:00:09'),
(16, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 1120.00, 1270.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 09:02:04', '2025-09-24 09:02:04'),
(17, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 620.00, 770.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 09:23:36', '2025-09-24 09:23:36'),
(18, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 2513.00, 2663.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 09:38:28', '2025-09-24 09:38:28'),
(19, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 284.00, 434.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 09:39:17', '2025-09-24 09:39:17'),
(20, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 1648.00, 1798.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 11:08:19', '2025-09-24 11:08:19'),
(21, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 1823.00, 1973.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 13:46:49', '2025-09-24 13:46:49'),
(22, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 1229.00, 1379.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 13:48:32', '2025-09-24 13:48:32'),
(23, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 4880.00, 5030.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 13:54:51', '2025-09-24 13:54:51'),
(24, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 2880.00, 3030.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 14:14:47', '2025-09-24 14:14:47'),
(25, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 70.00, 2100.00, 2170.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 14:16:23', '2025-09-24 14:16:23'),
(26, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 120.00, 600.00, 720.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 14:25:58', '2025-09-24 14:25:58'),
(27, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 150.00, 1080.00, 1230.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 14:34:32', '2025-09-24 14:34:32'),
(28, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 170.00, 1028.00, 1198.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 14:42:25', '2025-09-24 14:42:25'),
(29, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 170.00, 600.00, 770.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-24 15:00:46', '2025-09-24 15:00:46'),
(30, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 110.00, 110.00, 220.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-25 08:28:29', '2025-09-25 08:28:29'),
(31, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', NULL, 110.00, 1099.00, 1209.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-25 08:42:07', '2025-09-25 08:42:07'),
(32, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304. 1 Gopalpur, Tangail', 70.00, 200.00, 270.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-25 08:46:09', '2025-09-25 08:46:09'),
(33, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Dhaka', 130.00, 240.00, 370.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-25 08:47:00', '2025-09-25 08:47:00'),
(34, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Gauripur, Mymensingh', 130.00, 1028.00, 1158.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-25 09:05:12', '2025-09-25 09:05:12'),
(35, NULL, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Shibalaya, Manikganj', 70.00, 1093.00, 1163.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 04:27:10', '2025-09-26 04:27:10'),
(36, NULL, 'Karim', '01925923276', 'jamal@gmail.com', 'Jamalpur Sadar, Jamalpur', 90.00, 620.00, 710.00, 0.00, 'pending', 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 04:29:36', '2025-09-26 04:29:36'),
(37, NULL, 'morjina', '019586632859', 'morjina@gmail.com', 'Barhatta Upazilla, Netrokona', 70.00, 729.00, 799.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 04:38:51', '2025-09-26 04:38:51'),
(38, NULL, 'keramot', '0172596314', 'keramot @gmail.com', 'Rupganj, Narayanganj', 110.00, 729.00, 839.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 04:52:07', '2025-09-26 04:52:07'),
(39, NULL, 'moitta', '0258963147', 'moitta@gmail.com', 'Kaliakior, Gazipur', 110.00, 2430.00, 2540.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 05:05:28', '2025-09-26 05:05:28'),
(40, NULL, 'rumir', '9876544321', 'rumir@gmail.com', 'Lalpur, Natore', 110.00, 620.00, 730.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-26 05:07:25', '2025-09-26 05:07:25'),
(41, 165, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Faridpur Sadar, Faridpur', 0.00, 180.00, 180.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2025-09-26 05:17:18', '2025-09-26 05:17:18'),
(42, NULL, 'Md. Arif Mehedi', '01925923276', 'mehediarif.du@gmail.com', 'Narsingdi Sadar, Narsingdi', 90.00, 729.00, 819.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-27 04:21:13', '2025-09-27 04:21:13'),
(43, NULL, 'Arif', '01925923276', 'mehediarif.du@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 0.00, 729.00, 729.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-27 04:25:32', '2025-09-27 04:25:32'),
(44, NULL, 'naraj', '01925923276', 'naraj@gmail.com', 'test addresss', 0.00, 620.00, 620.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, 'test phone 01925923276', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-12 17:11:02', '2025-10-12 17:11:02'),
(45, NULL, 'master', NULL, 'master@gmail.com', 'Dhaka , chandina', 0.00, 109.00, 109.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-22 05:05:11', '2025-10-22 05:05:11'),
(46, NULL, 'aa', NULL, 'bb', 'dhaka', 0.00, 620.00, 620.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-26 06:14:13', '2025-10-26 06:14:13'),
(47, NULL, 'zahid', '01925923276', 'zahid@gmail.com', 'dhaka , 1204', 0.00, 109.00, 109.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-26 06:27:59', '2025-10-26 06:27:59'),
(48, NULL, 'sami', '123456789', 'sami@gmail.com', 'dhnamondi , dhaka', 0.00, 15.00, 15.00, 0.00, 'pending', 'pending', 'online', 'online', '1234567891011121314151617181920', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-26 06:29:49', '2025-10-26 06:29:49'),
(49, NULL, 'aa', NULL, 'aa@gmail.com', 'Dhaka', 68.00, 109.00, 177.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-05 07:49:19', '2025-11-05 07:49:19'),
(50, 1, 'Arif', NULL, 'mehediarif.du@gmail.com', 'Tangail', 0.00, 15.00, 15.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-11-21 07:27:52', '2025-11-21 07:27:52'),
(51, 1, 'Arif', NULL, 'mehediarif.du@gmail.com', 'Tangail', 0.00, 500.00, 500.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-11-21 07:29:06', '2025-11-21 07:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `user_id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`, `total_cost`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 118, 1, 3, 'Blood Pressure Monitor (Renevo) each', 2800.00, 1, 2800.00, 118, NULL, '2025-09-01 11:28:39', '2025-09-01 11:28:39'),
(2, 118, 2, 2, 'First Aid Kit Box, Medicine Box', 175.00, 1, 175.00, 118, NULL, '2025-09-01 11:30:30', '2025-09-01 11:30:30'),
(3, 118, 3, 2, 'First Aid Kit Box, Medicine Box', 175.00, 1, 175.00, 118, NULL, '2025-09-01 11:34:42', '2025-09-01 11:34:42'),
(4, 118, 4, 2, 'First Aid Kit Box, Medicine Box', 175.00, 1, 175.00, 118, NULL, '2025-09-01 11:37:35', '2025-09-01 11:37:35'),
(5, 1, 5, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 5, 4595.00, 1, NULL, '2025-09-03 22:07:53', '2025-09-03 22:07:53'),
(6, 1, 5, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 1, NULL, '2025-09-03 22:07:53', '2025-09-03 22:07:53'),
(7, 1, 6, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 1, NULL, '2025-09-03 22:09:01', '2025-09-03 22:09:01'),
(8, 1, 6, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 1, NULL, '2025-09-03 22:09:01', '2025-09-03 22:09:01'),
(9, 164, 7, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 164, NULL, '2025-09-03 22:47:52', '2025-09-03 22:47:52'),
(10, 163, 8, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 5, 4595.00, 163, NULL, '2025-09-03 22:59:04', '2025-09-03 22:59:04'),
(11, 1, 9, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 2, 1240.00, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(12, 1, 9, 8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', 175.00, 3, 525.00, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(13, 1, 9, 6, 'A6 Freedom Regular Flow Sanitary Napkin 8 pads', 45.00, 4, 180.00, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(14, 1, 9, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(15, 1, 9, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(16, 1, 10, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 2, 1240.00, 1, NULL, '2025-09-11 07:18:49', '2025-09-11 07:18:49'),
(17, 1, 10, 6, 'A6 Freedom Regular Flow Sanitary Napkin 8 pads', 45.00, 3, 135.00, 1, NULL, '2025-09-11 07:18:49', '2025-09-11 07:18:49'),
(18, 166, 11, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 166, NULL, '2025-09-11 07:31:27', '2025-09-11 07:31:27'),
(19, 166, 11, 7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', 65.00, 4, 260.00, 166, NULL, '2025-09-11 07:31:27', '2025-09-11 07:31:27'),
(20, 166, 12, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 166, NULL, '2025-09-13 14:04:46', '2025-09-13 14:04:46'),
(21, 165, 13, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-23 09:02:41', '2025-09-23 09:02:41'),
(22, 165, 13, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-23 09:02:41', '2025-09-23 09:02:41'),
(23, 165, 14, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-23 09:07:44', '2025-09-23 09:07:44'),
(24, 165, 15, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 3, 1860.00, 165, NULL, '2025-09-24 09:00:09', '2025-09-24 09:00:09'),
(25, 165, 16, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 09:02:04', '2025-09-24 09:02:04'),
(26, 165, 16, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 1, 500.00, 165, NULL, '2025-09-24 09:02:04', '2025-09-24 09:02:04'),
(27, 165, 17, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 09:23:36', '2025-09-24 09:23:36'),
(28, 165, 18, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 2, 218.00, 165, NULL, '2025-09-24 09:38:28', '2025-09-24 09:38:28'),
(29, 165, 18, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 3, 1500.00, 165, NULL, '2025-09-24 09:38:28', '2025-09-24 09:38:28'),
(30, 165, 18, 8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', 175.00, 1, 175.00, 165, NULL, '2025-09-24 09:38:28', '2025-09-24 09:38:28'),
(31, 165, 18, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 09:38:28', '2025-09-24 09:38:28'),
(32, 165, 19, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-24 09:39:17', '2025-09-24 09:39:17'),
(33, 165, 19, 8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', 175.00, 1, 175.00, 165, NULL, '2025-09-24 09:39:17', '2025-09-24 09:39:17'),
(34, 165, 20, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-24 11:08:19', '2025-09-24 11:08:19'),
(35, 165, 20, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-24 11:08:19', '2025-09-24 11:08:19'),
(36, 165, 20, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 11:08:19', '2025-09-24 11:08:19'),
(37, 165, 21, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-24 13:46:49', '2025-09-24 13:46:49'),
(38, 165, 21, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 13:46:49', '2025-09-24 13:46:49'),
(39, 165, 21, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-24 13:46:49', '2025-09-24 13:46:49'),
(40, 165, 21, 8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', 175.00, 1, 175.00, 165, NULL, '2025-09-24 13:46:49', '2025-09-24 13:46:49'),
(41, 165, 22, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-24 13:48:32', '2025-09-24 13:48:32'),
(42, 165, 22, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, 165, NULL, '2025-09-24 13:48:32', '2025-09-24 13:48:32'),
(43, 165, 22, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 1, 500.00, 165, NULL, '2025-09-24 13:48:32', '2025-09-24 13:48:32'),
(44, 165, 23, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 165, NULL, '2025-09-24 13:54:51', '2025-09-24 13:54:51'),
(45, 165, 23, 4, 'VivaChek Ino Glucose Test Meter each', 2000.00, 1, 2000.00, 165, NULL, '2025-09-24 13:54:51', '2025-09-24 13:54:51'),
(46, 165, 23, 3, 'Blood Pressure Monitor (Renevo) each', 2800.00, 1, 2800.00, 165, NULL, '2025-09-24 13:54:51', '2025-09-24 13:54:51'),
(47, 165, 24, 3, 'Blood Pressure Monitor (Renevo) each', 2800.00, 1, 2800.00, 165, NULL, '2025-09-24 14:14:47', '2025-09-24 14:14:47'),
(48, 165, 24, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 165, NULL, '2025-09-24 14:14:47', '2025-09-24 14:14:47'),
(49, 165, 25, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, 165, NULL, '2025-09-24 14:16:23', '2025-09-24 14:16:23'),
(50, 165, 25, 4, 'VivaChek Ino Glucose Test Meter each', 2000.00, 1, 2000.00, 165, NULL, '2025-09-24 14:16:23', '2025-09-24 14:16:23'),
(51, 165, 26, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, 165, NULL, '2025-09-24 14:25:58', '2025-09-24 14:25:58'),
(52, 165, 26, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 1, 500.00, 165, NULL, '2025-09-24 14:25:58', '2025-09-24 14:25:58'),
(53, 165, 27, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 2, 1000.00, 165, NULL, '2025-09-24 14:34:32', '2025-09-24 14:34:32'),
(54, 165, 27, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 165, NULL, '2025-09-24 14:34:32', '2025-09-24 14:34:32'),
(55, 165, 28, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-24 14:42:25', '2025-09-24 14:42:25'),
(56, 165, 28, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-24 14:42:25', '2025-09-24 14:42:25'),
(57, 165, 29, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 5, 400.00, 165, NULL, '2025-09-24 15:00:46', '2025-09-24 15:00:46'),
(58, 165, 29, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 2, 200.00, 165, NULL, '2025-09-24 15:00:46', '2025-09-24 15:00:46'),
(59, 165, 30, 7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', 65.00, 1, 65.00, 165, NULL, '2025-09-25 08:28:29', '2025-09-25 08:28:29'),
(60, 165, 30, 6, 'A6 Freedom Regular Flow Sanitary Napkin 8 pads', 45.00, 1, 45.00, 165, NULL, '2025-09-25 08:28:29', '2025-09-25 08:28:29'),
(61, 165, 31, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 165, NULL, '2025-09-25 08:42:07', '2025-09-25 08:42:07'),
(62, 165, 31, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-25 08:42:07', '2025-09-25 08:42:07'),
(63, 165, 31, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, 165, NULL, '2025-09-25 08:42:07', '2025-09-25 08:42:07'),
(64, 165, 32, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 2, 200.00, 165, NULL, '2025-09-25 08:46:09', '2025-09-25 08:46:09'),
(65, 165, 33, 8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', 175.00, 1, 175.00, 165, NULL, '2025-09-25 08:47:00', '2025-09-25 08:47:00'),
(66, 165, 33, 7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', 65.00, 1, 65.00, 165, NULL, '2025-09-25 08:47:00', '2025-09-25 08:47:00'),
(67, 165, 34, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, 165, NULL, '2025-09-25 09:05:12', '2025-09-25 09:05:12'),
(68, 165, 34, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, 165, NULL, '2025-09-25 09:05:12', '2025-09-25 09:05:12'),
(69, NULL, 35, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-09-26 04:27:10', '2025-09-26 04:27:10'),
(70, NULL, 35, 13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', 919.00, 1, 919.00, NULL, NULL, '2025-09-26 04:27:10', '2025-09-26 04:27:10'),
(71, NULL, 35, 7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', 65.00, 1, 65.00, NULL, NULL, '2025-09-26 04:27:10', '2025-09-26 04:27:10'),
(72, NULL, 36, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-26 04:29:36', '2025-09-26 04:29:36'),
(73, NULL, 37, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-26 04:38:51', '2025-09-26 04:38:51'),
(74, NULL, 37, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-09-26 04:38:51', '2025-09-26 04:38:51'),
(75, NULL, 38, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-26 04:52:07', '2025-09-26 04:52:07'),
(76, NULL, 38, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-09-26 04:52:07', '2025-09-26 04:52:07'),
(77, NULL, 39, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, NULL, NULL, '2025-09-26 05:05:28', '2025-09-26 05:05:28'),
(78, NULL, 39, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, NULL, NULL, '2025-09-26 05:05:28', '2025-09-26 05:05:28'),
(79, NULL, 39, 1, 'Nebulizer Save Life-01', 2250.00, 1, 2250.00, NULL, NULL, '2025-09-26 05:05:28', '2025-09-26 05:05:28'),
(80, NULL, 40, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-26 05:07:25', '2025-09-26 05:07:25'),
(81, 165, 41, 5, 'AF5 SMC Joya Regular Wings 8 pads', 80.00, 1, 80.00, 165, NULL, '2025-09-26 05:17:18', '2025-09-26 05:17:18'),
(82, 165, 41, 9, 'Dettol Handwash Original Liquid Pump 200 ml', 100.00, 1, 100.00, 165, NULL, '2025-09-26 05:17:18', '2025-09-26 05:17:18'),
(83, NULL, 42, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-09-27 04:21:13', '2025-09-27 04:21:13'),
(84, NULL, 42, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-27 04:21:13', '2025-09-27 04:21:13'),
(85, NULL, 43, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-09-27 04:25:32', '2025-09-27 04:25:32'),
(86, NULL, 43, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-09-27 04:25:32', '2025-09-27 04:25:32'),
(87, NULL, 44, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-10-12 17:11:02', '2025-10-12 17:11:02'),
(88, NULL, 45, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-10-22 05:05:11', '2025-10-22 05:05:11'),
(89, NULL, 46, 11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', 620.00, 1, 620.00, NULL, NULL, '2025-10-26 06:14:13', '2025-10-26 06:14:13'),
(90, NULL, 47, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-10-26 06:27:59', '2025-10-26 06:27:59'),
(91, NULL, 48, 14, 'aaa 02', 15.00, 1, 15.00, NULL, NULL, '2025-10-26 06:29:49', '2025-10-26 06:29:49'),
(92, NULL, 49, 12, 'Supermom Baby Diaper Belt S (3- 8 kg)', 109.00, 1, 109.00, NULL, NULL, '2025-11-05 07:49:19', '2025-11-05 07:49:19'),
(93, 1, 50, 14, 'aaa 02', 15.00, 1, 15.00, 1, NULL, '2025-11-21 07:27:52', '2025-11-21 07:27:52'),
(94, 1, 51, 10, 'Germnil Surgical Face Mask 50 pcs', 500.00, 1, 500.00, 1, NULL, '2025-11-21 07:29:06', '2025-11-21 07:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `drag_id` int NOT NULL DEFAULT '0',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name_en`, `name_bn`, `slug`, `type`, `excerpt_en`, `excerpt_bn`, `active`, `drag_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', NULL, 'privacy-policy', 'privacy_policy', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 07:33:03', '2025-07-17 07:33:03'),
(2, 'Term Conditions', NULL, 'term-conditions', 'term_conditions', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 07:33:30', '2025-07-17 07:33:30'),
(3, 'Support Policy', NULL, 'support-policy', 'support_policy', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 07:33:50', '2025-07-17 07:33:50'),
(4, 'Return Policy', NULL, 'return-policy', 'return_policy', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 07:34:26', '2025-07-17 07:34:26'),
(5, 'Help Center', NULL, 'help-center', 'help_center', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 08:38:15', '2025-07-17 08:38:15'),
(6, 'Contact Us', NULL, 'contact-us', 'contact_us', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 08:55:33', '2025-07-17 08:55:33');

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

-- --------------------------------------------------------

--
-- Table structure for table `page_items`
--

CREATE TABLE `page_items` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `editor` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_items`
--

INSERT INTO `page_items` (`id`, `page_id`, `name_en`, `name_bn`, `description_en`, `description_bn`, `active`, `editor`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, 13, '2025-07-17 08:27:36', '2025-07-17 08:29:50'),
(2, 3, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 08:30:33', '2025-07-17 08:30:33'),
(3, 2, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 08:30:55', '2025-07-17 08:30:55'),
(4, 1, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 08:31:16', '2025-07-17 08:31:16'),
(5, 5, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 08:38:40', '2025-07-17 08:38:40'),
(6, 7, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 09:00:01', '2025-07-17 09:00:01'),
(7, 6, 'Item 1', NULL, '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>', NULL, 1, 1, 13, NULL, '2025-07-17 09:00:58', '2025-07-17 09:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `previous_due_amount` decimal(8,2) DEFAULT NULL,
  `paid_amount` decimal(8,2) DEFAULT NULL,
  `due_amount` decimal(8,2) DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `previous_due_amount`, `paid_amount`, `due_amount`, `payment_status`, `payment_method`, `transaction_id`, `payment_date`, `addedby_id`, `editedby_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 0.00, 800.00, 0.00, 'paid', 'online', '1-1756746978', '2025-09-01', NULL, NULL, 'Online Payment Success', '2025-09-01 11:21:14', '2025-09-01 11:21:14'),
(2, 1, NULL, 0.00, 800.00, 0.00, 'paid', 'online', '1-1756746978', '2025-09-01', NULL, NULL, 'Online Payment Success', '2025-09-01 11:21:47', '2025-09-01 11:21:47'),
(3, 1, NULL, 0.00, 800.00, 0.00, 'paid', 'online', '1-1756747719', '2025-09-01', NULL, NULL, 'Online Payment Success', '2025-09-01 11:28:57', '2025-09-01 11:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` bigint UNSIGNED NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `click_count` tinyint NOT NULL DEFAULT '0',
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_bn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `final_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '1',
  `unit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `feature` tinyint(1) NOT NULL DEFAULT '0',
  `editor` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `click_count`, `name_en`, `name_bn`, `sku`, `slug`, `excerpt_en`, `excerpt_bn`, `description_en`, `description_bn`, `featured_image`, `price`, `discount`, `discount_price`, `final_price`, `stock`, `unit`, `tags`, `active`, `feature`, `editor`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Nebulizer Save Life-01', NULL, 'Nebulizer Save Life-01', 'nebulizer-save-life-01', 'Nebulizer Save Life-01', NULL, '<p>Nebulizer Save Life-01</p>', NULL, '1_1756296549.jpg', 2250.00, 0.00, 0.00, 2250.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-08-27 06:09:09', '2025-12-23 04:27:44'),
(2, 7, 'First Aid Kit Box, Medicine Box', NULL, NULL, 'first-aid-kit-box-medicine-box', 'first-aid-kit-box,-medicine-box', NULL, '<div class=\"product-categories\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Category:&nbsp;<span class=\"product-category\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><font color=\"#3065b5\" face=\"Open Sans, Arial, Helvetica, Nimbus Sans L, sans-serif\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border-style: initial; border-color: initial; border-image: initial; outline-color: initial; outline-style: initial; font-size: 13px; line-height: 20px; transition-duration: 0.3s; transition-timing-function: ease-in-out; transition-property: color;\">Medical Devices</span></font></span></div><div class=\"product-sku\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\"><div class=\"sku\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><span class=\"label\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">SKU:</span>&nbsp;<span id=\"sku-250787\" class=\"value\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">MED00014</span></div><div class=\"product-vendor\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><span class=\"label\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">Seller:</span>&nbsp;<span class=\"value\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><font color=\"#3065b5\" face=\"Open Sans, Arial, Helvetica, Nimbus Sans L, sans-serif\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border-style: initial; border-color: initial; border-image: initial; outline-color: initial; outline-style: initial; font-size: 13px; line-height: 20px; transition-duration: 0.3s; transition-timing-function: ease-in-out; transition-property: color;\">MEDI CARE</span></font></span></div></div>', NULL, '2_1756353935.jpg', 175.00, 0.00, 0.00, 175.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-08-27 22:05:35', '2025-12-23 04:30:03'),
(3, 1, 'Blood Pressure Monitor (Renevo) each', NULL, NULL, 'blood-pressure-monitor-renevo-each', 'blood-pressure-monitor-(renevo)-each', NULL, '<p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-0\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Product Details:</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-1\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">one-touch operation</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-2\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Digital Screen</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-3\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">large 3-row digital display for easy reading automatic power off</p>', NULL, '31756354066.webp', 2800.00, 0.00, 0.00, 2800.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-08-27 22:07:15', '2025-12-23 04:28:06'),
(4, 0, 'VivaChek Ino Glucose Test Meter each', NULL, NULL, 'vivachek-ino-glucose-test-meter-each', NULL, NULL, '<p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-0\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Code calibration (auto-coding)</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-1\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Checks for the possible damage of the strip</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-2\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Auto-shut off in 2 minutes after last action</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Small Size &amp; Easy to cary</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Suitable for Self Use</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-5\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">10 Test Strips &amp; 10 Lancets are free with VivaChek Ino</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Lancing Device Pen, Caring Case, User’s Manual, Reference Guide , Logbook included.</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-7\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usable at Home, Office, Doctor’s Chember, Hospitals &amp; Clinics.</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Test range: 0.6-33.3 mmol/L (10-600 mg/dL)</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-9\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Result calibration: Plasma-equivalent</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Sample type: Fresh capillary whole blood</p>', NULL, '4_1756354164.webp', 2070.00, 70.00, 70.00, 2000.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-08-27 22:09:24', '2025-08-28 02:01:29'),
(5, 0, 'AF5 SMC Joya Regular Wings 8 pads', NULL, NULL, 'af5-smc-joya-regular-wings-8-pads', 'Joya Wings Regular Flow (panty system) is the most affordable regular wings sanitary napkin available in the market. It is a scented sanitary napkin and is available in convenient tri-folded packaging with individual wrapping. It ensures faster absorption of liquid and prevents leakage. The pad length is 240 mm.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Joya Wings Regular Flow (panty system) is the most affordable regular wings sanitary napkin available in the market. It is a scented sanitary napkin and is available in convenient tri-folded packaging with individual wrapping. It ensures faster absorption of liquid and prevents leakage. The pad length is 240 mm.</span></p>', NULL, '5_1756887033.jpg', 80.00, 0.00, 0.00, 80.00, 10, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:10:33', '2025-09-03 02:10:33'),
(6, 0, 'A6 Freedom Regular Flow Sanitary Napkin 8 pads', NULL, NULL, 'a6-freedom-regular-flow-sanitary-napkin-8-pads', 'Freedom Heavy Flow Sanitary Napkin, It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Freedom Heavy Flow Sanitary Napkin, It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.</span></p>', NULL, '6_1756887107.jpg', 45.00, 0.00, 0.00, 45.00, 10, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:11:47', '2025-09-03 02:11:47'),
(7, 0, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', NULL, NULL, 'a10-aci-freedom-heavy-flow-sanitary-napkin-8-pads', 'It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.</span></p>', NULL, '7_1756887162.jpg', 65.00, 0.00, 0.00, 65.00, 10, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:12:42', '2025-09-03 02:12:42'),
(8, 0, 'Dettol Antiseptic Disinfectant Liquid 500 ml', NULL, NULL, 'dettol-antiseptic-disinfectant-liquid-500-ml', 'Dettol Antiseptic combines Dettol’s Trusted germ protection with Original fragrance to effectively protect you from germs that cause infection. Dettol Liquid needs to be used diluted and is used for First Aid, Medical & Personal Hygiene.', NULL, '<p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Highlights</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol’s trusted germ protection with Original fragrance</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-5\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic effectively protects you from germs that cause infection.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic Disinfectant is used for First Aid, Medical &amp; Personal Hygiene.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-7\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic to be used diluted.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Comes in 50ml, 100ml, 500ml, 750ml &amp; 5 Liter.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Antiseptic combines Dettol’s Trusted germ protection with Original fragrance to effectively protect you from germs that cause infection. Dettol Liquid needs to be used diluted and is used for First Aid, Medical &amp; Personal Hygiene.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-11\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usage Direction: Read the back label before use.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-12\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Safety Direction: For external use only and is not edible. Keep out of reach of children.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-13\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">About the Manufacturer: Dettol Antiseptic is Manufactured in Bangladesh by Reckitt Benckiser Bangladesh PLC.</p>', NULL, '8_1756887268.jpg', 175.00, 0.00, 0.00, 175.00, 10, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:14:28', '2025-09-03 02:14:29'),
(9, 0, 'Dettol Handwash Original Liquid Pump 200 ml', NULL, NULL, 'dettol-handwash-original-liquid-pump-200-ml', 'Usage Direction: Press the nozzle gently to get a small amount of Dettol Liquid Handwash on wet hands. Rub hands together ensuring total coverage with lather. Rinse well with water and dry off.', NULL, '<p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Highlights:</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Original Liquid Handwash Pump 200 ml Protects from 100 illness-causing germs. Tested under lab conditions. Daily use of Dettol keeps your hand clean and germ-free.Use Dettol Handwash for everyday protection.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Handwash provides everyday protection and protects from 100 illness-causing germs as per standard testing protocol. Daily use of Dettol Handwash keeps your hand clean and germ-free.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usage Direction: Press the nozzle gently to get a small amount of Dettol Liquid Handwash on wet hands. Rub hands together ensuring total coverage with lather. Rinse well with water and dry off.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Safety Direction: for external use only. Keep out of reach of children unless under adult supervision. Avoid contact with eyes. In case of contact with the eyes rinse immediately with water. If persistent irritation occurs, get medical attention. Not to be used on children under 3 years of age. Store in a cool and dry place.</p>', NULL, '9_1756887325.jpg', 100.00, 0.00, 0.00, 100.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:15:25', '2025-09-03 02:15:25'),
(10, 0, 'Germnil Surgical Face Mask 50 pcs', NULL, NULL, 'germnil-surgical-face-mask-50-pcs', 'The Germnil Surgical Face Mask (50 pcs) offers reliable protection and is designed for comfortable and breathable use. These masks are intended to provide a barrier against bacteria and viruses. They come in a pack of 50, making it a practical option for ongoing personal use.\r\n\r\nThe masks are manufactured in Bangladesh and are tested for safety standards, including ISO certification. They have also been approved by Bangladesh’s Directorate General of Drug Administration (DGDA), ensuring their compliance with local regulations​.', NULL, '<p data-reactid=\".16lb5kjey0q.$27382.0.1.0.1.5.$line-0\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">The Germnil Surgical Face Mask (50 pcs) offers reliable protection and is designed for comfortable and breathable use. These masks are intended to provide a barrier against bacteria and viruses. They come in a pack of 50, making it a practical option for ongoing personal use.</p><p data-reactid=\".16lb5kjey0q.$27382.0.1.0.1.5.$line-1\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">The masks are manufactured in Bangladesh and are tested for safety standards, including ISO certification. They have also been approved by Bangladesh’s Directorate General of Drug Administration (DGDA), ensuring their compliance with local regulations​.</p>', NULL, '10_1756887390.webp', 500.00, 0.00, 0.00, 500.00, 10, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:16:29', '2025-09-03 02:16:30'),
(11, 0, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', NULL, NULL, 'neocare-new-born-diaper-belt-0-4-kg-20-pcs', 'The NeoCare New Born Diaper (0–4 kg, 20 pcs) is designed to provide optimal comfort and protection for newborns. Tailored for babies weighing between 0–4 kg, these diapers ensure a snug and secure fit, catering specifically to the delicate needs of newborns.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">The NeoCare New Born Diaper (0–4 kg, 20 pcs) is designed to provide optimal comfort and protection for newborns. Tailored for babies weighing between 0–4 kg, these diapers ensure a snug and secure fit, catering specifically to the delicate needs of newborns.</span></p>', NULL, '11_1756887470.jpg', 620.00, 0.00, 0.00, 620.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:17:50', '2025-10-23 05:00:44'),
(12, 11, 'Supermom Baby Diaper Belt S (3- 8 kg)', NULL, NULL, 'supermom-baby-diaper-belt-s-3-8-kg', 'Square Toiletries Ltd. has brought for you the high quality diaper named “Supermom” in the market. It has 80% more absorbent than other diapers in the market. Supermom ensures zero leakage as it has hydrophobic leg cuff. Its cottony top sheet ensures that children can sleep comfortably the whole night.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Square Toiletries Ltd. has brought for you the high quality diaper named “Supermom” in the market. It has 80% more absorbent than other diapers in the market. Supermom ensures zero leakage as it has hydrophobic leg cuff. Its cottony top sheet ensures that children can sleep comfortably the whole night.</span></p>', NULL, '12_1756887530.png', 109.00, 0.00, 0.00, 109.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:18:49', '2025-12-23 04:35:08'),
(13, 0, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', NULL, NULL, 'savlon-twinkle-baby-new-born-diaper-belt-s-up-to-8-kg', 'Product type: Belt System. The diapers are Soft. Have elastic ears to ensure the best fit and comfort. Allows the flow of air. Completely Leak Proof. Size: S (Up to 8Kg). Pack Size: 44 Pcs. Made in Bangladesh.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Product type: Belt System. The diapers are Soft. Have elastic ears to ensure the best fit and comfort. Allows the flow of air. Completely Leak Proof. Size: S (Up to 8Kg). Pack Size: 44 Pcs. Made in Bangladesh.</span></p>', NULL, '131758900504.webp', 919.00, 0.00, 0.00, 919.00, 1, NULL, NULL, 1, 0, 1, 1, NULL, '2025-09-03 02:20:18', '2025-09-26 09:28:24'),
(14, 7, 'aaa 02', NULL, NULL, 'aaa-02', 'test', NULL, '<p>eta afgf as</p>', NULL, '14_1761304128.webp', 25.00, 10.00, 10.00, 15.00, 25, NULL, NULL, 1, 1, 1, 1, NULL, '2025-10-24 05:08:48', '2025-12-23 10:14:10'),
(17, 2, 'Wipes data', NULL, NULL, 'wipes-data', 'ok 28', NULL, '<p>ol 28</p>', NULL, NULL, 38.00, 28.00, 28.00, 10.00, 18, NULL, NULL, 1, 1, 1, 1, NULL, '2025-11-19 07:53:39', '2025-12-23 09:35:01'),
(18, 5, 'adf-g', NULL, NULL, 'adf-g', 'test ok', NULL, '<p>test ok&nbsp;</p>', NULL, NULL, 11.00, 25.00, 25.00, -14.00, 15, NULL, NULL, 1, 1, 1, 1, NULL, '2025-12-17 21:45:11', '2025-12-23 12:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `parent_id`, `name_en`, `name_bn`, `slug`, `excerpt`, `active`, `image`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Medical Device', NULL, 'medical-device', 'Medical Device', 1, '1756295067.jpeg', 1, 1, '2025-08-27 05:44:28', '2025-08-27 05:51:04'),
(2, NULL, 'Baby Care', NULL, 'baby-care', 'Baby Care', 1, '1756295517.jpeg', 1, NULL, '2025-08-27 05:51:58', '2025-08-27 05:51:58'),
(3, NULL, 'Health & Beauty', NULL, 'health-beauty', 'Health & Beauty', 1, '1756295539.jpeg', 1, NULL, '2025-08-27 05:52:19', '2025-08-27 05:52:19'),
(4, NULL, 'Personal Caree', '123456789 10', 'personal-caree', 'Personal Care 10', 1, '1759312208.jpg', 1, 1, '2025-08-27 05:52:42', '2025-10-23 03:35:07'),
(5, 1, 'somar bissas', 'soma bangla', 'somar-bissas', 'tor bissas', 1, '1761212151.png', 1, 1, '2025-10-23 03:35:51', '2025-10-23 04:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_cats`
--

CREATE TABLE `product_cats` (
  `id` bigint UNSIGNED NOT NULL,
  `product_category_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_cats`
--

INSERT INTO `product_cats` (`id`, `product_category_id`, `product_id`, `addedby_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, '2025-08-27 06:11:55', '2025-08-27 06:11:55'),
(3, 1, 2, 1, '2025-08-27 22:05:35', '2025-08-27 22:05:35'),
(5, 1, 3, 1, '2025-08-27 22:07:46', '2025-08-27 22:07:46'),
(7, 1, 4, 1, '2025-08-28 02:01:29', '2025-08-28 02:01:29'),
(8, 4, 5, 1, '2025-09-03 02:10:34', '2025-09-03 02:10:34'),
(9, 4, 6, 1, '2025-09-03 02:11:47', '2025-09-03 02:11:47'),
(10, 4, 7, 1, '2025-09-03 02:12:42', '2025-09-03 02:12:42'),
(11, 3, 8, 1, '2025-09-03 02:14:29', '2025-09-03 02:14:29'),
(12, 3, 9, 1, '2025-09-03 02:15:25', '2025-09-03 02:15:25'),
(13, 3, 10, 1, '2025-09-03 02:16:30', '2025-09-03 02:16:30'),
(15, 2, 12, 1, '2025-09-03 02:18:50', '2025-09-03 02:18:50'),
(18, 2, 13, 1, '2025-09-26 09:28:24', '2025-09-26 09:28:24'),
(19, 5, 11, 1, '2025-10-23 05:00:44', '2025-10-23 05:00:44'),
(23, 5, 15, 1, '2025-10-26 07:24:16', '2025-10-26 07:24:16'),
(25, 5, 16, 1, '2025-10-26 07:32:01', '2025-10-26 07:32:01'),
(26, 3, 14, 1, '2025-11-19 07:51:57', '2025-11-19 07:51:57'),
(32, 2, 17, 1, '2025-12-17 21:44:00', '2025-12-17 21:44:00'),
(33, 3, 18, 1, '2025-12-17 21:45:11', '2025-12-17 21:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 5, 'nice product', '2025-08-30 23:45:49', '2025-08-30 23:45:49'),
(2, 1, 4, 1, 'সাদাসদাসদ', '2025-08-31 00:05:41', '2025-08-31 00:05:41'),
(3, 1, 4, 5, 'gdfgdfg', '2025-08-31 00:06:05', '2025-08-31 00:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_requests`
--

CREATE TABLE `product_stock_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `collection_datetime` datetime NOT NULL,
  `collection_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by_id` int UNSIGNED DEFAULT NULL,
  `edited_by_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `role_name`, `role_value`, `added_by_id`, `edited_by_id`, `created_at`, `updated_at`) VALUES
(1, 148, 'admin', 'Admin', 1, NULL, '2023-01-08 05:59:20', '2023-01-08 05:59:20'),
(2, 164, 'Retailer', 'Retailer', 1, NULL, '2023-04-23 22:10:43', '2023-04-23 22:10:43'),
(3, 165, 'Retailer', 'Retailer', 1, 1, '2025-12-29 02:00:39', '2025-12-29 02:07:45'),
(4, 150, 'admin', 'Admin', 1, NULL, '2025-12-29 02:08:13', '2025-12-29 02:08:13'),
(5, 148, 'Retailer', 'Retailer', 1, 1, '2025-12-29 02:24:06', '2025-12-29 02:30:07'),
(6, 159, 'retailer', 'Retailer', 1, NULL, '2025-12-29 02:28:46', '2025-12-29 02:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `section_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `serial` int DEFAULT NULL,
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections_setups`
--

CREATE TABLE `sections_setups` (
  `id` bigint UNSIGNED NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `title_id` bigint UNSIGNED NOT NULL,
  `sub_title_id` bigint UNSIGNED NOT NULL,
  `content_id` bigint UNSIGNED NOT NULL,
  `pricing_id` bigint UNSIGNED DEFAULT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections_setup_features`
--

CREATE TABLE `sections_setup_features` (
  `id` bigint UNSIGNED NOT NULL,
  `sections_setup_id` bigint UNSIGNED NOT NULL,
  `feature_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_weight` decimal(8,2) DEFAULT NULL,
  `max_weight` decimal(8,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `same_day` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `location`, `min_weight`, `max_weight`, `price`, `is_free`, `same_day`, `created_at`, `updated_at`) VALUES
(2, 'Kafrul', 'Inside Dhaka District', NULL, NULL, 0.00, 1, 0, '2025-09-03 03:13:57', '2025-10-13 23:04:57'),
(3, 'Demra', 'Outsite Dhaka District', NULL, NULL, 100.00, 0, 0, '2025-09-03 03:14:34', '2025-10-13 23:04:19'),
(4, 'banani', 'batara', NULL, NULL, 68.00, 0, 0, '2025-10-13 22:38:31', '2025-10-13 23:03:39'),
(5, 'kapasia', 'garkaid tt', NULL, NULL, 985.00, 1, 0, '2025-10-13 22:41:05', '2025-10-13 23:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `sub_titles`
--

CREATE TABLE `sub_titles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `text_bn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rating` int NOT NULL DEFAULT '5',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `company`, `text_en`, `text_bn`, `rating`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'তামান্না সুলতানা', 'স্বেচ্ছাসেবক', 'স্বেচ্ছাসেবক', '<p>নর্থ বাংলা ফাউন্ডেশনের প্রকল্পে অংশ নেওয়া জীবন পরিবর্তনকারী অভিজ্ঞতা। কমিউনিটিকে সাহায্য করা, হাসি দেখা, এবং বাস্তব পরিবর্তন প্রত্যক্ষ করা আমাকে প্রতিদিন অনুপ্রাণিত করে।</p>', '<p>নর্থবেঙ্গল ডেইরী পরিবারের অংশ হতে পেরে আমি অত্যন্ত আনন্দিত। <br>\r\n\" নর্থবেঙ্গল ডেইরীর পণ্য সর্বদা খাঁটি, স্বাস্থ্যকর ও সর্বোত্তম....!!! <br><br>\r\n\"Products of North Bengal...!!! <br>\r\nAlways healthy &  All in All....!!! <br><br>\r\n<b>এএসএম সাইদুজ্জামান</b><br>এসএভিপি এবং ইউনিট প্রধান<br>\r\nলোয়েবিলিটি-মিডিয়াম বিজনেস, ঢাকা এরিয়া\r\n<br>সিটি ব্যাংক পিএলসি</p>', 5, NULL, 1, '2025-10-23 12:19:28', '2026-01-07 00:55:48'),
(2, 'আয়েশা রহমান', 'দাতা', 'bb', '<p>নর্থ বাংলা ফাউন্ডেশনকে সাহায্য করা সত্যিই একটি পুরস্কারস্বরূপ অভিজ্ঞতা। তারা দরিদ্র শিশু ও পরিবারদের সাহায্যে যে প্রতিশ্রুতি দেখায়, তা অনুপ্রেরণামূলক। আমি গর্বিত তাদের মিশনের অংশ হতে পারায়।</p>', '<p><strong>আসসালামু আলাইকুম!</strong></p><p>নর্থবেঙ্গল ডেইরী সরাসরি আপনার বাড়িতে উচ্চমানের পণ্য পৌঁছে দিতে প্রতিশ্রুতিবদ্ধ।<br>আমাদের নির্ভরযোগ্য ডেলিভারি পরিষেবার মাধ্যমে আমরা <strong>সতেজতা, স্থায়িত্ব ও গ্রাহক সন্তুষ্টি</strong>কে সর্বাধিক গুরুত্ব দিই।</p><p>নর্থবেঙ্গল ডেইরী ৩৬৫ দিন সকাল ৮টা থেকে রাত ৮টা পর্যন্ত ‘<strong>হোম ডেলিভারি</strong>’ পরিষেবা প্রদান করে।<br>এটি আমাদের কার্যকর ব্যবস্থাপনা ও সুপ্রশিক্ষিত ডেলিভারি কর্মীদের মাধ্যমে পরিচালিত হয়।<br>আমাদের লক্ষ্য — <strong>বাংলাদেশের সকল মানুষের জন্য স্বাস্থ্যকর ও তাজা খাবার সহজলভ্য করা।</strong></p>', 5, NULL, 1, '2025-10-23 12:33:11', '2026-01-07 00:54:47'),
(3, 'Farhan Ahmed', 'Donor', 'Donor', '<p>North Bangla Foundation truly makes a difference. Their programs are well-organized, transparent, and deeply impactful. I feel confident that my contributions are changing lives for the better.</p>', 'ddd', 5, NULL, 1, '2025-11-01 23:29:59', '2026-01-07 00:53:34'),
(4, 'Shumi Akter', 'Beneficiary', 'Beneficiary', '<p>Thanks to North Bangla Foundation, my children now have access to education and healthcare that we could never afford. Their support has given our family hope for a brighter future.</p>', 'আসসালামু আলাইকুম!\r\n\r\nনর্থবেঙ্গল ডেইরী সরাসরি আপনার বাড়িতে উচ্চমানের পণ্য পৌঁছে দিতে প্রতিশ্রুতিবদ্ধ।\r\nআমাদের নির্ভরযোগ্য ডেলিভারি পরিষেবার মাধ্যমে আমরা সতেজতা, স্থায়িত্ব ও গ্রাহক সন্তুষ্টিকে সর্বাধিক গুরুত্ব দিই।\r\n\r\nনর্থবেঙ্গল ডেইরী ৩৬৫ দিন সকাল ৮টা থেকে রাত ৮টা পর্যন্ত ‘হোম ডেলিভারি’ পরিষেবা প্রদান করে।\r\nএটি আমাদের কার্যকর ব্যবস্থাপনা ও সুপ্রশিক্ষিত ডেলিভারি কর্মীদের মাধ্যমে পরিচালিত হয়।\r\nআমাদের লক্ষ্য — বাংলাদেশের সকল মানুষের জন্য স্বাস্থ্যকর ও তাজা খাবার সহজলভ্য করা।', 5, NULL, 1, '2025-11-01 23:31:26', '2026-01-07 00:52:22'),
(5, 'Md. Imran Hossain', 'Volunteer', 'Volunteer', '<p>Volunteering with North Bangla Foundation has opened my eyes to the difference a small act of kindness can make. Every child and family they help shows the impact of compassion and community support.</p>', '<p><strong>আসসালামু আলাইকুম!</strong></p><p>নর্থবেঙ্গল ডেইরী সরাসরি আপনার বাড়িতে উচ্চমানের পণ্য পৌঁছে দিতে প্রতিশ্রুতিবদ্ধ।<br>আমাদের নির্ভরযোগ্য ডেলিভারি পরিষেবার মাধ্যমে আমরা <strong>সতেজতা, স্থায়িত্ব ও গ্রাহক সন্তুষ্টি</strong>কে সর্বাধিক গুরুত্ব দিই।</p><p>নর্থবেঙ্গল ডেইরী প্রতিদিন সকাল ৮টা থেকে রাত ৮টা পর্যন্ত ‘<strong>হোম ডেলিভারি</strong>’ পরিষেবা প্রদান করে।<br>এটি আমাদের কার্যকর ব্যবস্থাপনা ও সুপ্রশিক্ষিত ডেলিভারি কর্মীদের মাধ্যমে পরিচালিত হয়।<br>আমাদের লক্ষ্য — <strong>বাংলাদেশের সকল মানুষের জন্য স্বাস্থ্যকর ও তাজা খাবার সহজলভ্য করা।</strong></p>', 5, NULL, 1, '2025-11-01 23:37:06', '2026-01-07 00:50:38'),
(6, 'Ayesha Rahman', 'Donor', 'Donor', '<p>Supporting North Bangla Foundation has been a truly rewarding experience. Their dedication to helping underprivileged children and families is inspiring, and I’m proud to be a part of their mission.</p>', NULL, 3, NULL, 1, '2025-11-18 10:48:21', '2026-01-07 00:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `side_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` int UNSIGNED DEFAULT NULL,
  `district_id` int UNSIGNED DEFAULT NULL,
  `upazila_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `addedby_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `division_id`, `district_id`, `upazila_id`, `name`, `bn_name`, `lat`, `lng`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 6, 27, 407, 'Rosulpur', 'রসুলপুর', NULL, NULL, 1, NULL, '2026-01-20 07:19:15', '2026-01-20 07:19:15'),
(2, 6, 27, 407, 'Noldanga', 'নলডাঙ্গা', NULL, NULL, 1, NULL, NULL, NULL),
(3, 6, 27, 407, 'Damodpur', 'দামোদরপুর', NULL, NULL, 1, NULL, NULL, NULL),
(4, 6, 27, 407, 'Jamalpur', 'জামালপুর', NULL, NULL, 1, NULL, NULL, NULL),
(5, 6, 27, 407, 'Foridpur', 'ফরিদপুর', NULL, NULL, 1, NULL, NULL, NULL),
(6, 6, 27, 407, 'Daperhat', 'ধাপেরহাট', NULL, NULL, 1, NULL, NULL, NULL),
(7, 6, 27, 407, 'Idilpur', 'ইদিলপুর', NULL, NULL, 1, NULL, NULL, NULL),
(8, 6, 27, 407, 'vatgram', 'ভাতগ্রাম', NULL, NULL, 1, NULL, NULL, NULL),
(9, 6, 27, 407, 'Bongram', 'বনগ্রাম', NULL, NULL, 1, NULL, NULL, NULL),
(10, 6, 27, 407, 'Kamarpara', 'কামারপাড়া', NULL, NULL, 1, NULL, NULL, NULL),
(11, 6, 27, 407, 'Khordo KomorPur', 'খোর্দ্দকোমরপুর', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int UNSIGNED NOT NULL,
  `district_id` int UNSIGNED DEFAULT NULL,
  `division_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `addedby_id` int UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `division_id`, `name`, `bn_name`, `lat`, `lng`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 34, 1, 'Amtali', 'আমতলী', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(2, 34, 1, 'Bamna ', 'বামনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(3, 34, 1, 'Barguna Sadar ', 'বরগুনা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(4, 34, 1, 'Betagi ', 'বেতাগি', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(5, 34, 1, 'Patharghata ', 'পাথরঘাটা', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(6, 34, 1, 'Taltali ', 'তালতলী', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(7, 35, 1, 'Muladi ', 'মুলাদি', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(8, 35, 1, 'Babuganj ', 'বাবুগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(9, 35, 1, 'Agailjhara ', 'আগাইলঝরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(10, 35, 1, 'Barisal Sadar ', 'বরিশাল সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(11, 35, 1, 'Bakerganj ', 'বাকেরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(12, 35, 1, 'Banaripara ', 'বানাড়িপারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(13, 35, 1, 'Gaurnadi ', 'গৌরনদী', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(14, 35, 1, 'Hizla ', 'হিজলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(15, 35, 1, 'Mehendiganj ', 'মেহেদিগঞ্জ ', NULL, NULL, 1, NULL, '2018-09-27 07:12:17', '2018-09-27 07:12:17'),
(16, 35, 1, 'Wazirpur ', 'ওয়াজিরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(17, 36, 1, 'Bhola Sadar ', 'ভোলা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(18, 36, 1, 'Burhanuddin ', 'বুরহানউদ্দিন', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(19, 36, 1, 'Char Fasson ', 'চর ফ্যাশন', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(20, 36, 1, 'Daulatkhan ', 'দৌলতখান', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(21, 36, 1, 'Lalmohan ', 'লালমোহন', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(22, 36, 1, 'Manpura ', 'মনপুরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(23, 36, 1, 'Tazumuddin ', 'তাজুমুদ্দিন', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(24, 37, 1, 'Jhalokati Sadar ', 'ঝালকাঠি সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(25, 37, 1, 'Kathalia ', 'কাঁঠালিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(26, 37, 1, 'Nalchity ', 'নালচিতি', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(27, 37, 1, 'Rajapur ', 'রাজাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(28, 38, 1, 'Bauphal ', 'বাউফল', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(29, 38, 1, 'Dashmina ', 'দশমিনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(30, 38, 1, 'Galachipa ', 'গলাচিপা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(31, 38, 1, 'Kalapara ', 'কালাপারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(32, 38, 1, 'Mirzaganj ', 'মির্জাগঞ্জ ', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(33, 38, 1, 'Patuakhali Sadar ', 'পটুয়াখালী সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(34, 38, 1, 'Dumki ', 'ডুমকি', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(35, 38, 1, 'Rangabali ', 'রাঙ্গাবালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(36, 39, 1, 'Bhandaria', 'ভ্যান্ডারিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(37, 39, 1, 'Kaukhali', 'কাউখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(38, 39, 1, 'Mathbaria', 'মাঠবাড়িয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(39, 39, 1, 'Nazirpur', 'নাজিরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(40, 39, 1, 'Nesarabad', 'নেসারাবাদ', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(41, 39, 1, 'Pirojpur Sadar', 'পিরোজপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(42, 39, 1, 'Zianagar', 'জিয়ানগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(43, 40, 2, 'Bandarban Sadar', 'বান্দরবন সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(44, 40, 2, 'Thanchi', 'থানচি', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(45, 40, 2, 'Lama', 'লামা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(46, 40, 2, 'Naikhongchhari', 'নাইখংছড়ি ', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(47, 40, 2, 'Ali kadam', 'আলী কদম', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(48, 40, 2, 'Rowangchhari', 'রউয়াংছড়ি ', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(49, 40, 2, 'Ruma', 'রুমা', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(50, 41, 2, 'Brahmanbaria Sadar ', 'ব্রাহ্মণবাড়িয়া সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(51, 41, 2, 'Ashuganj ', 'আশুগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(52, 41, 2, 'Nasirnagar ', 'নাসির নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(53, 41, 2, 'Nabinagar ', 'নবীনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:18', '2018-09-27 07:12:18'),
(54, 41, 2, 'Sarail ', 'সরাইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(55, 41, 2, 'Shahbazpur Town', 'শাহবাজপুর টাউন', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(56, 41, 2, 'Kasba ', 'কসবা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(57, 41, 2, 'Akhaura ', 'আখাউরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(58, 41, 2, 'Bancharampur ', 'বাঞ্ছারামপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(59, 41, 2, 'Bijoynagar ', 'বিজয় নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(60, 42, 2, 'Chandpur Sadar', 'চাঁদপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(61, 42, 2, 'Faridganj', 'ফরিদগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(62, 42, 2, 'Haimchar', 'হাইমচর', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(63, 42, 2, 'Haziganj', 'হাজীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(64, 42, 2, 'Kachua', 'কচুয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(65, 42, 2, 'Matlab Uttar', 'মতলব উত্তর', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(66, 42, 2, 'Matlab Dakkhin', 'মতলব দক্ষিণ', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(67, 42, 2, 'Shahrasti', 'শাহরাস্তি', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(68, 43, 2, 'Anwara ', 'আনোয়ারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(69, 43, 2, 'Banshkhali ', 'বাশখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(70, 43, 2, 'Boalkhali ', 'বোয়ালখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(71, 43, 2, 'Chandanaish ', 'চন্দনাইশ', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(72, 43, 2, 'Fatikchhari ', 'ফটিকছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(73, 43, 2, 'Hathazari ', 'হাঠহাজারী', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(74, 43, 2, 'Lohagara ', 'লোহাগারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(75, 43, 2, 'Mirsharai ', 'মিরসরাই', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(76, 43, 2, 'Patiya ', 'পটিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(77, 43, 2, 'Rangunia ', 'রাঙ্গুনিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(78, 43, 2, 'Raozan ', 'রাউজান', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(79, 43, 2, 'Sandwip ', 'সন্দ্বীপ', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(80, 43, 2, 'Satkania ', 'সাতকানিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(81, 43, 2, 'Sitakunda ', 'সীতাকুণ্ড', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(82, 44, 2, 'Barura ', 'বড়ুরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(83, 44, 2, 'Brahmanpara ', 'ব্রাহ্মণপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(84, 44, 2, 'Burichong ', 'বুড়িচং', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(85, 44, 2, 'Chandina ', 'চান্দিনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:19', '2018-09-27 07:12:19'),
(86, 44, 2, 'Chauddagram ', 'চৌদ্দগ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(87, 44, 2, 'Daudkandi ', 'দাউদকান্দি', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(88, 44, 2, 'Debidwar ', 'দেবীদ্বার', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(89, 44, 2, 'Homna ', 'হোমনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(90, 44, 2, 'Comilla Sadar ', 'কুমিল্লা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(91, 44, 2, 'Laksam ', 'লাকসাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(92, 44, 2, 'Monohorgonj ', 'মনোহরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(93, 44, 2, 'Meghna ', 'মেঘনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(94, 44, 2, 'Muradnagar ', 'মুরাদনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(95, 44, 2, 'Nangalkot ', 'নাঙ্গালকোট', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(96, 44, 2, 'Comilla Sadar South ', 'কুমিল্লা সদর দক্ষিণ', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(97, 44, 2, 'Titas ', 'তিতাস', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(98, 45, 2, 'Chakaria ', 'চকরিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(99, 45, 2, 'Chakaria ', 'চকরিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(100, 45, 2, 'Cox\'s Bazar Sadar ', 'কক্স বাজার সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(101, 45, 2, 'Kutubdia ', 'কুতুবদিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(102, 45, 2, 'Maheshkhali ', 'মহেশখালী', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(103, 45, 2, 'Ramu ', 'রামু', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(104, 45, 2, 'Teknaf ', 'টেকনাফ', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(105, 45, 2, 'Ukhia ', 'উখিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(106, 45, 2, 'Pekua ', 'পেকুয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(107, 46, 2, 'Feni Sadar', 'ফেনী সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(108, 46, 2, 'Chagalnaiya', 'ছাগল নাইয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(109, 46, 2, 'Daganbhyan', 'দাগানভিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(110, 46, 2, 'Parshuram', 'পরশুরাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:20', '2018-09-27 07:12:20'),
(111, 46, 2, 'Fhulgazi', 'ফুলগাজি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(112, 46, 2, 'Sonagazi', 'সোনাগাজি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(113, 47, 2, 'Dighinala ', 'দিঘিনালা ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(114, 47, 2, 'Khagrachhari ', 'খাগড়াছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(115, 47, 2, 'Lakshmichhari ', 'লক্ষ্মীছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(116, 47, 2, 'Mahalchhari ', 'মহলছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(117, 47, 2, 'Manikchhari ', 'মানিকছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(118, 47, 2, 'Matiranga ', 'মাটিরাঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(119, 47, 2, 'Panchhari ', 'পানছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(120, 47, 2, 'Ramgarh ', 'রামগড়', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(121, 48, 2, 'Lakshmipur Sadar ', 'লক্ষ্মীপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(122, 48, 2, 'Raipur ', 'রায়পুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(123, 48, 2, 'Ramganj ', 'রামগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(124, 48, 2, 'Ramgati ', 'রামগতি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(125, 48, 2, 'Komol Nagar ', 'কমল নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(126, 49, 2, 'Noakhali Sadar ', 'নোয়াখালী সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(127, 49, 2, 'Begumganj ', 'বেগমগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(128, 49, 2, 'Chatkhil ', 'চাটখিল', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(129, 49, 2, 'Companyganj ', 'কোম্পানীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(130, 49, 2, 'Shenbag ', 'শেনবাগ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(131, 49, 2, 'Hatia ', 'হাতিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(132, 49, 2, 'Kobirhat ', 'কবিরহাট ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(133, 49, 2, 'Sonaimuri ', 'সোনাইমুরি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(134, 49, 2, 'Suborno Char ', 'সুবর্ণ চর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(135, 50, 2, 'Rangamati Sadar ', 'রাঙ্গামাটি সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(136, 50, 2, 'Belaichhari ', 'বেলাইছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(137, 50, 2, 'Bagaichhari ', 'বাঘাইছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(138, 50, 2, 'Barkal ', 'বরকল', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(139, 50, 2, 'Juraichhari ', 'জুরাইছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(140, 50, 2, 'Rajasthali ', 'রাজাস্থলি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(141, 50, 2, 'Kaptai ', 'কাপ্তাই', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(142, 50, 2, 'Langadu ', 'লাঙ্গাডু', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(143, 50, 2, 'Nannerchar ', 'নান্নেরচর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(144, 50, 2, 'Kaukhali ', 'কাউখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(145, 2, 3, 'Faridpur Sadar ', 'ফরিদপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:21', '2018-09-27 07:12:21'),
(146, 2, 3, 'Boalmari ', 'বোয়ালমারী', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(147, 2, 3, 'Alfadanga ', 'আলফাডাঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(148, 2, 3, 'Madhukhali ', 'মধুখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(149, 2, 3, 'Bhanga ', 'ভাঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(150, 2, 3, 'Nagarkanda ', 'নগরকান্ড', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(151, 2, 3, 'Charbhadrasan ', 'চরভদ্রাসন ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(152, 2, 3, 'Sadarpur ', 'সদরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(153, 2, 3, 'Shaltha ', 'শালথা', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(154, 3, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(155, 3, 3, 'Kaliakior', 'কালিয়াকৈর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(156, 3, 3, 'Kapasia', 'কাপাসিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(157, 3, 3, 'Sripur', 'শ্রীপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(158, 3, 3, 'Kaliganj', 'কালীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(159, 3, 3, 'Tongi', 'টঙ্গি', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(160, 4, 3, 'Gopalganj Sadar ', 'গোপালগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(161, 4, 3, 'Kashiani ', 'কাশিয়ানি', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(162, 4, 3, 'Kotalipara ', 'কোটালিপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(163, 4, 3, 'Muksudpur ', 'মুকসুদপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(164, 4, 3, 'Tungipara ', 'টুঙ্গিপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(165, 5, 8, 'Dewanganj ', 'দেওয়ানগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(166, 5, 8, 'Baksiganj ', 'বকসিগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(167, 5, 8, 'Islampur ', 'ইসলামপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(168, 5, 8, 'Jamalpur Sadar ', 'জামালপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(169, 5, 8, 'Madarganj ', 'মাদারগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(170, 5, 8, 'Melandaha ', 'মেলানদাহা', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(171, 5, 8, 'Sarishabari ', 'সরিষাবাড়ি ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(172, 5, 8, 'Narundi Police I.C', 'নারুন্দি', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(173, 6, 3, 'Astagram ', 'অষ্টগ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(174, 6, 3, 'Bajitpur ', 'বাজিতপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(175, 6, 3, 'Bhairab ', 'ভৈরব', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(176, 6, 3, 'Hossainpur ', 'হোসেনপুর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(177, 6, 3, 'Itna ', 'ইটনা', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(178, 6, 3, 'Karimganj ', 'করিমগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(179, 6, 3, 'Katiadi ', 'কতিয়াদি', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(180, 6, 3, 'Kishoreganj Sadar ', 'কিশোরগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(181, 6, 3, 'Kuliarchar ', 'কুলিয়ারচর', NULL, NULL, 1, NULL, '2018-09-27 07:12:22', '2018-09-27 07:12:22'),
(182, 6, 3, 'Mithamain ', 'মিঠামাইন', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(183, 6, 3, 'Nikli ', 'নিকলি', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(184, 6, 3, 'Pakundia ', 'পাকুন্ডা', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(185, 6, 3, 'Tarail ', 'তাড়াইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(186, 7, 3, 'Madaripur Sadar', 'মাদারীপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(187, 7, 3, 'Kalkini', 'কালকিনি', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(188, 7, 3, 'Rajoir', 'রাজইর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(189, 7, 3, 'Shibchar', 'শিবচর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(190, 8, 3, 'Manikganj Sadar ', 'মানিকগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(191, 8, 3, 'Singair ', 'সিঙ্গাইর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(192, 8, 3, 'Shibalaya ', 'শিবালয়', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(193, 8, 3, 'Saturia ', 'সাঠুরিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(194, 8, 3, 'Harirampur ', 'হরিরামপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(195, 8, 3, 'Ghior ', 'ঘিওর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(196, 8, 3, 'Daulatpur ', 'দৌলতপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(197, 9, 3, 'Lohajang ', 'লোহাজং', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(198, 9, 3, 'Sreenagar ', 'শ্রীনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(199, 9, 3, 'Munshiganj Sadar ', 'মুন্সিগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(200, 9, 3, 'Sirajdikhan ', 'সিরাজদিখান', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(201, 9, 3, 'Tongibari ', 'টঙ্গিবাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(202, 9, 3, 'Gazaria ', 'গজারিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(203, 10, 8, 'Bhaluka', 'ভালুকা', NULL, NULL, 1, NULL, '2018-09-27 07:12:23', '2018-09-27 07:12:23'),
(204, 10, 8, 'Trishal', 'ত্রিশাল', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(205, 10, 8, 'Haluaghat', 'হালুয়াঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(206, 10, 8, 'Muktagachha', 'মুক্তাগাছা', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(207, 10, 8, 'Dhobaura', 'ধবারুয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(208, 10, 8, 'Fulbaria', 'ফুলবাড়িয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(209, 10, 8, 'Gaffargaon', 'গফরগাঁও', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(210, 10, 8, 'Gauripur', 'গৌরিপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:24', '2018-09-27 07:12:24'),
(211, 10, 8, 'Ishwarganj', 'ঈশ্বরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(212, 10, 8, 'Mymensingh Sadar', 'ময়মনসিং সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(213, 10, 8, 'Nandail', 'নন্দাইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(214, 10, 8, 'Phulpur', 'ফুলপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(215, 11, 3, 'Araihazar ', 'আড়াইহাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(216, 11, 3, 'Sonargaon ', 'সোনারগাঁও', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(217, 11, 3, 'Bandar', 'বান্দার', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(218, 11, 3, 'Naryanganj Sadar ', 'নারায়ানগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(219, 11, 3, 'Rupganj ', 'রূপগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(220, 11, 3, 'Siddirgonj ', 'সিদ্ধিরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(221, 12, 3, 'Belabo ', 'বেলাবো', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(222, 12, 3, 'Monohardi ', 'মনোহরদি', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(223, 12, 3, 'Narsingdi Sadar ', 'নরসিংদী সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:25', '2018-09-27 07:12:25'),
(224, 12, 3, 'Palash ', 'পলাশ', NULL, NULL, 1, NULL, '2018-09-27 07:12:26', '2018-09-27 07:12:26'),
(225, 12, 3, 'Raipura , Narsingdi', 'রায়পুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:26', '2018-09-27 07:12:26'),
(226, 12, 3, 'Shibpur ', 'শিবপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:26', '2018-09-27 07:12:26'),
(227, 13, 8, 'Kendua Upazilla', 'কেন্দুয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:26', '2018-09-27 07:12:26'),
(228, 13, 8, 'Atpara Upazilla', 'আটপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:26', '2018-09-27 07:12:26'),
(229, 13, 8, 'Barhatta Upazilla', 'বরহাট্টা', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(230, 13, 8, 'Durgapur Upazilla', 'দুর্গাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(231, 13, 8, 'Kalmakanda Upazilla', 'কলমাকান্দা', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(232, 13, 8, 'Madan Upazilla', 'মদন', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(233, 13, 8, 'Mohanganj Upazilla', 'মোহনগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(234, 13, 8, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(235, 13, 8, 'Purbadhala Upazilla', 'পূর্বধলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(236, 13, 8, 'Khaliajuri Upazilla', 'খালিয়াজুরি', NULL, NULL, 1, NULL, '2018-09-27 07:12:27', '2018-09-27 07:12:27'),
(237, 14, 3, 'Baliakandi ', 'বালিয়াকান্দি', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(238, 14, 3, 'Goalandaghat ', 'গোয়ালন্দ ঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(239, 14, 3, 'Pangsha ', 'পাংশা', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(240, 14, 3, 'Kalukhali ', 'কালুখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(241, 14, 3, 'Rajbari Sadar ', 'রাজবাড়ি সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(242, 15, 3, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(243, 15, 3, 'Damudya ', 'দামুদিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(244, 15, 3, 'Naria ', 'নড়িয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(245, 15, 3, 'Jajira ', 'জাজিরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(246, 15, 3, 'Bhedarganj ', 'ভেদারগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(247, 15, 3, 'Gosairhat ', 'গোসাইর হাট ', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(248, 16, 8, 'Jhenaigati ', 'ঝিনাইগাতি', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(249, 16, 8, 'Nakla ', 'নাকলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(250, 16, 8, 'Nalitabari ', 'নালিতাবাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(251, 16, 8, 'Sherpur Sadar ', 'শেরপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(252, 16, 8, 'Sreebardi ', 'শ্রীবরদি', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(253, 17, 3, 'Tangail Sadar ', 'টাঙ্গাইল সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(254, 17, 3, 'Sakhipur ', 'সখিপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:28', '2018-09-27 07:12:28'),
(255, 17, 3, 'Basail ', 'বসাইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(256, 17, 3, 'Madhupur ', 'মধুপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(257, 17, 3, 'Ghatail ', 'ঘাটাইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(258, 17, 3, 'Kalihati ', 'কালিহাতি', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(259, 17, 3, 'Nagarpur ', 'নগরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(260, 17, 3, 'Mirzapur ', 'মির্জাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(261, 17, 3, 'Gopalpur ', 'গোপালপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(262, 17, 3, 'Delduar ', 'দেলদুয়ার', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(263, 17, 3, 'Bhuapur ', 'ভুয়াপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(264, 17, 3, 'Dhanbari ', 'ধানবাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(265, 55, 4, 'Bagerhat Sadar ', 'বাগেরহাট সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(266, 55, 4, 'Chitalmari ', 'চিতলমাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(267, 55, 4, 'Fakirhat ', 'ফকিরহাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(268, 55, 4, 'Kachua ', 'কচুয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(269, 55, 4, 'Mollahat ', 'মোল্লাহাট ', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(270, 55, 4, 'Mongla ', 'মংলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(271, 55, 4, 'Morrelganj ', 'মরেলগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(272, 55, 4, 'Rampal ', 'রামপাল', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(273, 55, 4, 'Sarankhola ', 'স্মরণখোলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(274, 56, 4, 'Damurhuda ', 'দামুরহুদা', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(275, 56, 4, 'Chuadanga-S ', 'চুয়াডাঙ্গা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(276, 56, 4, 'Jibannagar ', 'জীবন নগর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(277, 56, 4, 'Alamdanga ', 'আলমডাঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:29', '2018-09-27 07:12:29'),
(278, 57, 4, 'Abhaynagar ', 'অভয়নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(279, 57, 4, 'Keshabpur ', 'কেশবপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(280, 57, 4, 'Bagherpara ', 'বাঘের পাড়া ', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(281, 57, 4, 'Jessore Sadar ', 'যশোর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(282, 57, 4, 'Chaugachha ', 'চৌগাছা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(283, 57, 4, 'Manirampur ', 'মনিরামপুর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(284, 57, 4, 'Jhikargachha ', 'ঝিকরগাছা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(285, 57, 4, 'Sharsha ', 'সারশা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(286, 58, 4, 'Jhenaidah Sadar ', 'ঝিনাইদহ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(287, 58, 4, 'Maheshpur ', 'মহেশপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(288, 58, 4, 'Kaliganj ', 'কালীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(289, 58, 4, 'Kotchandpur ', 'কোট চাঁদপুর ', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(290, 58, 4, 'Shailkupa ', 'শৈলকুপা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(291, 58, 4, 'Harinakunda ', 'হাড়িনাকুন্দা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(292, 59, 4, 'Terokhada ', 'তেরোখাদা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(293, 59, 4, 'Batiaghata ', 'বাটিয়াঘাটা ', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(294, 59, 4, 'Dacope ', 'ডাকপে', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(295, 59, 4, 'Dumuria ', 'ডুমুরিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(296, 59, 4, 'Dighalia ', 'দিঘলিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(297, 59, 4, 'Koyra ', 'কয়ড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(298, 59, 4, 'Paikgachha ', 'পাইকগাছা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(299, 59, 4, 'Phultala ', 'ফুলতলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(300, 59, 4, 'Rupsa ', 'রূপসা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(301, 60, 4, 'Kushtia Sadar', 'কুষ্টিয়া সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(302, 60, 4, 'Kumarkhali', 'কুমারখালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(303, 60, 4, 'Daulatpur', 'দৌলতপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(304, 60, 4, 'Mirpur', 'মিরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(305, 60, 4, 'Bheramara', 'ভেরামারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(306, 60, 4, 'Khoksa', 'খোকসা', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(307, 61, 4, 'Magura Sadar ', 'মাগুরা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(308, 61, 4, 'Mohammadpur ', 'মোহাম্মাদপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:30', '2018-09-27 07:12:30'),
(309, 61, 4, 'Shalikha ', 'শালিখা', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(310, 61, 4, 'Sreepur ', 'শ্রীপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(311, 62, 4, 'angni ', 'আংনি', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(312, 62, 4, 'Mujib Nagar ', 'মুজিব নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(313, 62, 4, 'Meherpur-S ', 'মেহেরপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(314, 63, 4, 'Narail-S Upazilla', 'নড়াইল সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(315, 63, 4, 'Lohagara Upazilla', 'লোহাগাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(316, 63, 4, 'Kalia Upazilla', 'কালিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(317, 64, 4, 'Satkhira Sadar ', 'সাতক্ষীরা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(318, 64, 4, 'Assasuni ', 'আসসাশুনি ', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(319, 64, 4, 'Debhata ', 'দেভাটা', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(320, 64, 4, 'Tala ', 'তালা', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(321, 64, 4, 'Kalaroa ', 'কলরোয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(322, 64, 4, 'Kaliganj ', 'কালীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(323, 64, 4, 'Shyamnagar ', 'শ্যামনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(324, 18, 5, 'Adamdighi', 'আদমদিঘী', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(325, 18, 5, 'Bogra Sadar', 'বগুড়া সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(326, 18, 5, 'Sherpur', 'শেরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(327, 18, 5, 'Dhunat', 'ধুনট', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(328, 18, 5, 'Dhupchanchia', 'দুপচাচিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(329, 18, 5, 'Gabtali', 'গাবতলি', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(330, 18, 5, 'Kahaloo', 'কাহালু', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(331, 18, 5, 'Nandigram', 'নন্দিগ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(332, 18, 5, 'Sahajanpur', 'শাহজাহানপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(333, 18, 5, 'Sariakandi', 'সারিয়াকান্দি', NULL, NULL, 1, NULL, '2018-09-27 07:12:31', '2018-09-27 07:12:31'),
(334, 18, 5, 'Shibganj', 'শিবগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(335, 18, 5, 'Sonatala', 'সোনাতলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(336, 19, 5, 'Joypurhat S', 'জয়পুরহাট সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(337, 19, 5, 'Akkelpur', 'আক্কেলপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(338, 19, 5, 'Kalai', 'কালাই', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(339, 19, 5, 'Khetlal', 'খেতলাল', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(340, 19, 5, 'Panchbibi', 'পাঁচবিবি', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(341, 20, 5, 'Naogaon Sadar ', 'নওগাঁ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(342, 20, 5, 'Mohadevpur ', 'মহাদেবপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(343, 20, 5, 'Manda ', 'মান্দা', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(344, 20, 5, 'Niamatpur ', 'নিয়ামতপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(345, 20, 5, 'Atrai ', 'আত্রাই', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(346, 20, 5, 'Raninagar ', 'রাণীনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(347, 20, 5, 'Patnitala ', 'পত্নীতলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(348, 20, 5, 'Dhamoirhat ', 'ধামইরহাট ', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(349, 20, 5, 'Sapahar ', 'সাপাহার', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(350, 20, 5, 'Porsha ', 'পোরশা', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(351, 20, 5, 'Badalgachhi ', 'বদলগাছি', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(352, 21, 5, 'Natore Sadar ', 'নাটোর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(353, 21, 5, 'Baraigram ', 'বড়াইগ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(354, 21, 5, 'Bagatipara ', 'বাগাতিপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(355, 21, 5, 'Lalpur ', 'লালপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(356, 21, 5, 'Natore Sadar ', 'নাটোর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(357, 21, 5, 'Baraigram ', 'বড়াই গ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(358, 22, 5, 'Bholahat ', 'ভোলাহাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(359, 22, 5, 'Gomastapur ', 'গোমস্তাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(360, 22, 5, 'Nachole ', 'নাচোল', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(361, 22, 5, 'Nawabganj Sadar ', 'নবাবগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(362, 22, 5, 'Shibganj ', 'শিবগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(363, 23, 5, 'Atgharia ', 'আটঘরিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(364, 23, 5, 'Bera ', 'বেড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(365, 23, 5, 'Bhangura ', 'ভাঙ্গুরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(366, 23, 5, 'Chatmohar ', 'চাটমোহর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(367, 23, 5, 'Faridpur ', 'ফরিদপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(368, 23, 5, 'Ishwardi ', 'ঈশ্বরদী', NULL, NULL, 1, NULL, '2018-09-27 07:12:32', '2018-09-27 07:12:32'),
(369, 23, 5, 'Pabna Sadar ', 'পাবনা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(370, 23, 5, 'Santhia ', 'সাথিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(371, 23, 5, 'Sujanagar ', 'সুজানগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(372, 24, 5, 'Bagha', 'বাঘা', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(373, 24, 5, 'Bagmara', 'বাগমারা', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(374, 24, 5, 'Charghat', 'চারঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(375, 24, 5, 'Durgapur', 'দুর্গাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(376, 24, 5, 'Godagari', 'গোদাগারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(377, 24, 5, 'Mohanpur', 'মোহনপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(378, 24, 5, 'Paba', 'পবা', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(379, 24, 5, 'Puthia', 'পুঠিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(380, 24, 5, 'Tanore', 'তানোর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(381, 25, 5, 'Sirajganj Sadar ', 'সিরাজগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(382, 25, 5, 'Belkuchi ', 'বেলকুচি', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(383, 25, 5, 'Chauhali ', 'চৌহালি', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(384, 25, 5, 'Kamarkhanda ', 'কামারখান্দা', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(385, 25, 5, 'Kazipur ', 'কাজীপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(386, 25, 5, 'Raiganj ', 'রায়গঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(387, 25, 5, 'Shahjadpur ', 'শাহজাদপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(388, 25, 5, 'Tarash ', 'তারাশ', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(389, 25, 5, 'Ullahpara ', 'উল্লাপাড়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(390, 26, 6, 'Birampur ', 'বিরামপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(391, 26, 6, 'Birganj', 'বীরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(392, 26, 6, 'Biral ', 'বিড়াল', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(393, 26, 6, 'Bochaganj ', 'বোচাগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(394, 26, 6, 'Chirirbandar ', 'চিরিরবন্দর', NULL, NULL, 1, NULL, '2018-09-27 07:12:33', '2018-09-27 07:12:33'),
(395, 26, 6, 'Phulbari ', 'ফুলবাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(396, 26, 6, 'Ghoraghat ', 'ঘোড়াঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(397, 26, 6, 'Hakimpur ', 'হাকিমপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(398, 26, 6, 'Kaharole ', 'কাহারোল', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(399, 26, 6, 'Khansama ', 'খানসামা', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(400, 26, 6, 'Dinajpur Sadar ', 'দিনাজপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(401, 26, 6, 'Nawabganj', 'নবাবগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(402, 26, 6, 'Parbatipur ', 'পার্বতীপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(403, 27, 6, 'Fulchhari', 'ফুলছড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(404, 27, 6, 'Gaibandha sadar', 'গাইবান্ধা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(405, 27, 6, 'Gobindaganj', 'গোবিন্দগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(406, 27, 6, 'Palashbari', 'পলাশবাড়ী', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(407, 27, 6, 'Sadullapur', 'সাদুল্যাপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(408, 27, 6, 'Saghata', 'সাঘাটা', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(409, 27, 6, 'Sundarganj', 'সুন্দরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(410, 28, 6, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(411, 28, 6, 'Nageshwari', 'নাগেশ্বরী', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(412, 28, 6, 'Bhurungamari', 'ভুরুঙ্গামারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(413, 28, 6, 'Phulbari', 'ফুলবাড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(414, 28, 6, 'Rajarhat', 'রাজারহাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(415, 28, 6, 'Ulipur', 'উলিপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(416, 28, 6, 'Chilmari', 'চিলমারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(417, 28, 6, 'Rowmari', 'রউমারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(418, 28, 6, 'Char Rajibpur', 'চর রাজিবপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(419, 29, 6, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(420, 29, 6, 'Aditmari', 'আদিতমারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(421, 29, 6, 'Kaliganj', 'কালীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:34', '2018-09-27 07:12:34'),
(422, 29, 6, 'Hatibandha', 'হাতিবান্ধা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(423, 29, 6, 'Patgram', 'পাটগ্রাম', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(424, 30, 6, 'Nilphamari Sadar', 'নীলফামারী সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(425, 30, 6, 'Saidpur', 'সৈয়দপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(426, 30, 6, 'Jaldhaka', 'জলঢাকা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(427, 30, 6, 'Kishoreganj', 'কিশোরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(428, 30, 6, 'Domar', 'ডোমার', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(429, 30, 6, 'Dimla', 'ডিমলা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(430, 31, 6, 'Panchagarh Sadar', 'পঞ্চগড় সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(431, 31, 6, 'Debiganj', 'দেবীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(432, 31, 6, 'Boda', 'বোদা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(433, 31, 6, 'Atwari', 'আটোয়ারি', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(434, 31, 6, 'Tetulia', 'তেতুলিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(435, 32, 6, 'Badarganj', 'বদরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(436, 32, 6, 'Mithapukur', 'মিঠাপুকুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(437, 32, 6, 'Gangachara', 'গঙ্গাচরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(438, 32, 6, 'Kaunia', 'কাউনিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(439, 32, 6, 'Rangpur Sadar', 'রংপুর সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(440, 32, 6, 'Pirgachha', 'পীরগাছা', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(441, 32, 6, 'Pirganj', 'পীরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(442, 32, 6, 'Taraganj', 'তারাগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(443, 33, 6, 'Thakurgaon Sadar ', 'ঠাকুরগাঁও সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(444, 33, 6, 'Pirganj ', 'পীরগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(445, 33, 6, 'Baliadangi ', 'বালিয়াডাঙ্গি', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(446, 33, 6, 'Haripur ', 'হরিপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(447, 33, 6, 'Ranisankail ', 'রাণীসংকইল', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(448, 51, 7, 'Ajmiriganj', 'আজমিরিগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(449, 51, 7, 'Baniachang', 'বানিয়াচং', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(450, 51, 7, 'Bahubal', 'বাহুবল', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(451, 51, 7, 'Chunarughat', 'চুনারুঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(452, 51, 7, 'Habiganj Sadar', 'হবিগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(453, 51, 7, 'Lakhai', 'লাক্ষাই', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(454, 51, 7, 'Madhabpur', 'মাধবপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(455, 51, 7, 'Nabiganj', 'নবীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:35', '2018-09-27 07:12:35'),
(456, 51, 7, 'Shaistagonj ', 'শায়েস্তাগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(457, 52, 7, 'Moulvibazar Sadar', 'মৌলভীবাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(458, 52, 7, 'Barlekha', 'বড়লেখা', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(459, 52, 7, 'Juri', 'জুড়ি', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(460, 52, 7, 'Kamalganj', 'কামালগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(461, 52, 7, 'Kulaura', 'কুলাউরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(462, 52, 7, 'Rajnagar', 'রাজনগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(463, 52, 7, 'Sreemangal', 'শ্রীমঙ্গল', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(464, 53, 7, 'Bishwamvarpur', 'বিসশম্ভারপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(465, 53, 7, 'Chhatak', 'ছাতক', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(466, 53, 7, 'Derai', 'দেড়াই', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(467, 53, 7, 'Dharampasha', 'ধরমপাশা', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(468, 53, 7, 'Dowarabazar', 'দোয়ারাবাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(469, 53, 7, 'Jagannathpur', 'জগন্নাথপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(470, 53, 7, 'Jamalganj', 'জামালগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(471, 53, 7, 'Sulla', 'সুল্লা', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(472, 53, 7, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(473, 53, 7, 'Shanthiganj', 'শান্তিগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(474, 53, 7, 'Tahirpur', 'তাহিরপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(475, 54, 7, 'Sylhet Sadar', 'সিলেট সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36');
INSERT INTO `upazilas` (`id`, `district_id`, `division_id`, `name`, `bn_name`, `lat`, `lng`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(476, 54, 7, 'Beanibazar', 'বেয়ানিবাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(477, 54, 7, 'Bishwanath', 'বিশ্বনাথ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(478, 54, 7, 'Dakshin Surma ', 'দক্ষিণ সুরমা', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(479, 54, 7, 'Balaganj', 'বালাগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(480, 54, 7, 'Companiganj', 'কোম্পানিগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(481, 54, 7, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(482, 54, 7, 'Golapganj', 'গোলাপগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(483, 54, 7, 'Gowainghat', 'গোয়াইনঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(484, 54, 7, 'Jaintiapur', 'জয়ন্তপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(485, 54, 7, 'Kanaighat', 'কানাইঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(486, 54, 7, 'Zakiganj', 'জাকিগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(487, 54, 7, 'Nobigonj', 'নবীগঞ্জ', NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(488, 1, 3, 'Adabor', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(489, 1, 3, 'Airport', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(490, 1, 3, 'Badda', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(491, 1, 3, 'Banani', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:36', '2018-09-27 07:12:36'),
(492, 1, 3, 'Bangshal', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(493, 1, 3, 'Bhashantek', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(494, 1, 3, 'Cantonment', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(495, 1, 3, 'Chackbazar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(496, 1, 3, 'Darussalam', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(497, 1, 3, 'Daskhinkhan', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(498, 1, 3, 'Demra', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(499, 1, 3, 'Dhamrai', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(500, 1, 3, 'Dhanmondi', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(501, 1, 3, 'Dohar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(502, 1, 3, 'Gandaria', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(503, 1, 3, 'Gulshan', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(504, 1, 3, 'Hazaribag', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(505, 1, 3, 'Jatrabari', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(506, 1, 3, 'Kafrul', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(507, 1, 3, 'Kalabagan', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(508, 1, 3, 'Kamrangirchar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(509, 1, 3, 'Keraniganj', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(510, 1, 3, 'Khilgaon', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(511, 1, 3, 'Khilkhet', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(512, 1, 3, 'Kotwali', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(513, 1, 3, 'Lalbag', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(514, 1, 3, 'Mirpur Model', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(515, 1, 3, 'Mohammadpur', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(516, 1, 3, 'Motijheel', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(517, 1, 3, 'Mugda', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(518, 1, 3, 'Nawabganj', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:37', '2018-09-27 07:12:37'),
(519, 1, 3, 'New Market', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(520, 1, 3, 'Pallabi', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(521, 1, 3, 'Paltan', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(522, 1, 3, 'Ramna', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(523, 1, 3, 'Rampura', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(524, 1, 3, 'Rupnagar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(525, 1, 3, 'Sabujbag', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(526, 1, 3, 'Savar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(527, 1, 3, 'Shah Ali', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(528, 1, 3, 'Shahbag', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(529, 1, 3, 'Shahjahanpur', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(530, 1, 3, 'Sherebanglanagar', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(531, 1, 3, 'Shyampur', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(532, 1, 3, 'Sutrapur', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(533, 1, 3, 'Tejgaon', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(534, 1, 3, 'Tejgaon I/A', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(535, 1, 3, 'Turag', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(536, 1, 3, 'Uttara', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(537, 1, 3, 'Uttara West', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(538, 1, 3, 'Uttarkhan', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(539, 1, 3, 'Vatara', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(540, 1, 3, 'Wari', NULL, NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(541, 35, 1, 'Airport', 'এয়ারপোর্ট', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(542, 35, 1, 'Kawnia', 'কাউনিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(543, 35, 1, 'Bondor', 'বন্দর', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(544, 24, 5, 'Boalia', 'বোয়ালিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(545, 24, 5, 'Motihar', 'মতিহার', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(546, 24, 5, 'Shahmokhdum', 'শাহ্ মকখদুম ', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(547, 24, 5, 'Rajpara', 'রাজপারা ', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(548, 43, 2, 'Akborsha', 'Akborsha', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(549, 43, 2, 'Baijid bostami', 'বাইজিদ বোস্তামী', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(550, 43, 2, 'Bakolia', 'বাকোলিয়া', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(551, 43, 2, 'Bandar', 'বন্দর', NULL, NULL, 1, NULL, '2018-09-27 07:12:38', '2018-09-27 07:12:38'),
(552, 43, 2, 'Chandgaon', 'চাঁদগাও', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(553, 43, 2, 'Chokbazar', 'চকবাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(554, 43, 2, 'Doublemooring', 'ডাবল মুরিং', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(555, 43, 2, 'EPZ', 'ইপিজেড', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(556, 43, 2, 'Hali Shohor', 'হলী শহর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(557, 43, 2, 'Kornafuli', 'কর্ণফুলি', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(558, 43, 2, 'Kotwali', 'কোতোয়ালী', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(559, 43, 2, 'Kulshi', 'কুলশি', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(560, 43, 2, 'Pahartali', 'পাহাড়তলী', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(561, 43, 2, 'Panchlaish', 'পাঁচলাইশ', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(562, 43, 2, 'Potenga', 'পতেঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(563, 43, 2, 'Shodhorgat', 'সদরঘাট', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(564, 59, 4, 'Aranghata', 'আড়াংঘাটা', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(565, 59, 4, 'Daulatpur', 'দৌলতপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(566, 59, 4, 'Harintana', 'হারিন্তানা ', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(567, 59, 4, 'Horintana', 'হরিণতানা ', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(568, 59, 4, 'Khalishpur', 'খালিশপুর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(569, 59, 4, 'Khanjahan Ali', 'খানজাহান আলী', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(570, 59, 4, 'Khulna Sadar', 'খুলনা সদর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(571, 59, 4, 'Labanchora', 'লাবানছোরা', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(572, 59, 4, 'Sonadanga', 'সোনাডাঙ্গা', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(573, 54, 7, 'Airport', 'বিমানবন্দর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(574, 54, 7, 'Hazrat Shah Paran', 'হযরত শাহ পরাণ', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(575, 54, 7, 'Jalalabad', 'জালালাবাদ', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(576, 54, 7, 'Kowtali', 'কোতোয়ালী', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(577, 54, 7, 'Moglabazar', 'মোগলাবাজার', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(578, 54, 7, 'Osmani Nagar', 'ওসমানী নগর', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(579, 54, 7, 'South Surma', 'দক্ষিণ সুরমা', NULL, NULL, 1, NULL, '2018-09-27 07:12:39', '2018-09-27 07:12:39'),
(580, 11, 3, 'Fatullah', 'ফতুল্লা', 23.646111, 90.485556, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `bkash_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','corporate','owner','driver','solo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'solo',
  `status` enum('pending','active','suspended','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `otp_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `writer` tinyint DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_type` tinyint DEFAULT '0',
  `fb_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yt_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_temp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `present_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssc_passing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssc_registration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_history` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approve` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `father_name`, `designation`, `address`, `reg_date`, `bkash_number`, `dob`, `blood_group`, `email`, `role`, `status`, `otp_verified_at`, `email_verified_at`, `image`, `short_bio`, `writer`, `mobile`, `membership_type`, `fb_url`, `twitter_url`, `insta_url`, `yt_url`, `local_url`, `password`, `password_temp`, `remember_token`, `created_at`, `updated_at`, `present_address`, `permanent_address`, `nid`, `tin_number`, `ssc_passing`, `ssc_registration`, `health_history`, `is_approve`) VALUES
(148, 'Admin', 'Aretha Howard', NULL, 'Animi commodi commo', '2007-11-15', '473', '2013-05-02', 'O+', 'admin@gmail.com', 'admin', 'active', NULL, NULL, 'users/BRGTEl7IAmJt0VzXnsDyyFlFzt7qIBOApqktwQIP.png', NULL, NULL, '473', NULL, NULL, NULL, NULL, NULL, NULL, '$2a$12$PS5xglpvDnM8VcB1C4kRJOXlSIFANfYcIYQsprU4XAZTJvQYF4WGO', NULL, NULL, '2025-09-03 05:04:39', '2026-01-10 00:40:00', 'Animi commodi commo', 'Minim perferendis an', '466', '86', '2018', '1996', NULL, 0),
(160, 'Adara Bond', 'Renee Gilliam', NULL, 'Minim recusandae Ac', '2002-03-01', '549', '1973-08-12', 'B+', 'jajev@mailinator.com', 'solo', 'active', NULL, NULL, 'users/99gye9PXyrU0T7rrxZONQpywKhFoHCjl2fOZ5uHI.png', NULL, NULL, '549', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Q9hzeeBLBi/LeGXNpRAoXusS5jps6k9kScAHCmiD3IszIEr.c0y22', NULL, NULL, '2025-09-03 05:36:17', '2026-01-10 00:39:48', 'Minim recusandae Ac', 'Sunt dicta labore es', '422', '563', '1993', '1979', NULL, 1),
(161, 'Gage Lynch', 'Melodie Townsend', NULL, 'Consectetur in quis', '1999-03-08', '866', '2017-08-14', 'A+', 'birajasary@mailinator.com', 'solo', 'active', NULL, NULL, 'users/tmmsX2cnLOWWTm9A1XIf6VPk0BFDVUsyal0w6Ci6.png', NULL, NULL, '866', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$qGc/GwWgYMkUONFIEoZPxOmXC1neTY206kZWILU9mTDJSUCEHABhK', NULL, NULL, '2025-09-03 05:38:59', '2026-01-10 00:39:40', 'Consectetur in quis', 'Excepturi est anim v', '457', '954', '1987', '1986', NULL, 1),
(162, 'Rudyard Le', 'Tate Harrell', NULL, 'Fugiat totam labori', '1999-11-10', '807', '1974-02-01', 'O+', 'pexyk@mailinator.com', 'solo', 'active', NULL, NULL, 'users/xFzoLkobSjdHdtF4e7KRSCsgP40rnAkJvuWyTYVT.png', NULL, NULL, '807', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$LvT0NA0quEP9rAt1P0ekjufbsR2H7K7ubDGJdZvb8424Os1c6tnSG', NULL, NULL, '2025-09-03 05:40:10', '2026-01-10 00:39:32', 'Fugiat totam labori', 'Vel animi quasi nes', '379', '937', '2008', '2012', NULL, 0),
(163, 'Sultan Ahmmed', 'Md. Samsuzzaman', NULL, 'Building # 01, Road # 01,  Block# B, Flat # 01,  Mohanagar project.  West  Rampura. Dhaka', '2025-09-03', '01717000000', '1983-08-25', 'A+', 'admin01@gmail.com', 'solo', 'active', NULL, NULL, 'users/zyxU1MRZbpxfXShs2qUyV7Gzcyh8kd4KzTMkSzJj.png', NULL, NULL, '01717000000', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SwKHZvE.GfBSUuQ6/Gg5Xu7ekngmgKc9gRzkwzW7Y86iyLBxEqG76', NULL, NULL, '2025-09-03 22:23:01', '2026-01-10 00:39:22', 'Building # 01, Road # 01,  Block# B, Flat # 01,  Mohanagar project.  West  Rampura. Dhaka', 'Dhaka', '12345678', '12345678', '1999', '1997', NULL, 1),
(164, 'Rakib hasan', 'fawsder mia', NULL, 'dhaka', '2025-09-04', '01976009329', '2025-09-04', 'O+', 'hasanrr092@gmail.com', 'solo', 'active', NULL, NULL, 'users/ylS076knsHrIFVhcWg8j5Sl0iYzntbOn7sVo4WoX.png', NULL, NULL, '01976009329', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ZlR7Zo4yGsnI48okrCwsputGDz54B2cEpOGgKfdV7bNfqTCrxR8Mm', NULL, NULL, '2025-09-03 22:47:25', '2026-01-10 00:39:09', 'dhaka', 'Dhaka', '1111111', '1111111', '2013', '2013', NULL, 1),
(165, 'Arif', 'Md. Nurul Islam', NULL, '304/1, Dhanmondi 15 no(old new 8/a)', '2025-09-01', NULL, '2025-09-01', 'B+', 'mehediarif.du@gmail.com', 'solo', 'active', NULL, NULL, 'users/kpfKsqYp01QIcVZ2lTkEiG1Ozr1TULerKrpLjztF.png', NULL, NULL, '012354656', NULL, NULL, NULL, NULL, NULL, NULL, '$2a$12$FnC.FrBynedknV7oaBFBsOWY.NO9UEzkJ8k1Arn18vwLmJzJOQwLq', NULL, NULL, '2025-09-11 07:23:39', '2026-01-10 00:38:59', NULL, 'Tangail', '1234566789', NULL, '2011', '2020', NULL, 0),
(166, 'Rasel', 'Md. Nurul Islam', NULL, '123456789', '2025-09-11', NULL, '1994-03-01', 'B+', 'rasel93.ict@gmail.com', 'solo', 'active', NULL, NULL, 'users/mKKwfeUbB6ESh7uh3BWSVQNv9Si0hUB4DR69Y3u6.png', NULL, NULL, '01925923212', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$UknDjaRlGCpAGswllQvCYuhOESg.0OZIH3emrcPgQiry0/oqrRWw2', NULL, NULL, '2025-09-11 07:30:46', '2026-01-10 00:38:45', '123456789', 'Tangail', '1234566789', NULL, '2012', '2009', NULL, 0),
(167, 'Mahadi Sarkar', 'Nurul', NULL, 'Dhaka', '2025-09-12', NULL, '1994-03-01', 'B+', 'mehediarif.du2@gmail.com', 'solo', 'active', NULL, NULL, 'users/z2K8ZO2rBYy3OzHx7bIIyfNHicVGtwVgkuFkhUe3.png', NULL, NULL, '019225923276', 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$G7vm6/UfA0wnN3OEvmzcqOvKSczE1t61vJFNicveYir33wJjy6Koq', NULL, NULL, '2025-09-12 06:03:53', '2026-01-10 00:38:35', 'Dhaka', 'Tangail', '123456789', NULL, '2015', '215635', NULL, 0),
(168, 'Md.Sadequzzaman Mondal', 'mehedi', NULL, 'Village -Durgapur.,PS- Sadullapur,Dist. _Gaibandha,', '2025-09-14', NULL, '1994-03-01', 'B+', 'tashin.mondal@gmail.com', 'solo', 'active', NULL, NULL, 'users/SGEyPGM3hAK4UD7u8HzftxpnzJLAiJAnxtyphlNc.png', NULL, NULL, '01743486624', 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$eGxM7epWtI7eFdYUXCAn4OsI31z9JLDxL.KbH/G1cfo1.MzbjLCzG', NULL, 'KEDXTTbS2mnF04Exs0uVzjNlisVJNtkQLUc1NEwhqYSBiZHTIa3yJyrsNNGY', '2025-09-12 21:37:34', '2026-01-10 00:38:24', 'dhajka', 'khulna', '987654321', NULL, '2009', '2040', NULL, 1),
(169, 'Ruman Sikder', 'Nurul', NULL, 'Demra', '2025-09-14', NULL, '1994-03-01', 'B-', 'rasel930@gmail.com', 'solo', 'active', NULL, NULL, 'users/fT94tMeWZlqrwQwJMDxba7M4NPAgQz5K7C76bJ3V.png', NULL, NULL, '3698521470', 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$l3ZsDTpUsZUM5GCPcT1SsuEZHpnjz2HRqGeCiL7IKoGwfoDuTVYbS', NULL, NULL, '2025-09-14 08:24:27', '2026-01-10 00:40:32', 'Demra', 'Tango', '7412589633', NULL, '2009', '2011', NULL, 1),
(170, 'Namsid Sultana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'arif@gmail.com', 'solo', 'active', NULL, NULL, 'users/V6jmrBPk9nJHNEraO90AoggMi7HCdxWhdwUAMDmJ.png', 'A passionate volunteer committed to bringing hope and positive change to underprivileged communities in Northern Bangladesh.', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, '$2y$10$hxODPN0LAweWvFROBGbbiuDmrVlVOQSwDXtP/kNlq/RloqqU4.deW', NULL, NULL, '2025-11-20 23:48:07', '2026-01-10 00:38:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(171, 'Rahim Mehedi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aa10@gmail.com', 'solo', 'active', NULL, NULL, 'users/tljIAEmHuJtIVe4sZJerakje3IXYtytI3j1QcnmE.png', 'Dedicated to helping those in need, supporting North Bangla Foundation’s programs in education, healthcare, and community development.', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, '$2y$10$vsiBFSynWMk09fDBGbmGnuvAbhSqzYhQop.UGhUaGzkmIEMOGjlTi', NULL, NULL, '2025-11-21 02:54:52', '2026-01-10 00:38:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(172, 'Md. Romjan', NULL, 'Worker', 'Dhaka Khulna', NULL, NULL, NULL, NULL, 'aac@gmail.com', 'solo', 'active', NULL, NULL, 'users/EbK9PwQgybuYWGOSfvmaZ6hmS5fubDD0Jlx9YEnB.png', 'Passionate about serving the community and making a positive impact, committed to supporting North Bangla Foundation’s mission to uplift underprivileged lives through education, healthcare, and humanitarian aid.', NULL, '01303182772', 2, 'https://chatgpt.com/faces', 'https://chatgpt.com/twitters', 'https://chatgpt.com/instagrams', 'https://chatgpt.com/yts', 'https://chatgpt.com/others', '$2y$10$aODAQjkEEKat3CB48MYH1.Nr2wxixkjsaph37wM0ugy9HCwiwRUh6', NULL, NULL, '2026-01-06 08:53:53', '2026-01-10 00:37:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(173, 'aa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aaa@gmail.com', 'solo', 'active', NULL, NULL, 'users/e1sEH39DtFyLwrhmBjuHN49XAqsBccxe3Fq80qbD.png', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$7Ai/VTpaUqt0oJhHY6IKz.JuMJf0KAtl0ofJ6td0Gb89I/xXanT/m', NULL, NULL, '2026-01-06 08:55:06', '2026-01-10 00:37:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(174, 'Arif Customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'customer01@gmail.com', 'solo', 'active', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$lomHEAFfFn9Cy49vSSgaguRihd0ZITTwA6MSZqt5sda3VFdnBQ4ba', NULL, NULL, '2026-04-22 19:36:49', '2026-04-22 19:36:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(175, 'Driver arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'driver01@gmail.com', 'driver', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$b5uBJ5ctV4UXpklcCHBVYu2Dgy0BhJ3EgqWTkk0QHdisXdL6BIO4q', NULL, NULL, '2026-04-22 19:38:36', '2026-04-22 19:38:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(176, 'Corporate Arif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'corporate01@gmail.com', 'corporate', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$7QBi5Wrwb0EbOKbaFabcSenQ3u3WJXZqcssIjFonOvxO3GwGqA21C', NULL, NULL, '2026-04-22 20:19:26', '2026-04-22 20:19:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `office_location_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_type`, `plate_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trucks', '123456789', 60.00, 0, '2025-12-23 15:55:17', '2025-12-23 15:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_assignments`
--

CREATE TABLE `vehicle_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `farmer_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `delivery_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` datetime NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` int UNSIGNED DEFAULT NULL,
  `district_id` int UNSIGNED DEFAULT NULL,
  `upazila_id` int UNSIGNED DEFAULT NULL,
  `union_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bn_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `addedby_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `division_id`, `district_id`, `upazila_id`, `union_id`, `name`, `bn_name`, `lat`, `lng`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 6, 27, 407, 1, 'Chok Narayon', 'চকনারায়ন', NULL, NULL, 1, NULL, NULL, NULL),
(2, 6, 27, 407, 1, 'Torof Kamal', 'তরফকামাল', NULL, NULL, 1, NULL, NULL, NULL),
(3, 6, 27, 407, 1, 'Joydev', 'জয়দেব', NULL, NULL, 1, NULL, '2026-01-20 07:46:43', '2026-01-20 07:46:43'),
(4, 6, 27, 407, 1, 'Daudpur', 'দাউদপুর', NULL, NULL, 1, NULL, '2026-01-20 07:46:43', '2026-01-20 07:46:43'),
(24, 6, 27, 407, 1, 'Boro Daudpur', 'বড়দাউদপুর', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(25, 6, 27, 407, 1, 'Kisamt Tajpur', 'কিশামততাজপুর', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(26, 6, 27, 407, 1, 'Mohisbandi', 'মহিষবান্দি', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(27, 6, 27, 407, 1, 'Jan Para', 'জানপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(28, 6, 27, 407, 1, 'Khamari Para', 'খামারীপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(29, 6, 27, 407, 1, 'Araji Chandiapur', 'আরাজী ছান্দিয়াপুর', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(30, 6, 27, 407, 1, 'Araji Chandiapur(North Center)', 'আরাজী ছান্দিয়াপুর (উত্তর মধ্য)', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(31, 6, 27, 407, 1, 'Araji Chandiapur (South Center)', 'আরাজী ছান্দিয়াপুর (দক্ষিণ মধ্য)', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(32, 6, 27, 407, 1, 'Araji Chandiapur(North)', 'আরাজী ছান্দিয়াপুর (উত্তর)', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(33, 6, 27, 407, 1, 'Chandiapur', 'ছান্দিয়াপুর', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(34, 6, 27, 407, 1, 'Akra Para', 'আকড়া পাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(35, 6, 27, 407, 1, 'Kazipara Center', 'মধ্য কাজীপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(36, 6, 27, 407, 1, 'Fokir Para', 'ফকিরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(37, 6, 27, 407, 1, 'Araji Torof Kamal', 'আরাজী তরফকামাল', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(38, 6, 27, 407, 1, 'Nampara', 'নামাপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(39, 6, 27, 407, 1, 'Moddho Para', 'মধ্যপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(40, 6, 27, 407, 1, 'Kumidpur', 'কুমিদপুর', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(41, 6, 27, 407, 1, 'Shri-Rampur Poschim Para', 'শ্রীরামপুর পশ্চিমপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(42, 6, 27, 407, 1, 'Shri-Rampur Dokkhin Para', 'শ্রীরামপুর দক্ষিণপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(43, 6, 27, 407, 1, 'Shri-Rampur Bogura Para', 'শ্রীরামপুর বগুড়াপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(44, 6, 27, 407, 1, 'Shri-Rampur', 'শ্রীরামপুর', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(45, 6, 27, 407, 1, 'Shri-Rampur (North)', 'উত্তর শ্রীরামপুর', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(46, 6, 27, 407, 1, 'Shri-Rampur (Center)', 'মধ্য শ্রীরামপুর', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(47, 6, 27, 407, 1, 'Shri-Rampur (East)', 'পূর্ব শ্রীরামপুর', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(48, 6, 27, 407, 1, 'Shri-Rampur (South)', 'দক্ষিণ শ্রীরামপুর', NULL, NULL, 1, NULL, '2026-01-20 08:08:23', '2026-01-20 08:08:23'),
(49, 6, 27, 407, 1, 'Fokir Para', 'ফকিরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:03:14', '2026-01-20 08:03:14'),
(50, 6, 27, 407, 2, 'Kamar Doshria', 'খামারদশরিয়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(51, 6, 27, 407, 2, 'Noldanga', 'নলডাঙ্গা', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(52, 6, 27, 407, 2, 'Kisamot Hamid', 'কিশামতহামিদ', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(53, 6, 27, 407, 2, 'Tupamari Noldanga', 'টুপামারীনলডাঙ্গা', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(54, 6, 27, 407, 2, 'Dokkhinmonduar Para', 'দক্ষিণমন্দুয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(55, 6, 27, 407, 2, 'Monduar Para', 'মন্দুয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(56, 6, 27, 407, 2, 'Mondol Para', 'মন্ডলপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(57, 6, 27, 407, 2, 'Moddho Monduar Para', 'মধ্যমন্দুয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(58, 6, 27, 407, 2, 'Dosolia', 'দশলিয়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(59, 6, 27, 407, 2, 'Protab', 'প্রতাব', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(60, 6, 27, 407, 2, 'East Protab', 'পূর্বপ্রতাপ', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(61, 6, 27, 407, 2, 'Protap', 'প্রতাপ', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(62, 6, 27, 407, 2, 'Full Para', 'ফুলপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(63, 6, 27, 407, 2, 'East Protab', 'পূর্বপ্রতাব', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(64, 6, 27, 407, 2, 'Sholagari', 'শোলাগাড়ী', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(65, 6, 27, 407, 2, 'East Mondur Para', 'পূর্বমন্দুয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(66, 6, 27, 407, 2, 'East Monduar Para', 'পশ্চিমমন্দুয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 08:52:39', '2026-01-20 08:52:39'),
(67, 6, 27, 407, 3, 'North Vanga Mor', 'উত্তরভাঙ্গামোড়', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(68, 6, 27, 407, 3, 'Center Vanga Mor', 'মধ্যভাঙ্গামোড়', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(69, 6, 27, 407, 3, 'Kanto Nogor Bazar', 'কান্তনগরবাজার', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(70, 6, 27, 407, 3, 'South Vanga Mor', 'দক্ষিণভাঙ্গামোড়', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(71, 6, 27, 407, 3, 'Junior Para', 'জুনিয়ারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(72, 6, 27, 407, 3, 'Center Vanga Mor', 'মধ্যভাঙ্গামোড়', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(73, 6, 27, 407, 3, 'Kanto Nogor', 'কান্তনগর', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(74, 6, 27, 407, 3, 'Burir vita', 'বুড়িরভিটা', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(75, 6, 27, 407, 3, 'Kolar Bagan', 'কলারবাগান', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(76, 6, 27, 407, 3, 'Sorkar Bari', 'সরকারবাড়ী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(77, 6, 27, 407, 3, 'North Hat Bamuni', 'হাটবামুনী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(78, 6, 27, 407, 3, 'East Damodorpur', 'পূর্বদামোদরপুর', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(79, 6, 27, 407, 3, 'Sordar Para', 'সরদারপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(80, 6, 27, 407, 3, 'Singir Khamar', 'শিংগিরখামার', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(81, 6, 27, 407, 3, 'Devettor', 'দেবেত্তর', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(82, 6, 27, 407, 3, 'Kaji Para', 'কাজীপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(83, 6, 27, 407, 3, 'Kisamot Dosolia', 'কিশামতদশলিয়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(84, 6, 27, 407, 3, 'Beapri Para', 'ব্যাপারীপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(85, 6, 27, 407, 3, 'Uttor Para', 'উত্তরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(86, 6, 27, 407, 3, 'Poschim Para', 'পশ্চিমপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(87, 6, 27, 407, 3, 'Tengnar Vita', 'টেংনারভিটা', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(88, 6, 27, 407, 3, 'Matarhat', 'মাতারহাট', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(89, 6, 27, 407, 3, 'Damodurpur', 'দমোদরপুর', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(90, 6, 27, 407, 3, 'Talwalapara', 'তালওয়ালাপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(91, 6, 27, 407, 3, 'Jalar Bari', 'জালারবাড়ী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(92, 6, 27, 407, 3, 'Kochu Bari', 'কচুবাড়ী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(93, 6, 27, 407, 3, 'Dula Master Bari', 'দুলামাস্টারবাড়ী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(94, 6, 27, 407, 3, 'Kisamot Boro Bari', 'কিশামতবড়বাড়ী', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(95, 6, 27, 407, 3, 'Morua Doho Dokkhin Para', 'মরুয়াদহদক্ষিণপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(96, 6, 27, 407, 3, 'Jamu Danga Dokkhin Para', 'জামুডাঙ্গাদক্ষিণপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(97, 6, 27, 407, 3, 'Jmaudanga Mondol Para', 'জামুডাঙ্গামন্ডলপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(98, 6, 27, 407, 3, 'Chit Jamu Danga', 'চিটজামুডাঙ্গা', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(99, 6, 27, 407, 3, 'Chit Jamu Danga Poshcim Para', 'চিটজামুডাঙ্গাপশ্চিমপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(100, 6, 27, 407, 3, 'Morua Doho Uttor Para', 'মরুয়াদহউত্তরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(101, 6, 27, 407, 3, 'Vanga Mor Dokkhin Para', 'ভাঙ্গামোড়দক্ষিণপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(102, 6, 27, 407, 3, 'Vanga Mor Uttor Para', 'ভাঙ্গামোড়উত্তরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(103, 6, 27, 407, 3, 'Jamua Danga Bachia Para', 'জামুডাঙ্গাবাছিয়াপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(104, 6, 27, 407, 3, 'Jamua Danga Lal Bazar', 'জামুডাঙ্গালালবাজার', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(105, 6, 27, 407, 3, 'Jmaudanga Danga Uttor Para', 'জামুডাঙ্গাউত্তরপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(106, 6, 27, 407, 3, 'Morua Doho Moddo Para', 'মরুয়াদহমধ্যপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(107, 6, 27, 407, 3, 'Kisanot Kheju', 'কিশামতখেজু', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47'),
(108, 6, 27, 407, 3, 'Morua Doho Moddo Para', 'মরুয়াদহমধ্যপাড়া', NULL, NULL, 1, NULL, '2026-01-20 09:42:47', '2026-01-20 09:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `website_parameters`
--

CREATE TABLE `website_parameters` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_bottom_bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_bottom_text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` decimal(10,2) DEFAULT NULL,
  `google_analytics_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `google_search_console` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_pixel_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iframe_map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter_creator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_parameters`
--

INSERT INTO `website_parameters` (`id`, `logo`, `logo_alt`, `favicon`, `footer_bottom_bg_color`, `footer_bottom_text_color`, `website_title`, `shipping_charge`, `google_analytics_code`, `google_search_console`, `facebook_pixel_code`, `meta_author`, `meta_description`, `footer_copyright`, `fb_url`, `contact_mobile`, `contact_address`, `contact_email`, `iframe_map`, `twitter_url`, `youtube_url`, `twitter_title`, `twitter_description`, `twitter_creator`, `og_title`, `og_description`, `about_title`, `about_subtitle`, `about_img`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'logo1767761610.png', 'logo-alt1767761646.png', 'favicon1767761646.png', NULL, NULL, 'North Bengal Dairy', NULL, '<script>Google Analytics (Tracking) Code</script>', '<script>Google Search Console Code</script>', '<script>Facebook (Pixel) Code</script>', 'http://northbengal_foundation.tes', 'Meta Description', '© Copyright 2025. All Rights Reserved.', 'https://www.facebook.com/northbengalfoundation', '+880170000000', '123,  Dhaka, Bangladesh', 'info.northbengalfoundation@gmail.com', NULL, 'http://www.twitter.com/', 'https://www.youtube.com/@northbengalfoundation', NULL, NULL, NULL, NULL, NULL, 'Reliable Agriculture Product Transport & Supply Chain Partner', 'We specialize in transporting fresh agricultural produce safely and efficiently across regions. Our goal is to bridge the gap between farmers and markets, ensuring timely delivery, product quality, and maximum freshness. With a trusted network and years of logistics experience, we handle everything from field to destination with precision and care.', 'about_img1767759818.png', NULL, 1, NULL, '2026-01-06 22:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `user_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `user_ip`, `product_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 14, '2025-11-19 21:40:41', '2025-11-19 21:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance_services`
--
ALTER TABLE `ambulance_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bisesoggo_categories`
--
ALTER TABLE `bisesoggo_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_appointments`
--
ALTER TABLE `book_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `causes_slug_unique` (`slug`),
  ADD KEY `causes_addedby_id_foreign` (`addedby_id`),
  ADD KEY `causes_editedby_id_foreign` (`editedby_id`);

--
-- Indexes for table `chamber_locations`
--
ALTER TABLE `chamber_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_hospitals`
--
ALTER TABLE `doctor_hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivers_mobile_unique` (`mobile`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `features_section_id_foreign` (`section_id`);

--
-- Indexes for table `front_sliders`
--
ALTER TABLE `front_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cards`
--
ALTER TABLE `id_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_product` (`product_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_profiles_member_id_foreign` (`member_id`);

--
-- Indexes for table `member_social_links`
--
ALTER TABLE `member_social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_social_links_member_id_foreign` (`member_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_pages`
--
ALTER TABLE `menu_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mosques`
--
ALTER TABLE `mosques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mosques_district_id_foreign` (`district_id`),
  ADD KEY `mosques_upazila_id_foreign` (`upazila_id`),
  ADD KEY `mosques_division_id_district_id_upazila_id_index` (`division_id`,`district_id`,`upazila_id`),
  ADD KEY `mosques_status_index` (`status`),
  ADD KEY `mosques_union_id_foreign` (`union_id`),
  ADD KEY `mosques_village_id_foreign` (`village_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_contents_page_slug_unique` (`page_slug`);

--
-- Indexes for table `page_items`
--
ALTER TABLE `page_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricings_section_id_foreign` (`section_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent_category` (`parent_id`);

--
-- Indexes for table `product_cats`
--
ALTER TABLE `product_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock_requests`
--
ALTER TABLE `product_stock_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stock_requests_user_id_foreign` (`user_id`),
  ADD KEY `product_stock_requests_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections_setups`
--
ALTER TABLE `sections_setups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_setups_section_id_foreign` (`section_id`),
  ADD KEY `sections_setups_title_id_foreign` (`title_id`),
  ADD KEY `sections_setups_sub_title_id_foreign` (`sub_title_id`),
  ADD KEY `sections_setups_content_id_foreign` (`content_id`),
  ADD KEY `sections_setups_pricing_id_foreign` (`pricing_id`);

--
-- Indexes for table `sections_setup_features`
--
ALTER TABLE `sections_setup_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_setup_features_sections_setup_id_foreign` (`sections_setup_id`),
  ADD KEY `sections_setup_features_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_titles`
--
ALTER TABLE `sub_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unions`
--
ALTER TABLE `unions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unions_division_id_foreign` (`division_id`),
  ADD KEY `unions_district_id_foreign` (`district_id`),
  ADD KEY `unions_upazila_id_foreign` (`upazila_id`),
  ADD KEY `unions_addedby_id_foreign` (`addedby_id`),
  ADD KEY `unions_editedby_id_foreign` (`editedby_id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_plate_number_unique` (`plate_number`) USING BTREE;

--
-- Indexes for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_assignments_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `vehicle_assignments_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicle_assignments_product_id_foreign` (`product_id`),
  ADD KEY `vehicle_assignments_farmer_id_foreign` (`farmer_id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `villages_division_id_foreign` (`division_id`),
  ADD KEY `villages_district_id_foreign` (`district_id`),
  ADD KEY `villages_upazila_id_foreign` (`upazila_id`),
  ADD KEY `villages_union_id_foreign` (`union_id`),
  ADD KEY `villages_addedby_id_foreign` (`addedby_id`),
  ADD KEY `villages_editedby_id_foreign` (`editedby_id`);

--
-- Indexes for table `website_parameters`
--
ALTER TABLE `website_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD UNIQUE KEY `wishlists_user_ip_product_id_unique` (`user_ip`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance_services`
--
ALTER TABLE `ambulance_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bisesoggo_categories`
--
ALTER TABLE `bisesoggo_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `book_appointments`
--
ALTER TABLE `book_appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chamber_locations`
--
ALTER TABLE `chamber_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `doctor_hospitals`
--
ALTER TABLE `doctor_hospitals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_sliders`
--
ALTER TABLE `front_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `id_cards`
--
ALTER TABLE `id_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_profiles`
--
ALTER TABLE `member_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_social_links`
--
ALTER TABLE `member_social_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_pages`
--
ALTER TABLE `menu_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `mosques`
--
ALTER TABLE `mosques`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_items`
--
ALTER TABLE `page_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_cats`
--
ALTER TABLE `product_cats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_stock_requests`
--
ALTER TABLE `product_stock_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections_setups`
--
ALTER TABLE `sections_setups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections_setup_features`
--
ALTER TABLE `sections_setup_features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_titles`
--
ALTER TABLE `sub_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unions`
--
ALTER TABLE `unions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `website_parameters`
--
ALTER TABLE `website_parameters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `causes`
--
ALTER TABLE `causes`
  ADD CONSTRAINT `causes_addedby_id_foreign` FOREIGN KEY (`addedby_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `causes_editedby_id_foreign` FOREIGN KEY (`editedby_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_profiles`
--
ALTER TABLE `member_profiles`
  ADD CONSTRAINT `member_profiles_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_social_links`
--
ALTER TABLE `member_social_links`
  ADD CONSTRAINT `member_social_links_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mosques`
--
ALTER TABLE `mosques`
  ADD CONSTRAINT `mosques_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mosques_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mosques_union_id_foreign` FOREIGN KEY (`union_id`) REFERENCES `unions` (`id`),
  ADD CONSTRAINT `mosques_upazila_id_foreign` FOREIGN KEY (`upazila_id`) REFERENCES `upazilas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mosques_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`);

--
-- Constraints for table `pricings`
--
ALTER TABLE `pricings`
  ADD CONSTRAINT `pricings_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_parent_category` FOREIGN KEY (`parent_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_requests`
--
ALTER TABLE `product_stock_requests`
  ADD CONSTRAINT `product_stock_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_stock_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections_setups`
--
ALTER TABLE `sections_setups`
  ADD CONSTRAINT `sections_setups_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_setups_pricing_id_foreign` FOREIGN KEY (`pricing_id`) REFERENCES `pricings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sections_setups_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_setups_sub_title_id_foreign` FOREIGN KEY (`sub_title_id`) REFERENCES `sub_titles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_setups_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections_setup_features`
--
ALTER TABLE `sections_setup_features`
  ADD CONSTRAINT `sections_setup_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_setup_features_sections_setup_id_foreign` FOREIGN KEY (`sections_setup_id`) REFERENCES `sections_setups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  ADD CONSTRAINT `vehicle_assignments_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `vehicle_assignments_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vehicle_assignments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `vehicle_assignments_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
