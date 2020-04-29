-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2020 at 05:35 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bils_new_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT NULL,
	`nid_no` VARCHAR(20) NULL DEFAULT NULL,
	`contact_no` VARCHAR(20) NULL DEFAULT NULL,
	`email` VARCHAR(50) NULL DEFAULT NULL,
	`address` VARCHAR(255) NULL DEFAULT NULL,
	`password` VARCHAR(255) NULL DEFAULT NULL,
	`user_profile_image` VARCHAR(50) NULL DEFAULT NULL,
	`remarks` TEXT NULL DEFAULT NULL,
	`remember_token` VARCHAR(100) NULL DEFAULT NULL,
	`login_status` INT(1) NULL DEFAULT NULL COMMENT '1:logged in, 0 not logged in',
	`status` TINYINT(4) NULL DEFAULT NULL COMMENT '0: In-active, 1:Active, 2: Deleted',
	`user_type` INT(2) NOT NULL DEFAULT 2 COMMENT '1: Admin user, 2: App User',
	`created_at` TIMESTAMP NULL DEFAULT current_timestamp(),
	`updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=25
;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `nid_no`, `contact_no`, `email`, `address`, `password`, `user_profile_image`, `remarks`, `status`, `user_type`, `created_at`, `updated_at`) VALUES
(5, 'Sazzadur', '123', '01747083028', 'sazzadur@gmail.com', 'kalabagan,dhaka', '81dc9bdb52d04dc20036dbd8313ed055', '1584624907.jpg', 'he is good.', 1, 2, '2020-02-10 03:12:29', '2020-04-25 22:54:00'),
(14, 'Momit Hasan', '213123', '01980340482', 'momit@gmail.com', NULL, '81dc9bdb52d04dc20036dbd8313ed055', '1584625014.jpg', 'asfasfsfsfsdf', 1, 2, '2020-03-19 07:36:54', '2020-03-21 14:30:43'),
(15, 'Chaki', '1243124', '01757808214', 'chakddi@gmail.com', 'Dhaka', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '234234234243', 1, 2, '2020-03-19 07:37:48', '2020-03-21 14:30:10'),
(16, 'chanchal', '017', '017371511252', 'chanchal@gmail.com', NULL, '81dc9bdb52d04dc20036dbd8313ed055', '1584625108.jpg', 'asdasdasdas', 1, 2, '2020-03-19 07:38:14', '2020-03-27 09:28:46'),
(20, 'Nishat', '1234', '01706077974', 'nishat@gmail.com', 'dhanmondi', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 0, 2, '2020-03-21 16:29:02', '2020-04-04 21:58:50'),
(21, 'alif', '123', '01836', 'alif@gmail.com', 'asdasd', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 1, 2, '2020-03-21 16:31:40', '2020-03-21 16:31:40'),
(23, 'mehedi', '111', '011', 'mehedi@gmail.com', 'bangla bazar', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 1, 2, '2020-03-21 16:38:32', '2020-04-25 22:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `app_user_group_members`
--

CREATE TABLE `app_user_group_members` (
  `id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 : no access, 1 : access',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `app_user_group_members`
--

INSERT INTO `app_user_group_members` (`id`, `app_user_id`, `group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 40, 1, '2020-03-19 07:35:07', '2020-03-21 21:42:16'),
(2, 14, 39, 1, '2020-03-19 07:36:54', '2020-03-21 20:30:43'),
(3, 15, 40, 1, '2020-03-19 07:37:48', '2020-03-21 20:30:10'),
(4, 15, 41, 1, '2020-03-19 07:37:48', '2020-03-21 20:30:10'),
(5, 16, 41, 1, '2020-03-19 07:38:14', '2020-03-21 20:30:30'),
(7, 5, 39, 0, '2020-03-21 22:13:33', NULL),
(8, 5, 41, 0, '2020-03-21 22:14:14', '2020-03-27 18:10:29'),
(9, 14, 40, 0, '2020-03-21 22:14:33', NULL),
(10, 14, 41, 0, '2020-03-21 22:15:18', NULL),
(11, 15, 39, 0, '2020-03-21 22:15:41', NULL),
(13, 16, 39, 0, '2020-03-21 22:16:25', NULL),
(17, 20, 39, 1, '2020-03-21 16:29:02', '2020-03-21 22:30:32'),
(18, 20, 40, 0, '2020-03-21 16:29:02', '2020-03-21 16:29:02'),
(19, 20, 41, 0, '2020-03-21 16:29:02', '2020-03-21 16:29:02'),
(20, 21, 39, 0, '2020-03-21 16:31:40', '2020-03-21 16:31:40'),
(21, 21, 40, 0, '2020-03-21 16:31:40', '2020-03-21 16:31:40'),
(22, 21, 41, 1, '2020-03-21 16:31:41', '2020-03-21 22:37:34'),
(23, 23, 39, 0, '2020-03-21 16:38:32', '2020-03-21 16:38:32'),
(24, 23, 40, 0, '2020-03-21 16:38:32', '2020-03-21 16:38:32'),
(25, 23, 41, 1, '2020-03-21 16:38:32', '2020-03-21 22:38:32'),
(26, 5, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(27, 14, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(28, 15, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(29, 16, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(30, 20, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(31, 21, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41'),
(32, 23, 44, 0, '2020-03-21 17:55:41', '2020-03-21 17:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `details` text,
  `status` tinyint(1) NOT NULL COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `category_name`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Aid', 'All about first aid.', 1, '2020-03-20 05:51:16', '2020-03-20 05:51:16'),
(2, 'Labour law', 'Labour law (also known as labor law or employment law) mediates the relationship between workers, employing entities, trade unions and the government. Collective labour law relates to the tripartite relationship between employee, employer and union.', 1, '2020-03-20 06:18:09', '2020-03-20 06:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `course_masters`
--

CREATE TABLE `course_masters` (
  `id` int(11) NOT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `course_title` varchar(100) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `appx_start_time` date DEFAULT NULL,
  `appx_end_time` date DEFAULT NULL,
  `act_start_time` date DEFAULT NULL,
  `act_end_time` date DEFAULT NULL,
  `course_type` int(11) DEFAULT NULL COMMENT 'from course categories table',
  `course_teacher` int(11) DEFAULT NULL COMMENT 'form teacher table',
  `course_responsible_person` varchar(15) DEFAULT 'admin',
  `details` text,
  `course_status` tinyint(1) DEFAULT NULL COMMENT '1: Initiate, 2: Approved, 3: Rejected, 4: Started, 5: Completed',
  `payment_fee` double DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL COMMENT 'from paymet_methods table',
  `discount_message` text,
  `attachment` varchar(50) DEFAULT NULL,
  `pub_status` tinyint(1) DEFAULT NULL COMMENT '0: Not-published, 1: Published',
  `perticipants_limit` int(11) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT '',
  `updated_by` varchar(20) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `course_masters`
--

INSERT INTO `course_masters` (`id`, `course_code`, `course_title`, `duration`, `appx_start_time`, `appx_end_time`, `act_start_time`, `act_end_time`, `course_type`, `course_teacher`, `course_responsible_person`, `details`, `course_status`, `payment_fee`, `payment_method`, `discount_message`, `attachment`, `pub_status`, `perticipants_limit`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'course-1', 'Basic First Aid Procedures', '20 H', '2020-03-20', '2020-04-20', NULL, NULL, 1, 1, 'admin', 'This quick primer on common basic first aid procedures can help get you through a minor crisis, at least until the paramedics arrive or you can get to medical treatment. These tips are based on the 2019 first aid procedures recommended by the American Heart Association and American Red Cross.1﻿ They are not a substitute for proper first aid training but can be an introduction to what you can do.', 2, 100, 'Bkash', NULL, NULL, 1, 20, 'Momit', 'Momit', '2020-03-20 05:59:15', '2020-03-30 21:33:52'),
(2, 'course-2', 'Bangladesh Labour Act 2006 – A complete Overview of Employee Rights & Labour Law in Bangladesh', '30 D', '2020-03-21', '2020-05-11', NULL, NULL, 2, 1, 'admin', 'The 2006 Bangladesh Labor Act is relatively sweeping and progressive. The Act consolidates and replaces the 25 existing acts. The comprehensive nature of the law can immediately be gleaned from its coverage — conditions of service and employment, youth employment, maternity benefit, health hygiene, safety, welfare, working hours and leave, wages and payment, workers’ compensation for injury, trade unions and industrial relations, disputes, labour court, workers’ participation in companies profits, regulation of employment and safety of dock workers, provident funds, apprenticeship, penalty and procedure, administration, inspection, etc.', 1, 500, 'Bkash', NULL, NULL, 0, 30, 'Momit', 'Momit', '2020-03-20 06:50:58', '2020-03-30 21:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `course_perticipants`
--

CREATE TABLE `course_perticipants` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `perticipant_id` int(11) DEFAULT NULL,
  `is_interested` tinyint(1) DEFAULT NULL COMMENT '0: Not seen, 1: Interested, 2:NOt interested, 3:registered, 4:not-registered',
  `is_selected` tinyint(1) DEFAULT NULL COMMENT '0: Not-selected, 1: Selected',
  `status` tinyint(1) DEFAULT NULL COMMENT '1: Active, 2: Removed',
  `payment` double DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `is_payment_verified` tinyint(1) DEFAULT '0' COMMENT '0: Not-varified, 1: Varified',
  `payment_status` tinyint(1) DEFAULT NULL COMMENT '0: Partial-paid, 1:Pais',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `course_perticipants`
--

INSERT INTO `course_perticipants` (`id`, `course_id`, `perticipant_id`, `is_interested`, `is_selected`, `status`, `payment`, `payment_method`, `reference_no`, `is_payment_verified`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 06:58:45', '2020-03-20 13:05:24'),
(2, 1, 16, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 06:58:45', '2020-03-20 13:05:25'),
(3, 1, 14, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 06:58:45', '2020-03-20 06:58:45'),
(4, 1, 5, 3, 1, NULL, 100, 'bkash', '123', 1, NULL, '2020-03-20 06:58:45', '2020-03-30 15:36:08'),
(5, 1, 15, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(6, 1, 16, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(7, 1, 14, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(8, 1, 5, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-20 07:33:38', '2020-03-20 07:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `module_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `serial_no` int(11) DEFAULT NULL,
  `menu_icon_class` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active, 0:inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `module_name`, `menu_title`, `menu_url`, `parent_id`, `serial_no`, `menu_icon_class`, `status`, `created_at`, `updated_at`) VALUES
(1, 'User', 'Users', '', 0, 6, 'clip-user-plus', 1, '0000-00-00 00:00:00', '2020-02-04 05:46:09'),
(2, 'User', 'Admin Users', 'user/admin/admin-user-management', 1, 1, NULL, 1, '0000-00-00 00:00:00', '2020-02-04 06:09:48'),
(4, 'User', 'App Users', 'user/app-user/app-user-management', 1, 3, NULL, 1, '0000-00-00 00:00:00', '2020-02-04 06:28:13'),
(6, 'Surveys', 'Surveys', 'survey/management', 0, 3, 'clip-note', 1, '0000-00-00 00:00:00', '2020-02-04 06:28:13'),
(7, 'Courses', 'Courses', '', 0, 2, 'clip-book', 1, '0000-00-00 00:00:00', '2020-02-04 06:28:13'),
(8, 'Courses', 'Manage Courses', 'courses/open-course', 7, 1, NULL, 1, '0000-00-00 00:00:00', '2020-03-09 01:43:18'),
(10, 'Cpanel', 'Control Panel', '', 0, 9, 'clip-settings', 1, '0000-00-00 00:00:00', '2020-02-04 06:28:13'),
(11, 'Cpanel', 'General Setting', 'cp/general/general-setting', 10, NULL, '', 1, '0000-00-00 00:00:00', '2020-02-04 06:28:13'),
(13, 'Cpanel', 'Manage Module', 'cp/module/manage-module', 10, NULL, NULL, 1, '0000-00-00 00:00:00', '2020-02-04 05:28:38'),
(21, 'Cpanel', 'Web Actions', 'cp/web-action/web-action-management', 10, NULL, NULL, 1, '2020-02-04 06:20:29', '2020-02-04 06:21:40'),
(26, 'Settings', 'Settings', '', 0, 7, 'clip-wrench-2', 1, '2020-02-05 04:05:14', '2020-02-05 04:05:14'),
(27, 'Settings', 'Admin User Groups', 'settings/admin/admin-group-management', 26, NULL, NULL, 1, '2020-02-05 04:06:31', '2020-02-05 04:07:23'),
(28, 'Settings', 'App User Groups', 'settings/app-user/app-user-group-management', 26, NULL, NULL, 1, '2020-02-07 07:30:00', '2020-02-07 07:30:00'),
(29, 'Messages', 'Messages', '', 0, 1, 'clip-bubbles-3', 1, '2020-02-07 07:33:57', '2020-02-07 07:36:38'),
(30, 'Messages', 'All Messages', 'messages/all-messages-management', 29, NULL, NULL, 1, '2020-02-07 07:38:13', '2020-02-07 07:38:13'),
(33, 'Settings', 'Publication Category', 'settings/publication/publication-category', 26, NULL, NULL, 1, '2020-02-10 04:25:48', '2020-02-10 04:25:48'),
(34, 'Settings', 'Course Category', 'settings/courses/manage-courses-category', 26, NULL, NULL, 1, '2020-02-10 23:47:48', '2020-02-10 23:47:48'),
(35, 'Settings', 'Notice Category', 'settings/notice/manage-notice-category', 26, NULL, NULL, 1, '2020-02-11 03:53:05', '2020-02-11 03:53:05'),
(36, 'Settings', 'Survey Category', 'settings/survey/manage-survey-category', 26, NULL, NULL, 1, '2020-02-11 07:08:18', '2020-02-11 07:08:18'),
(37, 'Notice', 'Notice', 'notice/manage-notice', 0, 4, 'clip-notification', 1, '2020-02-18 05:21:38', '2020-02-18 05:21:38'),
(38, 'Publication', 'Publication', 'publication/publication-management', 0, 5, 'clip-stack-empty', 1, '2020-02-22 04:01:15', '2020-02-22 04:01:15'),
(39, 'Messages', 'Sent Message', 'messages/sent-message', 29, NULL, NULL, 1, '2020-02-29 00:44:15', '2020-02-29 00:44:15'),
(40, 'Settings', 'Message Category', 'settings/message/message-category', 26, NULL, NULL, 1, '2020-03-02 08:16:36', '2020-03-03 02:34:46'),
(42, 'Courses', 'Manage Teacher', 'course/teacher/manage-teacher', 7, NULL, NULL, 1, '2020-03-07 04:01:49', '2020-03-07 04:19:13'),
(43, 'Reports', 'Reports', '', 0, 8, 'clip-file-powerpoint', 1, '2020-03-13 04:43:01', '2020-03-13 04:43:01'),
(44, 'Reports', 'Survey Summary', 'report/survey-summary', 43, NULL, NULL, 1, '2020-03-13 04:54:43', '2020-03-13 04:54:43'),
(45, 'Reports', 'Survey Details', 'report/survey-details', 43, NULL, NULL, 1, '2020-03-13 04:55:17', '2020-03-13 04:55:17'),
(46, 'Reports', 'Survey Data', 'report/survey-data', 43, NULL, NULL, 10, '2020-03-13 04:55:51', '2020-03-13 04:55:51'),
(47, 'Reports', 'Survey Participants', 'report/survey-participants', 43, NULL, NULL, 1, '2020-03-13 04:56:21', '2020-03-13 04:56:21'),
(48, 'Reports', 'Survey Participants Answers', 'report/survey-participants-answers', 43, NULL, NULL, 1, '2020-03-13 04:57:13', '2020-03-13 04:57:13'),
(49, 'Reports', 'Course Summary', 'report/course-summary', 43, NULL, NULL, 1, '2020-03-13 04:57:56', '2020-03-13 04:57:56'),
(50, 'Reports', 'Course Details', 'report/course-details', 43, NULL, NULL, 1, '2020-03-13 04:58:33', '2020-03-13 04:58:33'),
(51, 'Reports', 'App User', 'report/app-user', 43, NULL, NULL, 1, '2020-03-21 12:50:11', '2020-03-21 12:50:11'),
(52, 'Messages', 'Group Messages', 'messages/group-messages-management', 29, NULL, NULL, 1, '2020-04-04 01:42:24', '2020-04-04 01:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `message_attachments`
--

CREATE TABLE `message_attachments` (
  `id` int(11) NOT NULL,
  `message_master_id` int(11) NOT NULL,
  `attachment_type` tinyint(1) NOT NULL COMMENT '1: Image, 2: Video 3: Audio, 4: File',
  `admin_atachment` varchar(255) DEFAULT '',
  `app_user_attachment` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `message_attachments`
--

INSERT INTO `message_attachments` (`id`, `message_master_id`, `attachment_type`, `admin_atachment`, `app_user_attachment`, `created_at`, `updated_at`) VALUES
(1, 17, 1, '98436752715847251681555317138760.jpg', '', '2020-03-20 11:26:08', '2020-03-20 11:26:08'),
(2, 18, 1, '123725902815847252101555317140809.jpg', '', '2020-03-20 11:26:50', '2020-03-20 11:26:50'),
(3, 42, 1, '12956332115865530361555317140809.jpg', '', '2020-04-10 15:10:36', '2020-04-10 15:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `message_categories`
--

CREATE TABLE `message_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `details` text,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `message_categories`
--

INSERT INTO `message_categories` (`id`, `category_name`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test Msg', 'something for testing', 1, '2020-03-27 10:46:06', '2020-03-27 10:46:06'),
(2, 'Fire', 'ascaffd', 1, '2020-04-04 02:31:09', '2020-04-04 02:31:09'),
(3, 'Corona virus', 'somethings', 1, '2020-04-06 14:07:01', '2020-04-06 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `message_masters`
--

CREATE TABLE `message_masters` (
  `id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `reply_to` int(11) DEFAULT NULL,
  `is_group_msg` int(11) DEFAULT '0' COMMENT '0: No, 1: Group-msg',
  `group_id` int(11) DEFAULT NULL,
  `is_attachment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: No-attachment, 1: Attachment',
  `is_attachment_app_user` tinyint(1) NOT NULL DEFAULT '0',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_message` text,
  `app_user_id` int(11) DEFAULT NULL,
  `app_user_message` text,
  `is_seen` tinyint(1) DEFAULT '0' COMMENT '0: Not-seen, 1: Seen',
  `message_category` int(11) DEFAULT NULL,
  `message_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT NULL COMMENT '0: In-active, 1: Active, 2: Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `message_masters`
--

INSERT INTO `message_masters` (`id`, `message_id`, `reply_to`, `is_group_msg`, `group_id`, `is_attachment`, `is_attachment_app_user`, `admin_id`, `admin_message`, `app_user_id`, `app_user_message`, `is_seen`, `message_category`, `message_date_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 0, 0, 0, 0, 1, 'Attention Everyone. Please Be careful. corona virus is spreading our country', 14, NULL, 0, NULL, '2020-03-20 13:47:20', 1, '2020-03-20 07:47:20', '2020-03-20 07:47:20'),
(2, 1, NULL, 0, 0, 0, 0, 1, 'Attention Everyone. Please Be careful. corona virus is spreading our country', 5, NULL, 1, NULL, '2020-03-20 13:47:20', 1, '2020-03-20 07:47:20', '2020-03-20 13:58:12'),
(3, 1, NULL, 0, 0, 0, 0, 1, 'Attention Everyone. Please Be careful. corona virus is spreading our country', 15, NULL, 0, NULL, '2020-03-20 13:47:20', 1, '2020-03-20 07:47:20', '2020-03-20 07:47:20'),
(4, 1, NULL, 0, 0, 0, 0, 1, 'Attention Everyone. Please Be careful. corona virus is spreading our country', 16, NULL, 0, NULL, '2020-03-20 13:47:20', 1, '2020-03-20 07:47:20', '2020-04-27 04:21:17'),
(6, NULL, NULL, 1, 40, 0, 0, NULL, NULL, 5, 'Ok i will try to be careful.', 0, 2, '2020-03-20 13:54:44', NULL, '2020-03-20 07:54:44', '2020-04-27 05:08:37'),
(7, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 5, 'But what can i do to be careful', 0, NULL, '2020-03-20 13:55:22', NULL, '2020-03-20 07:55:22', '2020-03-20 07:55:22'),
(8, NULL, NULL, 0, 0, 0, 0, 1, 'stay on home', 5, NULL, 0, NULL, '2020-03-20 13:55:45', NULL, '2020-03-20 07:55:45', '2020-03-20 07:55:45'),
(9, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 5, 'Ok i will stay at my home.', 0, NULL, '2020-03-20 14:00:04', NULL, '2020-03-20 08:00:04', '2020-03-20 08:00:04'),
(10, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 5, 'Anythings else....??', 0, NULL, '2020-03-20 14:02:46', NULL, '2020-03-20 08:02:46', '2020-03-20 08:02:46'),
(14, NULL, NULL, 0, 0, 0, 0, 1, 'yes', 5, NULL, 0, NULL, '2020-03-20 14:51:06', NULL, '2020-03-20 08:51:06', '2020-03-20 08:51:06'),
(15, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 5, 'what are those', 0, NULL, '2020-03-20 14:51:23', NULL, '2020-03-20 08:51:23', '2020-03-20 08:51:23'),
(16, NULL, NULL, 0, 0, 0, 0, 1, 'wait a minuts', 5, NULL, 0, NULL, '2020-03-20 14:51:55', NULL, '2020-03-20 08:51:55', '2020-03-20 08:51:55'),
(17, NULL, NULL, 0, 0, 1, 0, 1, NULL, 5, NULL, 0, NULL, '2020-03-20 17:26:08', NULL, '2020-03-20 11:26:08', '2020-03-20 11:26:08'),
(18, NULL, NULL, 0, 0, 1, 0, 1, 'test', 5, NULL, 0, NULL, '2020-03-20 17:26:50', NULL, '2020-03-20 11:26:50', '2020-03-20 11:26:50'),
(19, NULL, NULL, 0, 0, 0, 0, 1, 'hi', 16, NULL, 0, NULL, '2020-03-21 23:14:53', NULL, '2020-03-21 17:14:53', '2020-03-21 17:14:53'),
(20, NULL, NULL, 0, 0, 0, 0, 1, 'hi', 5, NULL, 0, NULL, '2020-03-21 23:22:22', NULL, '2020-03-21 17:22:22', '2020-03-21 17:22:22'),
(21, NULL, NULL, 0, 0, 0, 0, 1, 'are you there...??', 16, NULL, 0, NULL, '2020-03-24 19:42:22', NULL, '2020-03-24 13:42:22', '2020-03-24 13:42:22'),
(22, NULL, NULL, 1, 40, 0, 0, NULL, NULL, 23, 'Hi..........', 0, 1, '2020-03-24 19:44:46', NULL, '2020-03-24 13:44:46', '2020-04-27 05:08:48'),
(23, NULL, NULL, 0, 0, 0, 0, 1, 'hlw', 23, NULL, 0, NULL, '2020-03-24 19:45:05', NULL, '2020-03-24 13:45:05', '2020-03-24 13:45:05'),
(24, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 23, 'whats going on..??', 0, NULL, '2020-03-24 19:45:21', NULL, '2020-03-24 13:45:21', '2020-03-24 13:45:21'),
(35, 2, NULL, 0, 0, 0, 0, 1, 'test', 15, NULL, 0, NULL, '2020-03-27 18:39:59', 1, '2020-03-27 12:39:59', '2020-03-27 18:41:15'),
(36, 3, NULL, 0, 0, 0, 0, 1, 'test', 14, NULL, 0, 1, '2020-03-27 18:41:02', 1, '2020-03-27 12:41:02', '2020-03-30 18:53:48'),
(37, 3, NULL, 0, 0, 0, 0, 1, 'test', 20, NULL, 0, 1, '2020-03-27 18:41:02', 1, '2020-03-27 12:41:02', '2020-03-30 18:53:46'),
(38, NULL, NULL, 0, 0, 0, 0, 1, 'test for category', 5, NULL, 0, 1, '2020-03-30 19:19:13', NULL, '2020-03-30 13:19:13', '2020-03-30 13:19:13'),
(39, NULL, NULL, 0, 0, 0, 0, 1, 'testing', 5, NULL, 0, 1, '2020-03-30 19:22:48', NULL, '2020-03-30 13:22:48', '2020-03-30 13:22:48'),
(40, NULL, NULL, 1, 40, 0, 0, 1, 'awarness for corona virus', NULL, NULL, 0, 3, '2020-04-07 19:11:22', NULL, '2020-04-07 13:11:22', '2020-04-24 14:08:52'),
(41, NULL, NULL, 1, 40, 0, 0, 1, 'aa', NULL, NULL, 0, 3, '2020-04-10 21:08:05', NULL, '2020-04-10 15:08:05', '2020-04-24 14:08:55'),
(42, NULL, NULL, 1, 40, 1, 0, 1, 'bb', NULL, NULL, 0, 3, '2020-04-10 21:10:36', NULL, '2020-04-10 15:10:36', '2020-04-24 14:08:59'),
(43, NULL, NULL, 1, 40, 0, 0, 1, 'cc', NULL, NULL, 0, 3, '2020-04-10 21:13:27', NULL, '2020-04-10 15:13:27', '2020-04-24 14:09:03'),
(44, NULL, NULL, 1, 40, 0, 0, 1, 'fire slow', NULL, NULL, 0, 2, '2020-04-10 21:43:16', NULL, '2020-04-10 15:43:16', '2020-04-24 15:48:49'),
(45, NULL, NULL, 1, 40, 0, 0, 1, 'gg', NULL, NULL, 0, 2, '2020-04-10 21:44:46', NULL, '2020-04-10 15:44:46', '2020-04-24 15:48:51'),
(46, NULL, NULL, 1, 40, 0, 0, 1, 'd', NULL, NULL, 0, 3, '2020-04-10 21:45:16', NULL, '2020-04-10 15:45:16', '2020-04-24 14:08:45'),
(47, NULL, NULL, 1, 0, 0, 0, 1, 'testing', NULL, NULL, 0, 1, '2020-04-10 21:48:06', NULL, '2020-04-10 15:48:06', '2020-04-10 15:48:06'),
(48, NULL, NULL, 0, 0, 0, 0, 1, 'hi', 5, NULL, 0, NULL, '2020-04-22 06:53:46', NULL, '2020-04-22 00:53:46', '2020-04-22 00:53:46'),
(49, NULL, NULL, 0, 0, 0, 0, 1, 'hlw', 5, NULL, 0, NULL, '2020-04-22 06:53:51', NULL, '2020-04-22 00:53:51', '2020-04-22 00:53:51'),
(50, NULL, NULL, 1, 0, 0, 0, 1, 'saf', NULL, NULL, 0, 1, '2020-04-24 06:14:32', NULL, '2020-04-24 00:14:32', '2020-04-24 00:14:32'),
(51, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 5, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:54'),
(52, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 14, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:56'),
(53, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 15, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:46'),
(54, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 16, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:40'),
(55, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 20, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:36'),
(56, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 21, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:33'),
(57, 4, NULL, 0, 40, 0, 0, 1, 'This is working', 23, NULL, 0, 2, '2020-04-24 07:36:59', 1, '2020-04-24 01:36:59', '2020-04-24 15:48:28'),
(58, NULL, NULL, 0, 0, 0, 0, 1, 'hi', 23, NULL, 0, NULL, '2020-04-24 10:40:32', NULL, '2020-04-24 04:40:32', '2020-04-24 04:40:32'),
(59, NULL, NULL, 0, 0, 0, 0, 1, NULL, 23, 'This is good', 0, NULL, '2020-04-24 10:42:48', 0, '2020-04-24 10:42:48', NULL),
(60, NULL, NULL, 0, 0, 0, 0, 1, NULL, 23, 'This is good', 0, NULL, '2020-04-24 10:43:25', 0, '2020-04-24 10:43:25', NULL),
(61, NULL, NULL, 0, 0, 0, 0, 1, NULL, 23, 'This is good again', 0, NULL, '2020-04-24 11:03:36', 0, '2020-04-24 11:03:36', NULL),
(62, NULL, NULL, 1, 40, 0, 0, 1, 'hi', NULL, NULL, 0, 2, '2020-04-24 16:04:04', NULL, '2020-04-24 10:04:04', '2020-04-24 10:04:04'),
(63, NULL, NULL, 1, 26, 0, 0, 1, 'hi', NULL, NULL, 0, 1, '2020-04-24 16:04:21', NULL, '2020-04-24 10:04:21', '2020-04-24 10:04:21'),
(64, NULL, NULL, 1, 40, 0, 0, 1, 'good', NULL, NULL, 0, 3, '2020-04-24 17:55:28', NULL, '2020-04-24 11:55:28', '2020-04-24 11:55:28'),
(65, NULL, NULL, 1, 40, 0, 0, 1, 'good', NULL, NULL, 0, 3, '2020-04-24 17:59:14', NULL, '2020-04-24 11:59:14', '2020-04-24 11:59:14'),
(66, NULL, 43, 1, 40, 0, 0, 1, 'very good', NULL, NULL, 0, 3, '2020-04-24 18:01:19', NULL, '2020-04-24 12:01:19', '2020-04-24 12:01:19'),
(67, NULL, NULL, 1, 40, 0, 0, 1, 'testing msg', NULL, NULL, 0, 3, '2020-04-24 18:01:43', NULL, '2020-04-24 12:01:43', '2020-04-24 12:01:43'),
(68, NULL, 66, 1, 40, 0, 0, 1, 'replied message', NULL, NULL, 0, 3, '2020-04-25 07:32:34', NULL, '2020-04-25 01:32:34', '2020-04-25 01:32:34'),
(69, NULL, NULL, 1, 40, 0, 0, 1, NULL, 5, 'Looking good', 1, 3, '2020-04-25 10:40:46', NULL, '2020-04-25 10:40:46', '2020-04-26 04:58:04'),
(70, NULL, 69, 1, 40, 0, 0, 1, 'successfull', NULL, NULL, 0, 3, '2020-04-25 10:57:02', NULL, '2020-04-25 04:57:02', '2020-04-25 04:57:02'),
(71, NULL, 70, 1, 40, 0, 0, 1, 'good', NULL, NULL, 0, 3, '2020-04-25 10:57:59', NULL, '2020-04-25 04:57:59', '2020-04-25 04:57:59'),
(72, NULL, 71, 1, 40, 0, 0, NULL, NULL, 5, 'Looking good', 1, 3, '2020-04-25 11:00:41', NULL, '2020-04-25 11:00:41', '2020-04-26 04:58:04'),
(73, NULL, 71, 1, 40, 0, 0, 1, 'hope this will work', NULL, NULL, 0, 3, '2020-04-25 11:01:33', NULL, '2020-04-25 05:01:33', '2020-04-25 05:01:33'),
(74, NULL, 73, 1, 40, 0, 0, NULL, NULL, 5, 'Test auto load', 1, 3, '2020-04-26 04:59:01', 0, '2020-04-26 04:59:01', '2020-04-26 04:58:04'),
(75, NULL, NULL, 1, 40, 0, 0, 1, 'good day', NULL, NULL, 0, 3, '2020-04-26 06:08:14', NULL, '2020-04-26 00:08:14', '2020-04-26 00:11:59'),
(76, NULL, NULL, 1, 40, 0, 0, 1, 'sdf', NULL, NULL, 0, 3, '2020-04-26 06:12:01', NULL, '2020-04-26 00:12:01', '2020-04-26 00:12:01'),
(77, NULL, 75, 1, 40, 0, 0, NULL, NULL, 5, 'auto refresh check', 1, 3, '2020-04-26 08:56:32', NULL, '2020-04-26 08:56:32', '2020-04-26 04:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_24_063021_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `details` text,
  `notice_date` date DEFAULT NULL,
  `attachment` varchar(200) DEFAULT '',
  `expire_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0: In-active, 1: Active',
  `created_by` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `details`, `notice_date`, `attachment`, `expire_date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Coronavirus', 'Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS-CoV) and Severe Acute Respiratory Syndrome (SARS-CoV).\r\n\r\nCoronavirus disease (COVID-19) is a new strain that was discovered in 2019 and has not been previously identified in humans.\r\n\r\nCoronaviruses are zoonotic, meaning they are transmitted between animals and people.  Detailed investigations found that SARS-CoV was transmitted from civet cats to humans and MERS-CoV from dromedary camels to humans. Several known coronaviruses are circulating in animals that have not yet infected humans. \r\n\r\nCommon signs of infection include respiratory symptoms, fever, cough, shortness of breath and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. \r\n\r\nStandard recommendations to prevent infection spread include regular hand washing, covering mouth and nose when coughing and sneezing, thoroughly cooking meat and eggs. Avoid close contact with anyone showing symptoms of respiratory illness such as coughing and sneezing.', '2020-03-20', '', '2020-03-31', 1, 'Momit', NULL, '2020-03-20 09:14:21', '2020-03-20 09:14:21'),
(2, 'নিউইয়র্কে বাংলাদেশি পরিবারের চার সদস্য করোনায় আক্রান্ত', 'যুক্তরাষ্ট্রের নিউইয়র্কের কুইন্সে বসবাসকারী এক বাংলাদেশি পরিবারের চার সদস্য করোনাভাইরাসে আক্রান্ত হয়েছেন। আক্রান্ত ব্যক্তিরা হাসপাতালে ভর্তি হয়েছেন।\r\n\r\nপরিবারের কর্তা (পুরুষ) প্রথমে আক্রান্ত হন। পরে তাঁর স্ত্রী আক্রান্ত হন। তাঁদের দুই সন্তানও পরে করোনায় আক্রান্ত হয়।\r\n\r\nরাজশাহী বিশ্ববিদ্যালয় অ্যালামনাই অ্যাসোসিয়েশন ইউএসএর এক নেতা বলেন, ‘আমরা সার্বক্ষণিক পরিবারটির খোঁজখবর রাখছি। কোনো কিছুর প্রয়োজন হলে তা সরবরাহ করার চেষ্টা করছি।’\r\nপ্রবাসী বাংলাদেশিদের উদ্দেশে এই নেতা বলেন, ‘আমাদের সামাজিক বৈশিষ্ট্য হচ্ছে—কারও বিপদে পাশে দাঁড়ানো। কিন্তু করোনাভাইরাস আমাদের বিপরীত স্রোতে নিয়ে যাচ্ছে। তার পরও আমাদের পরস্পরের পাশে থাকতে হবে। সামাজিক যোগাযোগের নতুন মাধ্যম সোশ্যাল মিডিয়ার মাধ্যমে আমরা পরস্পরের খোঁজ নেব, কাছে থাকব, আমাদের করণীয় সম্পর্কে মতবিনিময় করব।’\r\n\r\nনেতা বলেন, যাঁরা ট্যাক্সি বা উবার চালান, মালিকপক্ষের লোভনীয় অফার প্রত্যাখ্যান করে কিছুদিন বাসায় থাকুন। যাঁদের কাজে যেতেই হয়, সর্বোচ্চ সতর্কতা অবলম্বন করুন। আমাদের পরস্পরের পাশে থাকতে হবে।', '2020-03-20', '', '2020-03-31', 1, 'Momit', NULL, '2020-03-20 09:21:26', '2020-03-20 09:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `notice_categories`
--

CREATE TABLE `notice_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `details` text,
  `status` tinyint(1) NOT NULL COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_id` int(11) DEFAULT NULL,
  `from_user_type` varchar(50) DEFAULT '' COMMENT 'Admin Or App User',
  `to_id` int(11) DEFAULT NULL,
  `to_user_type` varchar(50) DEFAULT '' COMMENT 'Admin Or App User',
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_title` varchar(255) DEFAULT '',
  `message` text,
  `view_url` varchar(100) DEFAULT NULL COMMENT 'moduleName/id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Un-seen, 1: Seen',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  COMMENT='m';

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_id`, `from_user_type`, `to_id`, `to_user_type`, `date_time`, `notification_title`, `message`, `view_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 15, 'App User', '2020-03-20 13:33:38', 'BILS Initiate Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(2, 1, 'Admin', 16, 'App User', '2020-03-20 13:33:38', 'BILS Initiate Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(3, 1, 'Admin', 14, 'App User', '2020-03-20 13:33:38', 'BILS Initiate Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(4, 1, 'Admin', 5, 'App User', '2020-03-20 13:33:38', 'BILS Initiate Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:38', '2020-03-20 07:33:38'),
(5, 1, 'Admin', 15, 'App User', '2020-03-20 13:33:47', 'BILS Approved Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:47', '2020-03-20 07:33:47'),
(6, 1, 'Admin', 16, 'App User', '2020-03-20 13:33:47', 'BILS Approved Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:47', '2020-03-20 07:33:47'),
(7, 1, 'Admin', 5, 'App User', '2020-03-20 13:33:47', 'BILS Approved Basic First Aid Procedures Course', NULL, 'course/1', 0, '2020-03-20 07:33:47', '2020-03-20 07:33:47'),
(8, 1, 'Admin', 14, 'App User', '2020-03-20 15:14:22', 'Coronavirus', 'Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS-CoV) and Severe Acute Respiratory Syndrome (SARS-CoV).\r\n\r\nCoronavirus disease (COVID-19) is a new strain that was discovered in 2019 and has not been previously identified in humans.\r\n\r\nCoronaviruses are zoonotic, meaning they are transmitted between animals and people.  Detailed investigations found that SARS-CoV was transmitted from civet cats to humans and MERS-CoV from dromedary camels to humans. Several known coronaviruses are circulating in animals that have not yet infected humans. \r\n\r\nCommon signs of infection include respiratory symptoms, fever, cough, shortness of breath and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. \r\n\r\nStandard recommendations to prevent infection spread include regular hand washing, covering mouth and nose when coughing and sneezing, thoroughly cooking meat and eggs. Avoid close contact with anyone showing symptoms of respiratory illness such as coughing and sneezing.', 'notice/1', 0, '2020-03-20 09:14:22', '2020-03-20 09:14:22'),
(9, 1, 'Admin', 5, 'App User', '2020-03-20 15:14:22', 'Coronavirus', 'Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS-CoV) and Severe Acute Respiratory Syndrome (SARS-CoV).\r\n\r\nCoronavirus disease (COVID-19) is a new strain that was discovered in 2019 and has not been previously identified in humans.\r\n\r\nCoronaviruses are zoonotic, meaning they are transmitted between animals and people.  Detailed investigations found that SARS-CoV was transmitted from civet cats to humans and MERS-CoV from dromedary camels to humans. Several known coronaviruses are circulating in animals that have not yet infected humans. \r\n\r\nCommon signs of infection include respiratory symptoms, fever, cough, shortness of breath and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. \r\n\r\nStandard recommendations to prevent infection spread include regular hand washing, covering mouth and nose when coughing and sneezing, thoroughly cooking meat and eggs. Avoid close contact with anyone showing symptoms of respiratory illness such as coughing and sneezing.', 'notice/1', 0, '2020-03-20 09:14:22', '2020-03-20 09:14:22'),
(10, 1, 'Admin', 15, 'App User', '2020-03-20 15:14:22', 'Coronavirus', 'Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS-CoV) and Severe Acute Respiratory Syndrome (SARS-CoV).\r\n\r\nCoronavirus disease (COVID-19) is a new strain that was discovered in 2019 and has not been previously identified in humans.\r\n\r\nCoronaviruses are zoonotic, meaning they are transmitted between animals and people.  Detailed investigations found that SARS-CoV was transmitted from civet cats to humans and MERS-CoV from dromedary camels to humans. Several known coronaviruses are circulating in animals that have not yet infected humans. \r\n\r\nCommon signs of infection include respiratory symptoms, fever, cough, shortness of breath and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. \r\n\r\nStandard recommendations to prevent infection spread include regular hand washing, covering mouth and nose when coughing and sneezing, thoroughly cooking meat and eggs. Avoid close contact with anyone showing symptoms of respiratory illness such as coughing and sneezing.', 'notice/1', 0, '2020-03-20 09:14:22', '2020-03-20 09:14:22'),
(11, 1, 'Admin', 16, 'App User', '2020-03-20 15:14:22', 'Coronavirus', 'Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS-CoV) and Severe Acute Respiratory Syndrome (SARS-CoV).\r\n\r\nCoronavirus disease (COVID-19) is a new strain that was discovered in 2019 and has not been previously identified in humans.\r\n\r\nCoronaviruses are zoonotic, meaning they are transmitted between animals and people.  Detailed investigations found that SARS-CoV was transmitted from civet cats to humans and MERS-CoV from dromedary camels to humans. Several known coronaviruses are circulating in animals that have not yet infected humans. \r\n\r\nCommon signs of infection include respiratory symptoms, fever, cough, shortness of breath and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. \r\n\r\nStandard recommendations to prevent infection spread include regular hand washing, covering mouth and nose when coughing and sneezing, thoroughly cooking meat and eggs. Avoid close contact with anyone showing symptoms of respiratory illness such as coughing and sneezing.', 'notice/1', 0, '2020-03-20 09:14:22', '2020-03-20 09:14:22'),
(12, 1, 'Admin', 14, 'App User', '2020-03-20 15:21:26', 'নিউইয়র্কে বাংলাদেশি পরিবারের চার সদস্য করোনায় আক্রান্ত', 'যুক্তরাষ্ট্রের নিউইয়র্কের কুইন্সে বসবাসকারী এক বাংলাদেশি পরিবারের চার সদস্য করোনাভাইরাসে আক্রান্ত হয়েছেন। আক্রান্ত ব্যক্তিরা হাসপাতালে ভর্তি হয়েছেন।\r\n\r\nপরিবারের কর্তা (পুরুষ) প্রথমে আক্রান্ত হন। পরে তাঁর স্ত্রী আক্রান্ত হন। তাঁদের দুই সন্তানও পরে করোনায় আক্রান্ত হয়।\r\n\r\nরাজশাহী বিশ্ববিদ্যালয় অ্যালামনাই অ্যাসোসিয়েশন ইউএসএর এক নেতা বলেন, ‘আমরা সার্বক্ষণিক পরিবারটির খোঁজখবর রাখছি। কোনো কিছুর প্রয়োজন হলে তা সরবরাহ করার চেষ্টা করছি।’\r\nপ্রবাসী বাংলাদেশিদের উদ্দেশে এই নেতা বলেন, ‘আমাদের সামাজিক বৈশিষ্ট্য হচ্ছে—কারও বিপদে পাশে দাঁড়ানো। কিন্তু করোনাভাইরাস আমাদের বিপরীত স্রোতে নিয়ে যাচ্ছে। তার পরও আমাদের পরস্পরের পাশে থাকতে হবে। সামাজিক যোগাযোগের নতুন মাধ্যম সোশ্যাল মিডিয়ার মাধ্যমে আমরা পরস্পরের খোঁজ নেব, কাছে থাকব, আমাদের করণীয় সম্পর্কে মতবিনিময় করব।’\r\n\r\nনেতা বলেন, যাঁরা ট্যাক্সি বা উবার চালান, মালিকপক্ষের লোভনীয় অফার প্রত্যাখ্যান করে কিছুদিন বাসায় থাকুন। যাঁদের কাজে যেতেই হয়, সর্বোচ্চ সতর্কতা অবলম্বন করুন। আমাদের পরস্পরের পাশে থাকতে হবে।', 'notice/2', 0, '2020-03-20 09:21:26', '2020-03-20 09:21:26'),
(13, 1, 'Admin', 5, 'App User', '2020-03-20 15:21:26', 'নিউইয়র্কে বাংলাদেশি পরিবারের চার সদস্য করোনায় আক্রান্ত', 'যুক্তরাষ্ট্রের নিউইয়র্কের কুইন্সে বসবাসকারী এক বাংলাদেশি পরিবারের চার সদস্য করোনাভাইরাসে আক্রান্ত হয়েছেন। আক্রান্ত ব্যক্তিরা হাসপাতালে ভর্তি হয়েছেন।\r\n\r\nপরিবারের কর্তা (পুরুষ) প্রথমে আক্রান্ত হন। পরে তাঁর স্ত্রী আক্রান্ত হন। তাঁদের দুই সন্তানও পরে করোনায় আক্রান্ত হয়।\r\n\r\nরাজশাহী বিশ্ববিদ্যালয় অ্যালামনাই অ্যাসোসিয়েশন ইউএসএর এক নেতা বলেন, ‘আমরা সার্বক্ষণিক পরিবারটির খোঁজখবর রাখছি। কোনো কিছুর প্রয়োজন হলে তা সরবরাহ করার চেষ্টা করছি।’\r\nপ্রবাসী বাংলাদেশিদের উদ্দেশে এই নেতা বলেন, ‘আমাদের সামাজিক বৈশিষ্ট্য হচ্ছে—কারও বিপদে পাশে দাঁড়ানো। কিন্তু করোনাভাইরাস আমাদের বিপরীত স্রোতে নিয়ে যাচ্ছে। তার পরও আমাদের পরস্পরের পাশে থাকতে হবে। সামাজিক যোগাযোগের নতুন মাধ্যম সোশ্যাল মিডিয়ার মাধ্যমে আমরা পরস্পরের খোঁজ নেব, কাছে থাকব, আমাদের করণীয় সম্পর্কে মতবিনিময় করব।’\r\n\r\nনেতা বলেন, যাঁরা ট্যাক্সি বা উবার চালান, মালিকপক্ষের লোভনীয় অফার প্রত্যাখ্যান করে কিছুদিন বাসায় থাকুন। যাঁদের কাজে যেতেই হয়, সর্বোচ্চ সতর্কতা অবলম্বন করুন। আমাদের পরস্পরের পাশে থাকতে হবে।', 'notice/2', 0, '2020-03-20 09:21:26', '2020-03-20 09:21:26'),
(14, 1, 'Admin', 15, 'App User', '2020-03-20 15:21:26', 'নিউইয়র্কে বাংলাদেশি পরিবারের চার সদস্য করোনায় আক্রান্ত', 'যুক্তরাষ্ট্রের নিউইয়র্কের কুইন্সে বসবাসকারী এক বাংলাদেশি পরিবারের চার সদস্য করোনাভাইরাসে আক্রান্ত হয়েছেন। আক্রান্ত ব্যক্তিরা হাসপাতালে ভর্তি হয়েছেন।\r\n\r\nপরিবারের কর্তা (পুরুষ) প্রথমে আক্রান্ত হন। পরে তাঁর স্ত্রী আক্রান্ত হন। তাঁদের দুই সন্তানও পরে করোনায় আক্রান্ত হয়।\r\n\r\nরাজশাহী বিশ্ববিদ্যালয় অ্যালামনাই অ্যাসোসিয়েশন ইউএসএর এক নেতা বলেন, ‘আমরা সার্বক্ষণিক পরিবারটির খোঁজখবর রাখছি। কোনো কিছুর প্রয়োজন হলে তা সরবরাহ করার চেষ্টা করছি।’\r\nপ্রবাসী বাংলাদেশিদের উদ্দেশে এই নেতা বলেন, ‘আমাদের সামাজিক বৈশিষ্ট্য হচ্ছে—কারও বিপদে পাশে দাঁড়ানো। কিন্তু করোনাভাইরাস আমাদের বিপরীত স্রোতে নিয়ে যাচ্ছে। তার পরও আমাদের পরস্পরের পাশে থাকতে হবে। সামাজিক যোগাযোগের নতুন মাধ্যম সোশ্যাল মিডিয়ার মাধ্যমে আমরা পরস্পরের খোঁজ নেব, কাছে থাকব, আমাদের করণীয় সম্পর্কে মতবিনিময় করব।’\r\n\r\nনেতা বলেন, যাঁরা ট্যাক্সি বা উবার চালান, মালিকপক্ষের লোভনীয় অফার প্রত্যাখ্যান করে কিছুদিন বাসায় থাকুন। যাঁদের কাজে যেতেই হয়, সর্বোচ্চ সতর্কতা অবলম্বন করুন। আমাদের পরস্পরের পাশে থাকতে হবে।', 'notice/2', 0, '2020-03-20 09:21:26', '2020-03-20 09:21:26'),
(15, 1, 'Admin', 16, 'App User', '2020-03-20 15:21:26', 'নিউইয়র্কে বাংলাদেশি পরিবারের চার সদস্য করোনায় আক্রান্ত', 'যুক্তরাষ্ট্রের নিউইয়র্কের কুইন্সে বসবাসকারী এক বাংলাদেশি পরিবারের চার সদস্য করোনাভাইরাসে আক্রান্ত হয়েছেন। আক্রান্ত ব্যক্তিরা হাসপাতালে ভর্তি হয়েছেন।\r\n\r\nপরিবারের কর্তা (পুরুষ) প্রথমে আক্রান্ত হন। পরে তাঁর স্ত্রী আক্রান্ত হন। তাঁদের দুই সন্তানও পরে করোনায় আক্রান্ত হয়।\r\n\r\nরাজশাহী বিশ্ববিদ্যালয় অ্যালামনাই অ্যাসোসিয়েশন ইউএসএর এক নেতা বলেন, ‘আমরা সার্বক্ষণিক পরিবারটির খোঁজখবর রাখছি। কোনো কিছুর প্রয়োজন হলে তা সরবরাহ করার চেষ্টা করছি।’\r\nপ্রবাসী বাংলাদেশিদের উদ্দেশে এই নেতা বলেন, ‘আমাদের সামাজিক বৈশিষ্ট্য হচ্ছে—কারও বিপদে পাশে দাঁড়ানো। কিন্তু করোনাভাইরাস আমাদের বিপরীত স্রোতে নিয়ে যাচ্ছে। তার পরও আমাদের পরস্পরের পাশে থাকতে হবে। সামাজিক যোগাযোগের নতুন মাধ্যম সোশ্যাল মিডিয়ার মাধ্যমে আমরা পরস্পরের খোঁজ নেব, কাছে থাকব, আমাদের করণীয় সম্পর্কে মতবিনিময় করব।’\r\n\r\nনেতা বলেন, যাঁরা ট্যাক্সি বা উবার চালান, মালিকপক্ষের লোভনীয় অফার প্রত্যাখ্যান করে কিছুদিন বাসায় থাকুন। যাঁদের কাজে যেতেই হয়, সর্বোচ্চ সতর্কতা অবলম্বন করুন। আমাদের পরস্পরের পাশে থাকতে হবে।', 'notice/2', 0, '2020-03-20 09:21:26', '2020-03-20 09:21:26'),
(16, 1, 'Admin', 14, 'App User', '2020-03-20 16:16:46', 'বিশ্বে ১০০ কোটি শিশুর স্কুলে যাওয়া বন্ধ, দেশে ৩ কোটি ৬৭ লাখ', 'মহামারি আকারে করোনাভাইরাস ছড়িয়ে পড়ায় বিশ্বব্যাপী শিক্ষাব্যবস্থা বিপর্যস্ত হয়ে পড়েছে। বিশ্বের ১১০টি দেশের সব শিক্ষাপ্রতিষ্ঠান বন্ধ হয়ে গেছে। প্রায় ১০০ কোটি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে। এর মধ্যে সবচেয়ে বেশি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে চীনে। ওই তালিকায় চতুর্থ স্থানে রয়েছে বাংলাদেশের নাম। চীনে ২৩ কোটি ৩০ লাখ ও বাংলাদেশে ৩ কোটি ৬৭ লাখ শিশু স্কুলে যাচ্ছে না। ওই তালিকায় দ্বিতীয় ও তৃতীয় স্থানে রয়েছে ইন্দোনেশিয়া ও পাকিস্তানের নাম।\r\n\r\nগত বুধবার জাতিসংঘের দুর্যোগবিষয়ক ওয়েবসাইট রিলিফ ওয়েবে প্রকাশিত এক প্রতিবেদনে এই তথ্য উঠে এসেছে। তবে সংস্থাটি এ–সংক্রান্ত সব তথ্য সংগ্রহ করেছে জাতিসংঘ শিশু তহবিলের (ইউনিসেফ) একটি প্রতিবেদন থেকে। এই পরিস্থিতিতে ইউনিসেফ থেকে বিশ্বের শিশুদের শিক্ষা পরিস্থিতি নিয়ে দুশ্চিন্তায় পড়েছে। তারা গত বৃহস্পতিবার বিশ্বের ৭৩টি দেশের শিক্ষামন্ত্রীদের সঙ্গে বৈঠক করেছে। অনলাইন বা ডিজিটাল মাধ্যমকে ব্যবহার করে এসব শিশুর কীভাবে শিক্ষা কার্যক্রম চালিয়ে নেওয়া যায়, সে বিষয়ে শিক্ষামন্ত্রীদের মতামত জানতে চেয়েছে তারা।', 'publication/3', 0, '2020-03-20 10:16:46', '2020-03-20 10:16:46'),
(17, 1, 'Admin', 5, 'App User', '2020-03-20 16:16:46', 'বিশ্বে ১০০ কোটি শিশুর স্কুলে যাওয়া বন্ধ, দেশে ৩ কোটি ৬৭ লাখ', 'মহামারি আকারে করোনাভাইরাস ছড়িয়ে পড়ায় বিশ্বব্যাপী শিক্ষাব্যবস্থা বিপর্যস্ত হয়ে পড়েছে। বিশ্বের ১১০টি দেশের সব শিক্ষাপ্রতিষ্ঠান বন্ধ হয়ে গেছে। প্রায় ১০০ কোটি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে। এর মধ্যে সবচেয়ে বেশি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে চীনে। ওই তালিকায় চতুর্থ স্থানে রয়েছে বাংলাদেশের নাম। চীনে ২৩ কোটি ৩০ লাখ ও বাংলাদেশে ৩ কোটি ৬৭ লাখ শিশু স্কুলে যাচ্ছে না। ওই তালিকায় দ্বিতীয় ও তৃতীয় স্থানে রয়েছে ইন্দোনেশিয়া ও পাকিস্তানের নাম।\r\n\r\nগত বুধবার জাতিসংঘের দুর্যোগবিষয়ক ওয়েবসাইট রিলিফ ওয়েবে প্রকাশিত এক প্রতিবেদনে এই তথ্য উঠে এসেছে। তবে সংস্থাটি এ–সংক্রান্ত সব তথ্য সংগ্রহ করেছে জাতিসংঘ শিশু তহবিলের (ইউনিসেফ) একটি প্রতিবেদন থেকে। এই পরিস্থিতিতে ইউনিসেফ থেকে বিশ্বের শিশুদের শিক্ষা পরিস্থিতি নিয়ে দুশ্চিন্তায় পড়েছে। তারা গত বৃহস্পতিবার বিশ্বের ৭৩টি দেশের শিক্ষামন্ত্রীদের সঙ্গে বৈঠক করেছে। অনলাইন বা ডিজিটাল মাধ্যমকে ব্যবহার করে এসব শিশুর কীভাবে শিক্ষা কার্যক্রম চালিয়ে নেওয়া যায়, সে বিষয়ে শিক্ষামন্ত্রীদের মতামত জানতে চেয়েছে তারা।', 'publication/3', 0, '2020-03-20 10:16:46', '2020-03-20 10:16:46'),
(18, 1, 'Admin', 15, 'App User', '2020-03-20 16:16:46', 'বিশ্বে ১০০ কোটি শিশুর স্কুলে যাওয়া বন্ধ, দেশে ৩ কোটি ৬৭ লাখ', 'মহামারি আকারে করোনাভাইরাস ছড়িয়ে পড়ায় বিশ্বব্যাপী শিক্ষাব্যবস্থা বিপর্যস্ত হয়ে পড়েছে। বিশ্বের ১১০টি দেশের সব শিক্ষাপ্রতিষ্ঠান বন্ধ হয়ে গেছে। প্রায় ১০০ কোটি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে। এর মধ্যে সবচেয়ে বেশি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে চীনে। ওই তালিকায় চতুর্থ স্থানে রয়েছে বাংলাদেশের নাম। চীনে ২৩ কোটি ৩০ লাখ ও বাংলাদেশে ৩ কোটি ৬৭ লাখ শিশু স্কুলে যাচ্ছে না। ওই তালিকায় দ্বিতীয় ও তৃতীয় স্থানে রয়েছে ইন্দোনেশিয়া ও পাকিস্তানের নাম।\r\n\r\nগত বুধবার জাতিসংঘের দুর্যোগবিষয়ক ওয়েবসাইট রিলিফ ওয়েবে প্রকাশিত এক প্রতিবেদনে এই তথ্য উঠে এসেছে। তবে সংস্থাটি এ–সংক্রান্ত সব তথ্য সংগ্রহ করেছে জাতিসংঘ শিশু তহবিলের (ইউনিসেফ) একটি প্রতিবেদন থেকে। এই পরিস্থিতিতে ইউনিসেফ থেকে বিশ্বের শিশুদের শিক্ষা পরিস্থিতি নিয়ে দুশ্চিন্তায় পড়েছে। তারা গত বৃহস্পতিবার বিশ্বের ৭৩টি দেশের শিক্ষামন্ত্রীদের সঙ্গে বৈঠক করেছে। অনলাইন বা ডিজিটাল মাধ্যমকে ব্যবহার করে এসব শিশুর কীভাবে শিক্ষা কার্যক্রম চালিয়ে নেওয়া যায়, সে বিষয়ে শিক্ষামন্ত্রীদের মতামত জানতে চেয়েছে তারা।', 'publication/3', 0, '2020-03-20 10:16:46', '2020-03-20 10:16:46'),
(19, 1, 'Admin', 16, 'App User', '2020-03-20 16:16:46', 'বিশ্বে ১০০ কোটি শিশুর স্কুলে যাওয়া বন্ধ, দেশে ৩ কোটি ৬৭ লাখ', 'মহামারি আকারে করোনাভাইরাস ছড়িয়ে পড়ায় বিশ্বব্যাপী শিক্ষাব্যবস্থা বিপর্যস্ত হয়ে পড়েছে। বিশ্বের ১১০টি দেশের সব শিক্ষাপ্রতিষ্ঠান বন্ধ হয়ে গেছে। প্রায় ১০০ কোটি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে। এর মধ্যে সবচেয়ে বেশি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে চীনে। ওই তালিকায় চতুর্থ স্থানে রয়েছে বাংলাদেশের নাম। চীনে ২৩ কোটি ৩০ লাখ ও বাংলাদেশে ৩ কোটি ৬৭ লাখ শিশু স্কুলে যাচ্ছে না। ওই তালিকায় দ্বিতীয় ও তৃতীয় স্থানে রয়েছে ইন্দোনেশিয়া ও পাকিস্তানের নাম।\r\n\r\nগত বুধবার জাতিসংঘের দুর্যোগবিষয়ক ওয়েবসাইট রিলিফ ওয়েবে প্রকাশিত এক প্রতিবেদনে এই তথ্য উঠে এসেছে। তবে সংস্থাটি এ–সংক্রান্ত সব তথ্য সংগ্রহ করেছে জাতিসংঘ শিশু তহবিলের (ইউনিসেফ) একটি প্রতিবেদন থেকে। এই পরিস্থিতিতে ইউনিসেফ থেকে বিশ্বের শিশুদের শিক্ষা পরিস্থিতি নিয়ে দুশ্চিন্তায় পড়েছে। তারা গত বৃহস্পতিবার বিশ্বের ৭৩টি দেশের শিক্ষামন্ত্রীদের সঙ্গে বৈঠক করেছে। অনলাইন বা ডিজিটাল মাধ্যমকে ব্যবহার করে এসব শিশুর কীভাবে শিক্ষা কার্যক্রম চালিয়ে নেওয়া যায়, সে বিষয়ে শিক্ষামন্ত্রীদের মতামত জানতে চেয়েছে তারা।', 'publication/3', 0, '2020-03-20 10:16:46', '2020-03-20 10:16:46'),
(23, 5, 'App User', NULL, 'Admin', '2020-04-10 21:54:29', 'Sent a message', NULL, NULL, 0, '2020-04-10 21:54:29', '2020-04-10 21:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `publication_title` varchar(255) DEFAULT '',
  `details` text,
  `publication_type` varchar(50) DEFAULT NULL,
  `authors` varchar(100) DEFAULT '',
  `attachment` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT NULL COMMENT '0: In-active, 1: Active',
  `created_by` varchar(20) DEFAULT '',
  `updated_by` varchar(20) DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `publication_title`, `details`, `publication_type`, `authors`, `attachment`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'বিশ্বে ১০০ কোটি শিশুর স্কুলে যাওয়া বন্ধ, দেশে ৩ কোটি ৬৭ লাখ', 'মহামারি আকারে করোনাভাইরাস ছড়িয়ে পড়ায় বিশ্বব্যাপী শিক্ষাব্যবস্থা বিপর্যস্ত হয়ে পড়েছে। বিশ্বের ১১০টি দেশের সব শিক্ষাপ্রতিষ্ঠান বন্ধ হয়ে গেছে। প্রায় ১০০ কোটি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে। এর মধ্যে সবচেয়ে বেশি শিশু-কিশোর স্কুলে যাওয়া বন্ধ করে দিয়েছে চীনে। ওই তালিকায় চতুর্থ স্থানে রয়েছে বাংলাদেশের নাম। চীনে ২৩ কোটি ৩০ লাখ ও বাংলাদেশে ৩ কোটি ৬৭ লাখ শিশু স্কুলে যাচ্ছে না। ওই তালিকায় দ্বিতীয় ও তৃতীয় স্থানে রয়েছে ইন্দোনেশিয়া ও পাকিস্তানের নাম।\r\n\r\nগত বুধবার জাতিসংঘের দুর্যোগবিষয়ক ওয়েবসাইট রিলিফ ওয়েবে প্রকাশিত এক প্রতিবেদনে এই তথ্য উঠে এসেছে। তবে সংস্থাটি এ–সংক্রান্ত সব তথ্য সংগ্রহ করেছে জাতিসংঘ শিশু তহবিলের (ইউনিসেফ) একটি প্রতিবেদন থেকে। এই পরিস্থিতিতে ইউনিসেফ থেকে বিশ্বের শিশুদের শিক্ষা পরিস্থিতি নিয়ে দুশ্চিন্তায় পড়েছে। তারা গত বৃহস্পতিবার বিশ্বের ৭৩টি দেশের শিক্ষামন্ত্রীদের সঙ্গে বৈঠক করেছে। অনলাইন বা ডিজিটাল মাধ্যমকে ব্যবহার করে এসব শিশুর কীভাবে শিক্ষা কার্যক্রম চালিয়ে নেওয়া যায়, সে বিষয়ে শিক্ষামন্ত্রীদের মতামত জানতে চেয়েছে তারা।', 'News', 'BILS', '', 1, 'Momit', 'Momit', '2020-03-20 10:16:46', '2020-03-30 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `publication_categories`
--

CREATE TABLE `publication_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `details` text,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `publication_categories`
--

INSERT INTO `publication_categories` (`id`, `category_name`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'News', 'this is about news', 1, '2020-03-20 10:08:14', '2020-03-20 10:08:14'),
(2, 'Corona virus', 'this is about corora virus', 1, '2020-03-20 10:08:42', '2020-03-20 10:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_mobile` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `short_name`, `site_name`, `admin_email`, `admin_mobile`, `site_url`, `admin_url`, `logo`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh Institute of Labour Studies', 'BILS', 'BILS APPLICATION', 'admin@bils.com', '01980340482', NULL, '/admin', NULL, 'Dhaka', NULL, '2020-02-03 11:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `survey_categories`
--

CREATE TABLE `survey_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `details` text,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_categories`
--

INSERT INTO `survey_categories` (`id`, `category_name`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Survey Category 1', NULL, 1, '2020-02-10 20:00:45', '2020-02-10 20:00:45'),
(3, 'Survey Category 3', 'asda', 1, '2020-02-10 20:04:45', '2020-03-04 16:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `survey_groups`
--

CREATE TABLE `survey_groups` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL COMMENT 'From app_user_groups',
  `status` tinyint(1) NOT NULL COMMENT '0: In-active, 1: Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `survey_masters`
--

CREATE TABLE `survey_masters` (
  `id` int(11) NOT NULL,
  `survey_code` varchar(100) DEFAULT NULL,
  `survey_name` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `survey_category` int(11) NOT NULL COMMENT 'From survey_categories ',
  `survey_type` int(11) NOT NULL,
  `details` text,
  `status` tinyint(1) NOT NULL COMMENT '0: Initiate, 1: Published, 2: Closed, 3: In-active',
  `created_by` int(11) NOT NULL COMMENT 'Admin User ID',
  `updated_by` int(11) NOT NULL COMMENT 'Admin User ID',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_masters`
--

INSERT INTO `survey_masters` (`id`, `survey_code`, `survey_name`, `start_date`, `end_date`, `survey_category`, `survey_type`, `details`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(21, '', 'New Survey 1', '2020-03-12', '2020-03-31', 1, 0, 'This is the test survey 1', 1, 1, 1, '2020-03-11 18:53:50', '2020-03-11 18:53:50'),
(22, '', 'New Survey 2', '2020-03-12', '2020-03-28', 1, 0, 'Test survey 2', 1, 1, 1, '2020-03-11 19:43:44', '2020-03-11 19:43:44'),
(24, NULL, 'Corona Virus', '2020-03-22', '2020-05-27', 1, 0, 'test discription', 1, 1, 1, '2020-03-20 11:08:20', '2020-03-20 11:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `survey_participants`
--

CREATE TABLE `survey_participants` (
  `id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL COMMENT 'survey participants, comes from app_users table',
  `survey_id` int(11) NOT NULL,
  `answer_date` date NOT NULL,
  `survey_completed` tinyint(1) DEFAULT NULL COMMENT '0: Not-completed, 1: Completed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_participants`
--

INSERT INTO `survey_participants` (`id`, `app_user_id`, `survey_id`, `answer_date`, `survey_completed`, `created_at`, `updated_at`) VALUES
(1, 5, 21, '2020-03-12', 0, '2020-03-12 01:15:59', NULL),
(2, 16, 21, '2020-03-12', 1, '2020-03-12 01:47:31', '2020-04-04 22:38:32'),
(3, 14, 21, '2020-03-12', 1, '2020-03-12 01:48:08', '2020-04-04 22:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `survey_participant_answers`
--

CREATE TABLE `survey_participant_answers` (
  `id` int(11) NOT NULL,
  `survey_participan_id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_participant_answers`
--

INSERT INTO `survey_participant_answers` (`id`, `survey_participan_id`, `survey_question_id`, `created_at`, `updated_at`) VALUES
(1, 1, 81, '2020-03-12 01:22:21', NULL),
(2, 1, 82, '2020-03-12 01:22:21', NULL),
(3, 1, 83, '2020-03-12 01:23:21', NULL),
(4, 1, 84, '2020-03-12 01:23:21', NULL),
(5, 1, 85, '2020-03-12 01:23:21', NULL),
(6, 1, 86, '2020-03-12 01:23:21', NULL),
(7, 2, 81, '2020-03-12 01:49:54', NULL),
(8, 2, 82, '2020-03-12 01:49:54', NULL),
(9, 2, 83, '2020-03-12 01:52:46', NULL),
(10, 2, 84, '2020-03-12 01:52:46', NULL),
(11, 2, 85, '2020-03-12 01:52:46', NULL),
(12, 2, 86, '2020-03-12 01:52:46', NULL),
(13, 3, 81, '2020-03-12 01:52:46', NULL),
(14, 3, 82, '2020-03-12 01:52:46', NULL),
(15, 3, 83, '2020-03-12 01:52:46', NULL),
(16, 3, 84, '2020-03-12 01:52:46', NULL),
(17, 3, 85, '2020-03-12 01:52:46', NULL),
(18, 3, 86, '2020-03-12 01:52:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_participant_answer_options`
--

CREATE TABLE `survey_participant_answer_options` (
  `id` int(11) NOT NULL,
  `survey_participant_answer_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT '0',
  `answer` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_participant_answer_options`
--

INSERT INTO `survey_participant_answer_options` (`id`, `survey_participant_answer_id`, `option_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Kajol', '2020-03-12 01:24:27', NULL),
(2, 2, 0, '27', '2020-03-12 01:24:27', NULL),
(3, 3, 132, '', '2020-03-12 01:35:41', NULL),
(4, 4, 134, '', '2020-03-12 01:35:41', NULL),
(5, 4, 137, '', '2020-03-12 01:35:41', NULL),
(6, 5, 140, '', '2020-03-12 01:35:41', NULL),
(7, 5, 141, '', '2020-03-12 01:35:41', NULL),
(8, 6, 145, '', '2020-03-12 01:35:41', NULL),
(9, 7, 0, 'chaki', '2020-03-12 01:54:02', NULL),
(10, 8, 0, '27', '2020-03-12 01:54:02', NULL),
(11, 9, 132, '', '2020-03-12 02:14:41', NULL),
(12, 10, 10, '134', '2020-03-12 02:14:41', NULL),
(13, 11, 140, '', '2020-03-12 02:14:41', NULL),
(14, 11, 141, '', '2020-03-12 02:14:41', NULL),
(15, 12, 147, '', '2020-03-12 02:14:41', NULL),
(16, 12, 145, '', '2020-03-12 02:14:41', NULL),
(17, 13, 0, 'Momit', '2020-03-12 02:14:41', NULL),
(18, 13, 0, '35', '2020-03-12 02:14:41', NULL),
(19, 14, 132, '', '2020-03-12 02:14:41', NULL),
(20, 15, 135, '', '2020-03-12 02:14:41', NULL),
(21, 16, 136, '', '2020-03-12 02:14:41', NULL),
(22, 17, 142, '', '2020-03-12 02:14:41', NULL),
(23, 17, 143, '', '2020-03-12 02:14:41', NULL),
(24, 18, 147, '', '2020-03-12 02:14:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_details` text,
  `question_type` int(11) DEFAULT NULL COMMENT '1: text 2: number ;3:radio ;3:checkbox',
  `display_option` tinyint(1) DEFAULT NULL COMMENT '1: Row, 2: Single Column, 3: Multiple Column',
  `serial` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `survey_id`, `question_details`, `question_type`, `display_option`, `serial`, `created_at`, `updated_at`) VALUES
(81, 21, 'Name', 1, 1, 1, '2020-03-11 18:54:05', '2020-03-20 10:23:00'),
(82, 21, 'Age', 2, 1, 2, '2020-03-11 18:54:22', '2020-03-11 18:54:22'),
(83, 21, 'What is your Profession?', 3, 2, 3, '2020-03-11 18:55:07', '2020-03-11 18:55:07'),
(84, 21, 'Which are your favourite food?', 4, 3, 4, '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(85, 21, 'Which are your favourite fruits?', 4, 3, 5, '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(86, 21, 'Which place do you like to visit on vacation?', 4, 2, 6, '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(87, 22, 'Name', 1, 1, 1, '2020-03-11 19:43:58', '2020-03-11 19:43:58'),
(88, 22, 'Age', 2, 1, 2, '2020-03-11 19:44:37', '2020-03-11 19:44:37'),
(89, 22, 'What is your Favourite Drink?', 3, 3, 3, '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(90, 24, 'What is your name', 1, 1, 1, '2020-03-20 11:09:24', '2020-03-20 11:09:24'),
(91, 24, 'What is your occupation?', 3, 3, 2, '2020-03-20 11:11:49', '2020-03-20 11:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_answer_options`
--

CREATE TABLE `survey_question_answer_options` (
  `id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL DEFAULT '0',
  `answer_option` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `survey_question_answer_options`
--

INSERT INTO `survey_question_answer_options` (`id`, `survey_question_id`, `answer_option`, `created_at`, `updated_at`) VALUES
(94, 69, 'dfdfdf', '2020-03-06 17:40:24', '2020-03-06 17:41:07'),
(95, 69, 'dfdfdfd', '2020-03-06 17:40:24', '2020-03-06 17:41:07'),
(96, 69, 'sfdsfdsf', '2020-03-06 17:40:35', '2020-03-06 17:41:07'),
(98, 69, 'fffff', '2020-03-06 17:41:07', '2020-03-06 17:41:07'),
(130, 83, 'Student', '2020-03-11 18:55:07', '2020-03-11 18:55:07'),
(131, 83, 'Teacher', '2020-03-11 18:55:07', '2020-03-11 18:55:07'),
(132, 83, 'Job Holder', '2020-03-11 18:55:07', '2020-03-11 18:55:07'),
(133, 83, 'Banker', '2020-03-11 18:55:07', '2020-03-11 18:55:07'),
(134, 84, 'Mutton Kaschi', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(135, 84, 'Beef Kaschi', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(136, 84, 'Teheri', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(137, 84, 'Pizza', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(138, 84, 'Burgur', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(139, 84, 'Kichuri', '2020-03-11 18:56:46', '2020-03-11 18:56:46'),
(140, 85, 'Mango', '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(141, 85, 'Apple', '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(142, 85, 'Banana', '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(143, 85, 'Grapes', '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(144, 85, 'Goava', '2020-03-11 18:58:13', '2020-03-11 18:58:13'),
(145, 86, 'Cox\'s Bazzar', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(146, 86, 'Bandarban', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(147, 86, 'Sylet', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(148, 86, 'Bagura', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(149, 86, 'Sundorbon', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(150, 86, 'Others', '2020-03-11 18:59:50', '2020-03-11 18:59:50'),
(151, 89, 'CocaCola', '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(152, 89, 'Sprite', '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(153, 89, 'Fanta', '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(154, 89, 'Marinda', '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(155, 89, 'Speed', '2020-03-11 19:46:09', '2020-03-11 19:46:09'),
(156, 91, 'Student', '2020-03-20 11:11:49', '2020-03-20 11:11:49'),
(157, 91, 'Job holder', '2020-03-20 11:11:49', '2020-03-20 11:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1:admin, 2:app-use, 3: teaher',
  `status` tinyint(1) NOT NULL COMMENT '0:  In-active, 1: Active, 2: Deleted',
  `remarks` text,
  `user_profile_image` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `contact_no`, `nid`, `address`, `user_type`, `status`, `remarks`, `user_profile_image`, `updated_at`) VALUES
(1, 'Teacher 1', 'teacher1@gmail.com', '1234', '1234', 'address1', 3, 1, 'This is teacher 1 profile details.', '', '2020-03-27 14:29:42'),
(4, 'Teacher 2', 'teacher2@gmail.com', '123', '1234', 'address 2', 3, 1, '', '', '2020-03-27 19:03:38'),
(5, 'Teacher 3', 'teacher3@gmail.com', '1111', '11111', NULL, 3, 1, '', '', '2020-03-27 19:03:41'),
(6, 'Tecer 4', 'teacher4@gmail.com', '444', '444', 'gabtali', 3, 1, 'asdfghjkl;', '1585338012.jpg', '2020-03-27 13:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nid_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(1) DEFAULT '1' COMMENT '1:admin user , 2:App user, 3: Teacher',
  `user_profile_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_status` tinyint(1) DEFAULT NULL COMMENT '1:logged in, 0 not logged in',
  `status` tinyint(1) DEFAULT NULL COMMENT '1:active, 0:in-active, 2: Deteted',
  `remarks` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nid_no`, `contact_no`, `email`, `address`, `user_type`, `user_profile_image`, `password`, `remember_token`, `login_status`, `status`, `remarks`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Momit', '12345', '01980340482', 'momit@bils.com', 'Mohammadpur,dhaka', 1, '1585081916.jpg', '$2y$10$ta1BmsLnz8H4tUqFJHI8puHxhCldn9DSwVfQjc3g59v9YSxM7.Trq', NULL, 0, 1, 'He is good enough', '2020-01-24 11:30:45', '2020-01-24 00:51:31', '2020-04-26 21:02:08'),
(39, 'SiaM', '1231', '01747083028', 'siam@gmail.com', 'asdasdas', 1, '1584702052.jpg', '$2y$10$ta1BmsLnz8H4tUqFJHI8puHxhCldn9DSwVfQjc3g59v9YSxM7.Trq', NULL, 0, 1, 'asdasd', NULL, '2020-03-19 07:16:15', '2020-03-24 13:50:52'),
(40, 'Mizanur Rahman', '1231231', '0123123', 'mizanur@gmail.com', NULL, 1, '', NULL, NULL, NULL, 1, 'asfsafsafasfas', NULL, '2020-03-19 07:29:16', '2020-03-21 14:35:38'),
(41, 'Mr Chaki', '2121', '01757808214', 'chaki@gmail.com', NULL, 1, '', NULL, NULL, NULL, 1, 'sgsdgsdgdsfg sdfgd f sg sdgsda', NULL, '2020-03-19 07:29:42', '2020-03-21 14:35:53'),
(42, 'Teacher 1', '1234', '1234', 'teacher1@gmail.com', 'address1', 1, '', NULL, NULL, NULL, 1, 'This is teacher 1 profile details.', NULL, '2020-03-20 02:10:30', '2020-03-27 14:29:42'),
(45, 'Teacher 2', '1234', '123', 'teacher2@gmail.com', 'address 2', 3, '', NULL, NULL, NULL, 1, '', NULL, '2020-03-20 02:28:24', '2020-03-27 19:42:19'),
(60, 'admin 1', '111', '111', 'admin1@gmail.com', NULL, 1, '', NULL, NULL, NULL, 1, '', NULL, '2020-03-20 04:26:38', '2020-03-27 19:04:17'),
(61, 'Teacher 3', '11111', '1111', 'teacher3@gmail.com', NULL, 3, '', NULL, NULL, NULL, 0, '', NULL, '2020-03-20 05:12:26', '2020-03-27 19:42:14'),
(62, 'Tecer 4', '444', '444', 'teacher4@gmail.com', 'gabtali', 3, '1585338012.jpg', NULL, NULL, NULL, 1, 'asdfghjkl;', NULL, '2020-03-27 13:23:46', '2020-03-27 19:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Admin User, 2: App User',
  `status` int(11) NOT NULL COMMENT '1: Active, 0: In-active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(26, 'Super Admin', 1, 1, '2020-02-08 05:39:02', '2020-03-19 07:00:03'),
(36, 'Admin', 1, 1, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(37, 'Teacher', 1, 1, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(38, 'Survey', 1, 1, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(39, 'Genarel', 2, 1, '2020-03-19 07:02:26', '2020-03-21 22:14:55'),
(40, 'Leader', 2, 1, '2020-03-19 07:02:58', '2020-03-19 07:02:58'),
(41, 'Worker', 2, 1, '2020-03-19 07:03:04', '2020-03-19 07:03:04'),
(44, 'test', 2, 1, '2020-03-21 17:55:41', '2020-03-21 17:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_members`
--

CREATE TABLE `user_group_members` (
  `id` int(11) NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0 : no access, 1 : access',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `user_group_members`
--

INSERT INTO `user_group_members` (`id`, `emp_id`, `group_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 26, 1, '2020-02-09 07:27:08', '2020-03-21 20:35:06'),
(29, 1, 36, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(30, 1, 37, 0, '2020-03-19 07:00:20', '2020-03-19 13:05:23'),
(31, 1, 38, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(32, 39, 37, 1, '2020-03-19 07:16:15', '2020-03-24 19:50:52'),
(33, 40, 38, 1, '2020-03-19 07:29:16', '2020-03-21 20:35:38'),
(34, 41, 36, 1, '2020-03-19 07:29:42', '2020-03-21 21:22:05'),
(35, 45, 37, 1, '2020-03-20 02:28:24', '2020-03-20 02:28:24'),
(44, 60, 26, 0, '2020-03-20 04:26:38', '2020-03-20 04:26:38'),
(45, 60, 36, 1, '2020-03-20 04:26:38', '2020-03-20 11:00:07'),
(46, 60, 37, 0, '2020-03-20 04:26:38', '2020-03-20 04:26:38'),
(47, 60, 38, 0, '2020-03-20 04:26:38', '2020-03-20 04:26:38'),
(48, 39, 36, 0, '2020-03-20 11:02:36', NULL),
(49, 39, 26, 0, '2020-03-20 11:03:17', '2020-03-20 11:03:22'),
(50, 39, 38, 0, '2020-03-20 11:03:45', NULL),
(51, 40, 36, 0, '2020-03-20 11:04:46', NULL),
(52, 40, 26, 0, '2020-03-20 11:05:00', NULL),
(53, 40, 37, 0, '2020-03-20 11:05:21', NULL),
(54, 41, 26, 0, '2020-03-20 11:06:02', NULL),
(55, 41, 37, 0, '2020-03-20 11:06:16', NULL),
(56, 41, 38, 1, '2020-03-20 11:06:27', '2020-03-21 21:22:05'),
(57, 45, 36, 0, '2020-03-20 11:06:46', NULL),
(58, 45, 26, 0, '2020-03-20 11:06:57', NULL),
(59, 45, 38, 0, '2020-03-20 11:07:18', NULL),
(60, 61, 37, 1, '2020-03-20 05:12:26', '2020-03-20 11:25:27'),
(61, 61, 26, 0, '2020-03-20 05:12:26', '2020-03-20 05:12:26'),
(62, 61, 36, 0, '2020-03-20 05:12:26', '2020-03-20 05:12:26'),
(63, 61, 38, 0, '2020-03-20 05:12:26', '2020-03-20 05:12:26'),
(64, 62, 37, 1, '2020-03-27 13:23:46', '2020-03-27 13:23:46'),
(65, 62, 26, 0, '2020-03-27 13:23:46', '2020-03-27 13:23:46'),
(66, 62, 36, 0, '2020-03-27 13:23:46', '2020-03-27 13:23:46'),
(67, 62, 38, 0, '2020-03-27 13:23:46', '2020-03-27 13:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE `user_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `action_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL COMMENT '0: Not Permit, 1: Permit',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `group_id`, `action_id`, `status`, `created_at`, `updated_at`) VALUES
(19, 26, 1, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(20, 26, 2, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(21, 26, 4, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(22, 26, 6, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(23, 26, 7, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(24, 26, 8, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(25, 26, 9, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(26, 26, 10, 1, '2020-02-08 05:39:02', '2020-04-04 08:10:35'),
(60, 26, 24, 1, '2020-02-17 07:46:51', '2020-04-04 08:10:35'),
(66, 26, 25, 1, '2020-02-18 00:17:38', '2020-04-04 08:10:35'),
(72, 26, 26, 1, '2020-02-18 00:23:30', '2020-04-04 08:10:35'),
(78, 26, 27, 1, '2020-02-18 00:37:34', '2020-04-04 08:10:35'),
(84, 26, 28, 1, '2020-02-18 00:44:36', '2020-04-04 08:10:35'),
(90, 26, 29, 1, '2020-02-18 00:47:38', '2020-04-04 08:10:35'),
(96, 26, 30, 1, '2020-02-18 00:48:40', '2020-04-04 08:10:35'),
(102, 26, 31, 1, '2020-02-18 00:48:55', '2020-04-04 08:10:35'),
(108, 26, 32, 1, '2020-02-18 00:51:12', '2020-04-04 08:10:35'),
(114, 26, 33, 1, '2020-02-18 01:12:07', '2020-04-04 08:10:35'),
(120, 26, 34, 1, '2020-02-18 01:14:20', '2020-04-04 08:10:35'),
(126, 26, 35, 1, '2020-02-18 01:34:40', '2020-04-04 08:10:35'),
(132, 26, 36, 1, '2020-02-18 01:36:01', '2020-04-04 08:10:35'),
(138, 26, 37, 1, '2020-02-18 01:46:54', '2020-04-04 08:10:35'),
(144, 26, 38, 1, '2020-02-18 01:47:10', '2020-04-04 08:10:35'),
(150, 26, 39, 1, '2020-02-18 02:21:39', '2020-04-04 08:10:35'),
(156, 26, 40, 1, '2020-02-18 02:26:01', '2020-04-04 08:10:35'),
(162, 26, 41, 1, '2020-02-18 02:37:37', '2020-04-04 08:10:35'),
(168, 26, 42, 1, '2020-02-18 02:49:36', '2020-04-04 08:10:35'),
(174, 26, 43, 1, '2020-02-18 02:49:48', '2020-04-04 08:10:35'),
(180, 26, 44, 1, '2020-02-18 03:02:37', '2020-04-04 08:10:35'),
(186, 26, 45, 1, '2020-02-18 03:02:55', '2020-04-04 08:10:35'),
(192, 26, 46, 1, '2020-02-18 03:03:06', '2020-04-04 08:10:35'),
(198, 26, 47, 1, '2020-02-18 03:03:18', '2020-04-04 08:10:35'),
(204, 26, 48, 1, '2020-02-18 03:13:35', '2020-04-04 08:10:35'),
(210, 26, 49, 1, '2020-02-18 03:14:00', '2020-04-04 08:10:35'),
(216, 26, 50, 1, '2020-02-18 03:14:15', '2020-04-04 08:10:35'),
(222, 26, 51, 1, '2020-02-18 03:14:26', '2020-04-04 08:10:35'),
(228, 26, 52, 1, '2020-02-18 03:25:01', '2020-04-04 08:10:35'),
(234, 26, 53, 1, '2020-02-18 03:25:15', '2020-04-04 08:10:35'),
(240, 26, 54, 1, '2020-02-18 03:25:30', '2020-04-04 08:10:35'),
(246, 26, 55, 1, '2020-02-18 03:25:43', '2020-04-04 08:10:35'),
(252, 26, 56, 1, '2020-02-18 03:32:33', '2020-04-04 08:10:35'),
(258, 26, 57, 1, '2020-02-18 03:32:46', '2020-04-04 08:10:35'),
(264, 26, 58, 1, '2020-02-18 03:32:55', '2020-04-04 08:10:35'),
(270, 26, 59, 1, '2020-02-18 03:33:07', '2020-04-04 08:10:35'),
(276, 26, 60, 1, '2020-02-18 03:39:22', '2020-04-04 08:10:35'),
(282, 26, 61, 1, '2020-02-18 03:39:33', '2020-04-04 08:10:35'),
(288, 26, 62, 1, '2020-02-18 03:39:44', '2020-04-04 08:10:35'),
(294, 26, 63, 1, '2020-02-18 03:40:00', '2020-04-04 08:10:35'),
(300, 26, 64, 1, '2020-02-18 05:23:13', '2020-04-04 08:10:35'),
(306, 26, 65, 1, '2020-02-18 05:38:26', '2020-04-04 08:10:35'),
(312, 26, 66, 1, '2020-02-18 05:38:38', '2020-04-04 08:10:35'),
(318, 26, 67, 1, '2020-02-18 05:38:50', '2020-04-04 08:10:35'),
(376, 26, 68, 1, '2020-02-22 04:02:39', '2020-04-04 08:10:35'),
(383, 26, 69, 1, '2020-02-22 04:06:07', '2020-04-04 08:10:35'),
(390, 26, 70, 1, '2020-02-22 04:06:25', '2020-04-04 08:10:35'),
(397, 26, 71, 1, '2020-02-22 04:06:50', '2020-04-04 08:10:35'),
(404, 26, 72, 1, '2020-02-29 00:45:50', '2020-04-04 08:10:35'),
(411, 26, 73, 1, '2020-02-29 00:46:46', '2020-04-04 08:10:35'),
(418, 26, 74, 1, '2020-02-29 00:46:56', '2020-04-04 08:10:35'),
(425, 26, 75, 1, '2020-02-29 00:47:04', '2020-04-04 08:10:35'),
(432, 26, 76, 1, '2020-03-02 03:25:05', '2020-04-04 08:10:35'),
(439, 26, 77, 1, '2020-03-02 03:25:28', '2020-04-04 08:10:35'),
(474, 26, 82, 1, '2020-03-03 05:25:01', '2020-04-04 08:10:35'),
(481, 26, 83, 1, '2020-03-03 05:25:10', '2020-04-04 08:10:35'),
(488, 26, 84, 1, '2020-03-03 05:25:19', '2020-04-04 08:10:35'),
(495, 26, 85, 1, '2020-03-03 05:25:29', '2020-04-04 08:10:35'),
(634, 26, 86, 1, '2020-03-07 01:22:25', '2020-04-04 08:10:35'),
(643, 26, 87, 1, '2020-03-07 01:22:40', '2020-04-04 08:10:35'),
(652, 26, 88, 1, '2020-03-07 04:14:47', '2020-04-04 08:10:35'),
(661, 26, 89, 1, '2020-03-07 04:15:10', '2020-04-04 08:10:35'),
(670, 26, 90, 1, '2020-03-07 04:15:24', '2020-04-04 08:10:35'),
(679, 26, 91, 1, '2020-03-07 04:15:39', '2020-04-04 08:10:35'),
(688, 26, 92, 1, '2020-03-09 01:54:34', '2020-04-04 08:10:35'),
(697, 26, 93, 1, '2020-03-09 01:54:59', '2020-04-04 08:10:35'),
(779, 36, 1, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(780, 36, 2, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(781, 36, 4, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(782, 36, 6, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(783, 36, 7, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(784, 36, 8, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(785, 36, 9, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(786, 36, 10, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(787, 36, 27, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(788, 36, 28, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(789, 36, 86, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(790, 36, 87, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(791, 36, 24, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(792, 36, 25, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(793, 36, 26, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(794, 36, 76, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(795, 36, 77, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(796, 36, 88, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(797, 36, 89, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(798, 36, 90, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(799, 36, 91, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(800, 36, 92, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(801, 36, 93, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(802, 36, 29, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(803, 36, 30, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(804, 36, 31, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(805, 36, 32, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(806, 36, 33, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(807, 36, 34, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(808, 36, 35, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(809, 36, 36, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(810, 36, 37, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(811, 36, 38, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(812, 36, 39, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(813, 36, 40, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(814, 36, 41, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(815, 36, 42, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(816, 36, 43, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(817, 36, 44, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(818, 36, 45, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(819, 36, 46, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(820, 36, 47, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(821, 36, 48, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(822, 36, 49, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(823, 36, 50, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(824, 36, 51, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(825, 36, 52, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(826, 36, 53, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(827, 36, 54, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(828, 36, 55, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(829, 36, 56, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(830, 36, 57, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(831, 36, 58, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(832, 36, 59, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(833, 36, 60, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(834, 36, 61, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(835, 36, 62, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(836, 36, 63, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(837, 36, 82, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(838, 36, 83, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(839, 36, 84, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(840, 36, 85, 0, '2020-03-19 07:00:12', '2020-03-19 07:00:12'),
(841, 36, 72, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(842, 36, 73, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(843, 36, 74, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(844, 36, 75, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(845, 36, 64, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(846, 36, 65, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(847, 36, 66, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(848, 36, 67, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(849, 36, 68, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(850, 36, 69, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(851, 36, 70, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(852, 36, 71, 1, '2020-03-19 07:00:12', '2020-03-19 13:31:47'),
(853, 37, 1, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(854, 37, 2, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(855, 37, 4, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(856, 37, 6, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(857, 37, 7, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(858, 37, 8, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(859, 37, 9, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(860, 37, 10, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(861, 37, 27, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(862, 37, 28, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(863, 37, 86, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(864, 37, 87, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(865, 37, 24, 1, '2020-03-19 07:00:20', '2020-03-19 13:33:08'),
(866, 37, 25, 1, '2020-03-19 07:00:20', '2020-03-19 13:33:08'),
(867, 37, 26, 1, '2020-03-19 07:00:20', '2020-03-19 13:33:08'),
(868, 37, 76, 1, '2020-03-19 07:00:20', '2020-03-19 13:33:08'),
(869, 37, 77, 1, '2020-03-19 07:00:20', '2020-03-19 13:33:08'),
(870, 37, 88, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(871, 37, 89, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(872, 37, 90, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(873, 37, 91, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(874, 37, 92, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(875, 37, 93, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(876, 37, 29, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(877, 37, 30, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(878, 37, 31, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(879, 37, 32, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(880, 37, 33, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(881, 37, 34, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(882, 37, 35, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(883, 37, 36, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(884, 37, 37, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(885, 37, 38, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(886, 37, 39, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(887, 37, 40, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(888, 37, 41, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(889, 37, 42, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(890, 37, 43, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(891, 37, 44, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(892, 37, 45, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(893, 37, 46, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(894, 37, 47, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(895, 37, 48, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(896, 37, 49, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(897, 37, 50, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(898, 37, 51, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(899, 37, 52, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(900, 37, 53, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(901, 37, 54, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(902, 37, 55, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(903, 37, 56, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(904, 37, 57, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(905, 37, 58, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(906, 37, 59, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(907, 37, 60, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(908, 37, 61, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(909, 37, 62, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(910, 37, 63, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(911, 37, 82, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(912, 37, 83, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(913, 37, 84, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(914, 37, 85, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(915, 37, 72, 0, '2020-03-19 07:00:20', '2020-03-19 07:00:20'),
(916, 37, 73, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(917, 37, 74, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(918, 37, 75, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(919, 37, 64, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(920, 37, 65, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(921, 37, 66, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(922, 37, 67, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(923, 37, 68, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(924, 37, 69, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(925, 37, 70, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(926, 37, 71, 0, '2020-03-19 07:00:21', '2020-03-19 07:00:21'),
(927, 38, 1, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(928, 38, 2, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(929, 38, 4, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(930, 38, 6, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(931, 38, 7, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(932, 38, 8, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(933, 38, 9, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(934, 38, 10, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(935, 38, 27, 1, '2020-03-19 07:00:27', '2020-03-19 13:34:28'),
(936, 38, 28, 1, '2020-03-19 07:00:27', '2020-03-19 13:34:28'),
(937, 38, 86, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(938, 38, 87, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(939, 38, 24, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(940, 38, 25, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(941, 38, 26, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(942, 38, 76, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(943, 38, 77, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(944, 38, 88, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(945, 38, 89, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(946, 38, 90, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(947, 38, 91, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(948, 38, 92, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(949, 38, 93, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(950, 38, 29, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(951, 38, 30, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(952, 38, 31, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(953, 38, 32, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(954, 38, 33, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(955, 38, 34, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(956, 38, 35, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(957, 38, 36, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(958, 38, 37, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(959, 38, 38, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(960, 38, 39, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(961, 38, 40, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(962, 38, 41, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(963, 38, 42, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(964, 38, 43, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(965, 38, 44, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(966, 38, 45, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(967, 38, 46, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(968, 38, 47, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(969, 38, 48, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(970, 38, 49, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(971, 38, 50, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(972, 38, 51, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(973, 38, 52, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(974, 38, 53, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(975, 38, 54, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(976, 38, 55, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(977, 38, 56, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(978, 38, 57, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(979, 38, 58, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(980, 38, 59, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(981, 38, 60, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(982, 38, 61, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(983, 38, 62, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(984, 38, 63, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(985, 38, 82, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(986, 38, 83, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(987, 38, 84, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(988, 38, 85, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(989, 38, 72, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(990, 38, 73, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(991, 38, 74, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(992, 38, 75, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(993, 38, 64, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(994, 38, 65, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(995, 38, 66, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(996, 38, 67, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(997, 38, 68, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(998, 38, 69, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(999, 38, 70, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(1000, 38, 71, 0, '2020-03-19 07:00:27', '2020-03-19 07:00:27'),
(1001, 26, 94, 1, '2020-04-04 01:49:39', '2020-04-04 08:10:35'),
(1002, 36, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1003, 37, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1004, 38, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1005, 39, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1006, 40, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1007, 41, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39'),
(1008, 44, 94, 0, '2020-04-04 01:49:39', '2020-04-04 01:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `web_actions`
--

CREATE TABLE `web_actions` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:active, 0:inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `web_actions`
--

INSERT INTO `web_actions` (`id`, `activity_name`, `module_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Users', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(2, 'Admin User Entry', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(4, 'Admin User update', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(6, 'Admin User delete', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(7, 'App Users', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(8, 'App User Entry', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(9, 'App User update', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(10, 'App User delete', 1, 1, '0000-00-00 00:00:00', '2020-02-05 08:13:21'),
(24, 'Open Course', 7, 1, '2020-02-17 07:46:50', '2020-02-17 07:46:50'),
(25, 'Course', 7, 1, '2020-02-18 00:17:38', '2020-02-18 00:17:38'),
(26, 'Course Entry', 7, 1, '2020-02-18 00:23:30', '2020-03-02 03:16:59'),
(27, 'Survey', 6, 1, '2020-02-18 00:37:34', '2020-02-18 00:37:34'),
(28, 'Add Survey', 6, 1, '2020-02-18 00:44:35', '2020-02-18 00:44:35'),
(29, 'Control Panel', 10, 1, '2020-02-18 00:47:38', '2020-02-18 00:47:38'),
(30, 'Web Actions Entry', 10, 1, '2020-02-18 00:48:40', '2020-02-18 00:48:40'),
(31, 'Web Actions Update', 10, 1, '2020-02-18 00:48:55', '2020-02-18 00:48:55'),
(32, 'Web Actions Management', 10, 1, '2020-02-18 00:51:12', '2020-02-18 00:51:12'),
(33, 'General Setting Management', 10, 1, '2020-02-18 01:12:07', '2020-02-18 01:12:07'),
(34, 'General Setting Update', 10, 1, '2020-02-18 01:14:20', '2020-02-18 01:14:20'),
(35, 'Manage Module', 10, 1, '2020-02-18 01:34:40', '2020-02-18 01:34:40'),
(36, 'Add Module', 10, 1, '2020-02-18 01:36:01', '2020-02-18 01:36:01'),
(37, 'Update Module', 10, 1, '2020-02-18 01:46:54', '2020-02-18 01:46:54'),
(38, 'Delete Module', 10, 1, '2020-02-18 01:47:10', '2020-02-18 01:47:10'),
(39, 'Admin User Group Management', 26, 1, '2020-02-18 02:21:39', '2020-02-18 02:21:39'),
(40, 'Admin User Group Entry', 26, 1, '2020-02-18 02:26:01', '2020-02-18 02:26:01'),
(41, 'Give Permission To Admin User', 26, 1, '2020-02-18 02:37:37', '2020-02-18 02:37:37'),
(42, 'Admin User Group Update', 26, 1, '2020-02-18 02:49:36', '2020-02-18 02:49:36'),
(43, 'Admin User Group Delete', 26, 1, '2020-02-18 02:49:47', '2020-02-18 02:49:47'),
(44, 'App User Group Management', 26, 1, '2020-02-18 03:02:37', '2020-02-18 03:02:37'),
(45, 'App User Group Entry', 26, 1, '2020-02-18 03:02:55', '2020-02-18 03:02:55'),
(46, 'App User Group Update', 26, 1, '2020-02-18 03:03:06', '2020-02-18 03:03:06'),
(47, 'App User Group Delete', 26, 1, '2020-02-18 03:03:18', '2020-02-18 03:03:18'),
(48, 'Publication Category', 26, 1, '2020-02-18 03:13:35', '2020-02-18 03:13:35'),
(49, 'Publication Category Entry', 26, 1, '2020-02-18 03:14:00', '2020-02-18 03:14:00'),
(50, 'Publication Category Update', 26, 1, '2020-02-18 03:14:15', '2020-02-18 03:14:15'),
(51, 'Publication Category Delete', 26, 1, '2020-02-18 03:14:26', '2020-02-18 03:14:26'),
(52, 'Course Category', 26, 1, '2020-02-18 03:25:01', '2020-02-18 03:25:01'),
(53, 'Course Category Entry', 26, 1, '2020-02-18 03:25:15', '2020-02-18 03:25:15'),
(54, 'Course Category Update', 26, 1, '2020-02-18 03:25:30', '2020-02-18 03:25:30'),
(55, 'Course Category Delete', 26, 1, '2020-02-18 03:25:43', '2020-02-18 03:25:43'),
(56, 'Notice Category', 26, 1, '2020-02-18 03:32:33', '2020-02-18 03:32:33'),
(57, 'Notice Category Entry', 26, 1, '2020-02-18 03:32:46', '2020-02-18 03:32:46'),
(58, 'Notice Category update', 26, 1, '2020-02-18 03:32:55', '2020-02-18 03:32:55'),
(59, 'Notice Category Delete', 26, 1, '2020-02-18 03:33:07', '2020-02-18 03:33:07'),
(60, 'Survey Category', 26, 1, '2020-02-18 03:39:22', '2020-02-18 03:39:22'),
(61, 'Survey Category Entry', 26, 1, '2020-02-18 03:39:33', '2020-02-18 03:39:33'),
(62, 'Survey Category Update', 26, 1, '2020-02-18 03:39:44', '2020-02-18 03:39:44'),
(63, 'Survey Category Delete', 26, 1, '2020-02-18 03:40:00', '2020-02-18 03:40:00'),
(64, 'Manage Notice', 37, 1, '2020-02-18 05:23:13', '2020-02-18 05:23:13'),
(65, 'Notice Entry', 37, 1, '2020-02-18 05:38:26', '2020-02-18 05:38:26'),
(66, 'Notice Update', 37, 1, '2020-02-18 05:38:38', '2020-02-18 05:38:38'),
(67, 'Notice Delete', 37, 1, '2020-02-18 05:38:50', '2020-02-18 05:38:50'),
(68, 'Publication', 38, 1, '2020-02-22 04:02:39', '2020-02-22 04:02:39'),
(69, 'Publication Entry', 38, 1, '2020-02-22 04:06:07', '2020-02-22 04:06:07'),
(70, 'Publication Update', 38, 1, '2020-02-22 04:06:25', '2020-02-22 04:06:25'),
(71, 'Publication Delete', 38, 1, '2020-02-22 04:06:50', '2020-02-22 04:06:50'),
(72, 'Message Manage', 29, 1, '2020-02-29 00:45:50', '2020-02-29 00:45:50'),
(73, 'Message Entry', 29, 1, '2020-02-29 00:46:46', '2020-02-29 00:46:46'),
(74, 'Message Update', 29, 1, '2020-02-29 00:46:56', '2020-02-29 00:46:56'),
(75, 'Message Delete', 29, 1, '2020-02-29 00:47:04', '2020-02-29 00:47:04'),
(76, 'Course Update', 7, 1, '2020-03-02 03:25:05', '2020-03-02 03:25:05'),
(77, 'Course Delete', 7, 1, '2020-03-02 03:25:27', '2020-03-02 03:25:27'),
(82, 'Message Category', 26, 1, '2020-03-03 05:25:01', '2020-03-03 05:25:01'),
(83, 'Message Category Entry', 26, 1, '2020-03-03 05:25:10', '2020-03-03 05:25:10'),
(84, 'Message Category Update', 26, 1, '2020-03-03 05:25:19', '2020-03-03 05:25:19'),
(85, 'Message Category Delete', 26, 1, '2020-03-03 05:25:29', '2020-03-03 05:25:29'),
(86, 'Survey Update', 6, 1, '2020-03-07 01:22:25', '2020-03-07 01:23:40'),
(87, 'Survey Delete', 6, 1, '2020-03-07 01:22:40', '2020-03-07 01:22:40'),
(88, 'Manage Teacher', 7, 1, '2020-03-07 04:14:47', '2020-03-07 04:14:47'),
(89, 'Teacher Entry', 7, 1, '2020-03-07 04:15:10', '2020-03-07 04:15:10'),
(90, 'Teacher Update', 7, 1, '2020-03-07 04:15:24', '2020-03-07 04:15:24'),
(91, 'Teacher Delete', 7, 1, '2020-03-07 04:15:39', '2020-03-07 04:15:39'),
(92, 'Publish Course', 7, 1, '2020-03-09 01:54:34', '2020-03-09 01:54:34'),
(93, 'Select Perticipant', 7, 1, '2020-03-09 01:54:59', '2020-03-09 01:54:59'),
(94, 'Group Message Manage', 29, 1, '2020-04-04 01:49:39', '2020-04-04 01:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `app_user_group_members`
--
ALTER TABLE `app_user_group_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Index 2` (`group_id`,`app_user_id`),
  ADD KEY `FK_app_user_group_members_app_users` (`app_user_id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_masters`
--
ALTER TABLE `course_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_perticipants`
--
ALTER TABLE `course_perticipants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_attachments`
--
ALTER TABLE `message_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_categories`
--
ALTER TABLE `message_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_masters`
--
ALTER TABLE `message_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_message_masters_app_users` (`app_user_id`),
  ADD KEY `FK_message_masters_users` (`admin_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_categories`
--
ALTER TABLE `notice_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publication_categories`
--
ALTER TABLE `publication_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_categories`
--
ALTER TABLE `survey_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_groups`
--
ALTER TABLE `survey_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_masters`
--
ALTER TABLE `survey_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_participants`
--
ALTER TABLE `survey_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_participant_answers`
--
ALTER TABLE `survey_participant_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_participant_answer_options`
--
ALTER TABLE `survey_participant_answer_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question_answer_options`
--
ALTER TABLE `survey_question_answer_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_members`
--
ALTER TABLE `user_group_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Index 4` (`emp_id`,`group_id`),
  ADD KEY `FK_user_group_members_user_groups` (`group_id`);

--
-- Indexes for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Index 2` (`group_id`,`action_id`),
  ADD KEY `FK_user_group_permission_web_actions` (`action_id`);

--
-- Indexes for table `web_actions`
--
ALTER TABLE `web_actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activity_name_module_id` (`activity_name`,`module_id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `app_user_group_members`
--
ALTER TABLE `app_user_group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_masters`
--
ALTER TABLE `course_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_perticipants`
--
ALTER TABLE `course_perticipants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `message_attachments`
--
ALTER TABLE `message_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message_categories`
--
ALTER TABLE `message_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message_masters`
--
ALTER TABLE `message_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notice_categories`
--
ALTER TABLE `notice_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publication_categories`
--
ALTER TABLE `publication_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_categories`
--
ALTER TABLE `survey_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_groups`
--
ALTER TABLE `survey_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_masters`
--
ALTER TABLE `survey_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `survey_participants`
--
ALTER TABLE `survey_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_participant_answers`
--
ALTER TABLE `survey_participant_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `survey_participant_answer_options`
--
ALTER TABLE `survey_participant_answer_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `survey_question_answer_options`
--
ALTER TABLE `survey_question_answer_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_group_members`
--
ALTER TABLE `user_group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `web_actions`
--
ALTER TABLE `web_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_user_group_members`
--
ALTER TABLE `app_user_group_members`
  ADD CONSTRAINT `FK_app_user_group_members_app_users` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`),
  ADD CONSTRAINT `FK_app_user_group_members_user_groups` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`);

--
-- Constraints for table `message_masters`
--
ALTER TABLE `message_masters`
  ADD CONSTRAINT `FK_message_masters_app_users` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`),
  ADD CONSTRAINT `FK_message_masters_users` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_group_members`
--
ALTER TABLE `user_group_members`
  ADD CONSTRAINT `FK_user_group_members_user_groups` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`),
  ADD CONSTRAINT `FK_user_group_members_users` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_group_permissions`
--
ALTER TABLE `user_group_permissions`
  ADD CONSTRAINT `FK_user_group_permission_user_group` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`),
  ADD CONSTRAINT `FK_user_group_permission_web_actions` FOREIGN KEY (`action_id`) REFERENCES `web_actions` (`id`);

--
-- Constraints for table `web_actions`
--
ALTER TABLE `web_actions`
  ADD CONSTRAINT `FK_web_actions_menus` FOREIGN KEY (`module_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
