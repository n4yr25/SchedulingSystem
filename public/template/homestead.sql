-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 04:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_programs`
--

CREATE TABLE `academic_programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `academic_type` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `program_code` varchar(255) DEFAULT NULL,
  `program_name` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `strand` varchar(255) DEFAULT NULL,
  `strand_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_programs`
--

INSERT INTO `academic_programs` (`id`, `academic_type`, `department`, `program_code`, `program_name`, `level`, `strand`, `strand_name`, `created_at`, `updated_at`) VALUES
(1, 'College', ' ', 'BSIT', 'Bachelor of Science in Information Technology', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(2, 'College', ' ', 'BSCS', 'Bachelor of Science in Computer Science', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(3, 'College', ' ', 'BSCE', 'Bachelor of Science in Civil Engineering', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(4, 'College', ' ', 'BSME', 'Bachelor of Science in Mechanical Engineering', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(5, 'College', ' ', 'BSEE', 'Bachelor of Science in Electrical Engineering', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(6, 'College', ' ', 'BSED', 'Bachelor in Secondary Education', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(7, 'College', ' ', 'BSCPE', 'Bachelor of Science in Computer Engineering', NULL, NULL, NULL, '2025-06-01 03:08:10', '2025-06-01 03:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_rooms`
--

CREATE TABLE `ctr_rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `room` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ctr_rooms`
--

INSERT INTO `ctr_rooms` (`id`, `room`, `building`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '302', 'IT Building', 'First Floor', 1, '2025-06-01 03:08:10', '2025-06-01 05:42:44'),
(2, '301', 'IT Building', NULL, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(3, '303', 'IT Building', NULL, 1, '2025-06-01 03:10:22', '2025-06-01 03:10:22'),
(4, '304', 'IT Building', NULL, 1, '2025-06-01 03:32:57', '2025-06-01 03:32:57'),
(5, '305', 'IT Building', NULL, 1, '2025-06-01 03:33:03', '2025-06-01 05:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_sections`
--

CREATE TABLE `ctr_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `program_code` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ctr_sections`
--

INSERT INTO `ctr_sections` (`id`, `program_code`, `level`, `section_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'BSIT', '1st Year', 'Block A', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(2, 'BSIT', '1st Year', 'Block B', 1, '2025-06-01 03:08:10', '2025-06-01 05:36:08'),
(3, 'BSIT', '2nd Year', 'Block A', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(4, 'BSIT', '2nd Year', 'Block B', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(5, 'BSIT', '3rd Year', 'Block A', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(6, 'BSIT', '3rd Year', 'Block B', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(7, 'BSIT', '4th Year', 'Block A', 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(8, 'BSIT', '4th Year', 'Block B', 1, '2025-06-01 03:08:10', '2025-06-01 05:32:12'),
(9, 'BSCS', '1st Year', 'BSCS - Block - A', 1, '2025-06-01 05:36:55', '2025-06-01 05:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `curricula`
--

CREATE TABLE `curricula` (
  `id` int(10) UNSIGNED NOT NULL,
  `curriculum_year` varchar(255) NOT NULL,
  `program_code` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `control_code` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `lec` decimal(5,2) DEFAULT NULL,
  `lab` decimal(5,2) DEFAULT NULL,
  `units` decimal(5,2) DEFAULT NULL,
  `hours` decimal(5,2) DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `srf` decimal(10,2) NOT NULL DEFAULT 0.00,
  `percent_tuition` int(11) NOT NULL DEFAULT 100,
  `is_complab` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curricula`
--

INSERT INTO `curricula` (`id`, `curriculum_year`, `program_code`, `program_name`, `control_code`, `course_code`, `course_name`, `lec`, `lab`, `units`, `hours`, `level`, `period`, `srf`, `percent_tuition`, `is_complab`, `created_at`, `updated_at`) VALUES
(1, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'CC101_IT', 'CC101_IT', 'Introduction to Computing', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(2, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'CC102_IT', 'CC102_IT', 'Fundamentals of Programming', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(3, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'GE5', 'GE5', 'The Contemporary World', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(4, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'GE6', 'GE6', 'Science, Technology and Society', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(5, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'GE7', 'GE7', 'Mathematics in the Modern World', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10'),
(6, '2025', 'BSIT', 'Bachelor of Science in Information Technology', 'PE1', 'PE1', 'Physical Activity Towards Health and Fitness 1', 3.00, 3.00, 3.00, NULL, '1st Year', '1st Semester', 0.00, 100, 1, '2025-06-01 03:08:10', '2025-06-01 03:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `instructors_infos`
--

CREATE TABLE `instructors_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `instructor_id` int(10) UNSIGNED NOT NULL,
  `college` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `cell_no` varchar(255) DEFAULT NULL,
  `degree_status` varchar(255) DEFAULT NULL,
  `program_graduated` varchar(255) DEFAULT NULL,
  `employee_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors_infos`
--

INSERT INTO `instructors_infos` (`id`, `instructor_id`, `college`, `department`, `gender`, `street`, `barangay`, `municipality`, `tel_no`, `cell_no`, `degree_status`, `program_graduated`, `employee_type`, `created_at`, `updated_at`) VALUES
(1, 3, 'BSIT', NULL, 'Male', NULL, 'Shimla', 'Assam', '7506400361', NULL, NULL, NULL, 'Full Time', '2025-05-30 21:55:13', '2025-05-30 21:55:13'),
(2, 4, 'BSIT', NULL, 'Male', '1792', 'Forst-Längenbühl', 'Thurgau', '0791088978', NULL, NULL, NULL, 'Full Time', '2025-05-30 21:56:50', '2025-05-30 21:56:50'),
(3, 5, 'BSIT', NULL, 'Female', 'Hämeentie', 'Ikaalinen', 'Åland', '03906459', NULL, NULL, NULL, 'Full Time', '2025-05-30 21:57:56', '2025-05-30 21:57:56'),
(4, 6, 'BSIT', NULL, 'Female', 'Rolling Green Rd', 'Toledo', 'Illinois', '(569) 997-3450', NULL, NULL, NULL, 'Full Time', '2025-05-30 21:59:26', '2025-05-30 21:59:26'),
(5, 7, 'BSIT', NULL, 'Male', 'Rosenstrace', 'Tramore', 'Limerick', '0312098679', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:01:07', '2025-05-30 22:01:07'),
(6, 8, 'BSCS', NULL, 'Male', 'Kasba Peth', 'Chinsurah', 'Punjab', '9745371315', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:02:47', '2025-05-30 22:02:47'),
(7, 9, 'BSCS', NULL, 'Male', '4183', 'Recife', 'Ceara', '1275623430', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:04:15', '2025-05-30 22:04:15'),
(8, 10, 'BSCS', NULL, 'Male', '8329', 'Umuarama', 'Roraima', '4289120179', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:05:40', '2025-05-30 22:05:40'),
(9, 11, 'BSCS', NULL, 'Female', 'Armsterveld', 'Heusden', 'Noord-Holland', '7644213', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:07:55', '2025-05-30 22:07:55'),
(10, 12, 'BSCS', NULL, 'Female', 'Brunnenstrake', 'Schlettau', 'Nordrhein-Westfalen', '0247-0008562', NULL, NULL, NULL, 'Full Time', '2025-05-30 22:09:09', '2025-05-30 22:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `load_notifications`
--

CREATE TABLE `load_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  `is_trash` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_17_095312_create_curricula_table', 1),
(4, '2019_01_17_095313_create_offerings_infos_table', 1),
(5, '2019_01_17_100323_create_room_schedules_table', 1),
(6, '2019_01_29_054032_create_academic_programs_table', 1),
(7, '2019_02_03_041414_create_ctr_sections_table', 1),
(8, '2019_02_03_100032_create_ctr_rooms_table', 1),
(9, '2019_02_06_064213_create_instructors_infos_table', 1),
(10, '2019_02_16_135143_create_load_notifications_table', 1),
(11, '2019_03_09_115124_create_units_loads_table', 1),
(12, '2025_06_16_092731_create_signatories_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offerings_infos`
--

CREATE TABLE `offerings_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_type` varchar(255) DEFAULT NULL,
  `curriculum_id` int(10) UNSIGNED NOT NULL,
  `description` decimal(5,2) DEFAULT NULL,
  `section_name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offerings_infos`
--

INSERT INTO `offerings_infos` (`id`, `course_type`, `curriculum_id`, `description`, `section_name`, `level`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 'Block A', '1st Year', '2025-06-01 03:11:03', '2025-06-01 03:11:03'),
(2, NULL, 2, NULL, 'Block A', '1st Year', '2025-06-01 03:11:04', '2025-06-01 03:11:04'),
(3, NULL, 3, NULL, 'Block A', '1st Year', '2025-06-01 03:11:05', '2025-06-01 03:11:05'),
(4, NULL, 4, NULL, 'Block A', '1st Year', '2025-06-01 03:11:06', '2025-06-01 03:11:06'),
(5, NULL, 5, NULL, 'Block A', '1st Year', '2025-06-01 03:11:07', '2025-06-01 03:11:07'),
(6, NULL, 1, NULL, 'Block B', '1st Year', '2025-06-01 03:11:40', '2025-06-01 03:11:40'),
(7, NULL, 2, NULL, 'Block B', '1st Year', '2025-06-01 03:11:41', '2025-06-01 03:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_schedules`
--

CREATE TABLE `room_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_starts` varchar(255) NOT NULL,
  `time_end` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `offering_id` int(10) UNSIGNED DEFAULT NULL,
  `instructor` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_loaded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_schedules`
--

INSERT INTO `room_schedules` (`id`, `day`, `time_starts`, `time_end`, `room`, `offering_id`, `instructor`, `is_active`, `created_at`, `updated_at`, `is_loaded`) VALUES
(1, 'M', '07:00:00', '10:00:00', '301', 6, 4, 1, '2025-06-01 03:12:13', '2025-06-01 03:12:13', 0),
(2, 'T', '07:00:00', '09:00:00', '302', 6, 4, 1, '2025-06-01 03:12:43', '2025-06-01 03:12:43', 0),
(3, 'F', '08:00:00', '10:00:00', '301', 1, 6, 1, '2025-06-01 05:51:49', '2025-06-01 05:51:49', 0),
(4, 'W', '14:00:00', '05:00:00', '301', 1, 6, 1, '2025-06-01 05:52:10', '2025-06-01 05:52:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

CREATE TABLE `signatories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units_loads`
--

CREATE TABLE `units_loads` (
  `id` int(10) UNSIGNED NOT NULL,
  `instructor_id` int(10) UNSIGNED NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `extensionname` varchar(255) DEFAULT NULL,
  `accesslevel` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_first_login` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `middlename`, `lastname`, `extensionname`, `accesslevel`, `email`, `email_verified_at`, `password`, `is_first_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super', ' ', 'Admin', NULL, 100, 'superadmin@gmail.com', NULL, '$2y$10$G/8Yynw45zMTKwq/Q3rsDOuMW7bZIgSsN3Uj59qC8eBidL4Zg3fxm', 0, NULL, '2025-05-30 21:48:47', '2025-05-30 21:48:47'),
(2, 'admin', 'Admin', ' ', 'Admin', NULL, 0, 'admin@gmail.com', NULL, '$2y$10$USzYmgTJCgcK7Voyn7tqIOD5WqQKpzFEyZQJOJ30njdmLCt94y52C', 0, NULL, '2025-05-30 21:48:47', '2025-05-30 21:48:47'),
(3, '1001', 'Tanmay', NULL, 'Anchan', NULL, 1, 'tanmay.anchan@example.com', NULL, '$2y$10$SLx92X5LqHuoc2Y0I/KTG.qfHkuLNARXfmtGJ5EfFK8CvO6cQKqze', 1, NULL, '2025-05-30 21:55:13', '2025-05-30 21:55:13'),
(4, '1002', 'Giancarlo', NULL, 'Nguyen', NULL, 1, 'giancarlo.nguyen@example.com', NULL, '$2y$10$KbN3g/rTVZoL6atH3UX9eO3zvY8pZzY6mp3kxL/wvF7CZvwz/utTq', 1, NULL, '2025-05-30 21:56:50', '2025-05-30 21:56:50'),
(5, '1003', 'Emilia', NULL, 'Joki', NULL, 1, 'emilia.joki@example.com', NULL, '$2y$10$9zkYMQPJ1lfBv7d2f/YKcO9fN66XSsA1HAXNy209WPW00YvQ1FXme', 1, NULL, '2025-05-30 21:57:56', '2025-05-30 21:57:56'),
(6, '1004', 'Lesa', NULL, 'Adams', NULL, 1, 'lesa.adams@example.com', NULL, '$2y$10$BMqoLU36cGic7jzM7kEzCOLz6ktPLL9FgDGznojm76dcy3lai/ydK', 1, NULL, '2025-05-30 21:59:26', '2025-05-30 21:59:26'),
(7, '1005', 'Birgid', NULL, 'Peetz', NULL, 1, 'birgid.peetz@example.com', NULL, '$2y$10$nBriPYxJ8gk.HR5Fu6k5UO1X9/.8jrR/44kW.6xJLDXXWF0EQ.znW', 1, NULL, '2025-05-30 22:01:07', '2025-05-30 22:01:07'),
(8, '1006', 'Hithakshi', NULL, 'Raval', NULL, 1, 'hithakshi.raval@example.com', NULL, '$2y$10$2yUg2pY76iZsRJxC7LatfOvNYgo2koFOsFqiWb7gujHr/8zzrrVMu', 1, NULL, '2025-05-30 22:02:47', '2025-05-30 22:02:47'),
(9, '1007', 'Miqueias', NULL, 'de Souza', NULL, 1, 'miqueias.desouza@example.com', NULL, '$2y$10$jgY1.Oy0nfyAs.vkS6wXGOrF9MFlhBo59mDoJuTALcehuNuF49vTO', 1, NULL, '2025-05-30 22:04:15', '2025-05-30 22:04:15'),
(10, '1008', 'Sadi', NULL, 'Duarte', NULL, 1, 'sadi.duarte@example.com', NULL, '$2y$10$95z72RC3DSL2D556igiwkuDa/yJW0nWwlDArHHyZTwFMWQGFcK/3O', 1, NULL, '2025-05-30 22:05:39', '2025-05-30 22:05:39'),
(11, '1009', 'Wiam', NULL, 'Wink', NULL, 1, 'wiam.wink@example.com', NULL, '$2y$10$JyLSSrxUb77hOrbhITN0m.qncR97eWhQ2FiEbpt4p38ArZjOwO4o2', 1, NULL, '2025-05-30 22:07:55', '2025-05-30 22:07:55'),
(12, '1010', 'Doris', NULL, 'David', NULL, 1, 'doris.david@example.com', NULL, '$2y$10$4hP7JIZ24a2yrczQSdMmUOo4LkGgzV/r98Xsz2RHEQmpYOmIDo1Le', 1, NULL, '2025-05-30 22:09:09', '2025-05-30 22:09:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_programs`
--
ALTER TABLE `academic_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_rooms`
--
ALTER TABLE `ctr_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_sections`
--
ALTER TABLE `ctr_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curricula`
--
ALTER TABLE `curricula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors_infos`
--
ALTER TABLE `instructors_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructors_infos_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `load_notifications`
--
ALTER TABLE `load_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerings_infos`
--
ALTER TABLE `offerings_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offerings_infos_curriculum_id_foreign` (`curriculum_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `room_schedules`
--
ALTER TABLE `room_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_schedules_offering_id_foreign` (`offering_id`),
  ADD KEY `room_schedules_instructor_foreign` (`instructor`);

--
-- Indexes for table `signatories`
--
ALTER TABLE `signatories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units_loads`
--
ALTER TABLE `units_loads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_loads_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_programs`
--
ALTER TABLE `academic_programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ctr_rooms`
--
ALTER TABLE `ctr_rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ctr_sections`
--
ALTER TABLE `ctr_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `curricula`
--
ALTER TABLE `curricula`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructors_infos`
--
ALTER TABLE `instructors_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `load_notifications`
--
ALTER TABLE `load_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offerings_infos`
--
ALTER TABLE `offerings_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room_schedules`
--
ALTER TABLE `room_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signatories`
--
ALTER TABLE `signatories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units_loads`
--
ALTER TABLE `units_loads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instructors_infos`
--
ALTER TABLE `instructors_infos`
  ADD CONSTRAINT `instructors_infos_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `offerings_infos`
--
ALTER TABLE `offerings_infos`
  ADD CONSTRAINT `offerings_infos_curriculum_id_foreign` FOREIGN KEY (`curriculum_id`) REFERENCES `curricula` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `room_schedules`
--
ALTER TABLE `room_schedules`
  ADD CONSTRAINT `room_schedules_instructor_foreign` FOREIGN KEY (`instructor`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `room_schedules_offering_id_foreign` FOREIGN KEY (`offering_id`) REFERENCES `offerings_infos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `units_loads`
--
ALTER TABLE `units_loads`
  ADD CONSTRAINT `units_loads_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
