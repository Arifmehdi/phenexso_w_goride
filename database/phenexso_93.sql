-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2025 at 10:02 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phenexso_93`
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
(1, 'Cardiologists', NULL, 'A Cardiologist Specialist is a medical doctor trained in diagnosing, treating, and preventing diseases of the heart and blood vessels. They provide expert care for conditions such as heart attacks, arrhythmias, hypertension, and coronary artery disease, helping patients improve heart health and overall well-being.', NULL, 0, '1756018491.png', 1, 1, 1, 1, '2023-02-28 06:12:08', '2025-08-24 00:54:51'),
(2, 'Dermatologists', NULL, 'A Dermatologist Specialist is a medical expert in diagnosing and treating conditions of the skin, hair, and nails. They provide care for acne, eczema, psoriasis, allergies, infections, and cosmetic skin concerns, helping patients maintain healthy and glowing skin.', NULL, 0, '1756018915.png', 1, 1, 1, 1, '2023-02-28 06:44:59', '2025-08-24 01:01:55'),
(3, 'Medicine', NULL, 'A Medicine Specialist is a physician skilled in diagnosing, treating, and managing a wide range of adult health conditions. They provide expert care for chronic diseases, infections, and lifestyle-related illnesses, ensuring comprehensive internal medicine treatment and long-term wellness.', NULL, 0, '1756018928.png', 1, 1, 1, 1, '2023-03-22 03:48:20', '2025-08-24 01:02:08'),
(4, 'Gynecologist', NULL, 'A Gynecologist Specialist is a medical expert focused on women’s reproductive health. They provide care for menstrual disorders, pregnancy, fertility, hormonal issues, and other gynecological conditions, supporting women’s health at every stage of life.', NULL, 0, '1756018801.png', 1, 1, 1, 1, '2023-03-22 03:52:05', '2025-08-24 01:00:01'),
(6, 'Dental', NULL, 'A Dental Specialist is a doctor who diagnoses, treats, and manages oral health issues, including teeth, gums, and jaw disorders, promoting healthy smiles and overall dental wellness.', NULL, 0, '1756018694.png', 1, 1, 1, 1, '2023-03-22 04:01:59', '2025-08-24 00:58:14'),
(8, 'Hepatologist', NULL, 'A Hepatologist Specialist is a doctor who diagnoses, treats, and manages liver, gallbladder, biliary tract, and pancreas disorders, promoting liver health and overall digestive wellness.', NULL, 0, '1756018831.png', 1, 1, 1, 1, '2023-03-22 04:07:52', '2025-08-24 01:00:31'),
(9, 'Neurology', NULL, 'A Neurology Specialist is a doctor who diagnoses, treats, and manages disorders of the brain, spinal cord, nerves, and muscles, helping patients maintain optimal nervous system health.', NULL, 0, '1756018941.png', 1, 1, 1, 1, '2023-03-22 04:10:11', '2025-08-24 01:02:21'),
(14, 'Paralysis', NULL, 'A Paralysis Specialist is a medical professional who diagnoses, treats, and manages conditions causing partial or complete loss of muscle function, helping patients regain mobility and improve quality of life.', NULL, 0, '1756018957.png', 1, 1, 1, 1, '2023-03-22 04:26:59', '2025-08-24 01:02:37'),
(18, 'Pulmonology', NULL, 'A Pulmonology Specialist is a doctor who diagnoses, treats, and manages lung and respiratory system disorders, helping patients improve breathing and maintain optimal lung health.', NULL, 0, '1756018743.png', 1, 1, 1, 1, '2023-03-22 04:41:09', '2025-08-24 00:59:03'),
(19, 'Gastroenterology', NULL, 'A Gastroenterology Specialist is a doctor who diagnoses, treats, and manages disorders of the digestive system, including the stomach, intestines, liver, pancreas, and gallbladder, ensuring digestive health.', NULL, 0, '1756018601.png', 1, 1, 1, 1, '2023-03-22 04:43:35', '2025-08-24 00:56:41');

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
(7, 'Category-1', 1, 1, 1, '2023-01-27 23:32:20', '2023-03-07 05:36:08'),
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
(54, 9, 'Sarcoidosis of the Breast: A Rare Case Report', '<p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Zachery Lerch, BS</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">• OluwatunmikeOgedengbe, BA</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">•Nicole D. Serrant, MPH</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Courtney Short, BS</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1 </span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">• Shazia Zafar, MD</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">2</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Syed M Imam, DO</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">3</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Sultan S. Ahmed, MD</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Syed A. A. Rizvi, MD, PhD, MPH, MBA</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span></p><p><b style=\"font-weight:normal;\" id=\"docs-internal-guid-cd09c245-7fff-0b69-e061-28490e1edb52\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Ross University School of Medicine, Bridgetown, Barbados.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">2</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Southwest Florida Cancer Care, Pembroke Pines, FL, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">3</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">HCA Northside Hospital, USF Morsani College of Medicine, St Petersburg, Florida, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">College of Biomedical Sciences, Larkin University, Miami, Florida, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p><b style=\"font-weight:normal;\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Abstract</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><br></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Arial; font-size: 12pt; white-space: pre-wrap; text-indent: 36pt;\">Sarcoidosis is a chronic multisystemic inflammatory disease with an unknown etiology that is characterized by noncaseating granulomas in multiple organ symptoms. It is a rare disease with a US prevalence of 1 to 40 per 100,000 and an estimated worldwide prevalence of 50 to 160 per 100,000 people. Among these cases, it is commonly found in young to middle-aged women, especially those of African American or Northern European descent. Sarcoidosis primarily manifests in the lungs, representing 90% of the total number of cases. Isolated extrapulmonary manifestations represent 10% of all total cases and occur in the lymph nodes, spleen, liver, and skin in order of decreasing occurrence. Of that 10%, isolated sarcoidosis of the breast represents less than 1% of all cases. The diagnosis of sarcoidosis traditionally relies on three criteria to make a clinical diagnosis, such as suspicion based on imaging such as elevated angiotensin-converting enzyme (ACE) levels and bilateral hilar adenopathy on chest radiography, noncaseating granulomas on biopsy of the nodule, and the exclusion of all possible diseases like fungal diseases or tuberculosis. However, in the case of breast sarcoidosis, which typically presents as a breast nodule, the diagnosis would follow the algorithm for breast lesions starting with a mammogram or ultrasound. However, irregular, or ill-defined spiculated masses on mammography, as well as a hypoechoic nodule on ultrasound, cannot rule out malignancy or benign conditions such as cysts or fibroadenomas. MRI has been found to be ineffective in providing a more definitive diagnosis. A biopsy showing noncaseating granuloma is necessary to lead towards sarcoidosis, but diseases showing similar histology in the breast such as tuberculosis are necessary to rule out before diagnosing breast sarcoidosis, just as in the criteria for pulmonary sarcoidosis.The treatment for sarcoidosis is case dependent, however the use of corticosteroid is common for significantly symptomatic patientspresenting with pulmonary or serious extrapulmonary disease. Some complex cases may require immunosuppressive medication. In some cases where pharmacotherapy fails or does not stop the disease progression, it can lead to severe complications leading to heart or lung transplantation. Our patient is a female of 32 years of age, has been suffering from multiple bilateral breast lumps with tenderness, erythema, and occasional exudative discharge from lesions for some time. She was without respiratory complaints such as shortness of breath or cough, denies family history of breast cancer and trauma. Diagnostic mammography and ultrasound revealed 1.2 cm irregular hypoechoic and 2.0cm mass in the left breast. Ultrasound guided biopsy then revealed fibro-adipose tissue with stromal fibrosis associated with chronic inflammatory infiltrate without any no glandular elements. Chest x-ray and CT of lungs were not performed due to lack of pulmonary complaint and findings. She was found to positive for ACE gene deletion variant detected by PCR. A diagnosis of breast sarcoidosis is made, and patient has been referred to an oncologist for further evaluation and management.&nbsp;</span></p><p><b style=\"font-weight:normal;\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: italic; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Keywords: </span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Sarcoidosis,inflammatory disease,&nbsp;</span></p><p><b style=\"font-weight:normal;\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Introduction</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Arial; font-size: 12pt; white-space: pre-wrap; text-indent: 36pt;\">Sarcoidosis is a disorder potentially involving multiple systems and characterized by a non-caseating granulomatous inflammation. Due to the variety of organs that may be involved, there are a multitude of symptoms that can occur. However, patients will have pulmonary involvement 95% of the time opposed having cutaneous involvement 15.9% of the time and lymph node involvement 15.2% of the time [1]. Patients will therefore most commonly present with respiratory symptoms such as dyspnea, cough and chest pain as well as weight loss, a fever and general malaise. When there is lung involvement, it typically will present as a diffuse interstitial lung disease, unfortunately with non-specific symptoms that are generally not helpful for diagnosis [2].&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">It should be noted that approximately one half of patients are diagnosed incidentally via chest radiograph indicating reticular opacities and bilateral hilar adenopathy that result in further evaluation of the patient. Regarding choices of imaging, a chest radiograph remains the best first test for a patient with suspected sarcoidosis, however it is not diagnostic. When radiographic findings are present, it is reasonable to send the patient for laboratory testing to further support a diagnosis [3]. Laboratory testing will reveal inflammatory markers for those who are experiencing acute sarcoidosis and elevated calcium, ACE, Alkaline phosphatase and decreased CD4+ T-Cells for those with chronic sarcoidosis [4]. Of note, ACE can be elevated in most patients with untreated sarcoidosis, however it has poor sensitivity and specificity therefore is not usable for diagnosis, determination of disease progression or to prove efficacy of treatment [5].&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">While laboratory testing serves to narrow your differentials, biopsy of the lung tissue and lymph nodes remains the gold standard for diagnosis to this day.&nbsp; Biopsy is typically taken from the most easily accessible lesion and will show noncaseating granulomas under histopathologic analysis. Upon diagnosis, patients should be evaluated for extent of disease involvement in additional organs. Notably, all newly diagnosed patients should have an ECG performed to assess for cardiac sarcoidosis. In addition to being the best initial imaging, chest radiographs are also useful for determining lung involvement which are broken into different Stages I-IV. Bilateral hilar adenopathy alone is characteristic of Stage I, addition of parenchymal involvement indicates Stage II. Parenchymal involvement without lymphadenopathy indicates Stage III. Finally, Stage IV is characterized by fibrosis which can progress in severity eventually leading to pulmonary hypertension in advanced disease, at this point patients may often require supplemental oxygen. It should be noted that radiographic staging does not serve as a marker of disease severity, instead serving as an indicator of anatomic involvement [6, 7].&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">When considering management options for newly diagnosed patients, it is important to know the indicators for observation versus initiating the mainstay of treatment: glucocorticoids [7]. While radiographic staging doesn’t indicate disease severity, it can be utilized when determining when to start therapy. Asymptomatic patients with Stage I and II can be observed without therapeutic intervention as 60-80% of Stage I patients will have spontaneous remission and approximately 50% of Stage II patients will have radiographic resolution without treatment. Stage III patients should be closely observed without therapy, however 66% of these patients will eventually require some sort of medical intervention. As mentioned above, glucocorticoid therapy is the first line treatment of sarcoidosis. The exact mechanism is unknown;however, it is thought to play a role in decreasing the drivers of immune responses responsible for granuloma formation and eventual fibrosis. Indications to start glucocorticoids are concerning respiratory symptoms, decreased pulmonary function, pulmonary hypertension, and Stage IV radiographic changes (cavity formation, fibrosis with honeycombing) [7, 8]. Dosing can vary;however, it is generally recommended to start therapy at 0.3-0.6 mg/kg of the patients ideal body weight, maintaining this dose for 4-6 weeks then re-assessing. Improvement of radiographic changes and pulmonary function can serve as an indicator to begin the tapering schedule which typically occurs in decrements of 5-10 mg every 4-12 weeks down to 10-15 mg daily. Maintenance therapy at this point should be carefully considered due to well-known adverse effects of long-term glucocorticoid therapy and the lack of formal evidence indicating its benefit [9, 10].&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Case Presentation</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Arial; font-size: 12pt; white-space: pre-wrap; text-indent: 36pt;\">Patient is a 32-year-old female patient with a past medical history significant only for hypothyroidism who was seen in clinic with a complaint of a 2-year history of left breast inflammation and pain in the upper outer breast with a mass. Notably, she has no family history of malignancy and had previously been evaluated for left breast pain at the onset of the pain and subsequently underwent imaging and biopsy which revealed a neutrophilic cystic granulomatous mastitis. She was then referred to an infectious disease specialist but stated that she was unable to make an appointment due to the ongoing COVID-19 pandemic. She was seen two years later by breast and infectious disease specialists due to continued left breast pain and open skin lesions. She was instructed to follow closely, and that treatment wasn’t necessary unless there was malodorous discharge.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Her vital signs were within normal limits with weight of 197 pounds, BMI of 37.6, blood pressure of 125/75, pulse of 80, temperature of 96.8F, respiratory rate of 16 bpm, height of 61 inches. On examination, there was a movable mass palpated in the left breast, diagnostic mammography and ultrasound were ordered.Additionally, she was without systemic signs of infection or malignancy, being afebrile with no weight loss, general malaise or clubbing of the fingers. Her lung examination revealed the following: normal bilateral breath sounds upon auscultation, no respiratory distress, normal percussion, normal tactile fremitus.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">On examination, there are, multiple moveable superficial masses noticed. Some of them are brownish-black and others were erythematous. There was exudative fluid noticed from the mass, with a serosanguinous fluid upon visual examination.There was no lymphadenopathy, nipple retraction, skin dimpling.The results of the imaging showed a 1.2 cm irregular hypoechoic as well as a 2.0cmmass in the left breast. Ultrasound guided biopsy then revealed fibro-adipose tissue with stromal fibrosis associated with chronic inflammatory infiltrate, of note, there were no glandular elements represented in the biopsy. Of note, chest x-ray and CT of lungs were not performed due to lack of pulmonary findings that indicated lung involvement.</span></p><p></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">A CMP was then ordered which revealed cholesterol 226 mg/dL, HDL 56 mg/dL, Triglyceride 112 mg/dL, LDL 147 mg/dL, Sodium 138 mmol/L, Potassium 3.9 mmol/L, Chloride 102 mmol/L, Calcium 9.2 mmol/L Glucose 88 mg/dL, BUN 11 mg/dL, Creatinine 0.76 mg/dL and TSH 3.25 mIU/L. Hemoglobin 10.8 g/dL, Hematocrit 35.6%, MCV 77.4 fL, Platelet 262 thousand/uL, and </span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(255, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">ACE ???</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">. She was found to bepositive for ACE gene deletion variant detected by PCR.&nbsp;&nbsp;</span><img src=\"http://journal.test/storage/media_images/230128063151.png\" style=\"text-indent: 36pt; font-size: 1rem; width: 100%;\"></p><div><span style=\"font-family: Arial;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"color: rgb(255, 0, 0); font-family: Arial; font-size: 16px; font-weight: 700; text-align: justify; white-space: pre-wrap;\">(A) </span></div><div><img src=\"http://journal.test/storage/media_images/230128063155.png\" style=\"width: 100%;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></div><div><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span id=\"docs-internal-guid-bdede827-7fff-b5f6-a03f-05b3ee3a2a0b\"><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\">   </span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span><span style=\"font-family: Arial;\">                                       </span></span><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\">(B)</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\" id=\"docs-internal-guid-b3b8becd-7fff-19b9-a305-60619bef8867\"><span style=\"font-size: 12pt; background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\">Figure 1. (A) </span><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\">Please write down description.</span><span style=\"font-size: 12pt; background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\"> (B)</span><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; font-family: Arial;\">Please write down description of the mammogram, where is the lesion? Please feel free to add any relevant imaging or histology image with description.</span></span></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\" id=\"docs-internal-guid-b3b8becd-7fff-19b9-a305-60619bef8867\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><br></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Discussion</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The patient’s bilateral erythematous, tender breast lumps, with erythema and exudative discharge from her breast lesions on further investigation, match the diagnosis of sarcoidosis of the breast.The 32-year-old female patient is in the relevant age and gender group for sarcoidosis but given that the patient’s symptoms and the imaging showing hypoechoic masses on ultrasound suggested a benign disease such as mastitis with the risk of malignancy, further investigation was necessary [11]. The ACE gene polymorphism, specifically a gene deletion, leads us to believe that sarcoidosis of the breast is the most likely diagnosis. ACE gene polymorphism indicates a deletion is associated with elevated ACE levels, which are commonly found with sarcoidosis, but neither elevated ACE levels nor the polymorphism are specific enough for a diagnosis of sarcoidosis [12]. Given the patient\'s lack of pulmonary symptoms such as coughing or shortness of breath, it is unlikely to be an extension of pulmonary sarcoidosis.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">While sarcoidosis is a disease found across the world and in all populations, studies have found that certain groups of people along racial, ethnic, and gender lines are more affected than others. Focusing on the most recent studies across the world from 2015 to 2017, Northern Europeans and African Americans tend to have a higher incidence and prevalence of sarcoidosis compared to other ethnic and racial groups, and the age of disease onset is close to 30 to 50 years old [12-17]. While incidence and prevalence are variable among the sexes, women are more likely to have the disease than men, and while there are certain nuances and limitations within the reported data, the general trends in current data are significant enough to warrant further study.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Observations of the African American and North European prevalence of sarcoidosis have been made through several recent studies. Using the Optum Health care database for US (United States) data, African Americans had a larger incidence and prevalence compared to Caucasians, the second largest, with Hispanics and Asians having the lowest prevalence and incidence [14]. Further into the data, not only are African Americans are found to have a higher incidence, but African American women also have the highest sarcoidosis prevalence compared to men or women of any race [14]. Moving outside of the US for rates of people with African ancestry, the French study focusing on hospitals in a multicultural Seine-Saint-Denise country showed Afro-Caribbeans had a higher incidence of sarcoidosis of 16.9 per 100,000 per year, similar but less than 17.8 per 100,000 per year in the US study, than North Africans of 9.7 per 100,000 per year [14, 16]</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">When comparing diverse groups of Europeans in terms of sarcoidosis prevalence and incidence, Sweden’s study using a nationwide population database showed 11.5 per 100,000 per year and a prevalence of 0.16%, showing a greater prevalence than Italy\'s study which had a prevalence of.005%, and Europeans in France which showed an incidence of 2.4 per 100,000 per year [12,16]. However, in the French study, it is not clear whether the Europeans are all French or not [16]. Despite the limitations of the numerous studies for sarcoidosis epidemiology, such as using a health company\'s limited database for the US population instead of a more generalized sampling of the population, and missing data on sarcoidosis in African, Hispanic, Asian, and Middle Eastern countries, it is a good overview of current general trends.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Based on sex and age in sarcoidosis epidemiology, the studies tend to be inconsistent with recent tend to show women having a higher prevalence and incidence than men in France, Italy, and Taiwan, but the study in Sweden showed men having a greater incidence of sarcoidosis [12, 15,16, 17). In terms of age at diagnosis, the average age of diagnosis in most studies was between 47 and 51 years old [13]. However, there tends to be an age gap between the age of onset of sarcoidosis among the sexes, with women being younger than men. The greatest gap in the current data on the age of onset of sarcoidosis was seen in Sweden\'s study which showed the onset on average was 45 years old in men and 54 years old in women, a more than 10-year difference [12]. More studies with a wide population sampling may be needed to see the full trend among the different sexes and ages across the world, but age at disease onset appears to trend around a distinct time within the 5th and 6th decade.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Despite incidence of sarcoidosis on sex is not as consistent as the racial or age trends around the world, current epidemiology studies on sarcoidosis show specific trends such as Northern Europeans and African Americans having the greatest incidence and prevalence, age of onset on average being between 40-50 years old with women tending to be younger than men. Even though the general trends are important for evaluating elevated risk groups, the shortcomings of how the studies were done, a specific hospital or insured population rather than the general population being studied, and certain races, ethnic groups being excluded should be investigated in the future to see how the trend changes with more information.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\" id=\"docs-internal-guid-b3b8becd-7fff-19b9-a305-60619bef8867\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\" id=\"docs-internal-guid-bad08ab4-7fff-7158-fe61-8b454405707f\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Conclusion</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Given the rarity of the finding a primary sarcoidosis manifesting in breast first, it may be misdiagnosed as a malignancy. The purpose of this study is to present the the case of a women where the first clinical manifestation of sarcoidosis occurred in the breast.The patient is currently at the diagnostic stage, with specialists on board throughout the treatment….</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">References</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[1]     </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Baughman RP, Teirstein AS, Judson MA, et al. Clinical characteristics of patients in a case control study of sarcoidosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Am J Respir Crit Care Med</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2001, 164(10 Pt 1), 1885-1889. doi:10.1164/ajrccm.164.10.2104046.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[2]     </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Sawahata M, Sugiyama Y, Nakamura Y, et al. Age-related and historical changes in the clinical characteristics of sarcoidosis in Japan. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Respir Med</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2015, 109(2), 272-278. doi:10.1016/j.rmed.2014.12.012.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[3]    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Sawahata M, Yamaguchi T. Imaging Findings of Fibrosis in Pulmonary Sarcoidosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Sarcoidosis Vasc Diffuse Lung Dis</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2022, 39(2), e2022018.doi:10.36141/svdld.v39i2.12995.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[4]    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Selroos OB. Biochemical markers in sarcoidosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Crit Rev Clin Lab Sci</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 1986, 24(3), 185-216. doi:10.3109/10408368609110273.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[5]   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Baudin B. Angiotensin I-converting enzyme (ACE) for sarcoidosis diagnosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pathol Biol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2005, 53(3), 183-188. doi:10.1016/j.patbio.2004.09.003.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[6]      </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Wessendorf TE, Bonella F, Costabel U. Diagnosis of Sarcoidosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Clin Rev Allergy Immunol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2015, 49(1), 54-62. doi: 10.1007/s12016-015-8475-x.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[7]     </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ungprasert P, Ryu JH, Matteson EL. Clinical Manifestations, Diagnosis, and Treatment of Sarcoidosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Mayo Clin Proc Innov Qual Outcomes</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2019, 3(3):358-375. doi: 10.1016/j.mayocpiqo.2019.04.006.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[8]     </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Brito-Zerón P, Pérez-Alvarez R, Pallarés L, et al. Sarcoidosis: an update on current pharmacotherapy options and future directions. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Expert OpinPharmacother</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2016, 17(18), 2431-2448. doi:10.1080/14656566.2016.1258061</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[9]     </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Baughman RP, Valeyre D, Korsten P, et al. ERS clinical practice guidelines on treatment of sarcoidosis. Eur Respir J. 2021;58(6):2004079. Published 2021 Dec 16. doi:10.1183/13993003.04079-2020.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[10]   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Judson MA. The treatment of sarcoidosis: translating the European respiratory guidelines into clinical practice. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">CurrOpinPulm Med</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2022, 28(5), 451-460. doi:10.1097/MCP.0000000000000896.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[11]    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Kim YR, Kim HS, Kim HW. Are Irregular Hypoechoic Breast Masses on Ultrasound Always Malignancies?: A Pictorial Essay. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Korean J Radiol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2015, 16(6):1266-75. doi: 10.3348/kjr.2015.16.6.1266.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[12]   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arkema EV, Grunewald J, Kullberg S, Eklund A, Askling J. Sarcoidosis incidence and prevalence: a nationwide register-based assessment in Sweden. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Eur Respir J</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2016, 48(6):1690-1699. doi: 10.1183/13993003.00477-2016.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[13]   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arkema EV, Cozier YC. Epidemiology of sarcoidosis: current findings and future directions. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ther Adv Chronic Dis</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2018 Aug 24, 9(11), 227-240. doi: 10.1177/2040622318790197.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[14]  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Baughman RP, Field S, Costabel U, Crystal RG, Culver DA, Drent M, Judson MA, Wolff G. Sarcoidosis in America. Analysis Based on Health Care Use. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ann Am Thorac Soc</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2016, 13(8):1244-52. doi: 10.1513/AnnalsATS.201511-760OC.</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[15]    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Beghè D, Dall\'Asta L, Garavelli C, Pastorelli AA, Muscarella M, Saccani G, Aiello M, Crisafulli E, Corradi M, Stacchini P, Chetta A, Bertorelli G. Sarcoidosis in an Italian province. Prevalence and environmental risk factors. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">PLoS One</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2017, 12(5):e0176859. doi: 10.1371/journal.pone.0176859.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><b style=\"font-weight:normal;\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">[16]    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Duchemann B, Annesi-Maesano I, Jacobe de Naurois C, Sanyal S, Brillet PY, Brauner M, Kambouchner M, Huynh S, Naccache JM, Borie R, Piquet J, Mekinian A, Virally J, Uzunhan Y, Cadranel J, Crestani B, Fain O, Lhote F, Dhote R, Saidenberg-Kermanac\'h N, Rosental PA, Valeyre D, Nunes H. Prevalence and incidence of interstitial lung diseases in a multi-ethnic county of Greater Paris. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Eur Respir J</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, 2017, 50(2):1602419. doi: 10.1183/13993003.02419-2016.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span id=\"docs-internal-guid-fa119edb-7fff-18cb-e837-39eb8f6efe69\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">[17]   </span><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">Wu CH, Chung PI, Wu CY, Chen YT, Chiu YW, Chang YT, Liu HN.  Comorbid autoimmune diseases in patients with sarcoidosis: A nationwide case-control study in Taiwan. </span><span style=\"font-size: 12pt; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">J Dermatol</span><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">, 2017, 44(4):423-430. doi: 10.1111/1346-8138.13654.</span></span><br></span></p><p dir=\"ltr\" style=\"line-height:1.7999999999999998;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><span style=\"font-weight:normal;\"><span style=\"font-size: 12pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><br><br></span></span><br></span></p><div><span style=\"font-size: 12pt; color: rgb(255, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\"><br></span></div></span></span></div>', 'Sarcoidosis is a chronic multisystemic inflammatory disease with an unknown etiology that is characterized by noncaseating granulomas in multiple organ symptoms. It is a rare disease with a US prevalence of 1 to 40 per 100,000 and an estimated worldwide prevalence of 50 to 160 per 100,000 people. Among these cases, it is commonly found in young to middle-aged women, especially those of African American or Northern European descent.', NULL, '230216093708.png', 1, 1, 'published', 1, 63, 1, 1, '2023-01-28 00:37:55', '2025-08-24 02:48:39');
INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `description`, `excerpt`, `tags`, `feature_image`, `active`, `editor`, `status`, `featured_slider`, `view_count`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(57, 10, 'Familial Neurofibromatosis Type I (von Recklinghausen\'s disease)', '<p dir=\"ltr\" style=\"line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">AUTHORS:</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Sultan S. Ahmed, MD</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Syed A. A. Rizvi, MD, PhD, MPH, MBA</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Jose Mendez, DO</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">2</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Neda Imam, MD, MBA</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">3</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">• Chloe Addison, MS</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Nicole D. Serrant, MPH</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> • Courtney Short, BS</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">• Zoya H. Rizvi</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">5</span></span></p><p><b style=\"font-weight:normal;\" id=\"docs-internal-guid-7024523b-7fff-31a7-5c01-3529160a89a5\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">AFFILIATIONS:</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">College of Biomedical Sciences, Larkin University, Miami, Florida, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">2</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Fort Lauderdale, Florida, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">3</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Northwestern Medicine Huntley Hospital, Huntley, Illinois, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Ross University School of Medicine, Bridgetown, Barbados.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">5</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Adlai E. Stevenson High School, Lincolnshire, Illinois, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">A 20-year-old female patient born in Miami, Florida with no past medical history and no medication use, presented to our clinic with c/o non -specific lower back, that has been going on past few. Upon examining her back, multiple hyperpigmented cafe-au-lait spots wi</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">th some pedunculated lesions were noted. The patient stated that she was born with multiple abnormal skin lesions all over her body. She is a nonsmoker without any organic symptomatology. The patient denied shortness of breath, chest pain, or abdominal pain at this time. Her mother, a 58-year-old femalewho accompanied the patient, also stated that shehas a similar skin presentation.</span></p><p><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></p><p><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">Physical examination.</span><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"> Vital signs: blood pressure, 118/75 mm Hg; pulse, 76 beats/min; respiratory rate, 16 breaths/min; height, 162.5 cm; weight, 52.7 kg; temperature, 37.9°C; and oxygen saturation, 98% on room air. During examinations of both eyes, the patient had multiple hypo-pigmented elevated lesions in her iris suggestive of Lisch nodules. Her visual acuity was 20/20 in both eyes. Examination of the face showed no visible craniofacial abnormalities. She had an oral neurofibroma with mild gingival hyperplasia and multiple dental caries in her molars. Dermatological examination showed multiple non-painful cutaneous</span><span style=\"text-align: justify; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"> lesions with s</span><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">mooth bordered café-au-lait macules on her back and lower extremities. She also presented with an elevated hairy rubber-like pigmented lesion suggesting a plexiform neurofibroma in her right lumbar and abdominal region. </span><span style=\"text-align: justify; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">The patient had inguinal and axillary freckling consistent with Crowe sign.</span><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"> The patient’s mother had similar skin neurofibromas which we were able to compare with patient’s presentation during the examination. The patient had no dyspnea, no evidence of cyanosis, and no neurological focal signs. Patient’s mother is also without neurological deficit. For our patient, due to non-specific back pain, she was advised to have anMRI of the lower lumbar region and anti-inflammatorymedication was prescribed to address the pain.</span></p><p><img src=\"http://journal.test/storage/media_images/230128055409.png\" style=\"width: 100%;\"><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 10pt; font-style: italic; font-weight: 700; white-space: pre-wrap;\">Figure 1</span></p><p><img src=\"http://journal.test/storage/media_images/230128055428.png\" style=\"width: 100%;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.3333px; font-style: italic; font-weight: 700; white-space: pre-wrap;\">Figure 2</span></p><p><img src=\"http://journal.test/storage/media_images/230128055434.jpg\" style=\"width: 100%;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.3333px; font-style: italic; font-weight: 700; white-space: pre-wrap;\"><br></span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: 13.3333px; font-style: italic; font-weight: 700; white-space: pre-wrap;\">Figure 3</span></p><p><img src=\"http://journal.test/storage/media_images/230128055416.jpg\" style=\"width: 100%;\"><span style=\"text-align: justify; background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.3333px; font-style: italic; font-weight: 700; white-space: pre-wrap;\">Figure 4</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Discussion.</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> In 1768, a strange case was documented and published describing a boy with several skin neurofibromas, small nerve tumors that form soft bumps under the skin. It was found that the boy’s father presented with similar symptoms, leading scientists to the conclusion that this new disease may be genetically inherited. However, more evidence and cases were needed in order to study the condition in more detail.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">The first scientific description of the disease was published by Dr. Mark Akenside</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">. A German pathologist, </span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Dr. Friedrich von Recklinghausen actually coined the name of the disease and was acknowledged as the one who discovered it later in 1882.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:#ffffff;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">2,3</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> Dr. Von Recklinghausen characterized the disease by a phenomenon of light brown spots on the skin that was likened to a warm cup of café-au-lait.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> These spots</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> tend to be concentrated in the groin and underarm areas of the body, this particular presentation is called Crowe sign</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">. Recklinghausen, as well as scientists Riccardi and Kleiner, worked to better classify the disease by grouping symptoms and their intensities. Three forms of this disease, Neurofibromatosis (NF), were distinguished at the time: NF 1, NF 2, and Schwannomatosis.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Neurofibromatosis type 1 (NF1), also known as Von Recklinghausen\'s disease (NFvR), is an autosomal dominant genetic disorder. It is the most common type of NF and accounts for about 90% of all cases. NF1 is a rare disorder that affects males and females equally as well as all races and ethnic groups.It has an incidence of approximately 1:2,600 to 1:3,000 individuals. Half of the NF1 cases are familia</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">l,</span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> while de novo mutations occur primarily in paternally derived chromosomes.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">5,6</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> There is 100% penetrance with variable expressivity. Manifestations range from mild lesions to several complications and functional impairment. Interestingly in our case, both patient and her mother showed no signs of neurological deficit until now. Oral manifestations can be found in 72% of NF1 patients. The prevalence is estimated at 1:36,000 to 1:40,000.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">7</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> In the United States, the mean age at death for persons with NF1 is 54.4 years, and median of 59 years.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">8</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Lisch nodules are small pigmented lesions found in the iris (iris hamartomas) mostly seen in adult patients, is a specific characteristic of NF1 and helps in diagnosis.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">9</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Neurofibromatosis type 2 (NF2) makes up about 3% of all cases and has a prevalence between 1:33,000 births and 1:87,410. Similar to NF1, there is no gender or race predilection. </span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">NF2 has variable presentations amongst different families. A more severe clinical presentation is associated with a frameshift or </span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">nonsense mutation that results in a truncated protein. Patients with NF2 are more likely to present with bilateral vestibular schwannomas, juvenile cataracts, meningiomas, or ependymomas. The third type of NF called Schwannomatosis is the rarest form of NF with its prevalence being mostly half that of the NF2 cases at 1 in 126,000 with unknown predilection of sex, race or ethnicity.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">10</span></span><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> Its presentation develops mostly in adulthood with an average diagnosis age being 40 years old. Different form NF2 with vestibular schwannomas, Schanomatisis has multiple schwannomas without vestibular involvement.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">4</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space:pre;\">	</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">NFvR occurs due to mutations found in Chromosome 17 (17qll.2). The mutations found in the NF gene contain insertions, deletions, splice mutations, amino acid changes, and chromosomic rearrangements. With alternative splicing, this gene can produce multiple mRNA outcomes. One of the more common transcripts is 13kb, which codes for a protein known as neurofibrin. Neurofibrin has many different functions. Arguably, one of the more important ones is inactivating the Ras protein that controls cellular growth and multiplication. If there is a mutation in the transcript 13kb that causes a decrease in the production of neurofibrin, cellular proliferation will not be controlled and can drive tumor development.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">1</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> This puts patients with NFvR at risk for developing cancer.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">11</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">This is a similar situation to another tumor suppressor gene called MLL4 that helps regulate differentiation and tumor suppression through ferroptosis. Ferroptosis is a type of programmed cell death that is dependent on the presence of iron. A scientific study found that this gene’s role in tumor suppression contributes to the skin’s homeostasis. In fact, this gene is mutated very frequently across all human cancers.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">12</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> Both the NF gene and MLL4 gene are tumor suppressor genes that help regulate cellular proliferation in the epidermis.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">13</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Solitary neurofibromas are benign and not associated with any systemic complications. The risk of transformation of solitary dermal neurofibromas into malignant peripheral nerve sheath tumors is exceedingly rare. Plexiform neurofibromas are most commonly seen in NF1. Plexiform neurofibromas can infiltrate surrounding tissues and impinge on vital structures. Neurological or functional impairment may occur. They also carry a risk for malignant transformation into a malignant peripheral nerve sheath tumor (MPNST). The exact incidence of malignancy is unknown but is estimated to be between 7 and 13%. Rapid growth or unrelenting pain in an otherwise stable plexiform neurofibroma are signs of malignant transformation. Malignant peripheral nerve sheath tumors (MPNSTs) frequently metastasize, and the outcome is poor.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">14</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Diagnosis of NFvR is based on the presence of at least 2 of the 7 following criteria: six or more cafe-au-lait macules over 5mm, freckling over the axillary and inguinal area, Lisch nodules over the iris, two or more neurofibroma or one plexiform neurofibroma, sphenoid dysplasia, optic glioma and a first-degree relative with NF-1.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">15</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> Skin biopsy and clinical signs help establish the diagnosis. If a skin nodule biopsy is performed, the expected findings would show the presence of hypocellular spindle-shaped cells, shredded carrot collagen, mast cells, and hypocellular myxoid areas without hypercellular areas.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">16</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> Immunocytochemistry markers for the differential diagnosis of neurofibroma would show positivity for calretinin, S100 protein, and a stronger association for CD34, which is highly sensitive (p&lt;0.001).</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">17</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Molecular genetic testing is often recommended to confirm NF1, especially in children displaying only pigmentary features. NF1 causes significantly increased malignancy risks compared with the general population. Specifically, NF1 is associated with highly elevated risks of rhabdomyosarcoma, juvenile myelomonocytic leukemia, noninvasive pilocytic astrocytoma, malignant peripheral nerve sheath tumor, and optic pathway glioma (OPG). Clinical assessment for OPG is advised every 6 to 12 months up until 8 years of age. Routine MRI assessment is not currently advised in asymptomatic individuals with no signs of visual pathway disturbances. Surveillance for other malignancies is not recommended, however, clinicians and parents should be aware of the small risks of certain specific malignancies. Since tumors do contribute to both morbidity and mortality, a single whole-body MRI should be considered to assist in determining approaches to long-term follow-up.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">10</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The treatment for NF1 varies based on the patient\'s symptoms and presentation. Minimization of radiation treatment is important in patients with NF1 and central nervous system (CNS) tumors because of concerns about secondary CNS malignancies and vascular complications. Cutaneous and subcutaneous neurofibromas are not removed due to the increased risk of scarring or recurrence. If the patient experiences disfigurement or unmanageable bleeding and pain, removal is indicated. Various options for removal are surgery, laser, or electrodesiccation. Some patients experience pruritus that typically does not respond to antihistamine treatment but improves with medications used to treat neuropathic pain, such as gabapentin.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">18</span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Plexiform Neurofibromas (PN) involve multiple nerve fascicles with serpiginous growth and significant vascularity. PNs can undergo malignant transformation to MPNSTs. Surgical treatment and pain management of PNs can be challenging depending on the location especially when there is progressive growth along the spinal column. For inoperable and symptomatic tumors Selumetinib, an oral selective mitogen-activated protein kinase (MEK) inhibitor, can induce tumor regression.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">19</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Selumetinib was approved for the treatment of pediatric patients in April 2020. The clinical trial resulted in a ≥20 percent decrease in tumor volume from baseline for at least four weeks in 70% of the patients. The mean tumor-related pain intensity scores decreased by two points after one year of treatment. Approximately 50% of patients experienced improvements in quality of life.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">18</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"> In addition, genetic counseling should be provided for patients and families. Prenatal or preimplantation testing should include information on the inheritance of the disorder, prognosis, and psychosocial adjustment.&nbsp;</span></p><p><b style=\"font-weight:normal;\" id=\"docs-internal-guid-5c031516-7fff-4bfb-cbdd-970dbe14b721\"><br><br></b></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">REFERENCES:</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1. &nbsp; &nbsp; </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Boyd KP, Korf BR, Theos A. Neurofibromatosis type 1. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">J Am Acad Dermatol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2009;61(1):1-16. doi:10.1016/j.jaad.2008.12.051.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2. &nbsp; &nbsp; </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Brosius S. A history of von Recklinghausen\'s NF1. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">J Hist Neurosci</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2010;19(4):333-348. doi:10.1080/09647041003642885.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3. &nbsp; &nbsp; </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ruggieri M, Praticò AD, Caltabiano R, Polizzi A. Early history of the different forms of neurofibromatosis from ancient Egypt to the British Empire and beyond: First descriptions, medical curiosities, misconceptions, landmarks, and the persons behind the syndromes. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Am J Med Genet A</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2018;176(3):515-550. doi:10.1002/ajmg.a.38486.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">4. &nbsp; &nbsp;  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Tamura R. Current Understanding of Neurofibromatosis Type 1, 2, and Schwannomatosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Int J Mol Sci</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2021;22(11):5850. doi:10.3390/ijms22115850.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">5. &nbsp; &nbsp;  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Evans DG, Howard E, Giblin C, et al. Birth incidence and prevalence of tumor-prone syndromes: estimates from a UK family genetic register service. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Am J Med Genet A</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2010;152A(2):327-332. doi:10.1002/ajmg.a.33139.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">6. &nbsp; &nbsp;</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Stephens K, Kayes L, Riccardi VM, Rising M, Sybert VP, Pagon RA. Preferential mutation of the neurofibromatosis type 1 gene in paternally derived chromosomes. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Hum Genet</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 1992;88(3):279-282. doi:10.1007/BF00197259.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7. &nbsp; &nbsp;</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Ruggieri M, Huson SM. The clinical and diagnostic implications of mosaicism in the neurofibromatoses. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Neurology</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2001;56(11):1433-1443. doi:10.1212/wnl.56.11.1433.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">8. &nbsp; &nbsp;   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Rasmussen SA, Yang Q, Friedman JM. Mortality in neurofibromatosis 1: an analysis using U.S. death certificates. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Am J Hum Genet</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2001;68(5):1110-1118. doi:10.1086/320121.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">9.</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space:pre;\">	</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Abaloun Y, Ajhoun Y. Nodules de lisch dans la neurofibromatose type 1 [Lisch nodule in neurofibromatosis type 1]. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Pan Afr Med J</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2017;27:218.doi:10.11604/pamj.2017.27.218.11517.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">10. &nbsp; &nbsp;</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Korf BR, Lobbous M, Metrock LK. Neurofibromatosis type 1 (NF1): Pathogenesis, clinical features, and diagnosis. Updated Apr 26, 2022. Accessed August 14, 2022.</span><a href=\"https://www.uptodate.com/contents/neurofibromatosis-type-1-nf1-pathogenesis-clinical-features-and-diagnosis\" style=\"text-decoration:none;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#0563c1;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:underline;-webkit-text-decoration-skip:none;text-decoration-skip-ink:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">https://www.uptodate.com/contents/neurofibromatosis-type-1-nf1-pathogenesis-clinical-features-and-diagnosis</span></a></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">11. &nbsp;   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Landry JP, Schertz KL, Chiang YJ, et al. Comparison of Cancer Prevalence in Patients With Neurofibromatosis Type 1 at an Academic Cancer Center vs in the General Population From 1985 to 2020. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">JAMA Netw Open</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2021;4(3):e210945. doi:10.1001/jamanetworkopen.2021.0945.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">12. &nbsp;  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Egolf S, Zou J, Anderson A, et al. MLL4 mediates differentiation and tumor suppression through ferroptosis. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Sci Adv</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2021;7(50):eabj9141. doi:10.1126/sciadv.abj9141.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">13. &nbsp; </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Bergoug M, Doudeau M, Godin F, Mosrin C, Vallée B, Bénédetti H. Neurofibromin Structure, Functions and Regulation. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Cells</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2020;9(11):2365. doi:10.3390/cells9112365.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">14. &nbsp;   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Gnepp DR, Bishop JA. Gnepp\'s diagnostic surgical pathology of the head and neck. 3rd ed. Amsterdam: Elsevier Inc; 2020.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">15. &nbsp;   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Neurofibromatosis. Conference statement. National Institutes of Health Consensus Development Conference. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arch Neurol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 1988;45(5):575-578.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">16. &nbsp;  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Abdellatif E, Kamel D. Soft Tissue Neurofibroma. Pathology Outlines - Neurofibroma-general. Updated June 21, 2022. Accessed August 14, 2022.</span><a href=\"https://www.pathologyoutlines.com/topic/softtissueneurofibroma.html\" style=\"text-decoration:none;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#0563c1;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:underline;-webkit-text-decoration-skip:none;text-decoration-skip-ink:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">https://www.pathologyoutlines.com/topic/softtissueneurofibroma.html</span></a></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">17. &nbsp;   </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Park JY, Park H, Park NJ, Park JS, Sung HJ, Lee SS. Use of calretinin, CD56, and CD34 for differential diagnosis of schwannoma and neurofibroma. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Korean J Pathol</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2011;45:30-35. doi:10.4132/KoreanJPathol.2011.45.1.30.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">18. &nbsp;  </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Gross AM, Wolters PL, Dombi E, et al. Selumetinib in Children with Inoperable Plexiform Neurofibromas [published correction appears in N Engl J Med.24;383(13):1290]. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">N Engl J Med</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2020;382(15):1430-1442. doi:10.1056/NEJMoa1912735.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-indent: -36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 36pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">19.    </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Klesse LJ, Jordan JT, Radtke HB, et al. The Use of MEK Inhibitors in Neurofibromatosis Type 1-Associated Tumors and Management of Toxicities. </span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Oncologist</span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2020;25(7):e1109-e1116. doi:10.1634/theoncologist.2020-0069.</span></p><p><br></p>', 'A 20-year-old female patient born in Miami, Florida with no past medical history and no medication use, presented to our clinic with c/o non -specific lower back, that has been going on past few. Upon examining her back, multiple hyperpigmented cafe-au-lait spots with some pedunculated lesions were noted. The patient stated that she was born with multiple abnormal skin lesions all over her body. She is a nonsmoker without any organic symptomatology.', NULL, '230216093734.png', 1, 1, 'published', 1, 79, 1, 1, '2023-01-28 00:56:11', '2025-08-24 02:48:23');
INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `description`, `excerpt`, `tags`, `feature_image`, `active`, `editor`, `status`, `featured_slider`, `view_count`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(58, 10, 'An unusual case of macro adenoma of the pituitary gland and atypical mycobacterium infection.', '<p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Authors:</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Sultan S. Ahmed*, MD., Robert McKittrick, MD., J. D. Suarez, M.D., Jasmin Ahmed, BS.</span></p><p><b style=\"font-weight:normal;\" id=\"docs-internal-guid-456e2199-7fff-03f1-7a24-6c403d83fc25\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">History</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">A 58 years old Haitian male who admitted at the hospital due to fever of unknown origin.&nbsp; At the time of the admission, his fever was 103.4°F. The patient continues having fever and developed a mild to moderate nonspecific progressive headache with some dizziness.&nbsp; The patient also has some weight loss. He denied night sweat, joint pain, shortness of breath, cough, abdominal pain, nausea and vomiting. He was diagnosed previously with diabetes mellitus, alcohol, and tobacco abuse. The patient’s family history was non-contributory. He had no history of trauma or surgery.</span></p><p><b style=\"font-weight:normal;\"><br></b></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Physical examination&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">The physical exam reveals vital signs; blood pressure 142/92, pulse 86 bpm and regular, respiration 15/min and regular, temperature 103.4 </span><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">0</span></span><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">F, height 69 in, weight 180 lbs. The patent appears alert, and oriented x 3. Abdomen soft, non-tender, non-distended, normal bowl sounds, no lymphadenopathy, no joint pain or swelling, no skin rash. Neurologic, heart and lungs, ear nose and throat examinations were all normal.</span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Diagnostic Testing</span></p><p><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></p><p><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">Initial workup for the patient indicated that his WBC 3.9, RBC count 4.26, hemoglobin 12, hematocrit 34.4, platelet 92, neutrophils 75.2, lymphocytes 17.3, monocytes 7.2 , eosinophil 0, basophils 0.3, BUN 8, creatinine 0.5, sodium 131, potassium 4, chloride 101, CO</span><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: sub; font-family: Arial;\">2</span></span><span style=\"text-align: justify; background-color: transparent; font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"> 25, calcium 8.1, albumin 3.4, AST 26, ALT 26, alkaline phosphatase 37, glucose 296, HgA1C 15.3. Blood culture collected repeatedly for aerobic and anaerobic organisms but showed no growth. Multiple urine culture also did not showed any growth of organisms. Chest x-ray was done with no abnormalities of the heart and lungs. The patient also been checked for sputum for AFBX3 and the results were negative. Only test came back with positive result was QuantiFERON-TB Gold test. MRI of the brain was done due to continuous headache and it showed massive pituitary macro adenoma. CT scan of the brain shows no hemorrhage, but significant pituitary macro-adenoma.&nbsp;</span></p><p><img src=\"http://journal.test/storage/media_images/230128065923.png\" style=\"width: 100%;\"></p><p><span id=\"docs-internal-guid-b11febae-7fff-07d0-13d2-650d70b6f198\"><span style=\"font-size: 11pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">                                                                                        (A)</span></span></p><p><font color=\"#000000\" face=\"Calibri, sans-serif\"><span style=\"font-size: 14.6667px; white-space: pre-wrap; font-family: Arial;\"><b>Figure 1. (A) MRI scan showing the pituitary macro adenoma, (B and C) histopathological slides of the </b></span></font><b style=\"font-size: 14.6667px; white-space: pre-wrap; color: rgb(0, 0, 0); font-family: Calibri, sans-serif;\"><span style=\"font-family: Arial;\">pituitary tumor.</span></b></p><p><br></p><p><img src=\"http://journal.test/storage/media_images/230128065926.png\" style=\"width: 100%;\"><span style=\"background-color: transparent; font-size: 11pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></p><p><span style=\"background-color: transparent; font-size: 11pt; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">                                                                                               (B)</span><span style=\"background-color: transparent; font-size: 11pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span></p><p><img src=\"http://journal.test/storage/media_images/230128065931.png\" style=\"width: 100%;\"></p><p><span id=\"docs-internal-guid-4fdf2c92-7fff-a7df-98b4-70fa11b86df3\"><span style=\"font-size: 11pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">&nbsp;                                                                                        &nbsp;(C)</span><span style=\"font-size: 11pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span></span></p><p dir=\"ltr\" style=\"line-height:1.3800000000000001;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 12pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Discussion&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre; font-family: Arial;\">	</span></span><span style=\"font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"> &nbsp; &nbsp; &nbsp; Fever of unknown origin is one of the most difficult entity in the clinical medicine, where all investigation need to be focused on possible occult infections. In this interesting case the positive Quantiferon Gold TB test indicated the patient must have occult TB infection in the body. Subsequently after resection of pituitary macro-adenoma, the TB medications were given to the patient. The following anti-TB regimen were given including, Isoniazid, Rifampicin, Pyrazinamide, and ethambutol.&nbsp; Clinically patient improved and became afebrile, after the admiration of Anti-TB medication.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Intrasellar TB continues to be a rare presentation, but incidence and prevalence are expected to grow with increasing numbers of multidrug-resistant TB and shrinking geographical boundaries across the world. Pituitary TB can present with features of a typical adenoma, but has certain radiological and histological features that help to differentiate from an adenoma. Patients can present with a variety of endocrine abnormalities at different times. The presence of an intrasellar mass in individuals at a high risk of developing TB, or with a previous history of systemic TB, should prompt the diagnosis of pituitary TB. In such individuals, it may be worth considering a trial of anti-tuberculous therapy, before considering surgery.</span><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">1-3 </span></span><span style=\"font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Intracranial tuberculomas account for 0.15-4% of all intracranial tumours (2) (3). TB affecting the sellar region, however, is extremely rare, with no reported incidence or prevalence. AFB are rarely demonstrated within the lesions</span><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size: 0.6em; vertical-align: super; font-family: Arial;\">.4</span></span></p><p dir=\"ltr\" style=\"line-height:1.2;text-indent: 36pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">ATT was recommenced (initially supervised directly observed treatment), with a plan to continue for a minimum period of 1 year and possibly extending to 18 months. Standard course of ATT was provided with an initial 2-month phase of intensive therapy with isoniazid, rifampicin, pyrazinamide and ethambutol, followed by isoniazid and rifampicin for the remaining duration of therapy.</span></p><p><span id=\"docs-internal-guid-4fdf2c92-7fff-a7df-98b4-70fa11b86df3\"><span style=\"font-size: 11pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space:pre;\"><b style=\"font-weight:normal;\" id=\"docs-internal-guid-883628c1-7fff-898f-44d2-10957e0223a3\"><br></b></span></span></span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">References:</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1. Majumdar K. Tuberculosis in the pituitary fossa: a common pathology in an uncommon site. </span><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Endocrinol Diabetes Metab Case Rep</span><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2014; 140091.</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2. World Health Organization. Global Tuberculosis Report 2012.</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3. deAngelis LM 1981 Intracranial tuberculoma: case report and review of the literature. Neurology 31 1133–1136.</span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:10pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">4. Sharma MC, Arora R, Mahapatra AK, Sarat-Chandra P, Gaikwad SB &amp; Sarkar C. 2000Intrasellar tuberculomas – an enigmatic pituitary infection: a series of 18 cases. Clinical Neurology and Neurosurgery 10272–77 10.</span></p><p><span><span style=\"font-size: 11pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space:pre;\"><span style=\"font-weight:normal;\"></span></span></span></span><br></p>', 'Fever of unknown origin is one of the most difficult entity in the clinical medicine, where all investigation need to be focused on possible occult infections. In this interesting case the positive Quantiferon Gold TB test indicated the patient must have occult TB infection in the body. Subsequently after resection of pituitary macro-adenoma, the TB medications were given to the patient. The following anti-TB regimen were given including, Isoniazid, Rifampicin, Pyrazinamide, and ethambutol.  Clinically patient improved and became afebrile, after the admiration of Anti-TB medication.', NULL, '230216093751.png', 1, 1, 'published', 1, 6, 1, 1, '2023-01-28 01:03:36', '2025-09-11 06:17:36');
INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `description`, `excerpt`, `tags`, `feature_image`, `active`, `editor`, `status`, `featured_slider`, `view_count`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(59, 9, 'Seventh Nerve Palsy: A Case Presentation', '<p dir=\"ltr\" style=\"line-height:1.2;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.2;text-align: center;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">Syed A. A. Rizvi*</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">1</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">, PhD., Rudy Lacosse</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">2</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">, PA., Ayman M. Saleh</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">3</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">, PhD., Jasmin Ahmed</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">4</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">,&nbsp; BS., Jose D. Suarez</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">5</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">, MD., Sultan Ahmed*</span><span style=\"background-color: transparent; font-size: 13.2pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">2</span></span><span style=\"background-color: transparent; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">, MD.</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.6890411376953125pt;margin-right: 0.020751953125pt;text-indent: -0.01895904541015625pt;margin-top:112.92068481445312pt;margin-bottom:0pt;padding:0pt 0pt 0pt 0.01895904541015625pt;\"><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">1</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">College&nbsp; of&nbsp; Pharmacy, Nova Southeastern University,&nbsp; 3200 South University Drive,&nbsp; Fort Lauderdale, FL 33328, USA.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.49896240234375pt;margin-top:14.480682373046875pt;margin-bottom:0pt;\"><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">2</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">JAS Medical Management LLC, 6151 Miramar Pkwy, Miramar, FL 33023, USA.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5279998779296875pt;margin-right: 0.042236328125pt;text-indent: 0.026397705078125pt;margin-top:14.31597900390625pt;margin-bottom:0pt;\"><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">3</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Department of Basic Medical Sciences, College of Medicine, King Saud Bin Abdulaziz University&nbsp; for Health Sciences, National Guard Health Affairs,&nbsp; P.O. Box:&nbsp; 3660, Mail&nbsp; Code: 3127, Riyadh 11481, Saudi Arabia.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.1320037841796875pt;text-indent: 0.16895294189453125pt;margin-top:14.380645751953125pt;margin-bottom:0pt;\"><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">4</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">School&nbsp; of&nbsp; Medicine,&nbsp; Spartan&nbsp; Health&nbsp; Science&nbsp; University,&nbsp; Laborie,&nbsp; 00124,&nbsp; St.&nbsp; Lucia,&nbsp; West Indies.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.1320037841796875pt;text-indent: 0.16895294189453125pt;margin-top:14.380645751953125pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Cambria, serif; font-variant-numeric: normal; font-variant-east-asian: normal; white-space: pre-wrap; font-size: 13.2pt; vertical-align: baseline;\"><span style=\"font-size:0.6em;vertical-align:super;\">5</span></span><span style=\"background-color: transparent; color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 12pt; font-variant-numeric: normal; font-variant-east-asian: normal; white-space: pre-wrap; vertical-align: baseline;\">Larkin Community Hospital, 6161 Sunset Drive, South Miami, FL 33143, USA.</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5999984741210938pt;margin-top:70.47598266601562pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Correspondence:&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.552001953125pt;margin-right: 0.03424072265625pt;text-indent: 0.15599822998046875pt;text-align: justify;margin-top:14.076004028320312pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Dr.&nbsp; Syed&nbsp; A.&nbsp; A.&nbsp; Rizvi*</span><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">1</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">,&nbsp; College&nbsp; of&nbsp; Pharmacy,&nbsp; Nova&nbsp; Southeastern&nbsp; University,&nbsp; 3200&nbsp; South&nbsp; University&nbsp; Drive,&nbsp; Fort&nbsp; Lauderdale,&nbsp; FL&nbsp; 33328,&nbsp; USA.&nbsp; 954-262-1542.&nbsp; srizvi@nova.edu&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.7080001831054688pt;margin-right: 0.042236328125pt;margin-top:14.38067626953125pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Dr. Sultan S. Ahmed*</span><span style=\"font-size:13.200000127156574pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">2</span></span><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, JAS Medical Management LLC, 6151 Miramar Pkwy, Miramar,&nbsp; FL 33023. 954-965-6001. cmeahmed@bellsouth.net</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5640029907226562pt;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">History&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3687857627868651;margin-left: 0.02951812744140625pt;margin-right: 0.452392578125pt;text-indent: -0.1475982666015625pt;margin-top:16.23602294921875pt;margin-bottom:0pt;padding:0pt 0pt 0pt 0.1475982666015625pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">A&nbsp; 48-year-old female patient presented with left-sided&nbsp; facial&nbsp; paralysis.&nbsp; She stated, facial weakness started about four years ago with a mild left ear pain. She experiences uncomfortable hearing in her&nbsp; left ear, particularly in a crowded and noisy place and her taste sensations are not the same as before either. She was unable to close her left eye while trying to sleep and used pillow to keep it covered.&nbsp; The lagophthalmos and consequent corneal exposure resulted in severe dry eyes and discomfort. Her&nbsp; past medical history includes hypertension and obesity. The patient denied history of dizziness, facial&nbsp; trauma,&nbsp; and&nbsp; flu-like&nbsp; illness.&nbsp; She&nbsp; is&nbsp; unemployed&nbsp; and&nbsp; her&nbsp; personal&nbsp; and&nbsp; family&nbsp; histories&nbsp; were&nbsp; noncontributory.&nbsp;&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5640029907226562pt;margin-top:26.97265625pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Physical Examination&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3714008808135987;margin-left: 0.226318359375pt;margin-right: 0.44927978515625pt;text-indent: 0.35424041748046875pt;text-align: justify;margin-top:16.2359619140625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Physical exam indicated temperature of 97.7</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">0 </span></span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">F; pulse rate 88; blood pressure, 122/78 mmHg, height&nbsp; 67 inches, and weight&nbsp; 190lbs with BMI&nbsp; 29.0. She&nbsp; has left-side&nbsp; facial&nbsp; drooping with&nbsp; the evidence&nbsp; of&nbsp; being unable to close her upper eyelid and mouth, wrinkling of the left side of the forehead, and has&nbsp; aching&nbsp; of&nbsp; the left&nbsp; ear&nbsp; with&nbsp; sensitivity&nbsp; to&nbsp; sound.&nbsp; Tympanic membrane&nbsp; bilaterally looks&nbsp; normal. Her&nbsp; motor activity of left forehead has blunted appearance, including blunted left nasolabial fold.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5640029907226562pt;margin-top:26.95123291015625pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Discussion&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3680170059204102;margin-left: 0.10823822021484375pt;margin-right: 0.4093017578125pt;text-indent: 0.472320556640625pt;text-align: justify;margin-top:16.23602294921875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Bell’s Palsy is one of the most common&nbsp; forms of&nbsp; facial paralysis affecting the seventh cranial nerve.&nbsp; Weakness&nbsp; of&nbsp; the&nbsp; seventh&nbsp; cranial&nbsp; nerve&nbsp; may&nbsp; begin&nbsp; with&nbsp; symptoms&nbsp; of&nbsp; pain&nbsp; in&nbsp; the&nbsp; mastoid&nbsp; region&nbsp; affecting normal hearing and producing full or partial paralysis of movement of one side of the face.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">1,2 </span></span><span style=\"font-size:6.480000495910644pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Facial nerve paralysis occurs due to the interruption at any of the facial nerve level and may result in&nbsp; complete&nbsp; or&nbsp; partial&nbsp; paralysis&nbsp; of&nbsp; facial&nbsp; muscles&nbsp; resulting&nbsp; in&nbsp; decreased&nbsp; salivation,&nbsp; tearing&nbsp; disorders,&nbsp; hyperacusia&nbsp; and&nbsp; hypoesthesia&nbsp; of&nbsp; external&nbsp; auditory&nbsp; canal.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">3 </span></span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Patients&nbsp; with&nbsp; bell’s&nbsp; also&nbsp; commonly&nbsp; deal&nbsp; with situation where the upper lid is always up and a drooping lower lid. The eyelids stay open even&nbsp; as&nbsp; patient&nbsp; trying&nbsp; to&nbsp; sleep,&nbsp; resulting&nbsp; in&nbsp; prolong&nbsp; dry&nbsp; that&nbsp; can&nbsp; lead&nbsp; to&nbsp; corneal&nbsp; ulcers,&nbsp; infection,&nbsp; perforation and loss of vision. Implantable devices have been used to restore dynamic lid closure in&nbsp; cases of severe, symptomatic lagophthalmos.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">4,5</span></span><span style=\"font-size:6.480000495910644pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.368790626525879;margin-left: 0.08856201171875pt;margin-right: 0.32928466796875pt;text-indent: 0.226318359375pt;text-align: justify;margin-top:14.25897216796875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The anatomical component of the seventh cranial nerve has motor and sensory functions. The motor&nbsp; allows&nbsp; for&nbsp; facial expression, secretion of saliva, and excretion of&nbsp; tears. The sensory allows&nbsp; for&nbsp; taste&nbsp; and&nbsp; muscle&nbsp; proprioception.&nbsp; The&nbsp; seventh&nbsp; nerve&nbsp; originates in&nbsp; the&nbsp; pons&nbsp; and&nbsp; is&nbsp; located&nbsp; lateral&nbsp; and&nbsp; anterior&nbsp; to&nbsp; the&nbsp; abducens&nbsp; nucleus.&nbsp; The&nbsp; nerve&nbsp; enters&nbsp; the&nbsp; internal&nbsp; auditory&nbsp; meatus&nbsp; with&nbsp; the&nbsp; vestibulococholear&nbsp; nerve,&nbsp; then&nbsp; forms&nbsp; the&nbsp; geniculate&nbsp; ganglion&nbsp; where&nbsp; it&nbsp; bends&nbsp; into&nbsp; the&nbsp; facial&nbsp; canal&nbsp; where it exits the skull through stylomastoid foramen. The nerve finally passes the parotid gland and&nbsp; subdivides&nbsp; into&nbsp; the&nbsp; temporal,&nbsp; zygomatic,&nbsp; buccal,&nbsp; marginal&nbsp; mandibular,&nbsp; and&nbsp; cervical&nbsp; of&nbsp; the&nbsp; facial&nbsp; muscles.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.373433494567871;margin-left: 0.383758544921875pt;margin-right: 0.41796875pt;text-indent: 0.19680023193359375pt;text-align: justify;margin-top:14.012649536132812pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">If damage occurs to the facial nerve at the site of the stylomastoid foramen, then paralyzes of all the&nbsp; facial muscle will occur. In addition, the patient will experience absent of facial creases and skin folds&nbsp; (especially&nbsp; on&nbsp; the&nbsp; forehead),&nbsp; decrease&nbsp; taste&nbsp; sensation,&nbsp; drooping&nbsp; of&nbsp; the lower eyelid and&nbsp; depressed&nbsp; angle of the mouth.&nbsp;</span></p><p><span id=\"docs-internal-guid-5c6aa935-7fff-4167-e438-a7004c7c3fa5\"></span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Signs&nbsp; during facial examination&nbsp; may&nbsp; help&nbsp; identify&nbsp; and&nbsp; pinpoint&nbsp; lesion&nbsp; of&nbsp; the&nbsp; facial&nbsp; nerve.&nbsp; It&nbsp; is&nbsp; important to document the location of the lesion to aid in assessment and plan of the patient (table&nbsp; 1).&nbsp;&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><br></span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 36.029518127441406pt;margin-top:40.8211669921875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:italic;font-variant:normal;text-decoration:underline;-webkit-text-decoration-skip:none;text-decoration-skip-ink:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Facial Branches with Lesion </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:underline;-webkit-text-decoration-skip:none;text-decoration-skip-ink:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Signs</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 36.89543914794922pt;margin-top:15.63665771484375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Temporal branch </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Raise upper eyelid.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 33.834320068359375pt;text-align: right;margin-top:1.9566650390625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Draw medial eyebrow downwards.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 0.52490234375pt;text-align: right;margin-top:1.9566650390625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Produce&nbsp; transverse&nbsp; wrinkle&nbsp; over&nbsp; the&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 104.68280029296875pt;text-align: right;margin-top:1.95672607421875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">bridge of the nose.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 113.14584350585938pt;text-align: right;margin-top:1.95660400390625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Close eye firmly.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 0.497802734375pt;text-align: right;margin-top:1.9566650390625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Vertical wrinkle in&nbsp; the&nbsp; forehead&nbsp; (causing&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 138.26791381835938pt;text-align: right;margin-top:2.19671630859375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">frowning).&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 35.94096374511719pt;margin-top:15.396697998046875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Zygomatic </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Absent nasolabial fold.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3896843910217285;margin-left: 36.206634521484375pt;margin-right: 10.06976318359375pt;text-indent: -216.36407470703125pt;margin-top:15.396759033203125pt;margin-bottom:0pt;padding:0pt 0pt 0pt 216.36407470703125pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Buccal branch </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Inability to elevate the upper lip. Compress cheeks, absent nasolabial fold.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 6.51983642578125pt;text-align: right;margin-top:0.40130615234375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Keep food under pressure while chewing.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 70.61651611328125pt;text-align: right;margin-top:1.95672607421875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Raised angle of the mouth.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 36.196800231933594pt;margin-top:15.396759033203125pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Mandibular&nbsp; </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Inability to close mouth&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 50.70452880859375pt;text-align: right;margin-top:1.956695556640625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Draw lips in and press on teeth&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 0.4703369140625pt;text-align: right;margin-top:2.19671630859375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Protrude&nbsp; lips,&nbsp; retracts&nbsp; and&nbsp; depress&nbsp; angle&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 128.53851318359375pt;text-align: right;margin-top:1.956756591796875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">of the mouth&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-right: 66.47610473632812pt;text-align: right;margin-top:1.95672607421875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Draws lower lip downward&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3653080463409424;margin-left: 36.600242614746094pt;margin-right: 0.490966796875pt;text-align: center;margin-top:15.396697998046875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Cervical branches </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Inability&nbsp; to&nbsp; raise&nbsp; and&nbsp; wrinkle&nbsp; skin&nbsp; of&nbsp; the&nbsp; neck.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3653080463409424;margin-left: 0.31488037109375pt;margin-right: 0.5086669921875pt;text-indent: -0.13775634765625pt;margin-top:27.72119140625pt;margin-bottom:0pt;padding:0pt 0pt 0pt 0.13775634765625pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Table&nbsp; 1: </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Localization&nbsp; of&nbsp; lesions&nbsp; in&nbsp; various&nbsp; branches&nbsp; of&nbsp; the&nbsp; facial&nbsp; nerve&nbsp; and&nbsp; associated&nbsp; physical&nbsp; symptoms.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3701840877532958;margin-left: 0.226318359375pt;margin-right: 0.4180908203125pt;text-indent: 0.08856201171875pt;text-align: justify;margin-top:41.16119384765625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The&nbsp; differential&nbsp; diagnosis&nbsp; of&nbsp; Bell’s&nbsp; palsy&nbsp; includes&nbsp; Ramsay&nbsp; Hunt&nbsp; Syndrome,&nbsp; acoustic&nbsp; neuroma,&nbsp; and&nbsp; brainstem glioma. Ramsay Hunt Syndrome is due to reactivation of varicella zoster in the geniculate&nbsp; ganglion, consists of facial palsy associated with a vesicular eruption, location may be in the pharynx,&nbsp; and external auditory canal. Patient may present with associated symptoms such as tinnitus, hearing&nbsp; loss, nausea, vomiting, and vertigo.&nbsp; Acoustic neuroma, a tumor on the </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:#ffffff;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">vestibulocochlear nerve</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">, may&nbsp; cause similar symptoms. Brainstem gliomas may cause similar effects over the 7</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">th </span></span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">nerve.&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.384002685546875pt;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:12pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Treatment and Management&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3683513164520262;margin-left: 0.02951812744140625pt;margin-right: 0.46429443359375pt;text-indent: 0.28536224365234375pt;text-align: justify;margin-top:14.79595947265625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The American Academy of Otolaryngology-Head and Neck Surgery Foundation (AAO-HNSF) and the American&nbsp; Academy&nbsp; of&nbsp; Neurology (AAN)&nbsp; recently&nbsp; published&nbsp; guidelines&nbsp; for&nbsp; the&nbsp; treatment&nbsp; of&nbsp; Bell’s&nbsp; palsy.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">6-7 </span></span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The&nbsp; initial&nbsp; treatment&nbsp; of&nbsp; Bell’s&nbsp; palsy&nbsp; is&nbsp; glucocorticoids&nbsp; therapy.&nbsp; Glucocorticoids&nbsp; steroid&nbsp; medication&nbsp; such&nbsp; as&nbsp; prednisone&nbsp; can&nbsp; be&nbsp; given&nbsp; to&nbsp; shorten&nbsp; the&nbsp; recovery&nbsp; period&nbsp; and&nbsp; improve&nbsp; the&nbsp; functional outcome. Prednisone 60mg daily for 5 days, then taper down to 10mg for the next 5 days,&nbsp; with&nbsp; total&nbsp; treatment&nbsp; for&nbsp; 10&nbsp; days.&nbsp; Since, there&nbsp; are&nbsp; reports&nbsp; suggesting&nbsp; possible&nbsp; connection between&nbsp; Bell’s&nbsp; palsy, herpes&nbsp; simplex&nbsp; and&nbsp; varicella&nbsp; zoster&nbsp; viruses; antivirals&nbsp; such&nbsp; as&nbsp; acyclovir&nbsp; could also&nbsp; be&nbsp; prescribed. Nonetheless, recent reports indicate, treatment with acyclovir alone or in simultaneously&nbsp; with prednisolone do not show any advantage and prednisolone alone is as effective.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">8-10</span></span><span style=\"font-size:6.480000495910644pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3653059005737305;margin-left: 0.17711639404296875pt;margin-right: 0.51397705078125pt;text-indent: 0.36408233642578125pt;text-align: justify;margin-top:14.2562255859375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Since functions&nbsp; of facial&nbsp; nerve&nbsp; are complex, quite a&nbsp; number&nbsp; of&nbsp; problems&nbsp; can&nbsp; arise from prolonged&nbsp; Bell’s&nbsp; palsy.&nbsp; Eye&nbsp; is&nbsp; one&nbsp; of&nbsp; the&nbsp; most&nbsp; sensitive&nbsp; and&nbsp; easily&nbsp; damageable organs due&nbsp; to&nbsp; Bell’s&nbsp; palsy.&nbsp; Because eyelids are unable to close, this may to lead to dryness and abrasion of the corneal. Artificial&nbsp; teardrops&nbsp; should&nbsp; be applied every&nbsp; hour&nbsp; during&nbsp; the&nbsp; time&nbsp; that&nbsp; the&nbsp; patient is awake.</span><span style=\"font-size:10.800000826517742pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">11 </span></span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">For additional&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-5d7f230c-7fff-42f3-3076-8ba2a2855912\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">eye protection, protective glasses should be prescribed.&nbsp; The degree of lagophthalmos and the use of&nbsp; eye lubricants needed may be addressed with surgery (upper lid weighting or tarsorraphy).</span><span style=\"font-size: 10.8pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span style=\"font-size:0.6em;vertical-align:super;\">5 </span></span><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">In case&nbsp; of our patient, her left upper eyelid was loaded with stainless steel weight, allowing her to close her&nbsp; eyes, thus preventing potential corneal damage and sleep comfortably (Figure 1).</span></span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-5d7f230c-7fff-42f3-3076-8ba2a2855912\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></span><img src=\"http://journal.test/storage/media_images/230128070539.png\" style=\"width: 100%;\"></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.12px; font-weight: 700; text-indent: 0.183675px; white-space: pre-wrap;\">                                                                                                     Figure 1</span><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.12px; font-weight: 700; text-indent: 0.183675px; white-space: pre-wrap;\"><br></span><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><img src=\"http://journal.test/storage/media_images/230128070543.png\" style=\"width: 100%;\"></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.12px; font-weight: 700; text-indent: 0.183675px; white-space: pre-wrap;\">                                                                                                     Figure 2</span><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><img src=\"http://journal.test/storage/media_images/230128070547.png\" style=\"width: 100%;\"></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"color: rgb(0, 0, 0); font-family: Cambria, serif; font-size: 13.12px; font-weight: 700; text-indent: 0.183675px; white-space: pre-wrap;\">                                                                                                     Figure 3</span><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-ec6ba55d-7fff-093a-b5c5-3eb04dd4db4d\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-ec6ba55d-7fff-093a-b5c5-3eb04dd4db4d\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">Figure 1. </span><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\">From left to right, the hemifacial paresis of the left upper and lower face, left upper eyelid&nbsp; with pretarsal stainless weight implantation. </span></span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-ec6ba55d-7fff-093a-b5c5-3eb04dd4db4d\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><br></span></span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.4624786376953125pt;margin-top:47.12065124511719pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">References:&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.20664215087890625pt;margin-right: 0.5203857421875pt;text-indent: 0.6494369506835938pt;margin-top:10.836700439453125pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">1. Adour KK. Current concepts in neurology: diagnosis and management of facial paralysis. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">The New&nbsp; England Journal of Medicine</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 1982;307:348151.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.6199188232421875pt;margin-right: 0.53643798828125pt;text-indent: -0.472320556640625pt;margin-top:10.640640258789062pt;margin-bottom:0pt;padding:0pt 0pt 0pt 0.472320556640625pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2. Valença MM, Valença LP, Lima MC. Idiopathic facial paralysis (Bell\'s palsy): a study of 180 patients&nbsp; [Paralisia facial periférica idiopática de Bell]. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arquivos de Neuro-Psiquiatria</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2001;59:733-739.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5805587768554688pt;margin-right: 0.61669921875pt;text-indent: 0.10823822021484375pt;margin-top:10.880645751953125pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">3.&nbsp; Ahmad&nbsp; SJ,&nbsp; Rather&nbsp; AH.&nbsp; A&nbsp; Prospective&nbsp; Study&nbsp; of&nbsp; Physical&nbsp; Therapy&nbsp; in&nbsp; Facial&nbsp; Nerve&nbsp; Paralysis:&nbsp; Experience at a Multispeciality Hospital of Kashmir. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Journal of Medical Sciences</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2012;15(2):145-148&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.3739166259765625pt;margin-top:12.080635070800781pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">4. Lee V, Currie Z, Collin JRO. Ophthalmic management of facial nerve palsy. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Eye</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2004;18:1225-1234.</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.6199188232421875pt;margin-right: 0.51397705078125pt;text-indent: 0.0984039306640625pt;margin-top:0pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">5.&nbsp; Rahman&nbsp; I,&nbsp; Sadiq&nbsp; SA.&nbsp; Ophthalmic&nbsp; management&nbsp; of&nbsp; facial&nbsp; nerve&nbsp; palsy:&nbsp; a&nbsp; review.&nbsp; </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Surv&nbsp; Ophthalmol</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">.&nbsp; 2007; 52(2):121-44.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.0098419189453125pt;margin-right: 0.53125pt;text-indent: 0.610076904296875pt;margin-top:11.84063720703125pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">6. Baugh RF, Basura GJ,&nbsp; Ishii LE, et al. Clinical practice guideline Bell’s palsy. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Otolaryngol Head Neck&nbsp; Surg </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2013;149(3 Suppl):S1–27.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.02951812744140625pt;margin-right: 0.52947998046875pt;text-indent: 0.6789627075195312pt;text-align: justify;margin-top:12.0806884765625pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">7.&nbsp; Gronseth&nbsp; GS,&nbsp; Paduga&nbsp; R,&nbsp; American&nbsp; Academy&nbsp; of&nbsp; Neurology.&nbsp; Evidence-based&nbsp; guideline&nbsp; update:&nbsp; steroids&nbsp; and&nbsp; antivirals&nbsp; for&nbsp; Bell&nbsp; palsy:&nbsp; report&nbsp; of&nbsp; the&nbsp; Guideline&nbsp; Development&nbsp; Subcommittee&nbsp; of&nbsp; the&nbsp; American Academy of Neurology. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Neurology </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2012;79:2209-2213.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.35424041748046875pt;margin-right: 0.4320068359375pt;text-indent: 0.17711639404296875pt;margin-top:11.840576171875pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">8.&nbsp; Sullivan&nbsp; FM,&nbsp; Swan&nbsp; IR,&nbsp; Donnan&nbsp; PT&nbsp; </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">et al</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">.&nbsp; Early&nbsp; treatment&nbsp; with&nbsp; prednisolone&nbsp; or&nbsp; acyclovir in&nbsp; Bell’s&nbsp; palsy. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">New England Journal of Medicine </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">2007;357(16):1598-1607.&nbsp;&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.46248626708984375pt;margin-right: 0.51397705078125pt;text-indent: -0.01967620849609375pt;text-align: justify;margin-top:12.08056640625pt;margin-bottom:0pt;padding:0pt 0pt 0pt 0.01967620849609375pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">9. Goudakos JK, Markou KD; Corticosteroids vs corticosteroids plus antiviral agents in the treatment&nbsp; of&nbsp; Bell palsy:&nbsp; a&nbsp; systematic&nbsp; review&nbsp; and&nbsp; meta-analysis.&nbsp; </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Arch&nbsp; Otolaryngol&nbsp; Head&nbsp; Neck&nbsp; Surg</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">.&nbsp; 2009;135(6):558-564&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.2;margin-left: 0.5018386840820312pt;margin-right: 0.529296875pt;text-indent: 0.35424041748046875pt;text-align: justify;margin-top:11.840667724609375pt;margin-bottom:0pt;\"><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">10.&nbsp; Sullivan FM,&nbsp; Swan&nbsp; IR,&nbsp; Donnan&nbsp; PT,&nbsp; Morrison&nbsp; JM,&nbsp; Smith&nbsp; BH,&nbsp; McKinstry&nbsp; B,&nbsp; et&nbsp; al.&nbsp; A&nbsp; randomised&nbsp; controlled trial of the use of aciclovir and/or prednisolone for the early treatment of Bell’s palsy: the&nbsp; BELLS study. </span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:italic;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">Health Technol Assess</span><span style=\"font-size:9.84000015258789pt;font-family:Cambria,serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;\">. 2009;13(47):iii-iv, ix-xi 1-130.&nbsp;</span></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span id=\"docs-internal-guid-ec6ba55d-7fff-093a-b5c5-3eb04dd4db4d\"><span style=\"font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"><span id=\"docs-internal-guid-f02121b5-7fff-7438-ac06-0871f79d3dcc\"><span style=\"font-size: 9.84pt; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">11. </span><span style=\"font-size: 9.84pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">Holland NJ, Weiner GM. Recent developments in Bell\'s palsy. </span><span style=\"font-size: 9.84pt; background-color: transparent; font-style: italic; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">BMJ </span><span style=\"font-size: 9.84pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;\">2004; 329(7465):553-557.</span></span><br></span></span><br></p><p dir=\"ltr\" style=\"line-height:1.3774967193603516;margin-left: 0.4034423828125pt;margin-right: 0.3592529296875pt;text-indent: 0.13775634765625pt;text-align: justify;margin-top:0pt;margin-bottom:0pt;\"><span style=\"background-color: transparent; text-align: left; font-size: 9.84pt; font-family: Cambria, serif; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;\"> </span></p>', 'The American Academy of Otolaryngology-Head and Neck Surgery Foundation (AAO-HNSF) and the American  Academy  of  Neurology (AAN)  recently  published  guidelines  for  the  treatment  of  Bell’s  palsy.6-7 The  initial  treatment  of  Bell’s  palsy  is  glucocorticoids  therapy.  Glucocorticoids  steroid  medication  such  as  prednisone  can  be  given  to  shorten  the  recovery  period  and  improve  the  functional outcome. Prednisone 60mg daily for 5 days, then taper down to 10mg for the next 5 days,  with  total  treatment  for  10  days.  Since, there  are  reports  suggesting  possible  connection between  Bell’s  palsy, herpes  simplex  and  varicella  zoster  viruses; antivirals  such  as  acyclovir  could also  be  prescribed. Nonetheless, recent reports indicate, treatment with acyclovir alone or in simultaneously  with prednisolone do not show any advantage and prednisolone alone is as effective.', NULL, '230216093811.jpg', 1, 1, 'published', 1, 3, 1, 1, '2023-01-28 01:24:47', '2025-08-31 05:24:19');
INSERT INTO `blog_posts` (`id`, `category_id`, `title`, `description`, `excerpt`, `tags`, `feature_image`, `active`, `editor`, `status`, `featured_slider`, `view_count`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(68, 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an', NULL, '230219111422.png', 1, 1, 'published', 1, 27, 1, 1, '2023-02-19 04:45:43', '2025-09-11 06:17:26');

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
  `chamber_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'rakib', 'hasanrr092@gmail.com', '0198009329', '0198009329', 800.00, 'confirmed', 'paid', '800.00', 'Dhaka', NULL, NULL, 3, 28, '2025-08-31 18:00:00', '১১১১১১', NULL, NULL, '2025-09-01 11:16:18', '2025-09-01 11:21:47');

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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `product_id`, `quantity`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(17, '2eg4KsIbFMlVoITs5c7KHsQO3alVDUgbmFjWGLkt', 0, 13, 2, 0, NULL, '2025-09-04 00:06:48', '2025-09-04 00:07:15'),
(18, '1RYiuTfN6rP31JTYpjEOr9ZyuslgDWEqTgTQTEng', 0, 10, 3, 0, NULL, '2025-09-04 01:07:12', '2025-09-04 01:07:18'),
(20, 'CCUMRvIqZxqqoA6utpxwJFBd9tz9vsrFaSVOtpBA', 0, 12, 3, 0, NULL, '2025-09-04 11:42:12', '2025-09-04 11:42:17'),
(21, 'MPM6ZNZiXSaRYzpJmZNkRqhM3SHZJIVgMWmHaPHo', 0, 10, 2, 0, NULL, '2025-09-06 04:50:00', '2025-09-06 04:50:02'),
(22, 'MPM6ZNZiXSaRYzpJmZNkRqhM3SHZJIVgMWmHaPHo', 0, 12, 3, 0, NULL, '2025-09-06 04:50:07', '2025-09-06 04:50:13'),
(25, '4dohoupahFnMbJOOZFA5oDi2Cv3df3tekPXGXiGY', 0, 12, 2, 0, NULL, '2025-09-08 09:22:08', '2025-09-08 09:25:04'),
(26, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 12, 3, 0, NULL, '2025-09-09 20:13:54', '2025-09-09 20:13:57'),
(27, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 13, 3, 0, NULL, '2025-09-09 20:13:58', '2025-09-09 20:14:01'),
(28, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 10, 3, 0, NULL, '2025-09-09 20:14:03', '2025-09-09 20:14:06'),
(29, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 11, 3, 0, NULL, '2025-09-09 20:14:07', '2025-09-09 20:14:10'),
(30, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 9, 3, 0, NULL, '2025-09-09 20:14:12', '2025-09-09 20:14:15'),
(31, 'fVuRYKPwkEoMlpifVM9tYNNcDM8ok9SI8VkqSMPI', 0, 8, 1, 0, NULL, '2025-09-09 20:14:16', '2025-09-09 20:14:33'),
(32, 'DYukfR42l7zY3dMBZAZYXAt0cY3q88xT6BUyYNjf', 0, 12, 1, 0, NULL, '2025-09-09 23:33:44', '2025-09-09 23:33:44'),
(34, '6jjrjAZEtbIToMdStbqMHaY9Xj6syFqOo4EONrPr', 0, 8, 2, 0, NULL, '2025-09-10 07:43:06', '2025-09-10 07:43:08'),
(36, '77xRentLKToOJyg5GsISr1fUmDnS7hNwFnY6n8sI', 0, 12, 2, 0, NULL, '2025-09-11 02:06:11', '2025-09-11 02:06:22'),
(45, NULL, 1, 11, 3, 0, NULL, '2025-09-11 07:42:47', '2025-09-11 07:45:10'),
(46, NULL, 1, 6, 4, 0, NULL, '2025-09-11 07:42:51', '2025-09-11 07:45:14'),
(47, 'JjrUWi3mCeDE1uZwRve8gc0rNzky1L9iFBZ92WXZ', 0, 13, 2, 0, NULL, '2025-09-11 11:19:54', '2025-09-11 11:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_locations`
--

CREATE TABLE `chamber_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL,
  `chamber_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedules` json DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, 166, 'Rasel', '01925923278', 'rasel93.ict@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', NULL, '2025-09-11 07:31:11', '2025-09-11 07:31:11');

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
(25, 108, 'Rahat Mia', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br></p>', NULL, 'rahat@gmail.com', '01976009329', NULL, 800.00, 'Dhaka', NULL, NULL, '1756020375.jpg', 1, 'male', 1, 1, 1, '2023-03-19 00:16:57', '2025-08-31 23:00:00'),
(26, 109, 'Rakib Hasan', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br></p>', NULL, 'rakib@gmail.com', '01976009328', NULL, 600.00, 'Dhaka', NULL, NULL, '1756020342.jpg', 1, 'male', 1, 1, 1, '2023-03-21 06:29:58', '2025-08-31 22:59:40'),
(28, 115, 'Sultan Mahabub', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'sultan@gmail.com', '01970000000', NULL, 900.00, 'Dhaka', NULL, NULL, '1756020439.jpg', 1, 'male', 3, 1, 1, '2025-08-24 01:27:19', '2025-08-31 22:59:05'),
(29, 116, 'Jhon Doe', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'jaon@gmail.com', '01970000000', NULL, 1000.00, 'Dhaka', NULL, NULL, '1756020489.jpg', 1, 'male', 4, 1, 1, '2025-08-24 01:28:09', '2025-08-31 22:58:47'),
(30, 117, 'Masum Billal', NULL, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', NULL, '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>', NULL, 'masum@gmail.com', '0197600000', NULL, 800.00, 'Dhaka', NULL, NULL, '1756021568.png', 1, 'male', 1, 1, 1, '2025-08-24 01:35:28', '2025-08-31 22:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_hospitals`
--

CREATE TABLE `doctor_hospitals` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_hospitals`
--

INSERT INTO `doctor_hospitals` (`id`, `doctor_id`, `hospital_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(16, 12, 1, 1, NULL, NULL, NULL),
(19, 13, 1, 1, NULL, NULL, NULL),
(20, 13, 2, 1, NULL, NULL, NULL),
(21, 14, 1, 1, NULL, NULL, NULL),
(22, 17, 5, 1, NULL, NULL, NULL),
(23, 15, 2, 1, NULL, NULL, NULL),
(24, 18, 2, 1, NULL, NULL, NULL),
(25, 19, 2, 1, NULL, NULL, NULL),
(26, 19, 3, 1, NULL, NULL, NULL),
(29, 20, 4, 1, NULL, NULL, NULL),
(30, 20, 5, 1, NULL, NULL, NULL),
(31, 21, 3, 1, NULL, NULL, NULL),
(32, 21, 4, 1, NULL, NULL, NULL),
(33, 22, 2, 1, NULL, NULL, NULL),
(46, 23, 2, 1, NULL, NULL, NULL),
(51, 24, 2, 1, NULL, NULL, NULL),
(55, 27, 2, 1, NULL, NULL, NULL),
(56, 27, 3, 1, NULL, NULL, NULL),
(57, 27, 4, 1, NULL, NULL, NULL),
(58, 27, 6, 1, NULL, NULL, NULL),
(68, 30, 2, 1, NULL, NULL, NULL),
(69, 29, 2, 1, NULL, NULL, NULL),
(70, 28, 2, 1, NULL, NULL, NULL),
(71, 26, 2, 1, NULL, NULL, NULL),
(72, 25, 2, 1, NULL, NULL, NULL);

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
(1, 'slider1', 'slider1', 'slider1', 'go-bangladesh1756012221.png', 1, 1, 1, '2023-03-19 03:30:07', '2025-08-23 23:10:21'),
(2, 'slider2', 'slider2', 'slider2', 'go-bangladesh1756012211.png', 1, 1, 1, '2023-03-19 03:30:23', '2025-08-23 23:10:11'),
(3, 'slider3', 'slider3', 'slider3', 'go-bangladesh1756012201.jpg', 1, 1, 1, '2023-03-19 03:30:44', '2025-08-23 23:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `galleries` (`id`, `title`, `designation`, `featured_image`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(3, 'Professor Dr. A.M Shahabuddin', 'President', '1756706149.jpg', 1, 1, 1, '2023-02-27 06:11:23', '2025-08-31 23:55:49'),
(7, 'Mohammad Arifur Rahman', 'Vice-President', '1756706464.jpg', 1, 1, NULL, '2025-09-01 00:01:04', '2025-09-01 00:01:04'),
(8, 'Mohammad Masudul Amin', 'General Secretary', '1756706513.jpg', 1, 1, NULL, '2025-09-01 00:01:53', '2025-09-01 00:01:53'),
(9, 'Mosharaf Hosain Khasru', 'Joint Secretary', '1756706536.jpg', 1, 1, NULL, '2025-09-01 00:02:16', '2025-09-01 00:02:16');

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
(2, 'Green Life Hospital, Rampura', NULL, '<p>Green Life Hospital, Rampura<br></p>', NULL, 'Green Life Hospital, Rampura', NULL, 'Green Life Hospital, Rampura', NULL, '01800000000', '1756035052.jpg', 1, 3, 1, 509, 1, 1, '2023-02-28 06:46:26', '2025-08-24 05:30:52'),
(3, 'Enam Hospital', NULL, '<p>Enam Hospital<br></p>', NULL, 'Enam Hospital', NULL, 'Enam Hospital', NULL, '01700000000', '1756035026.jpeg', 1, 5, 19, 336, 1, 1, '2023-03-04 00:56:13', '2025-08-24 05:30:26'),
(4, 'Delta hospital', NULL, '<p>Delta hospital<br></p>', NULL, 'Delta hospital', NULL, 'Delta hospital', NULL, '01900000000', '1756035000.jpeg', 1, 6, 28, 414, 1, 1, '2023-03-04 01:08:13', '2025-08-24 05:30:00'),
(5, 'Nurjan hospital', NULL, '<p>norjann hospital<br></p>', NULL, 'norjann hospital', NULL, 'norjann hospital', NULL, '01960000000', '1756034976.jpeg', 1, 5, 23, 367, 1, 1, '2023-03-04 04:39:07', '2025-08-24 05:29:36'),
(6, 'Health care', NULL, '<p>Health care<br></p>', NULL, 'Health care', NULL, 'Health care', NULL, '01970000111', '1756034947.jpg', 1, 3, 1, 523, 1, 1, '2023-03-15 23:46:56', '2025-08-24 05:29:07'),
(7, 'Moon Hospital', NULL, '<p>moon hospital, comilla</p>', NULL, 'moon hospital, comilla', NULL, 'Comilla', NULL, '01970000000', '1756034897.jpeg', 1, 2, 44, 90, 1, 1, '2023-05-22 04:42:43', '2025-08-24 05:28:33');

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
(17, 166, 'idcards/idcard_166_1757597446.pdf', '2025-09-10 18:00:00', NULL, NULL, '2025-09-11 07:30:47', '2025-09-11 07:30:47');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_ext`, `file_type`, `height`, `width`, `size`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, '250827053127.jpeg', 'jpeg', 'image', '169', '298', '5.43kB', 1, NULL, '2025-08-26 23:31:29', '2025-08-26 23:31:29'),
(2, '250827053139.jpeg', 'jpeg', 'image', '168', '300', '8.42kB', 1, NULL, '2025-08-26 23:31:39', '2025-08-26 23:31:39'),
(3, '250827053147.jpg', 'jpg', 'image', '153', '223', '17.04kB', 1, NULL, '2025-08-26 23:31:47', '2025-08-26 23:31:47'),
(4, '250827053205.png', 'png', 'image', '171', '261', '16.04kB', 1, NULL, '2025-08-26 23:32:05', '2025-08-26 23:32:05');

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
(115, '2025_09_03_084112_create_shipping_methods_table', 19);

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

INSERT INTO `orders` (`id`, `user_id`, `name`, `mobile`, `email`, `address_title`, `delivery_cost`, `subtotal`, `grand_total`, `paid_amount`, `order_status`, `payment_status`, `payment_method`, `payment_gateway`, `payment_trx_id`, `pending_at`, `confirmed_at`, `ready_to_ship_at`, `shiped_at`, `delivered_at`, `canceled_at`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 2800.00, 2800.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:28:39', '2025-09-01 11:28:39'),
(2, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:30:30', '2025-09-01 11:30:30'),
(3, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:34:42', '2025-09-01 11:34:42'),
(4, 118, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 175.00, 175.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2025-09-01 11:37:35', '2025-09-01 11:37:35'),
(5, 1, 'Admin', '0198009329', 'admin@gmail.com', 'dhaka', 0.00, 4704.00, 4704.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-03 22:07:53', '2025-09-03 22:07:53'),
(6, 1, 'Admin', NULL, 'admin@gmail.com', 'Dhaka', 0.00, 729.00, 729.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-03 22:09:01', '2025-09-03 22:09:01'),
(7, 164, 'Rakib hasan', '01976009329', 'hasanrr092@gmail.com', 'Dhaka', 0.00, 620.00, 620.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, '2025-09-03 22:47:52', '2025-09-03 22:47:52'),
(8, 163, 'Sultan Ahmmed', '01717000000', 'admin01@gmail.com', 'Dhaka', 0.00, 4595.00, 4595.00, 0.00, 'pending', 'pending', 'online', 'online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 163, NULL, '2025-09-03 22:59:04', '2025-09-03 22:59:04'),
(9, 1, 'Admin', '0198009329', 'admin@gmail.com', 'dhaka', 150.00, 2125.00, 2275.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-11 07:16:02', '2025-09-11 07:16:02'),
(10, 1, 'Arif', '01925923276', 'mehediarif.du@gmail.com', 'Tangail', 150.00, 1375.00, 1525.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-11 07:18:49', '2025-09-11 07:18:49'),
(11, 166, 'Rasel', '01925923278', 'rasel93.ict@gmail.com', '304/1, Dhanmondi 15 no(old new 8/a)', 150.00, 369.00, 519.00, 0.00, 'pending', 'unpaid', 'cod', 'cod', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166, NULL, '2025-09-11 07:31:27', '2025-09-11 07:31:27');

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
(19, 166, 11, 7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', 65.00, 4, 260.00, 166, NULL, '2025-09-11 07:31:27', '2025-09-11 07:31:27');

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
(6, 'Contact Us', NULL, 'contact-us', 'contact_us', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 08:55:33', '2025-07-17 08:55:33'),
(7, 'About Us', NULL, 'about-us', 'about_us', NULL, NULL, 1, 0, 13, NULL, '2025-07-17 08:55:42', '2025-07-17 08:55:42'),
(8, 'News', NULL, 'news', 'news', NULL, NULL, 1, 0, 1, NULL, '2025-08-25 02:08:22', '2025-08-25 02:08:22'),
(9, 'Hospital', NULL, 'hospital', 'hospital', NULL, NULL, 1, 0, 1, NULL, '2025-08-25 02:08:37', '2025-08-25 02:08:37'),
(10, 'Department', NULL, 'department', 'department', NULL, NULL, 1, 0, 1, NULL, '2025-08-25 02:09:24', '2025-08-25 02:09:24'),
(11, 'Ambulance Provider', NULL, 'ambulance-provider', 'ambulance_provider', NULL, NULL, 1, 0, 1, NULL, '2025-08-25 02:10:00', '2025-08-25 02:10:00');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
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
  `editor` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_en`, `name_bn`, `sku`, `slug`, `excerpt_en`, `excerpt_bn`, `description_en`, `description_bn`, `featured_image`, `price`, `discount`, `discount_price`, `final_price`, `stock`, `unit`, `tags`, `active`, `editor`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Nebulizer Save Life-01', NULL, 'Nebulizer Save Life-01', 'nebulizer-save-life-01', 'Nebulizer Save Life-01', NULL, '<p>Nebulizer Save Life-01</p>', NULL, '1_1756296549.jpg', 2250.00, 0.00, 0.00, 2250.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-08-27 06:09:09', '2025-08-27 06:11:55'),
(2, 'First Aid Kit Box, Medicine Box', NULL, NULL, 'first-aid-kit-box-medicine-box', 'first-aid-kit-box,-medicine-box', NULL, '<div class=\"product-categories\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Category:&nbsp;<span class=\"product-category\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><font color=\"#3065b5\" face=\"Open Sans, Arial, Helvetica, Nimbus Sans L, sans-serif\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border-style: initial; border-color: initial; border-image: initial; outline-color: initial; outline-style: initial; font-size: 13px; line-height: 20px; transition-duration: 0.3s; transition-timing-function: ease-in-out; transition-property: color;\">Medical Devices</span></font></span></div><div class=\"product-sku\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\"><div class=\"sku\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><span class=\"label\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">SKU:</span>&nbsp;<span id=\"sku-250787\" class=\"value\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">MED00014</span></div><div class=\"product-vendor\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><span class=\"label\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\">Seller:</span>&nbsp;<span class=\"value\" style=\"background: transparent; border: 0px; margin: 0px; padding: 0px; vertical-align: baseline; outline: none;\"><font color=\"#3065b5\" face=\"Open Sans, Arial, Helvetica, Nimbus Sans L, sans-serif\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border-style: initial; border-color: initial; border-image: initial; outline-color: initial; outline-style: initial; font-size: 13px; line-height: 20px; transition-duration: 0.3s; transition-timing-function: ease-in-out; transition-property: color;\">MEDI CARE</span></font></span></div></div>', NULL, '2_1756353935.jpg', 175.00, 0.00, 0.00, 175.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-08-27 22:05:35', '2025-08-27 22:05:35'),
(3, 'Blood Pressure Monitor (Renevo) each', NULL, NULL, 'blood-pressure-monitor-renevo-each', 'blood-pressure-monitor-(renevo)-each', NULL, '<p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-0\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Product Details:</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-1\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">one-touch operation</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-2\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Digital Screen</p><p data-reactid=\".1uq8q8d27bs.$39212.0.1.0.1.5.$line-3\" style=\"background: rgb(252, 252, 252); border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">large 3-row digital display for easy reading automatic power off</p>', NULL, '31756354066.webp', 2800.00, 0.00, 0.00, 2800.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-08-27 22:07:15', '2025-08-27 22:07:46'),
(4, 'VivaChek Ino Glucose Test Meter each', NULL, NULL, 'vivachek-ino-glucose-test-meter-each', NULL, NULL, '<p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-0\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Code calibration (auto-coding)</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-1\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Checks for the possible damage of the strip</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-2\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Auto-shut off in 2 minutes after last action</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Small Size &amp; Easy to cary</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Suitable for Self Use</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-5\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">10 Test Strips &amp; 10 Lancets are free with VivaChek Ino</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Lancing Device Pen, Caring Case, User’s Manual, Reference Guide , Logbook included.</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-7\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usable at Home, Office, Doctor’s Chember, Hospitals &amp; Clinics.</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Test range: 0.6-33.3 mmol/L (10-600 mg/dL)</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-9\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Result calibration: Plasma-equivalent</p><p data-reactid=\".1uq8q8d27bs.$37921.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Sample type: Fresh capillary whole blood</p>', NULL, '4_1756354164.webp', 2070.00, 70.00, 70.00, 2000.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-08-27 22:09:24', '2025-08-28 02:01:29'),
(5, 'AF5 SMC Joya Regular Wings 8 pads', NULL, NULL, 'af5-smc-joya-regular-wings-8-pads', 'Joya Wings Regular Flow (panty system) is the most affordable regular wings sanitary napkin available in the market. It is a scented sanitary napkin and is available in convenient tri-folded packaging with individual wrapping. It ensures faster absorption of liquid and prevents leakage. The pad length is 240 mm.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Joya Wings Regular Flow (panty system) is the most affordable regular wings sanitary napkin available in the market. It is a scented sanitary napkin and is available in convenient tri-folded packaging with individual wrapping. It ensures faster absorption of liquid and prevents leakage. The pad length is 240 mm.</span></p>', NULL, '5_1756887033.jpg', 80.00, 0.00, 0.00, 80.00, 10, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:10:33', '2025-09-03 02:10:33'),
(6, 'A6 Freedom Regular Flow Sanitary Napkin 8 pads', NULL, NULL, 'a6-freedom-regular-flow-sanitary-napkin-8-pads', 'Freedom Heavy Flow Sanitary Napkin, It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Freedom Heavy Flow Sanitary Napkin, It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.</span></p>', NULL, '6_1756887107.jpg', 45.00, 0.00, 0.00, 45.00, 10, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:11:47', '2025-09-03 02:11:47'),
(7, 'A10 ACI Freedom Heavy Flow Sanitary Napkin 8 pads', NULL, NULL, 'a10-aci-freedom-heavy-flow-sanitary-napkin-8-pads', 'It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">It has the Super Absorbent Polymer (SAP) that absorbs a large volume of fluid instantly, converts fluid into GEL, locks inside the pad, and ultimately ensures maximum dry-feel and protection.</span></p>', NULL, '7_1756887162.jpg', 65.00, 0.00, 0.00, 65.00, 10, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:12:42', '2025-09-03 02:12:42'),
(8, 'Dettol Antiseptic Disinfectant Liquid 500 ml', NULL, NULL, 'dettol-antiseptic-disinfectant-liquid-500-ml', 'Dettol Antiseptic combines Dettol’s Trusted germ protection with Original fragrance to effectively protect you from germs that cause infection. Dettol Liquid needs to be used diluted and is used for First Aid, Medical & Personal Hygiene.', NULL, '<p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Highlights</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol’s trusted germ protection with Original fragrance</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-5\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic effectively protects you from germs that cause infection.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic Disinfectant is used for First Aid, Medical &amp; Personal Hygiene.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-7\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Dettol Antiseptic to be used diluted.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">● Comes in 50ml, 100ml, 500ml, 750ml &amp; 5 Liter.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Antiseptic combines Dettol’s Trusted germ protection with Original fragrance to effectively protect you from germs that cause infection. Dettol Liquid needs to be used diluted and is used for First Aid, Medical &amp; Personal Hygiene.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-11\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usage Direction: Read the back label before use.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-12\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Safety Direction: For external use only and is not edible. Keep out of reach of children.</p><p data-reactid=\".16lb5kjey0q.$10208.0.1.0.1.5.$line-13\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">About the Manufacturer: Dettol Antiseptic is Manufactured in Bangladesh by Reckitt Benckiser Bangladesh PLC.</p>', NULL, '8_1756887268.jpg', 175.00, 0.00, 0.00, 175.00, 10, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:14:28', '2025-09-03 02:14:29'),
(9, 'Dettol Handwash Original Liquid Pump 200 ml', NULL, NULL, 'dettol-handwash-original-liquid-pump-200-ml', 'Usage Direction: Press the nozzle gently to get a small amount of Dettol Liquid Handwash on wet hands. Rub hands together ensuring total coverage with lather. Rinse well with water and dry off.', NULL, '<p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-3\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Highlights:</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-4\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Original Liquid Handwash Pump 200 ml Protects from 100 illness-causing germs. Tested under lab conditions. Daily use of Dettol keeps your hand clean and germ-free.Use Dettol Handwash for everyday protection.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-6\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Dettol Handwash provides everyday protection and protects from 100 illness-causing germs as per standard testing protocol. Daily use of Dettol Handwash keeps your hand clean and germ-free.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-8\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Usage Direction: Press the nozzle gently to get a small amount of Dettol Liquid Handwash on wet hands. Rub hands together ensuring total coverage with lather. Rinse well with water and dry off.</p><p data-reactid=\".16lb5kjey0q.$2201.0.1.0.1.5.$line-10\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">Safety Direction: for external use only. Keep out of reach of children unless under adult supervision. Avoid contact with eyes. In case of contact with the eyes rinse immediately with water. If persistent irritation occurs, get medical attention. Not to be used on children under 3 years of age. Store in a cool and dry place.</p>', NULL, '9_1756887325.jpg', 100.00, 0.00, 0.00, 100.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:15:25', '2025-09-03 02:15:25'),
(10, 'Germnil Surgical Face Mask 50 pcs', NULL, NULL, 'germnil-surgical-face-mask-50-pcs', 'The Germnil Surgical Face Mask (50 pcs) offers reliable protection and is designed for comfortable and breathable use. These masks are intended to provide a barrier against bacteria and viruses. They come in a pack of 50, making it a practical option for ongoing personal use.\r\n\r\nThe masks are manufactured in Bangladesh and are tested for safety standards, including ISO certification. They have also been approved by Bangladesh’s Directorate General of Drug Administration (DGDA), ensuring their compliance with local regulations​.', NULL, '<p data-reactid=\".16lb5kjey0q.$27382.0.1.0.1.5.$line-0\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">The Germnil Surgical Face Mask (50 pcs) offers reliable protection and is designed for comfortable and breathable use. These masks are intended to provide a barrier against bacteria and viruses. They come in a pack of 50, making it a practical option for ongoing personal use.</p><p data-reactid=\".16lb5kjey0q.$27382.0.1.0.1.5.$line-1\" style=\"background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 20px; vertical-align: baseline; outline: none; color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px;\">The masks are manufactured in Bangladesh and are tested for safety standards, including ISO certification. They have also been approved by Bangladesh’s Directorate General of Drug Administration (DGDA), ensuring their compliance with local regulations​.</p>', NULL, '10_1756887390.webp', 500.00, 0.00, 0.00, 500.00, 10, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:16:29', '2025-09-03 02:16:30'),
(11, 'NeoCare New Born Diaper Belt (0-4 kg) 20 pcs', NULL, NULL, 'neocare-new-born-diaper-belt-0-4-kg-20-pcs', 'The NeoCare New Born Diaper (0–4 kg, 20 pcs) is designed to provide optimal comfort and protection for newborns. Tailored for babies weighing between 0–4 kg, these diapers ensure a snug and secure fit, catering specifically to the delicate needs of newborns.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">The NeoCare New Born Diaper (0–4 kg, 20 pcs) is designed to provide optimal comfort and protection for newborns. Tailored for babies weighing between 0–4 kg, these diapers ensure a snug and secure fit, catering specifically to the delicate needs of newborns.</span></p>', NULL, '11_1756887470.jpg', 620.00, 0.00, 0.00, 620.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:17:50', '2025-09-03 02:17:50'),
(12, 'Supermom Baby Diaper Belt S (3- 8 kg)', NULL, NULL, 'supermom-baby-diaper-belt-s-3-8-kg', 'Square Toiletries Ltd. has brought for you the high quality diaper named “Supermom” in the market. It has 80% more absorbent than other diapers in the market. Supermom ensures zero leakage as it has hydrophobic leg cuff. Its cottony top sheet ensures that children can sleep comfortably the whole night.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Square Toiletries Ltd. has brought for you the high quality diaper named “Supermom” in the market. It has 80% more absorbent than other diapers in the market. Supermom ensures zero leakage as it has hydrophobic leg cuff. Its cottony top sheet ensures that children can sleep comfortably the whole night.</span></p>', NULL, '12_1756887530.png', 109.00, 0.00, 0.00, 109.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:18:49', '2025-09-03 02:18:50'),
(13, 'Savlon Twinkle Baby New Born Diaper Belt S Up TO 8 kg', NULL, NULL, 'savlon-twinkle-baby-new-born-diaper-belt-s-up-to-8-kg', 'Product type: Belt System. The diapers are Soft. Have elastic ears to ensure the best fit and comfort. Allows the flow of air. Completely Leak Proof. Size: S (Up to 8Kg). Pack Size: 44 Pcs. Made in Bangladesh.', NULL, '<p><span style=\"color: rgb(120, 120, 120); font-family: Roboto, Verdana, Geneva, &quot;DejaVu Sans&quot;, sans-serif; font-size: 14px; background-color: rgb(252, 252, 252);\">Product type: Belt System. The diapers are Soft. Have elastic ears to ensure the best fit and comfort. Allows the flow of air. Completely Leak Proof. Size: S (Up to 8Kg). Pack Size: 44 Pcs. Made in Bangladesh.</span></p>', NULL, '13_1756887618.jpg', 919.00, 0.00, 0.00, 919.00, 1, NULL, NULL, 1, 1, 1, NULL, '2025-09-03 02:20:18', '2025-09-03 02:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
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

INSERT INTO `product_categories` (`id`, `name_en`, `name_bn`, `slug`, `excerpt`, `active`, `image`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Medical Device', NULL, 'medical-device', 'Medical Device', 1, '1756295067.jpeg', 1, 1, '2025-08-27 05:44:28', '2025-08-27 05:51:04'),
(2, 'Baby Care', NULL, 'baby-care', 'Baby Care', 1, '1756295517.jpeg', 1, NULL, '2025-08-27 05:51:58', '2025-08-27 05:51:58'),
(3, 'Health & Beauty', NULL, 'health-beauty', 'Health & Beauty', 1, '1756295539.jpeg', 1, NULL, '2025-08-27 05:52:19', '2025-08-27 05:52:19'),
(4, 'Personal Care', NULL, 'personal-care', 'Personal Care', 1, '1756295562.jpeg', 1, NULL, '2025-08-27 05:52:42', '2025-08-27 05:52:42');

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
(14, 2, 11, 1, '2025-09-03 02:17:50', '2025-09-03 02:17:50'),
(15, 2, 12, 1, '2025-09-03 02:18:50', '2025-09-03 02:18:50'),
(16, 2, 13, 1, '2025-09-03 02:20:18', '2025-09-03 02:20:18');

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
(1, 1, 'admin', 'Admin', 1, NULL, '2023-01-08 05:59:20', '2023-01-08 05:59:20'),
(2, 112, 'admin', 'Admin', 1, NULL, '2023-04-23 22:10:43', '2023-04-23 22:10:43');

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
  `same_day` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `location`, `min_weight`, `max_weight`, `price`, `same_day`, `created_at`, `updated_at`) VALUES
(2, 'Local pickup', 'Inside Dhaka District', NULL, NULL, 60.00, 0, '2025-09-03 03:13:57', '2025-09-03 03:13:57'),
(3, 'Local pickup', 'Outsite Dhaka District', NULL, NULL, 100.00, 0, '2025-09-03 03:14:34', '2025-09-03 03:14:34');

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
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `bkash_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `health_history` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `father_name`, `address`, `reg_date`, `bkash_number`, `dob`, `blood_group`, `email`, `email_verified_at`, `image`, `short_bio`, `mobile`, `password`, `password_temp`, `remember_token`, `created_at`, `updated_at`, `present_address`, `permanent_address`, `nid`, `tin_number`, `ssc_passing`, `ssc_registration`, `health_history`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$f4qKWGpYfpujB23Oel7AWejZLI4JxAh1hzif5Wt0VSm0lBm3zXq1W', NULL, 'bSvfUj65DHGxt1WDh2kle786NJIorOjq8pC5xaWpbOwjOLTZWep5IuetmvS0', NULL, '2023-02-15 08:34:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL, NULL, NULL, NULL, 'user@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$bD9HRWW87USa/G/w9EEXTuyKFNDfzJGgStTqUpUQgNEdEvnQVNSFa', NULL, NULL, NULL, '2023-01-17 05:32:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 'Callie Medina', 'Aretha Howard', 'Animi commodi commo', '2007-11-15', '473', '2013-05-02', 'O+', 'qyfy@mailinator.com', NULL, '1756897478.jpg', NULL, '473', '$2y$10$2r.H6Rk6RXctQ93u5BwJAOydnu4ynKrE.tsj8EEyUnJ5faK92yRti', NULL, NULL, '2025-09-03 05:04:39', '2025-09-03 05:04:39', 'Animi commodi commo', 'Minim perferendis an', '466', '86', '2018', '1996', NULL),
(149, 'Piper Stuart', 'Zane Quinn', 'Accusantium exceptur', '2004-07-23', '215', '1983-03-21', 'B+', 'ricijavyk@mailinator.com', NULL, '1756897878.jpg', NULL, '215', '$2y$10$ST80sXlrLWg2aFWxr9XEx.gjJ47Y9A.KbnSzc5SOT7gL60KuUv7Ca', NULL, NULL, '2025-09-03 05:11:18', '2025-09-03 05:11:18', 'Accusantium exceptur', 'Quae eius placeat e', '531', '975', '2019', '2016', NULL),
(150, 'Sybill Henry', 'Bert Workman', NULL, '2014-10-22', NULL, '2014-01-05', 'O+', 'qudoqu@mailinator.com', NULL, '1756898129.jpg', NULL, '744', '$2y$10$z1OqMB8DWkLVm7rETs6yfuVhoLWt8qznLXCuVuBvo7BxUyMsQ3tiu', NULL, NULL, '2025-09-03 05:15:30', '2025-09-03 05:15:30', 'Eaque dolorem autem', 'Harum nihil adipisic', '123', '587', '1995', '2018', NULL),
(151, 'Leandra Hancock', 'Amena Stanley', 'Deserunt dolor ut al', '2013-12-06', '682', '1974-03-28', 'O-', 'qipu@mailinator.com', NULL, '1756898429.jpg', NULL, '682', '$2y$10$VzDi3DM/.J.ViuAegJTQW.Whdu3vQN17QCLXak4hGW3paib5WQj9O', NULL, NULL, '2025-09-03 05:20:30', '2025-09-03 05:20:30', 'Deserunt dolor ut al', 'Reiciendis non volup', '409', '950', '1984', '2012', NULL),
(152, 'Mariam Clemons', 'Olympia Mcbride', 'Eiusmod magna repreh', '1992-11-30', '46', '1992-02-22', 'A+', 'zehemoru@mailinator.com', NULL, '1756898561.jpg', NULL, '46', '$2y$10$/Y184p.S7MqFhkTjh9.jT..xgDpDL17cBngIxWziXddPOq/TWlPoy', NULL, NULL, '2025-09-03 05:22:41', '2025-09-03 05:22:41', 'Eiusmod magna repreh', 'Earum ut omnis non m', '84', '930', '1996', '2012', NULL),
(153, 'Alexis Hicks', 'Lamar Lindsay', 'In eiusmod dolor fug', '1978-06-09', '580', '2005-10-16', 'O+', 'pukyh@mailinator.com', NULL, '1756898632.jpg', NULL, '580', '$2y$10$R3IsylkWhCQFadfWkSBsDuGTjXYiO5O3xqfEXgqrmR500AfZKd7qi', NULL, NULL, '2025-09-03 05:23:52', '2025-09-03 05:23:52', 'In eiusmod dolor fug', 'Tempore laborum rep', '476', '1000', '2004', '1986', NULL),
(154, 'Neville Kidd', 'Flynn Jordan', 'Sequi et est aut ut', '1998-05-29', '535', '2014-08-01', 'AB-', 'ryfepyzyk@mailinator.com', NULL, '1756898688.jpg', NULL, '535', '$2y$10$cXs.PXStq3YtXLIoLRqob.TG0Ri9VxVuBL3aYQtQ4GDFvINDothoe', NULL, NULL, '2025-09-03 05:24:48', '2025-09-03 05:24:48', 'Sequi et est aut ut', 'Sed ad aut facilis a', '657', '329', '1987', '2017', NULL),
(155, 'Yael Lyons', 'Ayanna Hanson', 'Minim excepteur aspe', '1993-06-30', '523', '2011-05-05', 'O-', 'vohac@mailinator.com', NULL, '1756898766.jpg', NULL, '523', '$2y$10$yVEXtoWIcChK/rjqUzayI.VOP5QBytX4yZnXW.N085cG.o2Xaekwq', NULL, NULL, '2025-09-03 05:26:06', '2025-09-03 05:26:06', 'Minim excepteur aspe', 'Eaque earum ducimus', '820', '838', '1973', '1981', NULL),
(156, 'Castor Cherry', 'Hyatt Black', 'Amet consectetur qu', '1971-12-20', '645', '2004-04-25', 'B-', 'vucadusuky@mailinator.com', NULL, '1756898895.jpg', NULL, '645', '$2y$10$jC9kEMyJHUbP7oOGfnjGxeSZ4DRjF5NVjZ2MAGmPCOS7B465Eawp2', NULL, NULL, '2025-09-03 05:28:15', '2025-09-03 05:28:15', 'Amet consectetur qu', 'Ad sit dolorem cum b', '177', '199', '1996', '1980', NULL),
(157, 'Emi Bailey', 'Zahir Flynn', 'Reprehenderit ratio', '2018-08-18', '952', '1995-10-11', 'A-', 'qeqeteret@mailinator.com', NULL, '1756899033.jpg', NULL, '952', '$2y$10$m85XVQ7Jx6ke8IwDTK0UzOMkn4WWhWD9WzS9MxCV..MU2cKk4nC1K', NULL, NULL, '2025-09-03 05:30:33', '2025-09-03 05:30:33', 'Reprehenderit ratio', 'Doloribus adipisci v', '431', '453', '2004', '1974', NULL),
(158, 'Cassandra Sloan', 'Doris Parsons', 'Enim animi sunt eos', '2012-06-08', '505', '1999-05-20', 'A+', 'fukyquv@mailinator.com', NULL, '1756899198.jpg', NULL, '505', '$2y$10$IeILdo8rjo5OlMYGNXG9zuTFva0vsk9IOK/9yFC3dLV3rbdPvH6HK', NULL, NULL, '2025-09-03 05:33:18', '2025-09-03 05:33:18', 'Enim animi sunt eos', 'Quidem laborum et no', '517', '48', '2013', '2019', NULL),
(159, 'Chase Huff', 'Yolanda Willis', 'Nostrum corrupti et', '2019-03-21', '512', '1993-02-02', 'A+', 'kaly@mailinator.com', NULL, '1756899302.jpg', NULL, '512', '$2y$10$uB01mog/UH1l7egWu9GMNOfgwhzBZdWpe0HupTipz1WX8gsaHNrN6', NULL, NULL, '2025-09-03 05:35:02', '2025-09-03 05:35:02', 'Nostrum corrupti et', 'Error porro sit do a', '670', '887', '2003', '2018', NULL),
(160, 'Adara Bond', 'Renee Gilliam', 'Minim recusandae Ac', '2002-03-01', '549', '1973-08-12', 'B+', 'jajev@mailinator.com', NULL, '1756899377.jpg', NULL, '549', '$2y$10$Q9hzeeBLBi/LeGXNpRAoXusS5jps6k9kScAHCmiD3IszIEr.c0y22', NULL, NULL, '2025-09-03 05:36:17', '2025-09-03 05:36:17', 'Minim recusandae Ac', 'Sunt dicta labore es', '422', '563', '1993', '1979', NULL),
(161, 'Gage Lynch', 'Melodie Townsend', 'Consectetur in quis', '1999-03-08', '866', '2017-08-14', 'A+', 'birajasary@mailinator.com', NULL, '1756899539.jpg', NULL, '866', '$2y$10$qGc/GwWgYMkUONFIEoZPxOmXC1neTY206kZWILU9mTDJSUCEHABhK', NULL, NULL, '2025-09-03 05:38:59', '2025-09-03 05:38:59', 'Consectetur in quis', 'Excepturi est anim v', '457', '954', '1987', '1986', NULL),
(162, 'Rudyard Le', 'Tate Harrell', 'Fugiat totam labori', '1999-11-10', '807', '1974-02-01', 'O+', 'pexyk@mailinator.com', NULL, '1756899609.jpg', NULL, '807', '$2y$10$LvT0NA0quEP9rAt1P0ekjufbsR2H7K7ubDGJdZvb8424Os1c6tnSG', NULL, NULL, '2025-09-03 05:40:10', '2025-09-03 05:40:10', 'Fugiat totam labori', 'Vel animi quasi nes', '379', '937', '2008', '2012', NULL),
(163, 'Sultan Ahmmed', 'Md. Samsuzzaman', 'Building # 01, Road # 01,  Block# B, Flat # 01,  Mohanagar project.  West  Rampura. Dhaka', '2025-09-03', '01717000000', '1983-08-25', 'A+', 'admin01@gmail.com', NULL, '1756959781.jpg', NULL, '01717000000', '$2y$10$SwKHZvE.GfBSUuQ6/Gg5Xu7ekngmgKc9gRzkwzW7Y86iyLBxEqG76', NULL, NULL, '2025-09-03 22:23:01', '2025-09-03 22:23:01', 'Building # 01, Road # 01,  Block# B, Flat # 01,  Mohanagar project.  West  Rampura. Dhaka', 'Dhaka', '12345678', '12345678', '1999', '1997', NULL),
(164, 'Rakib hasan', 'fawsder mia', 'dhaka', '2025-09-04', '01976009329', '2025-09-04', 'O+', 'hasanrr092@gmail.com', NULL, '1756961245.jpg', NULL, '01976009329', '$2y$10$ZlR7Zo4yGsnI48okrCwsputGDz54B2cEpOGgKfdV7bNfqTCrxR8Mm', NULL, NULL, '2025-09-03 22:47:25', '2025-09-03 22:47:25', 'dhaka', 'Dhaka', '1111111', '1111111', '2013', '2013', NULL),
(165, 'Arif', 'Md. Nurul Islam', '304/1, Dhanmondi 15 no(old new 8/a)', '2025-09-01', NULL, '2025-09-01', 'B+', 'mehediarif.du@gmail.com', NULL, '1757597018.PNG', NULL, '01925923276', '$2y$10$vxdexsr1nMD4ROjvYDOfYO09.0nQLyFMzTY1Q587LuHYEL1JFGwG2', NULL, NULL, '2025-09-11 07:23:39', '2025-09-11 07:23:39', '304/1, Dhanmondi 15 no(old new 8/a)', 'Tangail', '1234566789', NULL, '2011', '2020', NULL),
(166, 'Rasel', 'Md. Nurul Islam', '123456789', '2025-09-11', NULL, '1994-03-01', 'B+', 'rasel93.ict@gmail.com', NULL, '1757597446.PNG', NULL, '01925923278', '$2y$10$UknDjaRlGCpAGswllQvCYuhOESg.0OZIH3emrcPgQiry0/oqrRWw2', NULL, NULL, '2025-09-11 07:30:46', '2025-09-11 07:30:46', '123456789', 'Tangail', '1234566789', NULL, '2012', '2009', NULL);

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
-- Table structure for table `website_parameters`
--

CREATE TABLE `website_parameters` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnostic_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eccomerce_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambulance_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_bottom_bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_bottom_text_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cahrge` decimal(10,2) DEFAULT NULL,
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
  `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter_creator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint UNSIGNED DEFAULT NULL,
  `editedby_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_parameters`
--

INSERT INTO `website_parameters` (`id`, `logo`, `logo_alt`, `favicon`, `diagnostic_img`, `eccomerce_img`, `hospital_img`, `ambulance_img`, `doctor_img`, `footer_bottom_bg_color`, `footer_bottom_text_color`, `website_title`, `shipping_cahrge`, `google_analytics_code`, `google_search_console`, `facebook_pixel_code`, `meta_author`, `meta_description`, `footer_copyright`, `fb_url`, `contact_mobile`, `contact_address`, `contact_email`, `twitter_url`, `youtube_url`, `twitter_title`, `twitter_description`, `twitter_creator`, `og_title`, `og_description`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'logo1756871380.png', 'logo-alt1756994190.png', 'favicon1756014583.ico', 'diagnostic_img1757422118.jpg', 'eccomerce_img1756704630.jpeg', 'hospital_img1756704630.jpeg', 'ambulance_img1756704630.jpeg', 'doctor_img1756704630.jpg', NULL, NULL, 'Shasthoseba Pharma', NULL, 'Google Analytics (Tracking) Code', 'Google Search Console Code', 'Facebook (Pixel) Code', 'http://shasthoseba.test/', 'Meta Description', '© Copyright 2023. All Rights Reserved.', 'https://www.facebook.com/93Shasthoseba', '+88017xxxxxxxx', '27/1, New Eskaton Road Standard Center (Level 4, 5 and 9, Dhaka 1000)', 'shasthoseba@gmail.com', 'http://www.twitter.com/', 'https://www.youtube.com/@93-shasthosebafoundation', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-11 04:34:55');

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
-- Indexes for table `chamber_locations`
--
ALTER TABLE `chamber_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `website_parameters`
--
ALTER TABLE `website_parameters`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `chamber_locations`
--
ALTER TABLE `chamber_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `doctor_hospitals`
--
ALTER TABLE `doctor_hospitals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `id_cards`
--
ALTER TABLE `id_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_cats`
--
ALTER TABLE `product_cats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_parameters`
--
ALTER TABLE `website_parameters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
