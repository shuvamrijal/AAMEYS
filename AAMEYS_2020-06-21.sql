# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.16-MariaDB)
# Database: AAMEYS
# Generation Time: 2020-06-21 07:58:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_profiles`;

CREATE TABLE `admin_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PhoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_profiles_admin_id_foreign` (`admin_id`),
  KEY `admin_profiles_firstname_index` (`FirstName`),
  KEY `admin_profiles_lastname_index` (`LastName`),
  CONSTRAINT `admin_profiles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table assigncourses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assigncourses`;

CREATE TABLE `assigncourses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assigncourses_cources_id_foreign` (`cources_id`),
  KEY `assigncourses_staff_id_foreign` (`staff_id`),
  CONSTRAINT `assigncourses_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `assigncourses_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table assignment_lists
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignment_lists`;

CREATE TABLE `assignment_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `assign_id` int(10) unsigned NOT NULL,
  `studentId` int(10) unsigned NOT NULL,
  `submittedDate` datetime NOT NULL,
  `submittedFile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_lists_cources_id_foreign` (`cources_id`),
  KEY `assignment_lists_staff_id_foreign` (`staff_id`),
  KEY `assignment_lists_assign_id_foreign` (`assign_id`),
  KEY `assignment_lists_studentid_foreign` (`studentId`),
  CONSTRAINT `assignment_lists_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assignments` (`id`),
  CONSTRAINT `assignment_lists_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `assignment_lists_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  CONSTRAINT `assignment_lists_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table assignments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignments`;

CREATE TABLE `assignments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` datetime NOT NULL,
  `grade_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_cources_id_foreign` (`cources_id`),
  CONSTRAINT `assignments_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table attendance_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendance_codes`;

CREATE TABLE `attendance_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attendance_code` int(11) NOT NULL,
  `cources_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_codes_cources_id_foreign` (`cources_id`),
  CONSTRAINT `attendance_codes_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table attendances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendances`;

CREATE TABLE `attendances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `studentId` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `attendance_date` datetime NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_cources_id_foreign` (`cources_id`),
  KEY `attendances_studentid_foreign` (`studentId`),
  KEY `attendances_staff_id_foreign` (`staff_id`),
  CONSTRAINT `attendances_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `attendances_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  CONSTRAINT `attendances_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `courses_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Coursedescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table enroll_courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `enroll_courses`;

CREATE TABLE `enroll_courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `studentId` int(10) unsigned NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enroll_courses_cources_id_foreign` (`cources_id`),
  KEY `enroll_courses_studentid_foreign` (`studentId`),
  CONSTRAINT `enroll_courses_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `enroll_courses_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_event_title_index` (`event_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assign_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `studentId` int(10) unsigned NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradeOn` datetime NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedbackFile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_assign_id_foreign` (`assign_id`),
  KEY `feedback_staff_id_foreign` (`staff_id`),
  KEY `feedback_studentid_foreign` (`studentId`),
  CONSTRAINT `feedback_assign_id_foreign` FOREIGN KEY (`assign_id`) REFERENCES `assignments` (`id`),
  CONSTRAINT `feedback_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  CONSTRAINT `feedback_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(4,'2020_04_27_091708_create_staff_table',1),
	(9,'2020_05_05_034741_create_resources_table',1),
	(17,'2020_05_16_223010_create_assignment_lists_table',1),
	(18,'2020_05_17_173423_create_feedback_table',1),
	(19,'2020_05_17_173424_create_feedback_table',2),
	(20,'2020_05_17_173426_create_feedback_table',3),
	(21,'2020_05_20_115303_create_quizzes_table',4),
	(22,'2020_05_21_115303_create_quizzes_table',5),
	(23,'2020_05_21_115304_create_quizzes_table',6),
	(24,'2020_05_21_115305_create_quizzes_table',7),
	(25,'2020_05_21_115539_quiz_questions',7),
	(27,'2020_05_29_131926_create_enroll_courses_table',9),
	(80,'2014_10_12_100000_create_password_resets_table',10),
	(81,'2020_04_24_014802_create_admins_table',10),
	(82,'2020_04_24_023102_create_users_table',10),
	(83,'2020_04_27_091709_create_staff_table',10),
	(84,'2020_04_29_065613_create_students_table',10),
	(85,'2020_04_30_022359_create_admin_profiles_table',10),
	(86,'2020_05_01_111157_create_courses_table',10),
	(87,'2020_05_03_072532_create_schedules_table',10),
	(88,'2020_05_05_034742_create_resources_table',10),
	(89,'2020_05_06_033021_create_staff_logins_table',10),
	(90,'2020_05_06_033030_create_student_logins_table',10),
	(91,'2020_05_08_104459_create_events_table',10),
	(92,'2020_05_10_032014_create_attendance_codes_table',10),
	(93,'2020_05_12_124715_create_attendances_table',10),
	(94,'2020_05_13_115125_create_assignments_table',10),
	(95,'2020_05_15_183432_assigncourse',10),
	(96,'2020_05_16_223012_create_assignment_lists_table',10),
	(97,'2020_05_17_173428_create_feedback_table',10),
	(98,'2020_05_21_115305_create_quizes_table',10),
	(99,'2020_05_21_115540_quiz_questions',10),
	(100,'2020_05_29_131928_create_enroll_courses_table',10),
	(101,'2020_06_10_140159_quiz_result',10),
	(102,'2020_06_15_180424_create_notifications_table',10);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table quiz_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_questions`;

CREATE TABLE `quiz_questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(10) unsigned NOT NULL,
  `option1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `quiz_questions_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `quiz_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizes` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table quiz_results
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_results`;

CREATE TABLE `quiz_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(10) unsigned NOT NULL,
  `cources_id` int(10) unsigned NOT NULL,
  `studentId` int(10) unsigned NOT NULL,
  `marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_results_quiz_id_foreign` (`quiz_id`),
  KEY `quiz_results_cources_id_foreign` (`cources_id`),
  KEY `quiz_results_studentid_foreign` (`studentId`),
  CONSTRAINT `quiz_results_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `quiz_results_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizes` (`quiz_id`),
  CONSTRAINT `quiz_results_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table quizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quizes`;

CREATE TABLE `quizes` (
  `quiz_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cources_id` int(10) unsigned NOT NULL,
  `no_of_question` int(11) NOT NULL,
  `Quiz_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`quiz_id`),
  KEY `quizes_cources_id_foreign` (`cources_id`),
  CONSTRAINT `quizes_cources_id_foreign` FOREIGN KEY (`cources_id`) REFERENCES `courses` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table resources
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resources`;

CREATE TABLE `resources` (
  `resources_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courses_id` int(10) unsigned NOT NULL,
  `Resources_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Resources_Path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Resources_Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`resources_id`),
  KEY `resources_courses_id_foreign` (`courses_id`),
  CONSTRAINT `resources_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table schedules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schedules`;

CREATE TABLE `schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courses_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `DaysOfWeek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Start_time` time NOT NULL,
  `End_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_courses_id_foreign` (`courses_id`),
  KEY `schedules_staff_id_foreign` (`staff_id`),
  CONSTRAINT `schedules_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`courses_id`),
  CONSTRAINT `schedules_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PhoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `staff_firstname_index` (`FirstName`),
  KEY `staff_lastname_index` (`LastName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table staff_logins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff_logins`;

CREATE TABLE `staff_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_logins_email_unique` (`email`),
  KEY `staff_logins_staff_id_foreign` (`staff_id`),
  CONSTRAINT `staff_logins_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table staff1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff1`;

CREATE TABLE `staff1` (
  `staff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `First Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PhoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `staff_name_index` (`First Name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `staff1` WRITE;
/*!40000 ALTER TABLE `staff1` DISABLE KEYS */;

INSERT INTO `staff1` (`staff_id`, `First Name`, `Address`, `PhoneNo`, `image`, `email`, `gender`, `dateofbirth`, `created_at`, `updated_at`, `LastName`)
VALUES
	(1,'Sujan Regmi','12 Jessie STreet, Oak Park, VIC, 3046, AU','0450562720','','sujanregmi14@gmail.com','male','1995-08-22','2020-05-18 15:32:41','2020-05-18 15:32:41',NULL);

/*!40000 ALTER TABLE `staff1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student_logins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student_logins`;

CREATE TABLE `student_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `studentId` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_logins_username_unique` (`username`),
  KEY `student_logins_studentid_foreign` (`studentId`),
  CONSTRAINT `student_logins_studentid_foreign` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table students
# ------------------------------------------------------------

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `studentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PhoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`studentId`),
  KEY `students_name_index` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
