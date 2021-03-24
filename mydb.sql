-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 07:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_result`
--

CREATE TABLE `access_result` (
  `access_result_id` int(11) NOT NULL,
  `indicator_result_indicator_result_ID` int(11) NOT NULL,
  `indicator_result_year_year_id` int(11) NOT NULL,
  `user_employee_all_idemployee_all` int(11) NOT NULL,
  `Employee_id_employee` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `access_stratetegic`
--

CREATE TABLE `access_stratetegic` (
  `access_id` int(11) NOT NULL,
  `indicator_stratetegic_indicator_stratetegic_id` int(11) NOT NULL,
  `indicator_stratetegic_year_year_id` int(11) NOT NULL,
  `Employee_id_employee` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `assign_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `Employee_id_employee` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `autrority`
--

CREATE TABLE `autrority` (
  `idautrority` int(11) NOT NULL,
  `KR_idKR` int(11) NOT NULL,
  `Employee_id_employee` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL,
  `name_department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id_department`, `name_department`) VALUES
(1, 'ผู้อำนวยการและรองผู้อำนวยการ'),
(2, 'ฝ่ายบริหารทั่วไปและธุรการ'),
(3, 'ฝ่ายพัฒนาทรัพยากรสารสนเทศ'),
(4, 'ฝ่ายส่งเสริมการเรียนรู้และให้บริการการศึกษา'),
(5, 'ฝ่ายสนับสนุนการเรียนการสอนและสื่อการศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `name_employee` varchar(255) NOT NULL,
  `id_position` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `username` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `name_employee`, `id_position`, `id_department`, `status`, `password`, `username`) VALUES
(1, 'ผศ.ดร.ศิวนาถ นันทพิชัย', 3, 1, 3, '1234', 'ssadmin'),
(2, 'ผศ.ดร.ฐิมาพร เพชรแก้ว', 4, 1, 3, '1234', 'sadmin');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indicator`
--

CREATE TABLE `indicator` (
  `indicator_id` int(11) NOT NULL,
  `indicator_name` varchar(45) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `year1_year_id` int(11) NOT NULL,
  `indicator_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indicator_month`
--

CREATE TABLE `indicator_month` (
  `indicator_month_id` int(11) NOT NULL,
  `result` varchar(45) DEFAULT NULL,
  `fullscore` varchar(45) DEFAULT NULL,
  `score` varchar(45) DEFAULT NULL,
  `percent` varchar(45) DEFAULT NULL,
  `indicator_id` int(11) NOT NULL,
  `year_year_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `indicator_result`
--

CREATE TABLE `indicator_result` (
  `indicator_result_ID` int(11) NOT NULL,
  `indicator_result_name` varchar(45) DEFAULT NULL,
  `year_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `indicator_stratetegic`
--

CREATE TABLE `indicator_stratetegic` (
  `indicator_stratetegic_id` int(11) NOT NULL,
  `indicator_stratetegic_name` varchar(45) DEFAULT NULL,
  `year_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `indicator_year`
--

CREATE TABLE `indicator_year` (
  `indicator_year_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `result` varchar(45) DEFAULT NULL,
  `fullscore` varchar(45) DEFAULT NULL,
  `score` varchar(45) DEFAULT NULL,
  `percent` varchar(45) DEFAULT NULL,
  `year1_year_id` int(11) NOT NULL,
  `user_employee_all_idemployee_all` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `Employee_id_employee` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kr`
--

CREATE TABLE `kr` (
  `idKR` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `nameKR` varchar(200) DEFAULT NULL,
  `object_idobject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `krdetail`
--

CREATE TABLE `krdetail` (
  `idKRdetail` int(11) NOT NULL,
  `result` varchar(200) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `future_result` varchar(200) DEFAULT NULL,
  `nameUser` varchar(100) DEFAULT NULL,
  `time` date DEFAULT NULL,
  `mount` int(11) DEFAULT NULL,
  `year_year_id` int(11) NOT NULL,
  `KR_idKR` int(11) NOT NULL,
  `KR_object_idobject` int(11) NOT NULL,
  `status_kr` int(11) DEFAULT NULL,
  `status_data` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `list_item`
--

CREATE TABLE `list_item` (
  `id_item` int(11) NOT NULL,
  `name_item` varchar(255) NOT NULL,
  `year_id` int(11) NOT NULL,
  `unit_id_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_item`
--

INSERT INTO `list_item` (`id_item`, `name_item`, `year_id`, `unit_id_unit`) VALUES
(1, 'fdf', 1, '5');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_09_065453_create_flights_table', 1),
(5, '2021_03_09_065507_create_indicators_table', 1),
(6, '2021_03_16_063853_create_sessions_table', 1),
(7, '2021_03_16_103609_create_file_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `idobject` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `nameObject` varchar(200) DEFAULT NULL,
  `year_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_list`
--

CREATE TABLE `position_list` (
  `id_position` int(11) NOT NULL,
  `name_position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_list`
--

INSERT INTO `position_list` (`id_position`, `name_position`) VALUES
(1, 'หัวหน้าฝ่าย'),
(2, 'พนักงานทั่วไป'),
(3, 'ผู้อำนวยการศูนย์บรรณสารและสื่อการศึกษา'),
(4, 'รองผู้อำนวยการศูนย์บรรณสารและสื่อการศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `responsibility`
--

CREATE TABLE `responsibility` (
  `id_item` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_ID` int(11) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `performance_result` varchar(500) DEFAULT NULL,
  `resultcol` varchar(45) DEFAULT NULL,
  `mount` varchar(45) DEFAULT NULL,
  `indicator_result_indicator_result_ID` int(11) NOT NULL,
  `year_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stratetegic`
--

CREATE TABLE `stratetegic` (
  `stratetegic_ID` int(11) NOT NULL,
  `indicators` varchar(45) DEFAULT NULL,
  `goal` varchar(45) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `job` varchar(500) DEFAULT NULL,
  `mount` varchar(45) DEFAULT NULL,
  `indicator_stratetegic_indicator_stratetegic_id` int(11) NOT NULL,
  `indicator_stratetegic_year_year_id` int(11) NOT NULL,
  `year_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id_summary` int(11) NOT NULL,
  `count` varchar(45) DEFAULT NULL,
  `id_item` int(11) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `count` varchar(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `mount` varchar(50) DEFAULT NULL,
  `id_item` int(11) NOT NULL,
  `Employee_id_position` int(11) NOT NULL,
  `Employee_id_department` int(11) NOT NULL,
  `year_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` varchar(255) NOT NULL,
  `unit_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_result`
--
ALTER TABLE `access_result`
  ADD PRIMARY KEY (`access_result_id`,`indicator_result_indicator_result_ID`,`indicator_result_year_year_id`,`user_employee_all_idemployee_all`,`Employee_id_employee`,`Employee_id_position`,`Employee_id_department`);

--
-- Indexes for table `access_stratetegic`
--
ALTER TABLE `access_stratetegic`
  ADD PRIMARY KEY (`access_id`,`indicator_stratetegic_indicator_stratetegic_id`,`indicator_stratetegic_year_year_id`,`Employee_id_employee`,`Employee_id_position`,`Employee_id_department`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`assign_id`,`indicator_id`,`Employee_id_employee`,`Employee_id_position`,`Employee_id_department`);

--
-- Indexes for table `autrority`
--
ALTER TABLE `autrority`
  ADD PRIMARY KEY (`idautrority`,`KR_idKR`,`Employee_id_employee`,`Employee_id_position`,`Employee_id_department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`,`id_position`,`id_department`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indicator`
--
ALTER TABLE `indicator`
  ADD PRIMARY KEY (`indicator_id`,`year1_year_id`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indicator_month`
--
ALTER TABLE `indicator_month`
  ADD PRIMARY KEY (`indicator_month_id`,`indicator_id`,`year_year_id`);

--
-- Indexes for table `indicator_result`
--
ALTER TABLE `indicator_result`
  ADD PRIMARY KEY (`indicator_result_ID`,`year_year_id`);

--
-- Indexes for table `indicator_stratetegic`
--
ALTER TABLE `indicator_stratetegic`
  ADD PRIMARY KEY (`indicator_stratetegic_id`,`year_year_id`);

--
-- Indexes for table `indicator_year`
--
ALTER TABLE `indicator_year`
  ADD PRIMARY KEY (`indicator_year_id`,`indicator_id`,`year_id`,`year1_year_id`,`user_employee_all_idemployee_all`,`Employee_id_employee`,`Employee_id_position`,`Employee_id_department`);

--
-- Indexes for table `kr`
--
ALTER TABLE `kr`
  ADD PRIMARY KEY (`idKR`,`object_idobject`);

--
-- Indexes for table `krdetail`
--
ALTER TABLE `krdetail`
  ADD PRIMARY KEY (`idKRdetail`,`year_year_id`,`KR_idKR`,`KR_object_idobject`);

--
-- Indexes for table `list_item`
--
ALTER TABLE `list_item`
  ADD PRIMARY KEY (`id_item`,`year_id`,`unit_id_unit`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`idobject`,`year_year_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `position_list`
--
ALTER TABLE `position_list`
  ADD PRIMARY KEY (`id_position`);

--
-- Indexes for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`id_item`,`id_employee`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_ID`,`indicator_result_indicator_result_ID`,`year_year_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stratetegic`
--
ALTER TABLE `stratetegic`
  ADD PRIMARY KEY (`stratetegic_ID`,`indicator_stratetegic_indicator_stratetegic_id`,`indicator_stratetegic_year_year_id`,`year_year_id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id_summary`,`id_item`,`year_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`,`id_item`,`Employee_id_position`,`Employee_id_department`,`year_year_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autrority`
--
ALTER TABLE `autrority`
  MODIFY `idautrority` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicator`
--
ALTER TABLE `indicator`
  MODIFY `indicator_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicator_month`
--
ALTER TABLE `indicator_month`
  MODIFY `indicator_month_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indicator_year`
--
ALTER TABLE `indicator_year`
  MODIFY `indicator_year_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kr`
--
ALTER TABLE `kr`
  MODIFY `idKR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `krdetail`
--
ALTER TABLE `krdetail`
  MODIFY `idKRdetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_item`
--
ALTER TABLE `list_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `idobject` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position_list`
--
ALTER TABLE `position_list`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stratetegic`
--
ALTER TABLE `stratetegic`
  MODIFY `stratetegic_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id_summary` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
