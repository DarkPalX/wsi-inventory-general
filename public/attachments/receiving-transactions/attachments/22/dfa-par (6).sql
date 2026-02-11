-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 02:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dfa-par`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_by` varchar(255) DEFAULT NULL,
  `activity_type` varchar(255) DEFAULT NULL,
  `dashboard_activity` varchar(255) DEFAULT NULL,
  `activity_desc` text DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL,
  `db_table` varchar(255) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `log_by`, `activity_type`, `dashboard_activity`, `activity_desc`, `activity_date`, `db_table`, `old_value`, `new_value`, `reference`, `created_at`, `updated_at`) VALUES
(1, NULL, 'insert', 'created a new role', 'created the role Admin', '2025-04-21 06:27:45', 'roles', '', 'Admin', '1', NULL, NULL),
(2, NULL, 'insert', 'created a new role', 'created the role Approver', '2025-04-21 06:27:45', 'roles', '', 'Approver', '2', NULL, NULL),
(3, NULL, 'insert', 'created a new role', 'created the role User', '2025-04-21 06:27:45', 'roles', '', 'User', '3', NULL, NULL),
(4, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '1', NULL, NULL),
(5, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-1 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-1', NULL, '1', NULL, NULL),
(6, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '1', NULL, NULL),
(7, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '2', NULL, NULL),
(8, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-2 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-2', NULL, '2', NULL, NULL),
(9, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '2', NULL, NULL),
(10, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '3', NULL, NULL),
(11, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-3 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-3', NULL, '3', NULL, NULL),
(12, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '3', NULL, NULL),
(13, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '4', NULL, NULL),
(14, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-4 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-4', NULL, '4', NULL, NULL),
(15, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '4', NULL, NULL),
(16, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '5', NULL, NULL),
(17, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-5 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-5', NULL, '5', NULL, NULL),
(18, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '5', NULL, NULL),
(19, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '6', NULL, NULL),
(20, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-6 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-6', NULL, '6', NULL, NULL),
(21, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '6', NULL, NULL),
(22, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '7', NULL, NULL),
(23, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-7 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-7', NULL, '7', NULL, NULL),
(24, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '7', NULL, NULL),
(25, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '8', NULL, NULL),
(26, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-8 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-8', NULL, '8', NULL, NULL),
(27, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '8', NULL, NULL),
(28, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '9', NULL, NULL),
(29, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-9 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-9', NULL, '9', NULL, NULL),
(30, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '9', NULL, NULL),
(31, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '10', NULL, NULL),
(32, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-10 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-10', NULL, '10', NULL, NULL),
(33, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '10', NULL, NULL),
(34, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '11', NULL, NULL),
(35, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-11 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-11', NULL, '11', NULL, NULL),
(36, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '11', NULL, NULL),
(37, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:45', 'receiving_headers', '', NULL, '12', NULL, NULL),
(38, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-12 to ', '2025-04-21 06:27:45', 'receiving_headers', 'R20250421-12', NULL, '12', NULL, NULL),
(39, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:45', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '12', NULL, NULL),
(40, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '13', NULL, NULL),
(41, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-13 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-13', NULL, '13', NULL, NULL),
(42, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:45 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:45', '2025-04-21', '13', NULL, NULL),
(43, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '14', NULL, NULL),
(44, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-14 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-14', NULL, '14', NULL, NULL),
(45, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '14', NULL, NULL),
(46, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '15', NULL, NULL),
(47, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-15 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-15', NULL, '15', NULL, NULL),
(48, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '15', NULL, NULL),
(49, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '16', NULL, NULL),
(50, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-16 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-16', NULL, '16', NULL, NULL),
(51, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '16', NULL, NULL),
(52, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '17', NULL, NULL),
(53, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-17 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-17', NULL, '17', NULL, NULL),
(54, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '17', NULL, NULL),
(55, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '18', NULL, NULL),
(56, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-18 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-18', NULL, '18', NULL, NULL),
(57, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '18', NULL, NULL),
(58, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '19', NULL, NULL),
(59, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-19 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-19', NULL, '19', NULL, NULL),
(60, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '19', NULL, NULL),
(61, NULL, 'insert', 'created a new receiving', 'created the receiving ', '2025-04-21 06:27:46', 'receiving_headers', '', NULL, '20', NULL, NULL),
(62, NULL, 'update', 'updated the receiving ref_no', 'updated the receiving ref_no of  from R20250421-20 to ', '2025-04-21 06:27:46', 'receiving_headers', 'R20250421-20', NULL, '20', NULL, NULL),
(63, NULL, 'update', 'updated the receiving date_received', 'updated the receiving date_received of  from 2025-04-21 06:27:46 to 2025-04-21', '2025-04-21 06:27:46', 'receiving_headers', '2025-04-21 06:27:46', '2025-04-21', '20', NULL, NULL),
(64, '1', 'insert', 'created a new requisition', 'created the requisition ', '2025-04-21 06:28:37', 'requisition_headers', '', NULL, '1', NULL, NULL),
(65, '1', 'update', 'updated the requisition ref_no', 'updated the requisition ref_no of  from RIS20250421001 to ', '2025-04-21 06:28:37', 'requisition_headers', 'RIS20250421001', NULL, '1', NULL, NULL),
(66, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from  to SAVED', '2025-04-21 06:28:37', 'requisition_headers', NULL, 'SAVED', '1', NULL, NULL),
(67, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from POSTED to SAVED', '2025-04-21 06:28:41', 'requisition_headers', 'POSTED', 'SAVED', '1', NULL, NULL),
(68, '1', 'update', 'updated the requisition posted_by', 'updated the requisition posted_by of  from 1 to ', '2025-04-21 06:28:41', 'requisition_headers', '1', NULL, '1', NULL, NULL),
(69, '1', 'update', 'updated the requisition posted_at', 'updated the requisition posted_at of  from 2025-04-21 06:28:41 to ', '2025-04-21 06:28:41', 'requisition_headers', '2025-04-21 06:28:41', NULL, '1', NULL, NULL),
(70, '1', 'insert', 'created a new issuance', 'created the issuance ', '2025-04-21 06:29:31', 'issuance_headers', '', NULL, '1', NULL, NULL),
(71, '1', 'update', 'updated the issuance ref_no', 'updated the issuance ref_no of  from I20250421-1 to ', '2025-04-21 06:29:31', 'issuance_headers', 'I20250421-1', NULL, '1', NULL, NULL),
(72, '1', 'update', 'updated the issuance status', 'updated the issuance status of  from  to POSTED', '2025-04-21 06:29:31', 'issuance_headers', NULL, 'POSTED', '1', NULL, NULL),
(73, '1', 'insert', 'created a new purchase-order', 'created the purchase-order ', '2025-04-21 06:29:31', 'par_headers', '', NULL, '1', NULL, NULL),
(74, '1', 'insert', 'created a new purchase-order', 'created the purchase-order ', '2025-04-21 06:29:31', 'par_headers', '', NULL, '2', NULL, NULL),
(75, '1', 'insert', 'created a new requisition', 'created the requisition ', '2025-04-22 05:29:55', 'requisition_headers', '', NULL, '2', NULL, NULL),
(76, '1', 'update', 'updated the requisition ref_no', 'updated the requisition ref_no of  from RIS20250422001 to ', '2025-04-22 05:29:55', 'requisition_headers', 'RIS20250422001', NULL, '2', NULL, NULL),
(77, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from  to SAVED', '2025-04-22 05:29:55', 'requisition_headers', NULL, 'SAVED', '2', NULL, NULL),
(78, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from POSTED to SAVED', '2025-04-22 05:30:12', 'requisition_headers', 'POSTED', 'SAVED', '2', NULL, NULL),
(79, '1', 'update', 'updated the requisition posted_by', 'updated the requisition posted_by of  from 1 to ', '2025-04-22 05:30:12', 'requisition_headers', '1', NULL, '2', NULL, NULL),
(80, '1', 'update', 'updated the requisition posted_at', 'updated the requisition posted_at of  from 2025-04-22 05:30:12 to ', '2025-04-22 05:30:12', 'requisition_headers', '2025-04-22 05:30:12', NULL, '2', NULL, NULL),
(81, '1', 'insert', 'created a new issuance', 'created the issuance ', '2025-04-22 05:33:48', 'issuance_headers', '', NULL, '2', NULL, NULL),
(82, '1', 'update', 'updated the issuance ref_no', 'updated the issuance ref_no of  from I20250422-2 to ', '2025-04-22 05:33:48', 'issuance_headers', 'I20250422-2', NULL, '2', NULL, NULL),
(83, '1', 'update', 'updated the issuance status', 'updated the issuance status of  from  to POSTED', '2025-04-22 05:33:48', 'issuance_headers', NULL, 'POSTED', '2', NULL, NULL),
(84, '1', 'insert', 'created a new purchase-order', 'created the purchase-order ', '2025-04-22 05:33:48', 'par_headers', '', NULL, '3', NULL, NULL),
(85, '1', 'insert', 'created a new purchase-order', 'created the purchase-order ', '2025-04-22 05:35:48', 'par_headers', '', NULL, '4', NULL, NULL),
(86, '1', 'insert', 'created a new requisition', 'created the requisition ', '2025-04-22 06:25:01', 'requisition_headers', '', NULL, '3', NULL, NULL),
(87, '1', 'update', 'updated the requisition ref_no', 'updated the requisition ref_no of  from RIS20250422002 to ', '2025-04-22 06:25:01', 'requisition_headers', 'RIS20250422002', NULL, '3', NULL, NULL),
(88, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from  to SAVED', '2025-04-22 06:25:01', 'requisition_headers', NULL, 'SAVED', '3', NULL, NULL),
(89, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from POSTED to SAVED', '2025-04-22 06:25:05', 'requisition_headers', 'POSTED', 'SAVED', '3', NULL, NULL),
(90, '1', 'update', 'updated the requisition posted_by', 'updated the requisition posted_by of  from 1 to ', '2025-04-22 06:25:05', 'requisition_headers', '1', NULL, '3', NULL, NULL),
(91, '1', 'update', 'updated the requisition posted_at', 'updated the requisition posted_at of  from 2025-04-22 06:25:05 to ', '2025-04-22 06:25:05', 'requisition_headers', '2025-04-22 06:25:05', NULL, '3', NULL, NULL),
(92, '1', 'insert', 'created a new requisition', 'created the requisition ', '2025-04-22 08:13:27', 'requisition_headers', '', NULL, '4', NULL, NULL),
(93, '1', 'update', 'updated the requisition ref_no', 'updated the requisition ref_no of  from RIS20250422003 to ', '2025-04-22 08:13:28', 'requisition_headers', 'RIS20250422003', NULL, '4', NULL, NULL),
(94, '1', 'update', 'updated the requisition status', 'updated the requisition status of  from  to SAVED', '2025-04-22 08:13:28', 'requisition_headers', NULL, 'SAVED', '4', NULL, NULL),
(95, '1', 'update', 'updated the requisition updated_by', 'updated the requisition updated_by of  from 1 to ', '2025-04-22 08:13:49', 'requisition_headers', '1', NULL, '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `transition_in` int(11) NOT NULL DEFAULT 1,
  `transition_out` int(11) NOT NULL DEFAULT 2,
  `transition` int(11) NOT NULL DEFAULT 6,
  `type` varchar(150) NOT NULL DEFAULT 'sub_banner',
  `banner_type` varchar(255) NOT NULL DEFAULT 'image',
  `user_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `transition_in`, `transition_out`, `transition`, `type`, `banner_type`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Home Banner', 1, 2, 6, 'main_banner', 'image', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Sub Banner 1', 1, 2, 6, 'sub_banner', 'image', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `alt` varchar(150) DEFAULT NULL,
  `image_path` text NOT NULL,
  `button_text` varchar(30) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `album_id`, `title`, `description`, `alt`, `image_path`, `button_text`, `url`, `order`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Best way to save your Money.', 'Interactively seize bricks-and-clicks channels before empowered users. Uniquely maximize bleeding-edge outsourcing.', 'Banner 1', 'http://172.16.11.76:7979/theme/images/banners/image1.jpg', NULL, 'http://172.16.11.76:7979', 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 1, 'Beautifully Flexible', 'Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.', NULL, 'http://172.16.11.76:7979/theme/images/banners/image2.jpg', NULL, NULL, 2, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 1, 'Great Performance', 'You\'ll be surprised to see the Final Results of your Creation &amp; would crave for more.', NULL, 'http://172.16.11.76:7979/theme/images/banners/image3.jpg', NULL, NULL, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 2, NULL, NULL, NULL, 'http://172.16.11.76:7979/theme/images/banners/sub1.jpg', NULL, NULL, 2, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, 2, NULL, NULL, NULL, 'http://172.16.11.76:7979/theme/images/banners/sub2.jpg', NULL, NULL, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `head_emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `head_emp_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ICT', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'MCD', 2, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Accounting', 3, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `emp_id` varchar(255) NOT NULL,
  `hired_date` date DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `section_id`, `department`, `position`, `emp_id`, `hired_date`, `avatar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Myoui Mina', 1, 'Accounting', 'Calculator', 'E001', '2025-01-01', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Hirai Momo', 3, 'Accounting', 'Calculator', 'E002', '2025-01-01', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Minatozaki Sana', 4, 'ICT', 'Developer', 'E003', '2025-01-01', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 'Chou Tzuyu', 2, 'ICT', 'Developer', 'E004', '2025-01-01', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issuance_details`
--

CREATE TABLE `issuance_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issuance_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `item_type_id` varchar(255) NOT NULL,
  `quantity` decimal(16,0) DEFAULT 0,
  `cost` decimal(16,2) DEFAULT 0.00,
  `issued_by` bigint(20) UNSIGNED DEFAULT NULL,
  `issued_at` timestamp NULL DEFAULT NULL,
  `received_by` bigint(20) UNSIGNED DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issuance_details`
--

INSERT INTO `issuance_details` (`id`, `issuance_header_id`, `item_id`, `sku`, `item_type_id`, `quantity`, `cost`, `issued_by`, `issued_at`, `received_by`, `received_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '202500104', '1', '1', '0.00', 1, '2025-04-20 22:29:31', NULL, '2025-04-20 22:29:31', '2025-04-20 22:29:31', '2025-04-20 22:29:31'),
(2, 1, 4, '202500103', '2', '1', '0.00', 1, '2025-04-20 22:29:31', 3, '2025-04-20 22:29:31', '2025-04-20 22:29:31', '2025-04-20 22:29:31'),
(3, 1, 2, '202500101', '2', '1', '0.00', 1, '2025-04-20 22:29:31', 2, '2025-04-20 22:29:31', '2025-04-20 22:29:31', '2025-04-20 22:29:31'),
(4, 1, 2, '202500101', '2', '1', '0.00', 1, '2025-04-20 22:29:31', 3, '2025-04-20 22:29:31', '2025-04-20 22:29:31', '2025-04-20 22:29:31'),
(5, 2, 5, '202500104', '1', '3', '0.00', 1, '2025-04-21 21:33:48', NULL, '2025-04-21 21:33:48', '2025-04-21 21:33:48', '2025-04-21 21:33:48'),
(6, 2, 2, '202500101', '2', '1', '0.00', 1, '2025-04-21 21:33:48', 3, '2025-04-21 21:33:48', '2025-04-21 21:33:48', '2025-04-21 21:33:48'),
(7, 2, 2, '202500101', '2', '1', '0.00', 1, '2025-04-21 21:33:48', 3, '2025-04-21 21:33:48', '2025-04-21 21:33:48', '2025-04-21 21:33:48'),
(8, 2, 2, '202500101', '2', '1', '0.00', 1, '2025-04-21 21:33:48', 3, '2025-04-21 21:33:48', '2025-04-21 21:33:48', '2025-04-21 21:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `issuance_headers`
--

CREATE TABLE `issuance_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `ris_no` varchar(255) NOT NULL,
  `date_released` date NOT NULL,
  `attachments` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'POSTED',
  `requested_by` bigint(20) UNSIGNED DEFAULT NULL,
  `requested_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `posted_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issuance_headers`
--

INSERT INTO `issuance_headers` (`id`, `ref_no`, `ris_no`, `date_released`, `attachments`, `remarks`, `status`, `requested_by`, `requested_at`, `approved_by`, `approved_at`, `posted_by`, `posted_at`, `cancelled_by`, `cancelled_at`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'I20250421-1', 'RIS20250421001', '2025-04-21', NULL, NULL, 'POSTED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-20 22:29:31', '2025-04-20 22:29:31', NULL),
(2, 'I20250422-2', 'RIS20250422001', '2025-04-22', NULL, NULL, 'POSTED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-21 21:33:48', '2025-04-21 21:33:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `image_cover` text DEFAULT NULL,
  `minimum_stock` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `sku`, `barcode`, `name`, `slug`, `category_id`, `unit_id`, `type_id`, `image_cover`, `minimum_stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '202500100', '0000100', 'Flower Vase', 'flower-vase', 1, 4, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, '202500101', '0000101', 'Wooden Chair', 'wooden-chair', 2, 2, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, '202500102', '0000102', 'Glass Bottle', 'glass-bottle', 2, 2, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, '202500103', '0000103', 'Ceramic Plate', 'ceramic-plate', 1, 2, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, '202500104', '0000104', 'Metal Spoon', 'metal-spoon', 2, 3, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(6, '202500105', '0000105', 'Cotton Towel', 'cotton-towel', 1, 1, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(7, '202500106', '0000106', 'Leather Wallet', 'leather-wallet', 2, 3, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(8, '202500107', '0000107', 'Plastic Container', 'plastic-container', 3, 1, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(9, '202500108', '0000108', 'Steel Knife', 'steel-knife', 2, 2, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(10, '202500109', '0000109', 'Paper Notebook', 'paper-notebook', 4, 3, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(11, '202500110', '0000110', 'Silk Scarf', 'silk-scarf', 4, 4, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(12, '202500111', '0000111', 'Linen Blanket', 'linen-blanket', 2, 2, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(13, '202500112', '0000112', 'Stone Mortar', 'stone-mortar', 1, 2, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(14, '202500113', '0000113', 'Copper Pan', 'copper-pan', 1, 1, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(15, '202500114', '0000114', 'Aluminum Can', 'aluminum-can', 1, 2, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(16, '202500115', '0000115', 'Rubber Mat', 'rubber-mat', 1, 3, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(17, '202500116', '0000116', 'Bamboo Stick', 'bamboo-stick', 1, 2, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(18, '202500117', '0000117', 'Clay Pot', 'clay-pot', 4, 4, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(19, '202500118', '0000118', 'Gold Ring', 'gold-ring', 3, 4, 2, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(20, '202500119', '0000119', 'Silver Bracelet', 'silver-bracelet', 2, 2, 1, NULL, 0, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `slug`, `description`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Home Appliances', 'home-appliances', 'home', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'School Supplies', 'school-supplies', 'school', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Kitchen Wares', 'kitchen-wares', 'Sanaol', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 'Gadgets', 'gadgets', 'edi wow', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Office Supplies', 'office-supplies', 'Office Supplies', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Equipment', 'equipment', 'Equipment', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_units`
--

CREATE TABLE `item_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_units`
--

INSERT INTO `item_units` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Piece', 'piece', 'Piece', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Box', 'box', 'Box', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Jumbo Box', 'jumbo-box', 'Jumbo Box', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 'Cellophane', 'cellophane', 'Cellophane', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `pages_json` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `is_active`, `pages_json`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Menu 1', 1, '[]', NULL, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_has_pages`
--

CREATE TABLE `menu_has_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `page_order` int(11) NOT NULL,
  `label` varchar(150) DEFAULT NULL,
  `uri` text DEFAULT NULL,
  `target` varchar(150) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_has_pages`
--

INSERT INTO `menu_has_pages` (`id`, `menu_id`, `parent_id`, `page_id`, `page_order`, `label`, `uri`, `target`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 1, 1, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 1, 0, 2, 2, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 1, 0, 3, 3, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 1, 0, 4, 4, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, 1, 0, 5, 5, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(6, 1, 2, 7, 1, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(7, 1, 2, 8, 2, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(8, 1, 3, 9, 1, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(9, 1, 3, 10, 2, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(10, 1, 3, 11, 3, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(11, 1, 3, 12, 4, '', '', '', 'page', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_05_044926_create_settings_table', 1),
(7, '2022_12_05_045653_create_menus_table', 1),
(8, '2022_12_05_045836_create_menu_has_pages_table', 1),
(9, '2022_12_05_064934_create_activity_logs_table', 1),
(10, '2022_12_05_065748_create_permissions_table', 1),
(11, '2022_12_05_073918_create_pages_table', 1),
(12, '2022_12_05_074752_create_albums_table', 1),
(13, '2022_12_05_080128_create_roles_table', 1),
(14, '2022_12_14_012326_create_options_table', 1),
(15, '2022_12_14_012535_create_banners_table', 1),
(16, '2022_12_14_040626_create_social_media_accounts_table', 1),
(17, '2022_12_14_074742_create_role_permission_table', 1),
(18, '2024_07_29_075127_create_item_categories_table', 1),
(19, '2024_07_29_075815_create_items_table', 1),
(20, '2024_08_09_031450_create_receiving_headers_table', 1),
(21, '2024_08_09_031505_create_receiving_details_table', 1),
(22, '2024_08_09_031517_create_suppliers_table', 1),
(23, '2024_08_14_063439_create_receivers_table', 1),
(24, '2024_08_14_070146_create_issuance_headers_table', 1),
(25, '2024_08_14_070157_create_issuance_details_table', 1),
(26, '2024_11_29_070007_create_item_types_table', 1),
(27, '2024_12_05_071530_create_purchase_order_headers_table', 1),
(28, '2024_12_05_071540_create_purchase_order_details_table', 1),
(29, '2024_12_19_011210_create_vehicles_table', 1),
(30, '2025_02_20_022317_create_employees_table', 1),
(31, '2025_02_25_012537_create_par_headers_table', 1),
(32, '2025_02_25_012549_create_par_details_table', 1),
(33, '2025_03_25_075543_create_sections_table', 1),
(34, '2025_03_25_075554_create_divisions_table', 1),
(35, '2025_03_25_093315_create_item_units_table', 1),
(36, '2025_03_31_005531_create_requisition_headers_table', 1),
(37, '2025_03_31_005540_create_requisition_details_table', 1),
(38, '2025_04_21_025900_create_par_borrowed_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` text NOT NULL,
  `field_type` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `type`, `name`, `value`, `field_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'animation', 'Fade In', 'fadeIn', 'entrance', NULL, NULL, NULL),
(2, 'animation', 'Fade Out', 'fadeOut', 'exit', NULL, NULL, NULL),
(3, 'animation', 'Fade In Down', 'fadeInDown', 'entrance', NULL, NULL, NULL),
(4, 'animation', 'Fade Out Down', 'fadeOutDown', 'exit', NULL, NULL, NULL),
(5, 'animation', 'Fade In Down Big', 'fadeInDownBig', 'entrance', NULL, NULL, NULL),
(6, 'animation', 'Fade Out Down Big', 'fadeOutDownBig', 'exit', NULL, NULL, NULL),
(7, 'animation', 'Fade In Left', 'fadeInLeft', 'entrance', NULL, NULL, NULL),
(8, 'animation', 'Fade Out Left', 'fadeOutLeft', 'exit', NULL, NULL, NULL),
(9, 'animation', 'Fade In Left Big', 'fadeInLeftBig', 'entrance', NULL, NULL, NULL),
(10, 'animation', 'Fade Out Left Big', 'fadeOutDownBig', 'exit', NULL, NULL, NULL),
(11, 'animation', 'Fade In Right', 'fadeInRight', 'entrance', NULL, NULL, NULL),
(12, 'animation', 'Fade Out Right', 'fadeOutRight', 'exit', NULL, NULL, NULL),
(13, 'animation', 'Fade In Right Big', 'fadeInRightBig', 'entrance', NULL, NULL, NULL),
(14, 'animation', 'Fade Out Right Big', 'fadeInRightBig', 'exit', NULL, NULL, NULL),
(15, 'animation', 'Fade In Up', 'fadeInUp', 'entrance', NULL, NULL, NULL),
(16, 'animation', 'Fade Out Up', 'fadeOutUp', 'exit', NULL, NULL, NULL),
(17, 'animation', 'Fade In Up Big', 'fadeInUpBig', 'entrance', NULL, NULL, NULL),
(18, 'animation', 'Fade Out Up Big', 'fadeInUpBig', 'exit', NULL, NULL, NULL),
(19, 'animation', 'Bounce In', 'bounceIn', 'entrance', NULL, NULL, NULL),
(20, 'animation', 'Bounce Out', 'bounceOut', 'exit', NULL, NULL, NULL),
(21, 'animation', 'Bounce In Down', 'bounceInDown', 'entrance', NULL, NULL, NULL),
(22, 'animation', 'Bounce Out Down', 'bounceOutDown', 'exit', NULL, NULL, NULL),
(23, 'animation', 'Bounce In Left', 'bounceInLeft', 'entrance', NULL, NULL, NULL),
(24, 'animation', 'Bounce Out Left', 'bounceOutLeft', 'exit', NULL, NULL, NULL),
(25, 'animation', 'Bounce In Right', 'bounceInRight', 'entrance', NULL, NULL, NULL),
(26, 'animation', 'Bounce Out Right', 'bounceOutRight', 'exit', NULL, NULL, NULL),
(27, 'animation', 'Bounce In Up', 'bounceInUp', 'entrance', NULL, NULL, NULL),
(28, 'animation', 'Bounce Out Up', 'bounceOutUp', 'exit', NULL, NULL, NULL),
(29, 'animation', 'Route In', 'rotateIn', 'entrance', NULL, NULL, NULL),
(30, 'animation', 'Route Out', 'rotateOut', 'exit', NULL, NULL, NULL),
(31, 'animation', 'Route In Down Left', 'rotateInDownLeft', 'entrance', NULL, NULL, NULL),
(32, 'animation', 'Route Out Down Left', 'rotateOutDownLeft', 'exit', NULL, NULL, NULL),
(33, 'animation', 'Route In Down Right', 'rotateInDownRight', 'entrance', NULL, NULL, NULL),
(34, 'animation', 'Route Out Down Right', 'rotateOutDownRight', 'exit', NULL, NULL, NULL),
(35, 'animation', 'Route In Up Left', 'rotateInUpLeft', 'entrance', NULL, NULL, NULL),
(36, 'animation', 'Route Out Up Left', 'rotateOutUpLeft', 'exit', NULL, NULL, NULL),
(37, 'animation', 'Route In Up Right', 'rotateInUpRight', 'entrance', NULL, NULL, NULL),
(38, 'animation', 'Route Out Up Right', 'rotateOutUpRight', 'exit', NULL, NULL, NULL),
(39, 'animation', 'Slide In Up', 'slideInUp', 'entrance', NULL, NULL, NULL),
(40, 'animation', 'Slide Out Up', 'slideOutUp', 'exit', NULL, NULL, NULL),
(41, 'animation', 'Slide In Down', 'slideInDown', 'entrance', NULL, NULL, NULL),
(42, 'animation', 'Slide Out Down', 'slideOutDown', 'exit', NULL, NULL, NULL),
(43, 'animation', 'Slide In Left', 'slideInLeft', 'entrance', NULL, NULL, NULL),
(44, 'animation', 'Slide Out Left', 'slideOutLeft', 'exit', NULL, NULL, NULL),
(45, 'animation', 'Slide In Right', 'slideInRight', 'entrance', NULL, NULL, NULL),
(46, 'animation', 'Slide Out Right', 'slideOutRight', 'exit', NULL, NULL, NULL),
(47, 'animation', 'Zoom In', 'zoomIn', 'entrance', NULL, NULL, NULL),
(48, 'animation', 'Zoom Out', 'zoomOut', 'exit', NULL, NULL, NULL),
(49, 'animation', 'Zoom In Down', 'zoomInDown', 'entrance', NULL, NULL, NULL),
(50, 'animation', 'Zoom Out Down', 'zoomOutDown', 'exit', NULL, NULL, NULL),
(51, 'animation', 'Zoom In Left', 'zoomInLeft', 'entrance', NULL, NULL, NULL),
(52, 'animation', 'Zoom Out Left', 'zoomOutLeft', 'exit', NULL, NULL, NULL),
(53, 'animation', 'Zoom In Right', 'zoomInRight', 'entrance', NULL, NULL, NULL),
(54, 'animation', 'Zoom Out Right', 'zoomOutRight', 'exit', NULL, NULL, NULL),
(55, 'animation', 'Zoom In Up', 'zoomInUp', 'entrance', NULL, NULL, NULL),
(56, 'animation', 'Zoom Out Up', 'zoomOutUp', 'exit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_page_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `label` varchar(150) DEFAULT NULL,
  `contents` text DEFAULT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `styles` text DEFAULT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'draft',
  `page_type` varchar(150) NOT NULL DEFAULT 'custom',
  `image_url` text DEFAULT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keyword` varchar(150) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_page_id`, `album_id`, `slug`, `name`, `label`, `contents`, `json`, `styles`, `status`, `page_type`, `image_url`, `meta_title`, `meta_keyword`, `meta_description`, `user_id`, `template`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 1, 'home', 'Home', 'Home', '\n        <div class=\"container topmargin-lg bottommargin-lg\">\n            <div class=\"heading-block mw-xs mx-auto text-center mb-6\">\n                <h3 class=\" nott ls0\">Tour Packages</h3>\n            </div>\n\n            <div class=\"row\">\n                <div class=\"col-lg-4 px-lg-5 mt-5 mt-lg-0 text-center\">\n                    <div class=\"mb-4\">\n                        <img src=\"http://172.16.11.76:7979/theme/images/travels/image1.jpg\" />\n                    </div>\n                    <h3 class=\"fw-semibold font-body mb-4 \">The most comprehensive template collection on envato.</h3>\n                    <p class=\"op-06 fw-medium \">\"Completely productivate quality web services rather than standards compliant niches. Continually engineer.\"</p>\n                </div>\n                <div class=\"col-lg-4 px-lg-5 mt-5 mt-lg-0 text-center\">\n                    <div class=\"mb-4\">\n                        <img src=\"http://172.16.11.76:7979/theme/images/travels/image2.jpg\" />\n                    </div>\n                    <h3 class=\"fw-semibold font-body mb-4 \">Awesome Design &amp; Customer Support.</h3>\n                    <p class=\"op-06 fw-medium \">\"Amazing WORK ! This guys also very fast for support. No matter Sunday or Monday. I get my answers and they were really patiently with my sometimes stupid questions!\"</p>\n                </div>\n                <div class=\"col-lg-4 px-lg-5 mt-5 mt-lg-0 text-center\">\n                    <div class=\"mb-4\">\n                        <img src=\"http://172.16.11.76:7979/theme/images/travels/image3.jpg\" />\n                    </div>\n                    <h3 class=\"fw-semibold font-body mb-4 \">Flexibility and Feature Availability</h3>\n                    <p class=\"op-06 fw-medium \">\"A great thing that there are many demos available otherwise all of the great implementation and features would never be used or understood the right way.\"</p>\n                </div>\n            </div>\n\n            <div class=\"text-center m-auto w-75\">					\n                <a href=\"tour-package-details.htm\" class=\"button button-border button-rounded ms-0 topmargin-sm button-small\">View All</a>\n            </div>\n        </div>\n        \n        <div class=\"section mb-0 mt-0\" style=\"background-color:#264653;\">\n            <div class=\"container\">\n                <div class=\"heading-block mw-xs mx-auto text-center mb-6\">\n                    <h3 class=\"nott ls0 text-white\">Latest News</h3>\n                </div>\n\n                <div id=\"oc-posts\" class=\"owl-carousel posts-carousel carousel-widget posts-md\" data-pagi=\"false\" data-items-xs=\"1\" data-items-sm=\"2\" data-items-md=\"3\" data-items-lg=\"4\">\n                    <div class=\"oc-item\">\n                        <div class=\"entry topmargin-sm\">\n                            <div class=\"entry-image\">\n                                <a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/news/news1.jpg\" alt=\"Image\"></a>\n                            </div>\n                            <div class=\"entry-title title-xs nott\">\n                                <h3><a href=\"#\" class=\"text-white\">Bloomberg smart cities; change-makers economic security</a></h3>\n                            </div>\n                            <div class=\"entry-meta\">\n                                <ul>\n                                    <li><i class=\"icon-calendar3\"></i> 13th Jun 2021</li>\n                                </ul>\n                            </div>\n                            <div class=\"entry-content mt-3 text-white\">\n                                <p>Prevention effect, advocate dialogue rural development lifting people up community civil society. Catalyst, grantees leverage.</p>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"oc-item\">\n                        <div class=\"entry topmargin-sm\">\n                            <div class=\"entry-image\">\n                                <a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/news/news2.jpg\" alt=\"Image\"></a>\n                            </div>\n                            <div class=\"entry-title title-xs nott\">\n                                <h3><a href=\"#\" class=\"text-white\">Medicine new approaches communities, outcomes partnership</a></h3>\n                            </div>\n                            <div class=\"entry-meta\">\n                                <ul>\n                                    <li><i class=\"icon-calendar3\"></i> 24th Feb 2021</li>\n                                </ul>\n                            </div>\n                            <div class=\"entry-content mt-3 text-white\">\n                                <p>Cross-agency coordination clean water rural, promising development turmoil inclusive education transformative community.</p>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"oc-item\">\n                        <div class=\"entry topmargin-sm\">\n                            <div class=\"entry-image\">\n                                <a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/news/news3.jpg\" alt=\"Image\"></a>\n                            </div>\n                            <div class=\"entry-title title-xs nott\">\n                                <h3><a href=\"#\" class=\"text-white\">Significant altruism planned giving insurmountable challenges liberal</a></h3>\n                            </div>\n                            <div class=\"entry-meta\">\n                                <ul>\n                                    <li><i class=\"icon-calendar3\"></i> 30th Dec 2021</li>\n                                </ul>\n                            </div>\n                            <div class=\"entry-content mt-3 text-white\">\n                                <p>Micro-finance; vaccines peaceful contribution citizens of change generosity. Measures design thinking accelerate progress medical initiative.</p>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"oc-item\">\n                        <div class=\"entry topmargin-sm\">\n                            <div class=\"entry-image\">\n                                <a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/news/news4.jpg\" alt=\"Image\"></a>\n                            </div>\n                            <div class=\"entry-title title-xs nott\">\n                                <h3><a href=\"#\" class=\"text-white\">Compassion conflict resolution, progressive; tackle</a></h3>\n                            </div>\n                            <div class=\"entry-meta\">\n                                <ul>\n                                    <li><i class=\"icon-calendar3\"></i> 15th Jan 2021</li>\n                                </ul>\n                            </div>\n                            <div class=\"entry-content mt-3 text-white\">\n                                <p>Community health workers best practices, effectiveness meaningful work The Elders fairness. Our ambitions local solutions globalization.</p>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"oc-item\">\n                        <div class=\"entry topmargin-sm\">\n                            <div class=\"entry-image\">\n                                <a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/news/news2.jpg\" alt=\"Image\"></a>\n                            </div>\n                            <div class=\"entry-title title-xs nott\">\n                                <h3><a href=\"#\" class=\"text-white\">Medicine new approaches communities, outcomes partnership</a></h3>\n                            </div>\n                            <div class=\"entry-meta\">\n                                <ul>\n                                    <li><i class=\"icon-calendar3\"></i> 24th Feb 2021</li>\n                                </ul>\n                            </div>\n                            <div class=\"entry-content mt-3 text-white\">\n                                <p>Cross-agency coordination clean water rural, promising development turmoil inclusive education transformative community.</p>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"text-center m-auto w-75\">					\n                    <a href=\"news.htm\" class=\"button button-border button-rounded ms-0 topmargin-sm button-small button-yellow\">Read More</a>\n                </div>\n            </div>\n        </div>\n        \n        \n        <div class=\"container topmargin-lg bottommargin-lg\">\n            <div class=\"row\">\n                <div class=\"col-md-4 text-center\">\n                    <span class=\"icon-image1 icon-5x\"></span>\n                    <h3>Item It</h3>\n                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus voluptate id aperiam ea ipsum magni aut perspiciatis rem voluptatibus.</p>\n                </div>\n                <div class=\"col-md-4 text-center\">\n                    <span class=\"icon-image1 icon-5x\"></span>\n                    <h3>Live It</h3>\n                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus voluptate id aperiam ea ipsum magni aut perspiciatis rem voluptatibus.</p>\n                </div>\n                <div class=\"col-md-4 text-center\">\n                    <span class=\"icon-image1 icon-5x\"></span>\n                    <h3>Love It</h3>\n                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt, blanditiis est quisquam doloribus voluptate id aperiam ea ipsum magni aut perspiciatis rem voluptatibus.</p>\n                </div>\n            </div>\n        </div>\n        \n        <div class=\"section m-0 p-0\">\n            <div class=\"container topmargin-lg bottommargin-lg\">\n                <div class=\"col-12\">\n                    <div class=\"heading-block mw-xs mx-auto text-center mb-2\">\n                        <h3 class=\" nott ls0\">Affiliated With</h3>\n                    </div>\n\n                    <div id=\"oc-clients\" class=\"owl-carousel image-carousel carousel-widget\" data-margin=\"60\" data-loop=\"true\" data-nav=\"false\" data-autoplay=\"5000\" data-pagi=\"false\" data-items-xs=\"2\" data-items-sm=\"3\" data-items-md=\"4\" data-items-lg=\"5\" data-items-xl=\"5\">\n\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/dot.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/iata.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/philtoa.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/piata.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/ptaa.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/tcp.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/women.png\" alt=\"Clients\"></a></div>\n                        <div class=\"oc-item\"><a href=\"#\"><img src=\"http://172.16.11.76:7979/theme/images/clients/immigration.png\" alt=\"Clients\"></a></div>\n\n                    </div>\n                </div>\n            </div>\n        </div>', NULL, NULL, 'PUBLISHED', 'default', '', 'Home', 'home', 'Home page', '1', 'home', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 0, 2, 'about-us', 'About', 'About', '\n            <div class=\"container topmargin-lg bottommargin-lg\">\n                <div class=\"row\">\n                    <span onclick=\"closeNav()\" class=\"dark-curtain\"></span>\n                    <div class=\"col-lg-12 col-md-5 col-sm-12\">\n                        <span onclick=\"openNav()\" class=\"button button-small button-circle border-bottom ms-0 text-initial nols fw-normal noleftmargin d-lg-none mb-4\"><span class=\"icon-chevron-left me-2 color-2\"></span> Quicklinks</span>\n                    </div>\n                    <div class=\"col-lg-3 pe-lg-4\">\n                        <div class=\"tablet-view\">\n                            <a href=\"javascript:void(0)\" class=\"closebtn d-block d-lg-none\" onclick=\"closeNav()\">&times;</a>\n\n                            <div class=\"card border-0\">\n                                <h3>Quicklinks</h3>\n                                <div class=\"side-menu\">\n                                    <ul class=\"mb-0 pb-0\">\n                                        <li class=\"active\"><a href=\"#\"><div>Company Profile</div></a></li>\n                                        <li><a href=\"#\"><div>Awards</div></a></li>\n                                    </ul>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"col-lg-9\">\n                        <h2>Who We Are</h2>\n\n                        <div class=\"row\">\n                            <div class=\"col-md-5\">\n                                <img src=\"http://172.16.11.76:7979/theme/images/travels/image3.jpg\" alt=\"We\'re divided land his creature which have evening subdue\">\n                            </div>\n                            <div class=\"col-md-7\">\n                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n\n                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>', NULL, NULL, 'PUBLISHED', 'standard', '', 'About Us', 'About Us', 'About Us page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 0, 2, 'services', 'Services', 'Services', '\n            <div class=\"container topmargin-lg bottommargin-lg\">\n                <div class=\"row\">\n                    <span onclick=\"closeNav()\" class=\"dark-curtain\"></span>\n                    <div class=\"col-lg-12 col-md-5 col-sm-12\">\n                        <span onclick=\"openNav()\" class=\"button button-small button-circle border-bottom ms-0 text-initial nols fw-normal noleftmargin d-lg-none mb-4\"><span class=\"icon-chevron-left me-2 color-2\"></span> Quicklinks</span>\n                    </div>\n                    <div class=\"col-lg-3 pe-lg-4\">\n                        <div class=\"tablet-view\">\n                            <a href=\"javascript:void(0)\" class=\"closebtn d-block d-lg-none\" onclick=\"closeNav()\">&times;</a>\n\n                            <div class=\"card border-0\">\n                                <h3>Quicklinks</h3>\n                                <div class=\"side-menu\">\n                                    <ul class=\"mb-0 pb-0\">\n                                        <li class=\"active\"><a class=\"menu-link\" href=\"services.htm\"><div>Ticketing and Reservations</div></a></li>\n                                        <li><a class=\"menu-link\" href=\"services.htm\"><div>Hotel Itemings and Reservations</div></a></li>\n                                        <li><a class=\"menu-link\" href=\"services.htm\"><div>Passport and Visa Processing</div></a></li>\n                                        <li><a class=\"menu-link\" href=\"services.htm\"><div>Travel Insurance</div></a></li>\n                                    </ul>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"col-lg-9\">\n                        <h2>Ticketing and Reservations</h2>\n\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>\n\n                        <p class=\"nobottommargin\">\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\n                    </div>\n                </div>\n            </div>\n        ', NULL, NULL, 'PUBLISHED', 'standard', '', 'Services', 'Services', 'Services page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 0, 2, 'tour-packages', 'Tour Packages', 'Tour Packages', '\n            <div class=\"container topmargin-lg bottommargin-lg\">\n                <div class=\"row\">\n                    <div class=\"entry col-md-4 px-lg-5 mt-5 mt-lg-0\">\n                        <div class=\"grid-inner row g-0\">\n                            <div class=\"col-12\">\n                                <div class=\"news-imag\">\n                                    <a href=\"tour-package-details.htm\"><img src=\"http://172.16.11.76:7979/theme/images/travels/image2.jpg\" alt=\"We\'re divided land his creature which have evening subdue\"></a>\n                                </div>\n                            </div>\n                            <div class=\"col-12 text-center\">\n                                <div class=\"entry-title title-sm py-3\">\n                                    <h2><a href=\"tour-package-details.htm\">This is a Standard post with a Preview Image</a></h2>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"entry col-md-4 px-lg-5 mt-5 mt-lg-0\">\n                        <div class=\"grid-inner row g-0\">\n                            <div class=\"col-12\">\n                                <div class=\"news-imag\">\n                                    <a href=\"tour-package-details.htm\"><img src=\"http://172.16.11.76:7979/theme/images/travels/image1.jpg\" alt=\"We\'re divided land his creature which have evening subdue\"></a>\n                                </div>\n                            </div>\n                            <div class=\"col-12 text-center\">\n                                <div class=\"entry-title title-sm py-3\">\n                                    <h2><a href=\"tour-package-details.htm\">This is a Standard post with a Preview Image</a></h2>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n\n                    <div class=\"entry col-md-4 px-lg-5 mt-5 mt-lg-0\">\n                        <div class=\"grid-inner row g-0\">\n                            <div class=\"col-12\">\n                                <div class=\"news-imag\">\n                                    <a href=\"tour-package-details.htm\"><img src=\"http://172.16.11.76:7979/theme/images/travels/image3.jpg\" alt=\"We\'re divided land his creature which have evening subdue\"></a>\n                                </div>\n                            </div>\n                            <div class=\"col-12 text-center\">\n                                <div class=\"entry-title title-sm py-3\">\n                                    <h2><a href=\"tour-package-details.htm\">This is a Standard post with a Preview Image</a></h2>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    \n                    <div class=\"entry col-md-4 px-lg-5 mt-5 mt-lg-0\">\n                        <div class=\"grid-inner row g-0\">\n                            <div class=\"col-12\">\n                                <div class=\"news-imag\">\n                                    <a href=\"tour-package-details.htm\"><img src=\"http://172.16.11.76:7979/theme/images/travels/image2.jpg\" alt=\"We\'re divided land his creature which have evening subdue\"></a>\n                                </div>\n                            </div>\n                            <div class=\"col-12 text-center\">\n                                <div class=\"entry-title title-sm py-3\">\n                                    <h2><a href=\"tour-package-details.htm\">This is a Standard post with a Preview Image</a></h2>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        ', NULL, NULL, 'PUBLISHED', 'standard', '', 'Tour Packages', 'Tour Packages', 'Tour Packages page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, 0, 2, 'contact-us', 'Contact Us', 'Contact Us', '\n            <div class=\"col-12\">\n                <h3>Contact Details</h3>\n            </div>\n            <div class=\"col-lg-7 mb-5\">\n                <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.4304358272857!2d120.99440521464825!3d14.517354383003676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ceafabef58cb%3A0x7a5d4f5233f8f45b!2sHouse%20Of%20Travel!5e0!3m2!1sen!2sph!4v1679467638444!5m2!1sen!2sph\" width=\"100%\" height=\"70\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>\n\n                <div class=\"row topmargin d-none\">\n                    <div class=\"col-lg-6\">\n                        <address>\n                            <abbr title=\"Address\">Address:</abbr><br>\n                            444a EDSA, Guadalupe Viejo, Makati City, Philippines 1211\n                        </address>\n                    </div>\n                    <div class=\"col-lg-6\">\n                        <p><abbr title=\"Email Address\">Email:</abbr><br>info@vanguard.edu.ph</p>\n                    </div>\n                    <div class=\"col-lg-6\">\n                        <p class=\"nomargin\"><abbr title=\"Phone Number\">Phone:</abbr><br>(632) 8-1234-4567</p>\n                    </div>\n                    <div class=\"col-lg-6\">\n                        <p class=\"nomargin\"><abbr title=\"Phone Number\">Fax:</abbr><br>(632) 8-1234-4567</p>\n                    </div>\n                </div>\n            </div>\n            <div class=\"col-lg-5\">\n                <div class=\"table-responsive-faker\">\n                    <table>\n                        <tbody>\n                        <tr>\n                            <td><i class=\"bg-transparent i-small icon-line-map-pin m-0 me-1\"></i></td>\n                            <td><h5 class=\"m-0\">2/F Anflocor Building 411 Quirino Aveñue, corner NAIA Road, Barangay Tambo Parañaque City, Metro Manila</h5></td>\n                        </tr>\n                        <tr><td colspan=\"2\">&nbsp;</td></tr>\n                        <tr>\n                            <td><i class=\"bg-transparent i-small icon-phone1 m-0 me-1\"></i></td>\n                            <td><h6 class=\"m-0\">(+63) (2) 8832-2404 <br>(+63) (2) 8853-3988 <br>(+63) (2) 8855-2741 to 47</h6></td>\n                        </tr>\n                        <tr><td colspan=\"2\">&nbsp;</td></tr>\n                        <tr>\n                            <td><i class=\"bg-transparent i-small icon-clock2 m-0 me-1\"></i></td>\n                            <td><h6 class=\"m-0\">Monday – Thursday: 8:00AM – 6:00PM\n                            <br>Friday: 8:00AM – 5:00PM</h6></td>\n                        </tr>\n                        </tbody>\n                    </table>\n                </div>\n\n                <a href=\"#\" class=\"social-icon si-small si-light si-facebook\">\n                    <i class=\"icon-facebook\"></i>\n                    <i class=\"icon-facebook\"></i>\n                </a>\n\n                <br><br>\n            </div>', NULL, NULL, 'PUBLISHED', 'standard', '', 'Contact Us', 'Contact Us', 'Contact Us page', '1', 'contact-us', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(6, 0, 0, 'footer', 'Footer', 'footer', '\n        <footer id=\"footer\" class=\"border-0 border-top\">\n            <div class=\"container\">\n\n                <!-- Footer Widgets\n                ============================================= -->\n                <div class=\"footer-widgets-wrap\">\n\n                    <div class=\"row justify-content-between\">\n                        <div class=\"col-lg-10 offset-lg-1 mb-5 mb-lg-0\">\n                            <div class=\"fw-semibold font-primary color ls3 h2 text-uppercase mb-0\"><img src=\"http://172.16.11.76:7979/theme/images/hoti-logo-white.png\" /></div>\n                            \n                            <div class=\"row\">\n                                <div class=\"col-lg-5 dark\">\n                                    <div class=\"table-responsive-faker\">\n                                        <table>\n                                            <tbody>\n                                            <tr>\n                                                <td><i class=\"bg-transparent i-small icon-line-map-pin m-0 me-1\"></i></td>\n                                                <td><h5 class=\"m-0\">2/F Anflocor Building 411 Quirino Aveñue, corner NAIA Road, Barangay Tambo Parañaque City, Metro Manila</h5></td>\n                                            </tr>\n                                            <tr><td colspan=\"2\">&nbsp;</td></tr>\n                                            <tr>\n                                                <td><i class=\"bg-transparent i-small icon-phone1 m-0 me-1\"></i></td>\n                                                <td><h6 class=\"m-0\">(+63) (2) 8832-2404 <br>(+63) (2) 8853-3988 <br>(+63) (2) 8855-2741 to 47</h6></td>\n                                            </tr>\n                                            <tr><td colspan=\"2\">&nbsp;</td></tr>\n                                            <tr>\n                                                <td><i class=\"bg-transparent i-small icon-clock2 m-0 me-1\"></i></td>\n                                                <td><h6 class=\"m-0\">Monday – Thursday: 8:00AM – 6:00PM\n                                                <br>Friday: 8:00AM – 5:00PM</h6></td>\n                                            </tr>\n                                            </tbody>\n                                        </table>\n                                    </div>\n\n                                    \n                                    \n                                    <a href=\"#\" class=\"social-icon si-small si-light si-facebook\">\n                                        <i class=\"icon-facebook\"></i>\n                                        <i class=\"icon-facebook\"></i>\n                                    </a>\n                                    \n                                    <br><br>\n                                </div>\n                                <div class=\"col-lg-7 dark\">\n                                    <div class=\"row\">\n                                        <div class=\"col-md-6\">\n                                            <div class=\"mb-2\">\n                                                <h5 class=\"m-0\">Ticketing Department</h5>\n                                                <small>For ticketing and reservation inquiry:</small>\n                                                <table class=\"table-responsive m-0\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td><i class=\"bg-transparent i-small icon-envelope21 m-0 me-1\"></i></td>\n                                                            <td><a class=\"text-white text-decoration-underline\" href=\"mailto:ticketing@houseoftravel.com.ph\">ticketing@houseoftravel.com.ph</a></td>\n                                                        </tr>\n                                                    </tbody>\n                                                </table>\n                                                \n                                            </div>\n                                            \n                                            <div class=\"mb-2\">\n                                                <h5 class=\"m-0\">Tours Department</h5>\n                                                <small>For tour packages inquiry:</small>\n                                                <table class=\"table-responsive m-0\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td><i class=\"bg-transparent i-small icon-envelope21 m-0 me-1\"></i></td>\n                                                            <td><a class=\"text-white text-decoration-underline\"  href=\"mailto:tours@houseoftravel.com.ph\">tours@houseoftravel.com.ph</a></td>\n                                                        </tr>\n                                                    </tbody>\n                                                </table>\n                                            </div>\n                                            \n                                            <div class=\"mb-2\">\n                                                <h5 class=\"m-0\">Documentation Department</h5>\n                                                <small>For passport, visa and other document concern:</small>\n                                                <table class=\"table-responsive m-0\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td><i class=\"bg-transparent i-small icon-envelope21 m-0 me-1\"></i></td>\n                                                            <td><a class=\"text-white text-decoration-underline\"  href=\"mailto:documentation@houseoftravel.com.ph\">documentation@houseoftravel.com.ph</a></td>\n                                                        </tr>\n                                                    </tbody>\n                                                </table>\n                                            </div>\n                                        </div>\n                                        <div class=\"col-md-6\">\n                                            <div class=\"mb-2\">\n                                                <h5 class=\"m-0\">Pearl Farm Manila Department</h5>\n                                                <small>For pearl farm reservation inquiry:</small>\n                                                <table class=\"table-responsive m-0\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td><i class=\"bg-transparent i-small icon-envelope21 m-0 me-1\"></i></td>\n                                                            <td><a class=\"text-white text-decoration-underline\"  href=\"mailto:pearlfarm@houseoftravel.com.ph\">pearlfarm@houseoftravel.com.ph</a></td>\n                                                        </tr>\n                                                    </tbody>\n                                                </table>\n                                            </div>\n                                            \n                                            <div class=\"mb-2\">\n                                                <h5 class=\"m-0\">Technical Support Department</h5>\n                                                <small>For website technical issues concern:</small>\n                                                <table class=\"table-responsive m-0\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td><i class=\"bg-transparent i-small icon-envelope21 m-0 me-1\"></i></td>\n                                                            <td><a class=\"text-white text-decoration-underline\" href=\"mailto:support@houseoftravel.com.ph\">support@houseoftravel.com.ph</a></td>\n                                                        </tr>\n                                                    </tbody>\n                                                </table>\n                                            </div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n\n                </div><!-- .footer-widgets-wrap end -->\n\n            </div>\n\n            <!-- Copyrights\n            ============================================= -->\n            <div id=\"copyrights\" class=\"\">\n                <div class=\"container\">\n\n                    <div class=\"row justify-content-between\">\n\n                        <div class=\"col\">\n                            <span class=\"text-black-50\">&copy; 2023 House of Travel, Inc.</span>\n                        </div>\n\n                        <div class=\"col text-end\">\n                            <a href=\"#\">Home</a>/<a href=\"#\">About</a>/<a href=\"#\">Service</a>/<a href=\"#\">Tour Packages</a>/<a href=\"#\">Contact</a>\n                        </div>\n\n                    </div>\n\n                </div>\n            </div><!-- #copyrights end -->\n        </footer><!-- #footer end -->', NULL, NULL, 'PUBLISHED', 'default', '', '', '', '', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(7, 0, 0, 'company-profile', 'Company Profile', 'Company Profile', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Company Profile', 'Company Profile', 'Company Profile Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(8, 0, 0, 'awards', 'Awards', 'Awards', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Awards', 'Awards', 'Awards Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(9, 0, 0, 'ticketing-and-reservations', 'Ticketing and Reservations', 'Ticketing and Reservations', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Ticketing and Reservations', 'Ticketing and Reservations', 'Ticketing and Reservations Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(10, 0, 0, 'hotel-bookings-and-reservations', 'Hotel Itemings and Reservations', 'Hotel Itemings and Reservations', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Hotel Itemings and Reservations', 'Hotel Itemings and Reservations', 'Hotel Itemings and Reservations Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(11, 0, 0, 'passport-and-visa-processing', 'Passport and Visa Processing', 'Passport and Visa Processing', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Passport and Visa Processing', 'Passport and Visa Processing', 'Passport and Visa Processing Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(12, 0, 0, 'travel-insurance', 'Travel Insurance', 'Travel Insurance', '', NULL, NULL, 'PUBLISHED', 'default', '', 'Travel Insurance', 'Travel Insurance', 'Travel Insurance Page', '1', '', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `par_borrowed_items`
--

CREATE TABLE `par_borrowed_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `par_detail_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_borrowed` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'OPEN',
  `remarks` longtext DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `par_borrowed_items`
--

INSERT INTO `par_borrowed_items` (`id`, `par_detail_id`, `item_id`, `sku`, `barcode`, `item_description`, `employee_id`, `date_borrowed`, `date_returned`, `status`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '202500103', '123', 'Ceramic Plate', 2, '2025-04-21', '2025-04-21', 'CLOSED', 'GIULI NAKO KAY MANA KO', 1, '2025-04-20 22:31:18', '2025-04-20 22:51:18'),
(2, 1, 4, '202500103', '123', 'Ceramic Plate', 4, '2025-04-21', '2025-04-21', 'CLOSED', 'ULI NAKO OY', 1, '2025-04-20 22:51:55', '2025-04-20 22:52:06'),
(3, 1, 4, '202500103', '123', 'Ceramic Plate', 3, '2025-04-22', '2025-04-22', 'CLOSED', 'GANI', 1, '2025-04-21 17:49:43', '2025-04-21 17:49:56'),
(4, 7, 2, '202500101', '000026L8', 'Wooden Chair', 1, '2025-04-22', '2025-04-22', 'CLOSED', 'test return', 1, '2025-04-21 21:37:24', '2025-04-21 21:37:58'),
(5, 7, 2, '202500101', '000026L8', 'Wooden Chair', 1, '2025-04-22', '2025-04-22', 'CLOSED', 'OK NA', 1, '2025-04-21 21:49:31', '2025-04-21 21:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `par_details`
--

CREATE TABLE `par_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `par_header_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `quantity` decimal(16,0) DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'OPEN',
  `transferred_to` bigint(20) UNSIGNED DEFAULT NULL,
  `borrowed_to` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `par_details`
--

INSERT INTO `par_details` (`id`, `par_header_id`, `item_id`, `sku`, `barcode`, `item_description`, `price`, `quantity`, `status`, `transferred_to`, `borrowed_to`, `remarks`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, '202500103', '123', 'Ceramic Plate', '0.00', '1', 'OPEN', NULL, NULL, 'GANI', 1, '2025-04-20 22:29:31', '2025-04-21 17:49:56', NULL),
(2, 2, 2, '202500101', '456', 'Wooden Chair', '0.00', '1', 'OPEN', NULL, NULL, NULL, 1, '2025-04-20 22:29:31', '2025-04-20 22:29:31', NULL),
(3, 2, 2, '202500101', '789', 'Wooden Chair', '0.00', '1', 'OPEN', NULL, NULL, NULL, 1, '2025-04-20 22:29:31', '2025-04-20 22:29:31', NULL),
(4, 3, 2, '202500101', '000026L8', 'Wooden Chair', '0.00', '1', 'CLOSED', 4, NULL, 'no issues', 1, '2025-04-21 21:33:48', '2025-04-21 21:35:48', NULL),
(5, 3, 2, '202500101', '8851295511021', 'Wooden Chair', '0.00', '1', 'OPEN', NULL, NULL, NULL, 1, '2025-04-21 21:33:48', '2025-04-21 21:33:48', NULL),
(6, 3, 2, '202500101', '4800194179881', 'Wooden Chair', '0.00', '1', 'OPEN', NULL, NULL, NULL, 1, '2025-04-21 21:33:48', '2025-04-21 21:33:48', NULL),
(7, 4, 2, '202500101', '000026L8', 'Wooden Chair', '0.00', '1', 'OPEN', NULL, NULL, 'OK NA', 1, '2025-04-21 21:35:48', '2025-04-21 21:49:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `par_headers`
--

CREATE TABLE `par_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date_released_par` date DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `issuance_header_id` bigint(20) UNSIGNED NOT NULL,
  `attachments` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `posted_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `par_headers`
--

INSERT INTO `par_headers` (`id`, `employee_id`, `date_released_par`, `date_received`, `issuance_header_id`, `attachments`, `remarks`, `posted_at`, `posted_by`, `cancelled_at`, `cancelled_by`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-20 22:29:31', '2025-04-20 22:29:31', NULL),
(2, 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-20 22:29:31', '2025-04-20 22:29:31', NULL),
(3, 3, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-21 21:33:48', '2025-04-21 21:33:48', NULL),
(4, 4, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-04-21 21:35:48', '2025-04-21 21:35:48', NULL);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `routes` text DEFAULT NULL,
  `methods` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_view_page` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `po_number` varchar(255) NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `quantity` decimal(16,0) DEFAULT 0,
  `remaining` decimal(16,0) DEFAULT 0,
  `price` decimal(16,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_headers`
--

CREATE TABLE `purchase_order_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `date_ordered` date NOT NULL,
  `total_order` decimal(16,0) DEFAULT 0,
  `total_remaining` decimal(16,0) DEFAULT 0,
  `net_total` decimal(16,2) DEFAULT 0.00,
  `vat` decimal(16,2) DEFAULT 0.00,
  `grand_total` decimal(16,2) DEFAULT 0.00,
  `attachments` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'SAVED',
  `posted_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `name`, `address`, `contact`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bureau of Immigrations', 'Davao City', '09987654321', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Commmission on Audit', 'Buhangin, Davao City', '09987654321', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'San Miguel', 'Panabo City', '09987654321', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_details`
--

CREATE TABLE `receiving_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receiving_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(16,2) DEFAULT 0.00,
  `order` decimal(16,0) DEFAULT 0,
  `quantity` decimal(16,0) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receiving_details`
--

INSERT INTO `receiving_details` (`id`, `receiving_header_id`, `item_id`, `sku`, `price`, `order`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0001', NULL, '26', '53', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(2, 1, 8, '0008', NULL, '45', '83', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(3, 2, 4, '0004', NULL, '46', '54', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(4, 2, 13, '0013', NULL, '21', '68', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(5, 2, 10, '0010', NULL, '32', '93', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(6, 3, 11, '0011', NULL, '38', '56', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(7, 3, 4, '0004', NULL, '23', '62', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(8, 3, 2, '0002', NULL, '29', '72', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(9, 4, 20, '0020', NULL, '46', '61', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(10, 4, 6, '0006', NULL, '23', '87', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(11, 4, 6, '0006', NULL, '32', '94', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(12, 5, 20, '0020', NULL, '30', '76', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(13, 5, 18, '0018', NULL, '24', '64', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(14, 6, 7, '0007', NULL, '20', '59', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(15, 6, 11, '0011', NULL, '31', '88', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(16, 7, 20, '0020', NULL, '46', '86', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(17, 7, 18, '0018', NULL, '28', '65', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(18, 8, 12, '0012', NULL, '24', '66', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(19, 8, 2, '0002', NULL, '30', '58', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(20, 8, 17, '0017', NULL, '47', '98', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(21, 9, 13, '0013', NULL, '36', '77', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(22, 9, 18, '0018', NULL, '27', '62', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(23, 9, 4, '0004', NULL, '27', '100', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(24, 10, 19, '0019', NULL, '21', '70', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(25, 10, 17, '0017', NULL, '49', '80', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(26, 11, 6, '0006', NULL, '47', '53', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(27, 11, 8, '0008', NULL, '20', '70', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(28, 11, 9, '0009', NULL, '48', '97', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(29, 12, 5, '0005', NULL, '34', '86', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(30, 12, 4, '0004', NULL, '30', '70', '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(31, 13, 13, '0013', NULL, '44', '88', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(32, 13, 4, '0004', NULL, '34', '76', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(33, 14, 20, '0020', NULL, '24', '73', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(34, 14, 14, '0014', NULL, '33', '68', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(35, 14, 8, '0008', NULL, '28', '73', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(36, 15, 19, '0019', NULL, '30', '55', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(37, 15, 15, '0015', NULL, '41', '66', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(38, 16, 9, '0009', NULL, '28', '59', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(39, 16, 9, '0009', NULL, '36', '100', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(40, 17, 7, '0007', NULL, '24', '76', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(41, 17, 17, '0017', NULL, '20', '78', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(42, 18, 18, '0018', NULL, '38', '62', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(43, 18, 10, '0010', NULL, '41', '76', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(44, 18, 20, '0020', NULL, '48', '53', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(45, 19, 11, '0011', NULL, '34', '57', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(46, 19, 3, '0003', NULL, '46', '79', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(47, 20, 4, '0004', NULL, '21', '93', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(48, 20, 6, '0006', NULL, '34', '86', '2025-04-20 22:27:46', '2025-04-20 22:27:46'),
(49, 20, 18, '0018', NULL, '35', '65', '2025-04-20 22:27:46', '2025-04-20 22:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_headers`
--

CREATE TABLE `receiving_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `si_number` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `date_received` date NOT NULL,
  `attachments` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'SAVED',
  `posted_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receiving_headers`
--

INSERT INTO `receiving_headers` (`id`, `ref_no`, `si_number`, `supplier_id`, `date_received`, `attachments`, `remarks`, `status`, `posted_at`, `posted_by`, `cancelled_at`, `cancelled_by`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'R20250421-1', NULL, '[2]', '2025-04-21', NULL, 'Receiving transaction 1', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'R20250421-2', NULL, '[1]', '2025-04-21', NULL, 'Receiving transaction 2', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'R20250421-3', NULL, '[1,2]', '2025-04-21', NULL, 'Receiving transaction 3', 'POSTED', '2025-04-20 22:27:45', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 'R20250421-4', NULL, '[3]', '2025-04-21', NULL, 'Receiving transaction 4', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, 'R20250421-5', NULL, '[2,3]', '2025-04-21', NULL, 'Receiving transaction 5', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(6, 'R20250421-6', NULL, '[2]', '2025-04-21', NULL, 'Receiving transaction 6', 'POSTED', '2025-04-20 22:27:45', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(7, 'R20250421-7', NULL, '[2]', '2025-04-21', NULL, 'Receiving transaction 7', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(8, 'R20250421-8', NULL, '[2,3]', '2025-04-21', NULL, 'Receiving transaction 8', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(9, 'R20250421-9', NULL, '[1]', '2025-04-21', NULL, 'Receiving transaction 9', 'POSTED', '2025-04-20 22:27:45', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(10, 'R20250421-10', NULL, '[3]', '2025-04-21', NULL, 'Receiving transaction 10', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(11, 'R20250421-11', NULL, '[1]', '2025-04-21', NULL, 'Receiving transaction 11', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(12, 'R20250421-12', NULL, '[2,3]', '2025-04-21', NULL, 'Receiving transaction 12', 'POSTED', '2025-04-20 22:27:45', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(13, 'R20250421-13', NULL, '[1,2]', '2025-04-21', NULL, 'Receiving transaction 13', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:46', NULL),
(14, 'R20250421-14', NULL, '[3]', '2025-04-21', NULL, 'Receiving transaction 14', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(15, 'R20250421-15', NULL, '[1,2]', '2025-04-21', NULL, 'Receiving transaction 15', 'POSTED', '2025-04-20 22:27:46', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(16, 'R20250421-16', NULL, '[1,2]', '2025-04-21', NULL, 'Receiving transaction 16', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(17, 'R20250421-17', NULL, '[1,2]', '2025-04-21', NULL, 'Receiving transaction 17', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(18, 'R20250421-18', NULL, '[1]', '2025-04-21', NULL, 'Receiving transaction 18', 'POSTED', '2025-04-20 22:27:46', 1, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(19, 'R20250421-19', NULL, '[1,3]', '2025-04-21', NULL, 'Receiving transaction 19', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL),
(20, 'R20250421-20', NULL, '[2]', '2025-04-21', NULL, 'Receiving transaction 20', 'SAVED', NULL, NULL, NULL, NULL, 1, 1, '2025-04-20 22:27:46', '2025-04-20 22:27:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_details`
--

CREATE TABLE `requisition_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ref_no` varchar(255) NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `quantity` decimal(16,0) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_details`
--

INSERT INTO `requisition_details` (`id`, `requisition_header_id`, `ref_no`, `item_id`, `sku`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'RIS20250421001', 5, '202500104', '1', '2025-04-20 22:28:37', '2025-04-20 22:28:37'),
(2, 1, 'RIS20250421001', 4, '202500103', '2', '2025-04-20 22:28:37', '2025-04-20 22:28:37'),
(3, 1, 'RIS20250421001', 2, '202500101', '2', '2025-04-20 22:28:37', '2025-04-20 22:28:37'),
(4, 2, 'RIS20250422001', 5, '202500104', '5', '2025-04-21 21:29:55', '2025-04-21 21:29:55'),
(5, 2, 'RIS20250422001', 2, '202500101', '3', '2025-04-21 21:29:55', '2025-04-21 21:29:55'),
(6, 3, 'RIS20250422002', 2, '202500101', '1', '2025-04-21 22:25:01', '2025-04-21 22:25:01'),
(11, 4, 'RIS20250422003', 7, '202500106', '3', '2025-04-22 00:17:21', '2025-04-22 00:17:21'),
(12, 4, 'RIS20250422003', 5, 'Leather Wallet', '4', '2025-04-22 00:17:21', '2025-04-22 00:17:21'),
(13, 4, 'RIS20250422003', 2, '202500104', '5', '2025-04-22 00:17:21', '2025-04-22 00:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_headers`
--

CREATE TABLE `requisition_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `entity_name` varchar(255) DEFAULT NULL,
  `fund_cluster` varchar(255) DEFAULT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `responsibility_center_code` varchar(255) DEFAULT NULL,
  `date_requested` date NOT NULL,
  `date_needed` date NOT NULL,
  `purpose` longtext DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'SAVED',
  `requested_by` bigint(20) UNSIGNED DEFAULT NULL,
  `requested_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `posted_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisition_headers`
--

INSERT INTO `requisition_headers` (`id`, `ref_no`, `entity_name`, `fund_cluster`, `division_id`, `section_id`, `responsibility_center_code`, `date_requested`, `date_needed`, `purpose`, `remarks`, `status`, `requested_by`, `requested_at`, `approved_by`, `approved_at`, `posted_by`, `posted_at`, `cancelled_by`, `cancelled_at`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RIS20250421001', NULL, NULL, NULL, NULL, '1', '2025-04-21', '2025-04-21', 'For The Char', 'For The Char', 'POSTED', 1, '2025-04-20 22:28:37', NULL, NULL, 1, '2025-04-20 22:28:41', NULL, NULL, 1, NULL, '2025-04-20 22:28:37', '2025-04-20 22:28:41', NULL),
(2, 'RIS20250422001', NULL, NULL, NULL, NULL, '1234', '2025-04-22', '2025-04-23', 'test', 'test', 'POSTED', 1, '2025-04-21 21:29:55', NULL, NULL, 1, '2025-04-21 21:30:12', NULL, NULL, 1, NULL, '2025-04-21 21:29:55', '2025-04-21 21:30:12', NULL),
(3, 'RIS20250422002', NULL, NULL, NULL, NULL, '1', '2025-04-22', '2025-04-22', 'For The Char', 'For The Char', 'POSTED', 1, '2025-04-21 22:25:01', NULL, NULL, 1, '2025-04-21 22:25:05', NULL, NULL, 1, NULL, '2025-04-21 22:25:01', '2025-04-21 22:25:05', NULL),
(4, 'RIS20250422003', NULL, NULL, NULL, NULL, '2', '2025-04-22', '2025-04-22', 'For The Char', 'For The Char', 'SAVED', 1, '2025-04-22 00:13:27', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-04-22 00:13:27', '2025-04-22 00:13:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Administrator of the system', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Approver', 'Approver of the transactions', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'User', 'Normal User', 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `module_id`, `role_id`, `permission_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(2, 1, 1, 2, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(3, 2, 1, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(4, 2, 1, 2, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(5, 2, 1, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(6, 3, 1, 1, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(7, 3, 1, 2, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45'),
(8, 3, 1, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `head_emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `secretary_emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `division_id`, `head_emp_id`, `secretary_emp_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Developer', 1, 1, 4, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'DMS', 1, 2, 4, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Admin', 2, 2, 3, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, 'Kitchen', 2, 1, 3, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(5, 'Tax', 3, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(6, 'Payroll', 3, 3, 1, '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` text DEFAULT NULL,
  `website_name` varchar(150) NOT NULL,
  `website_favicon` text NOT NULL,
  `company_logo` text NOT NULL,
  `company_favicon` text NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `company_about` text NOT NULL,
  `company_address` text NOT NULL,
  `google_analytics` text DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `google_recaptcha_sitekey` text DEFAULT NULL,
  `google_recaptcha_secret` text DEFAULT NULL,
  `data_privacy_title` varchar(150) NOT NULL,
  `data_privacy_popup_content` varchar(150) NOT NULL,
  `data_privacy_content` text NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `fax_no` varchar(255) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `social_media_accounts` text DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `min_order` int(11) NOT NULL DEFAULT 0,
  `promo_is_displayed` int(11) NOT NULL DEFAULT 0,
  `review_is_allowed` int(11) NOT NULL DEFAULT 0,
  `pickup_is_allowed` int(11) NOT NULL DEFAULT 1,
  `delivery_note` text DEFAULT NULL,
  `min_order_is_allowed` int(11) NOT NULL DEFAULT 1,
  `flatrate_is_allowed` int(11) NOT NULL DEFAULT 1,
  `delivery_collect_is_allowed` int(11) NOT NULL DEFAULT 1,
  `accepted_payments` text DEFAULT NULL,
  `coupon_limit` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `api_key`, `website_name`, `website_favicon`, `company_logo`, `company_favicon`, `company_name`, `company_about`, `company_address`, `google_analytics`, `google_map`, `google_recaptcha_sitekey`, `google_recaptcha_secret`, `data_privacy_title`, `data_privacy_popup_content`, `data_privacy_content`, `mobile_no`, `fax_no`, `tel_no`, `email`, `social_media_accounts`, `copyright`, `user_id`, `min_order`, `promo_is_displayed`, `review_is_allowed`, `pickup_is_allowed`, `delivery_note`, `min_order_is_allowed`, `flatrate_is_allowed`, `delivery_collect_is_allowed`, `accepted_payments`, `coupon_limit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'Foreign Service Institute', 'http://172.16.11.76:7979/theme/images/favicon.ico', 'http://172.16.11.76:7979/theme/images/hoti-logo-white.png', '', 'Foreign Service Institute', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '795 Folsom Ave, Suite 600 San Francisco, CA 94107', NULL, 'https://www.google.com/maps?ll=14.584069,121.062934&z=17&t=m&hl=en&gl=PH&mapclient=embed&cid=4804121224053792784', '6Lfgj7cUAAAAAJfCgUcLg4pjlAOddrmRPt86tkQK', '6Lfgj7cUAAAAALOaFTbSFgCXpJldFkG8nFET9eRx', 'Privacy-Policy', 'This website uses cookies to ensure you get the best experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '(1) 8547 632521', '13232107114', '(1) 11 4752 1433', 'info@canvas.com', '', '2022-2023', 1, 0, 0, 0, 1, NULL, 1, 1, 1, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `media_account` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cellphone_no` varchar(255) DEFAULT NULL,
  `telephone_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `cellphone_no`, `telephone_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Maligaya Printers', 'Davao City', '09987654321', '2287000', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'Epson Printer', 'Davao City', '09987654321', '2287000', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, 'Asus', 'Davao City', '09987654321', '2287000', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address_street` text DEFAULT NULL,
  `address_city` varchar(250) DEFAULT NULL,
  `address_municipality` varchar(150) DEFAULT NULL,
  `address_zip` varchar(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `middlename`, `lastname`, `email`, `password`, `email_verified_at`, `avatar`, `role_id`, `is_active`, `user_id`, `mobile`, `phone`, `address_street`, `address_city`, `address_municipality`, `address_zip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Istrator', 'admin', 'user', 'istrator', 'wsiprod.demo@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-20 22:27:45', NULL, 1, 1, 1, '09456714321', '022646545', 'Maharlika St', 'Pasay', NULL, '1234', 'l3ZGRuBGJG', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, 'App Rover', 'App', 'Ro', 'Rover', 'approver', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-04-20 22:27:45', NULL, 2, 1, 2, '09456714321', '022646545', 'Maharlika St', 'Pasay', NULL, '1234', 'qzBWesgn9q', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `slug`, `plate_no`, `driver`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 'LXY 576', NULL, 'Truck', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(2, NULL, NULL, 'LXZ 810', NULL, 'Truck', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(3, NULL, NULL, 'LZS 245', NULL, 'Truck', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL),
(4, NULL, NULL, 'LYR 143', NULL, 'Truck', '2025-04-20 22:27:45', '2025-04-20 22:27:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issuance_details`
--
ALTER TABLE `issuance_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuance_headers`
--
ALTER TABLE `issuance_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_sku_unique` (`sku`),
  ADD UNIQUE KEY `items_barcode_unique` (`barcode`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_units`
--
ALTER TABLE `item_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_has_pages`
--
ALTER TABLE `menu_has_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `par_borrowed_items`
--
ALTER TABLE `par_borrowed_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `par_details`
--
ALTER TABLE `par_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `par_headers`
--
ALTER TABLE `par_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_headers`
--
ALTER TABLE `purchase_order_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_details`
--
ALTER TABLE `receiving_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_headers`
--
ALTER TABLE `receiving_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_details`
--
ALTER TABLE `requisition_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_headers`
--
ALTER TABLE `requisition_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuance_details`
--
ALTER TABLE `issuance_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `issuance_headers`
--
ALTER TABLE `issuance_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_units`
--
ALTER TABLE `item_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_has_pages`
--
ALTER TABLE `menu_has_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `par_borrowed_items`
--
ALTER TABLE `par_borrowed_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `par_details`
--
ALTER TABLE `par_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `par_headers`
--
ALTER TABLE `par_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_headers`
--
ALTER TABLE `purchase_order_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receiving_details`
--
ALTER TABLE `receiving_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `receiving_headers`
--
ALTER TABLE `receiving_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `requisition_details`
--
ALTER TABLE `requisition_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `requisition_headers`
--
ALTER TABLE `requisition_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
