/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: 192.168.50.38    Database: laravel
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES
(1,'admin@allngrow.com','$2y$12$tMrBqgJa9TwNgyjEKzOdo.9pMe110xkbeFRH..F99S1ty.pjW5owK',NULL,'2025-11-17 23:23:45','2025-11-17 23:23:45');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('laravel-cache-608926f5b617ceac6067227ccf9064874679f6c6','i:1;',1763447299),
('laravel-cache-608926f5b617ceac6067227ccf9064874679f6c6:timer','i:1763447299;',1763447299),
('laravel-cache-c7019c35bcc83bcfe8645425be515e8c533938b2','i:1;',1763509792),
('laravel-cache-c7019c35bcc83bcfe8645425be515e8c533938b2:timer','i:1763509792;',1763509792);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Business & Finance','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(2,'Music & Perform Arts','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(3,'IT','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(4,'Art & Design','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(5,'Language & Writing','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(6,'Lifestyle & Development','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(7,'Cooking & Culinary','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(8,'Professional Certification','2025-11-17 23:23:45','2025-11-17 23:23:45'),
(9,'Health & Sports','2025-11-17 23:23:45','2025-11-17 23:23:45');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_rating`
--

DROP TABLE IF EXISTS `course_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_rating` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseID` bigint(20) unsigned NOT NULL,
  `studentID` bigint(20) unsigned NOT NULL,
  `rating` tinyint(4) NOT NULL COMMENT '1-5 scale',
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `course_rating_courseid_studentid_unique` (`courseID`,`studentID`),
  KEY `course_rating_courseid_index` (`courseID`),
  KEY `course_rating_studentid_index` (`studentID`),
  CONSTRAINT `course_rating_courseid_foreign` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE,
  CONSTRAINT `course_rating_studentid_foreign` FOREIGN KEY (`studentID`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_rating`
--

LOCK TABLES `course_rating` WRITE;
/*!40000 ALTER TABLE `course_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `courseID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `instructorID` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `partner_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`courseID`),
  KEY `courses_instructorid_index` (`instructorID`),
  KEY `courses_status_index` (`status`),
  KEY `courses_category_id_foreign` (`category_id`),
  KEY `courses_partner_id_foreign` (`partner_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `courses_instructorid_foreign` FOREIGN KEY (`instructorID`) REFERENCES `instructors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `courses_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_details`
--

DROP TABLE IF EXISTS `instructor_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_details` (
  `instructorID` bigint(20) unsigned NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `yearsOfExperience` int(11) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`instructorID`),
  KEY `instructor_details_status_index` (`status`),
  CONSTRAINT `instructor_details_instructorid_foreign` FOREIGN KEY (`instructorID`) REFERENCES `instructors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_details`
--

LOCK TABLES `instructor_details` WRITE;
/*!40000 ALTER TABLE `instructor_details` DISABLE KEYS */;
INSERT INTO `instructor_details` VALUES
(5,'Ibraahiim','+62 8135555555','Male',NULL,NULL,'Indonesia','CTPS',50,NULL,NULL,'approved','2025-11-18 16:48:12','2025-11-18 16:48:38');
/*!40000 ALTER TABLE `instructor_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instructors_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` VALUES
(5,'ibraahiim@gmail.com','$2y$12$PXXXn/kiVOVWMoto3pzAo.dBa.ZHCLXGJoUzPxSbIy/tQiBSfM5Dy',NULL,'2025-11-18 16:47:47','2025-11-18 16:47:47');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2025_11_16_153511_create_students_table',1),
(2,'2025_11_16_153513_create_student_details_table',1),
(3,'2025_11_16_153515_create_instructors_table',1),
(4,'2025_11_16_153518_create_instructor_details_table',1),
(5,'2025_11_16_153520_create_admin_table',1),
(6,'2025_11_16_153522_create_courses_table',1),
(7,'2025_11_16_153524_create_subcourses_table',1),
(8,'2025_11_16_153526_create_student_course_table',1),
(9,'2025_11_16_153528_create_course_rating_table',1),
(10,'2025_11_16_153530_add_foreign_keys_to_all_tables',1),
(11,'2025_11_17_064833_create_sessions_table',1),
(12,'2025_11_17_064947_create_cache_table',1),
(13,'2025_11_17_075650_create_categories_table',1),
(14,'2025_11_17_080447_add_category_id_to_courses_table',1),
(15,'2025_11_17_112658_create_partners_table',1),
(16,'2025_11_17_112840_add_partnerid_to_courses_table',1),
(17,'2025_11_18_000001_add_video_and_order_to_subcourses_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partners_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('7iHJuQvRuZhKLHnxOw2860YyPsuDaXbAqARYMOo8',NULL,'192.168.50.38','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSUUyUlZEYTdvR3dWbjF5amcyTHJNbXB6Rk5ja0pJQU1oSEJHU1pXZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xOTIuMTY4LjUwLjM4OjgwMDEvc3R1ZGVudC9icm93c2UtY291cnNlcyI7fXM6NTQ6ImxvZ2luX3N0dWRlbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjU3OiJsb2dpbl9pbnN0cnVjdG9yXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9',1763510403);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_course`
--

DROP TABLE IF EXISTS `student_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_course` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `studentID` bigint(20) unsigned NOT NULL,
  `courseID` bigint(20) unsigned NOT NULL,
  `completion` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-100 progress percent',
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` enum('pending','paid') NOT NULL DEFAULT 'pending' COMMENT 'pending = belum dibayar/dikonfirmasi, paid = sudah dikonfirmasi instructor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_course_studentid_courseid_unique` (`studentID`,`courseID`),
  KEY `student_course_studentid_index` (`studentID`),
  KEY `student_course_courseid_index` (`courseID`),
  KEY `student_course_payment_status_index` (`payment_status`),
  CONSTRAINT `student_course_courseid_foreign` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE,
  CONSTRAINT `student_course_studentid_foreign` FOREIGN KEY (`studentID`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_course`
--

LOCK TABLES `student_course` WRITE;
/*!40000 ALTER TABLE `student_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_details`
--

DROP TABLE IF EXISTS `student_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_details` (
  `studentID` bigint(20) unsigned NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`studentID`),
  CONSTRAINT `student_details_studentid_foreign` FOREIGN KEY (`studentID`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_details`
--

LOCK TABLES `student_details` WRITE;
/*!40000 ALTER TABLE `student_details` DISABLE KEYS */;
INSERT INTO `student_details` VALUES
(1,'Sarah Johnson','+62823456789','female','2002-07-25',NULL,'Indonesia','2025-11-17 23:23:46','2025-11-17 23:23:46'),
(2,'David Lee','+62823456790','male','2001-11-12',NULL,'Indonesia','2025-11-17 23:23:46','2025-11-17 23:23:46'),
(3,'Emma Brown','+62823456791','female','2003-04-08',NULL,'Indonesia','2025-11-17 23:23:46','2025-11-17 23:23:46'),
(4,'Alex Garcia','+62823456792','male','2002-01-30',NULL,'Indonesia','2025-11-17 23:23:46','2025-11-17 23:23:46'),
(5,'Bejo Subejo',NULL,NULL,NULL,NULL,NULL,'2025-11-17 23:27:13','2025-11-17 23:27:13'),
(6,'tesuser12_',NULL,NULL,NULL,NULL,NULL,'2025-11-18 08:58:25','2025-11-18 08:58:25'),
(7,'Baim',NULL,NULL,NULL,NULL,NULL,'2025-11-18 09:16:29','2025-11-18 09:16:29'),
(8,'Baim',NULL,NULL,NULL,NULL,NULL,'2025-11-18 10:19:28','2025-11-18 10:19:28');
/*!40000 ALTER TABLE `student_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES
(1,'sarah.johnson@student.com','$2y$12$juk.PTBqSuPHAAewSpOXn.nkuQNRQwECCpu.o0IScUEWnihHvKDLS',NULL,'2025-11-17 23:23:46','2025-11-17 23:23:46'),
(2,'david.lee@student.com','$2y$12$lZjKM7v/dHfmloZB2G8CwOno0oRzvQyZDVYDhPyYz.tCBMjdF07Di',NULL,'2025-11-17 23:23:46','2025-11-17 23:23:46'),
(3,'emma.brown@student.com','$2y$12$Df08rsavu7menPv8Dv0QUuQhrHoaiq/v1Np7xvP2B7w/iiczbndQm',NULL,'2025-11-17 23:23:46','2025-11-17 23:23:46'),
(4,'alex.garcia@student.com','$2y$12$524jdblhcOVszDw7byb/beBqk1C0f7mJUlfa45h7wdDXYAZYpQT8.',NULL,'2025-11-17 23:23:46','2025-11-17 23:23:46'),
(5,'bejo@gmail.com','$2y$12$9lGE0Azj.CKlZ3wv3/r9g.INcUtrg0Pc1anDW.VCEqFxmEwY570am','WGrab9D2kGmjCyM6upzBlx8MCiICyw1NMwb03ckj00i32l9aNawPditE6Izb','2025-11-17 23:27:13','2025-11-17 23:27:13'),
(6,'tesuser12@gmail.com','$2y$12$6GpsHvSluoCW9m9VHuBh8.agZqtjxlCeFP3kC8qAkEdgQuNUBdbYq','cUSFZf61C0bvOLkF6aEjYTAvUo650kK9DQJtRE5cAPQJrBWButt9GLi5WNQP','2025-11-18 08:58:25','2025-11-18 08:58:25'),
(7,'tesemail1234@gmail.com','$2y$12$uWPQoLAOH6wlj6eKhBJmBeoewZRm4v/itsOL0Egh4qB2MNPX7fEIe','ynNSIinjhGmvngBBrQXQsScSst9ATSo1FyZp5rYzqSJMAVVUeFUjrydkQKlc','2025-11-18 09:16:29','2025-11-18 09:16:29'),
(8,'copenaon@gmail.com','$2y$12$VeFBQq1DO628hIW43OFVx.bMy1DHeDC7UVkYlNZWfTv50f/k8WuMu','8ULfSQq2OSe2r4opGSBjf0Rx3fJ0hC5EKvvTUevlDCNTWL8pb5Tmx39lB694','2025-11-18 10:19:28','2025-11-18 10:19:28');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcourses`
--

DROP TABLE IF EXISTS `subcourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcourses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `fileUpload` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcourses_course_id_index` (`course_id`),
  CONSTRAINT `subcourses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcourses`
--

LOCK TABLES `subcourses` WRITE;
/*!40000 ALTER TABLE `subcourses` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcourses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-19  7:09:37
