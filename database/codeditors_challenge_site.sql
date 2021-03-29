-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 02:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeditors_challenge_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenges_log`
--

CREATE TABLE `challenges_log` (
  `challenge_id` int(11) NOT NULL,
  `challenge_by` int(11) NOT NULL,
  `game` varchar(255) NOT NULL,
  `console` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `game_mode` varchar(255) NOT NULL,
  `rules` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `comments` text NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `accepted_by` int(11) DEFAULT NULL,
  `accepted_timestamp` timestamp NULL DEFAULT NULL,
  `challenge_date` date DEFAULT NULL,
  `challenge_time` time DEFAULT NULL,
  `confirmed_timestamp` timestamp NULL DEFAULT NULL,
  `cancelled_timestamp` timestamp NULL DEFAULT NULL,
  `reset_timestamp` timestamp NULL DEFAULT NULL,
  `reopen_timestamp` timestamp NULL DEFAULT NULL,
  `challenge_by_claimed_result` varchar(255) NOT NULL,
  `accepted_by_claimed_result` varchar(255) NOT NULL,
  `challenge_by_claim_timestamp` timestamp NULL DEFAULT NULL,
  `accepted_by_claim_timestamp` timestamp NULL DEFAULT NULL,
  `end_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenges_log`
--

INSERT INTO `challenges_log` (`challenge_id`, `challenge_by`, `game`, `console`, `amount`, `game_mode`, `rules`, `status`, `comments`, `created_timestamp`, `accepted_by`, `accepted_timestamp`, `challenge_date`, `challenge_time`, `confirmed_timestamp`, `cancelled_timestamp`, `reset_timestamp`, `reopen_timestamp`, `challenge_by_claimed_result`, `accepted_by_claimed_result`, `challenge_by_claim_timestamp`, `accepted_by_claim_timestamp`, `end_timestamp`) VALUES
(1, 5, 'fifa_21', 'pc', 10, 'Test', 'Test', 'no_result', '', '2021-02-08 08:16:32', 6, '2021-02-18 11:05:30', '2021-02-17', '16:05:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(2, 5, 'fifa_21', 'ps4', 15, '', '', 'disputed', '', '2021-02-08 09:44:22', 11, '2021-02-17 04:35:59', '2021-02-18', '09:35:00', NULL, NULL, NULL, NULL, 'win', 'win', '2021-02-17 11:40:41', '2021-02-17 11:41:17', NULL),
(3, 5, 'fortnite', 'xbox', 15, 'Test123', 'Test123', 'no_result', '', '2021-02-08 11:52:23', 6, '2021-02-16 06:53:36', '2021-02-17', '11:53:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(4, 6, 'clash_of_clans', 'xbox', 20, 'Test', 'Test', 'no_result', '', '2021-02-09 06:17:29', 5, '2021-02-15 11:49:00', '2021-02-16', '16:48:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(5, 7, 'fifa_21', 'ps4', 10, 'test1', 'test1', 'no_result', '', '2021-02-09 11:31:56', 5, '2021-02-15 11:29:23', '2021-02-15', '16:29:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(6, 7, 'fortnite', 'pc', 15, 'test2', 'test2', 'no_result', '', '2021-02-09 11:32:32', 5, '2021-02-15 10:52:18', '2021-02-10', '15:52:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(7, 7, 'clash_of_clans', 'xbox', 20, 'test3', 'test3', 'no_result', '', '2021-02-09 11:32:44', 5, '2021-02-15 10:56:16', '2021-02-12', '15:56:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(8, 7, 'clash_of_clans', 'nintendo', 25, 'test4', 'test4', 'accepted', '', '2021-02-09 11:32:57', 5, '2021-02-23 06:11:10', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(9, 5, 'clash_of_clans', 'ps4', 10, 'testing123', 'testing123', 'cancelled', 'Challenge cancelled by owner', '2021-02-15 06:22:27', 6, '2021-02-17 07:46:03', '2021-02-18', '12:46:00', NULL, '2021-02-25 11:22:14', '2021-02-25 10:43:01', NULL, 'win', 'win', '2021-02-17 09:33:35', '2021-02-17 09:32:51', NULL),
(10, 11, 'fifa_21', 'ps4', 10, 'test', 'test', 'accepted', '', '2021-02-17 04:35:20', 12, '2021-02-17 05:00:16', '2021-02-18', '10:00:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(11, 12, 'fifa_21', 'ps4', 10, 'test', 'test', 'accepted', '', '2021-02-17 04:59:29', 5, '2021-02-20 08:35:07', '2021-02-23', '15:37:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(12, 5, 'fortnite', 'nintendo', 25, 'test', 'test', 'completed', '', '2021-02-17 07:19:49', 6, '2021-02-17 07:20:07', '2021-02-18', '12:20:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-17 11:43:56', '2021-02-17 11:44:33', NULL),
(13, 5, 'clash_of_clans', 'pc', 15, 'test', 'test', 'completed', '', '2021-02-17 11:48:18', 6, '2021-02-17 11:48:44', '2021-02-18', '16:48:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-17 11:49:36', '2021-02-17 11:49:47', NULL),
(14, 5, 'fortnite', 'ps4', 10, 'test123', 'test123', 'completed', '', '2021-02-18 10:47:43', 6, '2021-02-18 10:48:19', '2021-02-19', '15:48:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-18 10:50:42', '2021-02-18 10:51:06', NULL),
(15, 5, 'clash_of_clans', 'ps4', 10, 'test234', 'test234', 'completed', '', '2021-02-18 11:01:41', 6, '2021-02-18 11:02:00', '2021-02-19', '16:01:00', NULL, NULL, NULL, NULL, 'lose', 'win', '2021-02-18 11:03:14', '2021-02-18 11:03:26', NULL),
(16, 6, 'fifa_21', 'ps4', 10, 'asd', 'ghsgd', 'completed', '', '2021-02-18 11:08:49', 5, '2021-02-18 11:09:35', '2021-02-19', '16:09:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-18 11:09:52', '2021-02-18 11:09:58', NULL),
(17, 5, 'fifa_21', 'ps4', 10, 'asd', 'asd', 'no_result', '', '2021-02-18 11:10:50', 6, '2021-02-18 11:11:22', '2021-02-17', '16:11:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(18, 5, 'fifa_21', 'pc', 15, 'sadhj', 'kasjhdkj', 'completed', '', '2021-02-18 11:58:25', 6, '2021-02-18 11:58:46', '2021-02-19', '16:58:00', NULL, NULL, NULL, NULL, 'lose', 'win', '2021-02-19 04:40:18', '2021-02-19 04:40:14', NULL),
(19, 5, 'fifa_21', 'ps4', 10, 'ashdj', 'ashjdkjh', 'completed', '', '2021-02-19 04:57:08', 6, '2021-02-19 04:57:26', '2021-02-20', '09:57:00', NULL, NULL, NULL, NULL, 'lose', 'win', '2021-02-19 04:58:36', '2021-02-19 04:57:45', NULL),
(20, 5, 'clash_of_clans', 'pc', 15, 'dsf', 'sdf', 'disputed', '', '2021-02-19 05:14:31', 6, '2021-02-19 05:14:57', '2021-02-20', '10:14:00', NULL, NULL, NULL, NULL, 'win', 'win', '2021-02-19 05:15:11', '2021-02-19 05:15:15', NULL),
(21, 5, 'fortnite', 'ps4', 100, 'no mod', 'no rules', 'cancelled', 'Challenge cancelled by owner', '2021-02-20 08:25:05', 6, '2021-02-23 06:09:39', NULL, NULL, NULL, '2021-02-24 10:30:38', NULL, NULL, '', '', NULL, NULL, NULL),
(22, 6, 'fifa_21', 'pc', 10, '', '', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 10:00:20', 5, '2021-02-23 06:14:57', '2021-02-23', '15:00:00', NULL, '2021-02-24 10:33:00', NULL, NULL, '', '', NULL, NULL, NULL),
(23, 6, 'fortnite', 'ps4', 15, 'testing123', 'testing123', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 10:01:29', 5, '2021-02-23 06:07:20', '2021-01-26', '15:01:00', NULL, '2021-02-25 11:21:23', '2021-02-25 11:01:23', NULL, '', '', NULL, NULL, NULL),
(24, 5, 'clash_of_clans', 'pc', 250, 'dsas', 'dasdas', 'disputed', '', '2021-02-22 11:01:14', 6, '2021-02-23 06:15:36', '2021-02-27', '16:59:00', '2021-02-23 11:39:32', NULL, NULL, NULL, 'loss', 'loss', '2021-03-01 11:54:49', '2021-03-01 04:39:41', '2021-03-01 11:54:49'),
(25, 5, 'fortnite', 'xbox', 15, 'daasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 11:51:08', 6, '2021-02-23 06:03:36', '2021-02-24', '16:51:00', NULL, '2021-02-24 10:34:16', NULL, NULL, '', '', NULL, NULL, NULL),
(26, 6, 'fifa_21', 'ps4', 15, 'adasd', 'asdasd', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:15:59', 5, '2021-02-23 06:16:10', '2021-01-26', '11:15:00', NULL, '2021-02-24 11:53:56', NULL, NULL, '', '', NULL, NULL, NULL),
(27, 5, 'fifa_21', 'pc', 25, 'ddgd', 'fgdfgd', 'confirmed', '', '2021-02-23 06:18:08', 6, '2021-02-23 06:18:22', '2021-02-27', '02:21:00', NULL, NULL, NULL, NULL, 'loss', 'loss', '2021-03-01 05:00:14', '2021-03-01 05:00:52', NULL),
(28, 6, 'fortnite', 'xbox', 10, 'asjdklj', 'kljsdlakjkl', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:20:50', 5, '2021-02-23 06:20:58', '2021-01-26', '23:20:00', NULL, '2021-02-24 06:40:36', NULL, NULL, '', '', NULL, NULL, NULL),
(29, 5, 'fifa_21', 'pc', 10, 'dfs', 'fsdf', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:23:44', 6, '2021-02-23 06:23:49', '2021-02-12', '23:23:00', NULL, '2021-02-24 06:41:54', NULL, NULL, '', '', NULL, NULL, NULL),
(30, 5, 'fifa_21', 'ps4', 10, 'asdasd', 'dasdas', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:05:58', NULL, NULL, '2021-01-24', '00:05:00', NULL, '2021-02-24 07:23:05', NULL, NULL, '', '', NULL, NULL, NULL),
(31, 5, 'clash_of_clans', 'nintendo', 15, 'asdasd', 'asdas', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:06:19', 6, '2021-02-24 04:24:14', '2021-02-04', '16:10:00', NULL, '2021-02-24 06:35:58', NULL, NULL, '', '', NULL, NULL, NULL),
(32, 6, 'fortnite', 'xbox', 15, 'dadas', 'dasda', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:08:30', NULL, NULL, '2021-01-27', '16:12:00', NULL, '2021-02-24 07:24:25', NULL, NULL, '', '', NULL, NULL, NULL),
(33, 5, 'fortnite', 'pc', 15, 'dsadas', 'dasd', 'tie', '', '2021-02-23 11:46:40', 6, '2021-02-23 11:46:56', '2021-03-02', '13:49:00', '2021-02-23 11:47:34', NULL, NULL, NULL, 'tie', 'tie', '2021-03-02 09:14:59', '2021-03-02 09:15:18', '2021-03-02 09:15:18'),
(34, 5, 'fortnite', 'ps4', 15, 'asdas', 'dasdad', 'cancelled', 'Challenge date time exceeded', '2021-02-24 04:23:20', NULL, NULL, '2021-01-27', '09:23:00', NULL, '2021-02-24 07:19:15', NULL, NULL, '', '', NULL, NULL, NULL),
(35, 5, 'fifa_21', 'nintendo', 20, 'dqwdasd', 'asdasd', 'cancelled', 'Challenge date time exceeded', '2021-02-24 04:23:34', NULL, NULL, '2021-02-07', '09:23:00', NULL, '2021-02-24 07:26:39', NULL, NULL, '', '', NULL, NULL, NULL),
(36, 5, 'fifa_21', 'ps4', 10, 'ashdkjhasd', 'hksdhkjs', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 07:58:01', NULL, NULL, '2021-02-25', '12:57:00', NULL, '2021-02-24 10:29:27', NULL, NULL, '', '', NULL, NULL, NULL),
(37, 5, 'fortnite', 'pc', 20, 'sdajs', 'kjhsadkhjas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 07:58:18', NULL, NULL, '2021-03-06', '13:58:00', NULL, '2021-02-24 10:44:58', NULL, NULL, '', '', NULL, NULL, NULL),
(38, 6, 'fifa_21', 'pc', 400, 'asdasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:37:09', NULL, NULL, '2021-02-27', '15:37:00', NULL, '2021-02-24 10:37:20', NULL, NULL, '', '', NULL, NULL, NULL),
(39, 6, 'fortnite', 'nintendo', 250, 'sdas', 'dasdas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:38:38', 5, '2021-02-24 10:41:55', '2021-02-26', '03:38:00', NULL, '2021-02-24 10:43:02', NULL, NULL, '', '', NULL, NULL, NULL),
(40, 5, 'fortnite', 'pc', 12, 'asdas', 'dasdsda', 'open', '', '2021-02-24 10:49:32', NULL, NULL, '2021-02-27', '15:49:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(41, 5, 'fortnite', 'xbox', 5, 'asdasda', 'sdasdas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:49:45', NULL, NULL, '2021-03-07', '15:49:00', NULL, '2021-02-24 10:49:48', NULL, NULL, '', '', NULL, NULL, NULL),
(42, 5, 'fifa_21', 'pc', 3, 'das', 'dasdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:50:14', NULL, NULL, '2021-03-05', '15:50:00', NULL, '2021-02-24 10:50:18', NULL, NULL, '', '', NULL, NULL, NULL),
(43, 5, 'fortnite', 'xbox', 15, 'asdasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:50:38', NULL, NULL, '2021-03-05', '15:50:00', NULL, '2021-02-24 11:52:58', NULL, NULL, '', '', NULL, NULL, NULL),
(44, 6, 'fortnite', 'pc', 15, 'skjdla', 'kjsadlas', 'reset', 'Challenge date time exceeded', '2021-02-24 11:32:21', NULL, NULL, '2021-02-05', '16:32:00', NULL, NULL, '2021-02-25 10:51:44', NULL, '', '', NULL, NULL, NULL),
(45, 5, 'clash_of_clans', 'pc', 20, 'gshadgj', 'hjsagdj', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 11:52:02', 6, '2021-02-24 11:52:18', '2021-03-06', '16:51:00', NULL, '2021-02-24 11:52:36', NULL, NULL, '', '', NULL, NULL, NULL),
(46, 6, 'clash_of_clans', 'pc', 15, 'asd', 'asdasd', 'open', 'Challenge date time exceeded', '2021-02-25 11:33:22', NULL, NULL, '2021-03-06', '16:53:00', NULL, NULL, '2021-02-25 11:33:46', '2021-02-25 11:53:41', '', '', NULL, NULL, NULL),
(47, 5, 'fortnite', 'xbox', 10, 'asdkjhadjk', 'hakjsdhkhasdkj', 'open', '', '2021-02-25 11:49:13', NULL, NULL, '2021-02-28', '16:49:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(48, 6, 'fortnite', 'ps4', 15, 'asdas', 'dasdasd', 'open', '', '2021-02-25 11:53:30', NULL, NULL, '2021-02-27', '16:53:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(49, 6, 'clash_of_clans', 'xbox', 25, 'asd', 'asdasd', 'accepted', '', '2021-02-25 11:54:04', 5, '2021-03-07 04:30:07', '2021-03-13', '16:54:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(50, 5, 'fifa_21', 'ps4', 10, 'test1', 'test1', 'reset', 'Challenge date time exceeded', '2021-02-25 12:03:32', 6, '2021-02-26 04:44:04', '2021-02-27', '17:04:00', NULL, NULL, '2021-03-01 05:35:17', '2021-02-25 12:04:49', '', '', NULL, NULL, NULL),
(51, 5, 'fortnite', 'pc', 20, 'asdasd', 'sadasd', 'open', '', '2021-02-26 04:36:45', NULL, NULL, '2021-03-13', '09:36:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(52, 5, 'fortnite', 'pc', 10, 'asdad', 'asdasdas', 'accepted', '', '2021-03-07 04:25:18', 6, '2021-03-07 04:25:51', '2021-03-20', '09:25:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL),
(53, 6, 'fifa_21', 'ps4', 10, 'testing', 'testing', 'accepted', '', '2021-03-07 07:00:30', 5, '2021-03-07 07:02:00', '2021-03-08', '12:00:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit_log`
--

CREATE TABLE `deposit_log` (
  `deposit_id` int(11) NOT NULL,
  `deposit_by` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` decimal(65,30) UNSIGNED NOT NULL,
  `client_date` varchar(255) NOT NULL,
  `server_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposit_log`
--

INSERT INTO `deposit_log` (`deposit_id`, `deposit_by`, `method`, `amount`, `client_date`, `server_timestamp`) VALUES
(1, 5, 'Dummy Deposit', '15.000000000000000000000000000000', 'Thu Jan 04 2020 15:28:14 GMT+0500 (Pakistan Standard Time)', '2020-01-04 10:28:14'),
(2, 5, 'Dummy Deposit', '15.990000000000000000000000000000', 'Thu Jan 04 2021 15:28:26 GMT+0500 (Pakistan Standard Time)', '2021-01-04 10:28:26'),
(3, 5, 'Dummy Deposit', '10.990000000000000000000000000000', 'Thu Jan 04 2021 15:28:35 GMT+0500 (Pakistan Standard Time)', '2021-01-04 10:28:35'),
(4, 5, 'Dummy Deposit', '12.345678900000000000000000000000', 'Thu Feb 04 2021 15:29:01 GMT+0500 (Pakistan Standard Time)', '2021-02-04 10:29:01'),
(5, 5, 'Dummy Deposit', '98.765432100000000000000000000000', 'Thu Feb 04 2021 15:43:33 GMT+0500 (Pakistan Standard Time)', '2021-02-04 10:43:33'),
(6, 6, 'Dummy Deposit', '12.345678900000000000000000000000', 'Thu Feb 04 2021 16:07:13 GMT+0500 (Pakistan Standard Time)', '2021-02-04 11:07:13'),
(7, 6, 'Dummy Deposit', '98.765432100000000000000000000000', 'Thu Feb 04 2021 16:07:25 GMT+0500 (Pakistan Standard Time)', '2021-02-04 11:07:25'),
(8, 6, 'Dummy Deposit', '12.345678900000000000000000000000', 'Thu Feb 04 2021 16:22:37 GMT+0500 (Pakistan Standard Time)', '2021-02-04 11:22:37'),
(9, 4, 'Dummy Deposit', '10.000000000000000000000000000000', 'Thu Feb 04 2021 16:47:25 GMT+0500 (Pakistan Standard Time)', '2021-02-04 11:47:25'),
(10, 4, 'Dummy Deposit', '15.000000000000000000000000000000', 'Thu Feb 04 2021 16:47:37 GMT+0500 (Pakistan Standard Time)', '2021-02-04 11:47:37'),
(11, 5, 'Dummy Deposit', '123.000000000000000000000000000000', 'Sat Feb 06 2020 12:12:11 GMT+0500 (Pakistan Standard Time)', '2020-02-06 07:12:11'),
(12, 5, 'Dummy Deposit', '10.000000000000000000000000000000', 'Sat Feb 06 2021 12:33:49 GMT+0500 (Pakistan Standard Time)', '2021-02-06 07:33:49'),
(13, 5, 'Dummy Deposit', '11.000000000000000000000000000000', 'Sat Feb 06 2021 12:34:02 GMT+0500 (Pakistan Standard Time)', '2021-02-06 07:34:02'),
(14, 5, 'Dummy Deposit', '125.000000000000000000000000000000', 'Sat Feb 06 2021 16:31:20 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:31:20'),
(15, 5, 'Dummy Deposit', '12.345678900000000000000000000000', 'Sat Feb 06 2021 16:31:29 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:31:29'),
(16, 5, 'Dummy Deposit', '98.765432100000000000000000000000', 'Sat Feb 06 2021 16:31:40 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:31:40'),
(17, 5, 'Dummy Deposit', '12.345678900000000000000000000000', 'Sat Feb 06 2021 16:32:49 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:32:49'),
(18, 5, 'Dummy Deposit', '98.765432100000000000000000000000', 'Sat Feb 06 2021 16:32:55 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:32:55'),
(19, 5, 'Dummy Deposit', '12.345678900000000000000000000000', 'Sat Feb 06 2021 16:40:10 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:40:10'),
(20, 5, 'Dummy Deposit', '98.765432100000000000000000000000', 'Sat Feb 06 2021 16:40:38 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:40:38'),
(21, 5, 'Dummy Deposit', '1000.000000000000000000000000000000', 'Mon Feb 08 2021 14:44:10 GMT+0500 (Pakistan Standard Time)', '2021-02-08 09:44:10'),
(22, 7, 'Dummy Deposit', '1000.000000000000000000000000000000', 'Tue Feb 09 2021 16:31:39 GMT+0500 (Pakistan Standard Time)', '2021-02-09 11:31:39'),
(23, 3, 'Dummy Deposit', '100.000000000000000000000000000000', 'Tue Feb 09 2021 16:52:46 GMT+0500 (Pakistan Standard Time)', '2021-02-09 11:52:46'),
(24, 5, 'Dummy Deposit', '10.000000000000000000000000000000', 'Mon Feb 15 2021 11:15:28 GMT+0500 (Pakistan Standard Time)', '2021-02-15 06:15:28'),
(25, 11, 'Dummy Deposit', '100.000000000000000000000000000000', 'Wed Feb 17 2021 09:33:41 GMT+0500 (Pakistan Standard Time)', '2021-02-17 04:33:41'),
(26, 12, 'Dummy Deposit', '100.000000000000000000000000000000', 'Wed Feb 17 2021 09:58:06 GMT+0500 (Pakistan Standard Time)', '2021-02-17 04:58:06'),
(27, 6, 'Dummy Deposit', '1000.000000000000000000000000000000', 'Tue Feb 23 2021 11:15:30 GMT+0500 (Pakistan Standard Time)', '2021-02-23 06:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `meta_id` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` varchar(255) NOT NULL,
  `created_timestamp` timestamp NULL DEFAULT NULL,
  `last_modified_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`meta_id`, `meta_key`, `meta_value`, `created_timestamp`, `last_modified_timestamp`) VALUES
(1, 'player_starting_points', '500', '2021-02-20 10:23:43', '2021-02-20 10:23:43'),
(2, 'min_challenge_amount', '1', '2021-02-22 04:57:11', '2021-02-22 04:57:11'),
(3, 'max_challenge_amount', '500', '2021-02-22 04:57:11', '2021-02-22 04:57:11'),
(4, 'win_loss_points_difference', '10', '2021-02-25 09:00:59', '2021-02-25 09:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL,
  `notif_for` int(11) NOT NULL,
  `notif_msg` text NOT NULL,
  `notif_status` varchar(255) NOT NULL DEFAULT 'unread',
  `notif_create_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `notif_read_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `notif_for`, `notif_msg`, `notif_status`, `notif_create_timestamp`, `notif_read_timestamp`) VALUES
(1, 5, 'USER 6 has accepted your Challenge! Challenge ID: 14.', 'read', '2021-02-18 10:48:19', NULL),
(2, 6, 'USER 6 have started the Challenge! Challenge ID: 14.', 'unread', '2021-02-18 10:49:47', NULL),
(3, 5, 'USER 5 have started the Challenge! Challenge ID: 14.', 'read', '2021-02-18 10:50:18', NULL),
(4, 6, 'USER 6 have claimed their result for Challenge ID: 14.', 'unread', '2021-02-18 10:50:42', NULL),
(5, 5, 'USER 5 have claimed their result for Challenge ID: 14.', 'read', '2021-02-18 10:51:06', NULL),
(6, 5, 'Challenge ID: 14 has ended successfully.', 'read', '2021-02-18 10:51:06', NULL),
(7, 6, 'Challenge ID: 14 has ended successfully.', 'unread', '2021-02-18 10:51:06', NULL),
(8, 5, 'USER 6 has accepted your Challenge! Challenge ID: 15.', 'read', '2021-02-18 11:02:00', NULL),
(9, 6, 'USER 6 have started the Challenge! Challenge ID: 15.', 'unread', '2021-02-18 11:02:34', NULL),
(10, 5, 'USER 5 have started the Challenge! Challenge ID: 15.', 'read', '2021-02-18 11:03:00', NULL),
(11, 6, 'USER 6 have claimed their result for Challenge ID: 15.', 'unread', '2021-02-18 11:03:14', NULL),
(12, 5, 'USER 5 have claimed their result for Challenge ID: 15.', 'read', '2021-02-18 11:03:26', NULL),
(13, 5, 'Challenge ID: 15 has ended successfully.', 'read', '2021-02-18 11:03:26', NULL),
(14, 6, 'Challenge ID: 15 has ended successfully.', 'unread', '2021-02-18 11:03:26', NULL),
(15, 5, '$20 awarded to the winning player for winning Challenge ID: 15.', 'read', '2021-02-18 11:03:26', NULL),
(16, 6, '$20 awarded to the winning player for winning Challenge ID: 15.', 'unread', '2021-02-18 11:03:26', NULL),
(17, 5, 'USER 6 has accepted your Challenge! Challenge ID: 1.', 'read', '2021-02-18 11:05:30', NULL),
(18, 5, 'Both players failed to start the Challenge in time! Challenge ID: 1 has ended with No Result!', 'read', '2021-02-18 11:06:03', NULL),
(19, 6, 'Both players failed to start the Challenge in time! Challenge ID: 1 has ended with No Result!', 'unread', '2021-02-18 11:06:03', NULL),
(20, 5, 'Since Challenge ID: 1 ended with No Result, the Challenge amount, $10, has been refunded to both players', 'read', '2021-02-18 11:06:03', NULL),
(21, 6, 'Since Challenge ID: 1 ended with No Result, the Challenge amount, $10, has been refunded to both players', 'unread', '2021-02-18 11:06:03', NULL),
(22, 6, 'USER 5 has accepted your Challenge! Challenge ID: 16.', 'unread', '2021-02-18 11:09:35', NULL),
(23, 6, 'USER 6 have started the Challenge! Challenge ID: 16.', 'read', '2021-02-18 11:09:41', NULL),
(24, 5, 'USER 5 have started the Challenge! Challenge ID: 16.', 'read', '2021-02-18 11:09:49', NULL),
(25, 5, 'USER 5 have claimed their result for Challenge ID: 16.', 'read', '2021-02-18 11:09:52', NULL),
(26, 6, 'USER 6 have claimed their result for Challenge ID: 16.', 'unread', '2021-02-18 11:09:58', NULL),
(27, 6, 'Challenge ID: 16 has ended successfully.', 'read', '2021-02-18 11:09:58', NULL),
(28, 5, 'Challenge ID: 16 has ended successfully.', 'read', '2021-02-18 11:09:58', NULL),
(29, 6, '$20 awarded to the winning player for winning Challenge ID: 16.', 'unread', '2021-02-18 11:09:58', NULL),
(30, 5, '$20 awarded to the winning player for winning Challenge ID: 16.', 'read', '2021-02-18 11:09:58', NULL),
(31, 5, 'USER 6 has accepted your Challenge! Challenge ID: 17.', 'read', '2021-02-18 11:11:22', NULL),
(32, 5, 'Both players failed to start the Challenge in time! Challenge ID: 17 has ended with No Result!', 'read', '2021-02-18 11:11:55', NULL),
(33, 6, 'Both players failed to start the Challenge in time! Challenge ID: 17 has ended with No Result!', 'read', '2021-02-18 11:11:55', NULL),
(34, 5, 'Since Challenge ID: 17 ended with No Result, the Challenge amount, $10, has been refunded to both players', 'read', '2021-02-18 11:11:56', NULL),
(35, 6, 'Since Challenge ID: 17 ended with No Result, the Challenge amount, $10, has been refunded to both players', 'read', '2021-02-18 11:11:56', NULL),
(36, 5, 'USER 6 has accepted your Challenge! Challenge ID: 18.', 'read', '2021-02-18 11:58:46', NULL),
(37, 5, 'USER 5 have started the Challenge! Challenge ID: 18.', 'read', '2021-02-19 04:40:01', '2021-02-19 04:59:46'),
(38, 6, 'USER 6 have started the Challenge! Challenge ID: 18.', 'unread', '2021-02-19 04:40:07', NULL),
(39, 5, 'USER 5 have claimed their result for Challenge ID: 18.', 'read', '2021-02-19 04:40:14', '2021-02-19 04:59:53'),
(40, 6, 'USER 6 have claimed their result for Challenge ID: 18.', 'unread', '2021-02-19 04:40:18', NULL),
(41, 5, 'Challenge ID: 18 has ended successfully.', 'read', '2021-02-19 04:40:18', '2021-02-19 04:59:55'),
(42, 6, 'Challenge ID: 18 has ended successfully.', 'read', '2021-02-19 04:40:18', '2021-02-19 05:01:21'),
(43, 5, '$30 awarded to the winning player for winning Challenge ID: 18.', 'read', '2021-02-19 04:40:18', '2021-02-19 04:59:54'),
(44, 6, '$30 awarded to the winning player for winning Challenge ID: 18.', 'unread', '2021-02-19 04:40:18', NULL),
(45, 5, 'USER 6 has accepted your Challenge! Challenge ID: 19.', 'read', '2021-02-19 04:57:26', '2021-02-19 04:59:56'),
(46, 5, 'USER 6 have started the Challenge! Challenge ID: 19.', 'read', '2021-02-19 04:57:29', '2021-02-19 04:59:57'),
(47, 6, 'USER 5 have started the Challenge! Challenge ID: 19.', 'read', '2021-02-19 04:57:37', '2021-02-19 05:01:22'),
(48, 5, 'USER 6 have claimed their result for Challenge ID: 19.', 'read', '2021-02-19 04:57:45', '2021-02-19 04:59:58'),
(49, 6, 'USER 5 have claimed their result for Challenge ID: 19.', 'read', '2021-02-19 04:58:36', '2021-02-19 05:01:24'),
(50, 5, 'Challenge ID: 19 has ended successfully.', 'read', '2021-02-19 04:58:36', '2021-02-19 04:59:59'),
(51, 6, 'Challenge ID: 19 has ended successfully.', 'read', '2021-02-19 04:58:36', '2021-02-19 05:01:23'),
(52, 5, '$20 awarded to the winning player for winning Challenge ID: 19.', 'read', '2021-02-19 04:58:36', '2021-02-19 04:59:58'),
(53, 6, '$20 awarded to the winning player for winning Challenge ID: 19.', 'unread', '2021-02-19 04:58:36', NULL),
(54, 5, 'USER 6 has accepted your Challenge! Challenge ID: 20.', 'read', '2021-02-19 05:14:57', '2021-02-19 05:31:40'),
(55, 5, 'USER 6 have started the Challenge! Challenge ID: 20.', 'read', '2021-02-19 05:15:00', '2021-02-19 05:31:41'),
(56, 6, 'USER 5 have started the Challenge! Challenge ID: 20.', 'unread', '2021-02-19 05:15:07', NULL),
(57, 6, 'USER 5 have claimed their result for Challenge ID: 20.', 'unread', '2021-02-19 05:15:11', NULL),
(58, 5, 'USER 6 have claimed their result for Challenge ID: 20.', 'read', '2021-02-19 05:15:15', '2021-02-19 05:31:42'),
(59, 5, 'Challenge ID: 20 has ended with a Dispute.', 'read', '2021-02-19 05:15:15', '2021-02-19 05:31:42'),
(60, 6, 'Challenge ID: 20 has ended with a Dispute.', 'unread', '2021-02-19 05:15:15', NULL),
(61, 12, 'USER 5 has accepted your Challenge! Challenge ID: 11.', 'unread', '2021-02-20 08:35:07', NULL),
(62, 12, 'USER 5 have started the Challenge! Challenge ID: 11.', 'unread', '2021-02-20 08:35:17', NULL),
(63, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 25.', 'unread', '2021-02-23 06:03:36', NULL),
(64, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 23.', 'unread', '2021-02-23 06:07:20', NULL),
(65, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 21.', 'unread', '2021-02-23 06:09:39', NULL),
(66, 7, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 8.', 'read', '2021-02-23 06:11:10', '2021-03-06 11:00:58'),
(67, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 22.', 'unread', '2021-02-23 06:14:57', NULL),
(68, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 24.', 'unread', '2021-02-23 06:15:36', NULL),
(69, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 26.', 'unread', '2021-02-23 06:16:10', NULL),
(70, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 27.', 'unread', '2021-02-23 06:18:22', NULL),
(71, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 28.', 'unread', '2021-02-23 06:20:58', NULL),
(72, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 29.', 'unread', '2021-02-23 06:23:49', NULL),
(73, 6, 'Challenge # 27 has been accepted by its owner. Your Challenge is set to be played on: 2021-02-27 02:21:00', 'unread', '2021-02-23 10:37:33', NULL),
(74, 6, 'Challenge # 24 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-06 15:59:00', 'unread', '2021-02-23 11:39:32', NULL),
(75, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 33.', 'unread', '2021-02-23 11:46:56', NULL),
(76, 6, 'Challenge # 33 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-05 19:49:00', 'unread', '2021-02-23 11:47:34', NULL),
(77, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 31.', 'unread', '2021-02-24 04:24:14', NULL),
(78, 6, 'Challenge # 31 has been Cancelled because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded to both players.', 'unread', '2021-02-24 06:35:58', NULL),
(79, 5, 'Challenge # 28 has been Cancelled because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded to both players.', 'unread', '2021-02-24 06:40:36', NULL),
(80, 6, 'Challenge # 29 has been Cancelled because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded to both players.', 'unread', '2021-02-24 06:41:54', NULL),
(81, 5, 'Challenge # 34 has been Cancelled because nobody Accepted your Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee has been refunded.', 'unread', '2021-02-24 07:19:15', NULL),
(82, 5, 'Challenge # 30 has been Cancelled because a player Accepted your Challenge after the set Challenge date and time. The Challenge amount MINUS the service fee has been refunded.', 'unread', '2021-02-24 07:23:05', NULL),
(83, 6, 'Challenge # 32 has been Cancelled because a player Accepted your Challenge after the set Challenge date and time. The Challenge amount MINUS the service fee has been refunded.', 'unread', '2021-02-24 07:24:25', NULL),
(84, 5, 'Challenge # 35 has been Cancelled because a player Accepted your Challenge after the set Challenge date and time. The Challenge amount MINUS the service fee has been refunded.', 'unread', '2021-02-24 07:26:39', NULL),
(85, 6, 'Challenge # 21 has been cancelled by its owner.', 'unread', '2021-02-24 10:30:38', NULL),
(86, 6, 'Challenge # 21 has been Cancelled by its owner. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-02-24 10:30:38', NULL),
(87, 5, 'Challenge # 22 has been Cancelled by its owner. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-02-24 10:33:00', NULL),
(88, 6, 'Challenge # 25 has been Cancelled by its owner. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-24 10:34:16', NULL),
(89, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 39.', 'unread', '2021-02-24 10:41:55', NULL),
(90, 5, 'Challenge # 39 has been Cancelled by its owner. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-24 10:43:02', NULL),
(91, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 45.', 'unread', '2021-02-24 11:52:18', NULL),
(92, 6, 'Challenge # 45 has been Cancelled by its owner. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-24 11:52:36', NULL),
(93, 5, 'Challenge # 26 has been Cancelled because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded to both players.', 'unread', '2021-02-24 11:53:56', NULL),
(94, 6, 'Challenge # 9 has been Reset because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-02-25 10:43:01', NULL),
(95, 6, 'Challenge # 44 has been Reset because a player Accepted your Challenge after the set Challenge date and time. You can re-open the Challenge from your Challenges page. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-25 10:51:44', NULL),
(96, 5, 'Challenge # 23 has been Reset because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-02-25 11:01:23', NULL),
(97, 6, 'Challenge # 46 has been Reset because a player Accepted your Challenge after the set Challenge date and time. You can re-open the Challenge from your Challenges page. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-25 11:33:46', NULL),
(98, 5, 'Challenge # 50 has been Reset because a player Accepted your Challenge after the set Challenge date and time. You can re-open the Challenge from your Challenges page. The Challenge amount MINUS the service fee has been refunded back into your Balance.', 'unread', '2021-02-25 12:04:13', NULL),
(99, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 50.', 'unread', '2021-02-26 04:44:04', NULL),
(100, 6, 'Your Opponent have claimed their result for Challenge # 27.', 'unread', '2021-03-01 05:00:14', NULL),
(101, 5, 'Your Opponent have claimed their result for Challenge # 27.', 'unread', '2021-03-01 05:00:52', NULL),
(102, 6, 'Challenge # 50 has been Reset because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-03-01 05:35:17', NULL),
(103, 6, 'Your Opponent have claimed their result for Challenge # 24.', 'unread', '2021-03-01 11:52:11', NULL),
(104, 6, 'Your Opponent have claimed their result for Challenge # 24.', 'unread', '2021-03-01 11:54:49', NULL),
(105, 6, 'Challenge # 24 has ended.', 'unread', '2021-03-01 11:54:49', NULL),
(106, 6, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:07:35', NULL),
(107, 5, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:07:54', NULL),
(108, 5, 'Challenge # 33 has ended.', 'unread', '2021-03-02 09:07:54', NULL),
(109, 5, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:10:53', NULL),
(110, 5, 'Challenge # 33 has ended.', 'unread', '2021-03-02 09:10:53', NULL),
(111, 5, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:13:42', NULL),
(112, 5, 'Challenge # 33 has ended.', 'unread', '2021-03-02 09:13:42', NULL),
(113, 6, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:14:59', NULL),
(114, 5, 'Your Opponent have claimed their result for Challenge # 33.', 'unread', '2021-03-02 09:15:18', NULL),
(115, 5, 'Challenge # 33 has ended.', 'unread', '2021-03-02 09:15:18', NULL),
(116, 5, 'Tournament # 5 has ben Reset. You have been removed from the Tournament.', 'unread', '2021-03-06 10:55:42', NULL),
(117, 5, 'Tournament # 5 amount ($10) has been refunded back into your Balance!', 'unread', '2021-03-06 10:55:42', NULL),
(118, 5, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 6', 'unread', '2021-03-06 11:02:34', NULL),
(119, 6, 'Tournament # 1 has ben Reset. You have been removed from the Tournament.', 'unread', '2021-03-06 12:02:17', NULL),
(120, 6, 'Tournament # 1 amount ($10) has been refunded back into your Balance!', 'unread', '2021-03-06 12:02:17', NULL),
(121, 5, 'Your Tournament has been Reset! You can Re-Open your Tournament from your Tornaments page. Tournament # 4', 'unread', '2021-03-06 13:01:52', NULL),
(122, 6, 'Tournament # 4 has been Reset. You have been removed from the Tournament.', 'unread', '2021-03-06 13:01:52', NULL),
(123, 6, 'Tournament # 4 amount ($30) has been refunded back into your Balance!', 'unread', '2021-03-06 13:01:52', NULL),
(124, 7, 'Tournament # 4 has been Reset. You have been removed from the Tournament.', 'unread', '2021-03-06 13:01:52', NULL),
(125, 7, 'Tournament # 4 amount ($30) has been refunded back into your Balance!', 'unread', '2021-03-06 13:01:52', NULL),
(126, 5, 'Your Tournament has been Reset! You can Re-Open your Tournament from your Tournaments page. Tournament # 7', 'unread', '2021-03-06 13:06:41', NULL),
(127, 7, 'Tournament # 7 has been Reset. You have been removed from the Tournament.', 'unread', '2021-03-06 13:06:41', NULL),
(128, 7, 'Tournament # 7 amount ($10) has been refunded back into your Balance!', 'unread', '2021-03-06 13:06:41', NULL),
(129, 5, 'USER 6 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 52.', 'unread', '2021-03-07 04:25:51', NULL),
(130, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 49.', 'unread', '2021-03-07 04:30:07', NULL),
(131, 6, 'USER 5 has accepted your Challenge! Waiting for your confirmation. Challenge ID: 53.', 'unread', '2021-03-07 07:02:00', NULL),
(132, 6, 'Tournament # 3 was cancelled by its owner. The Tournament amount (20) has been refunded back into your Balance.', 'unread', '2021-03-09 11:50:31', NULL),
(133, 7, 'Tournament # 3 was cancelled by its owner. The Tournament amount (20) has been refunded back into your Balance.', 'unread', '2021-03-09 11:50:31', NULL),
(134, 5, 'Tournament # 8 was cancelled by its owner. The Tournament amount ($10) has been refunded back into your Balance.', 'unread', '2021-03-09 11:58:19', NULL),
(135, 6, 'Tournament # 2 was cancelled by its owner. The Tournament amount ($15) has been refunded back into your Balance.', 'unread', '2021-03-09 12:00:10', NULL),
(136, 7, 'Tournament # 2 was cancelled by its owner. The Tournament amount ($15) has been refunded back into your Balance.', 'unread', '2021-03-09 12:00:10', NULL),
(137, 5, 'Your Tournament has been Reset! You can Re-Open your Tournament from your Tournaments page. Tournament # 9', 'unread', '2021-03-09 13:33:38', NULL),
(138, 5, 'Your Tournament has been Reset! You can Re-Open your Tournament from your Tournaments page. Tournament # 10', 'unread', '2021-03-10 04:51:26', NULL),
(139, 6, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 13', 'unread', '2021-03-10 07:08:37', NULL),
(140, 7, 'Tournament # 6 was cancelled by its owner. The Tournament amount ($10) has been refunded back into your Balance.', 'unread', '2021-03-10 11:32:50', NULL),
(141, 5, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 14', 'unread', '2021-03-10 11:33:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `points_difference`
--

CREATE TABLE `points_difference` (
  `points_diff_id` int(11) NOT NULL,
  `level_diff` int(11) NOT NULL,
  `points_diff` int(11) NOT NULL,
  `created_timestamp` timestamp NULL DEFAULT NULL,
  `last_modified_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `points_difference`
--

INSERT INTO `points_difference` (`points_diff_id`, `level_diff`, `points_diff`, `created_timestamp`, `last_modified_timestamp`) VALUES
(1, 0, 10, '2021-02-20 10:53:38', '2021-02-20 10:53:38'),
(2, 1, 20, '2021-02-20 10:53:38', '2021-02-20 10:53:38'),
(3, 2, 30, '2021-02-20 10:53:38', '2021-02-20 10:53:38'),
(4, 3, 40, '2021-02-20 10:53:38', '2021-02-20 10:53:38'),
(5, 4, 50, '2021-02-20 10:53:38', '2021-02-20 10:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `service_fees`
--

CREATE TABLE `service_fees` (
  `service_fee_id` int(11) NOT NULL,
  `min_amount` float NOT NULL,
  `max_amount` float NOT NULL,
  `service_fee` float NOT NULL,
  `service_fee_type` varchar(255) NOT NULL,
  `created_timestamp` timestamp NULL DEFAULT NULL,
  `last_modified_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_fees`
--

INSERT INTO `service_fees` (`service_fee_id`, `min_amount`, `max_amount`, `service_fee`, `service_fee_type`, `created_timestamp`, `last_modified_timestamp`) VALUES
(1, 1, 3, 0.25, 'dollar', '2021-02-22 04:54:25', '2021-02-22 04:54:25'),
(2, 3.01, 100, 10, 'percent', '2021-02-22 04:55:48', '2021-02-22 04:55:48'),
(3, 100.01, 500, 15, 'percent', '2021-02-22 04:55:48', '2021-02-22 04:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `skill_levels`
--

CREATE TABLE `skill_levels` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL,
  `min_points` int(11) NOT NULL,
  `max_points` int(11) NOT NULL,
  `created_timestamp` timestamp NULL DEFAULT NULL,
  `last_modified_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_levels`
--

INSERT INTO `skill_levels` (`level_id`, `level_name`, `min_points`, `max_points`, `created_timestamp`, `last_modified_timestamp`) VALUES
(1, 'beginner', 0, 200, '2021-02-20 10:31:14', '2021-02-20 10:31:14'),
(2, 'amateur', 201, 400, '2021-02-20 10:31:14', '2021-02-20 10:31:14'),
(3, 'intermediate', 401, 600, '2021-02-20 10:32:42', '2021-02-20 10:32:42'),
(4, 'advanced', 601, 800, '2021-02-20 10:32:42', '2021-02-20 10:32:42'),
(5, 'pro', 801, 1000, '2021-02-20 10:32:42', '2021-02-20 10:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments_log`
--

CREATE TABLE `tournaments_log` (
  `tournament_id` int(11) NOT NULL,
  `tournament_by` int(11) NOT NULL,
  `game` varchar(255) NOT NULL,
  `console` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `players` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `game_mode` varchar(255) NOT NULL,
  `rules` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `ready_timestamp` timestamp NULL DEFAULT NULL,
  `reset_timestamp` timestamp NULL DEFAULT NULL,
  `cancelled_timestamp` timestamp NULL DEFAULT NULL,
  `reopen_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournaments_log`
--

INSERT INTO `tournaments_log` (`tournament_id`, `tournament_by`, `game`, `console`, `amount`, `players`, `start_date`, `start_time`, `game_mode`, `rules`, `status`, `created_timestamp`, `ready_timestamp`, `reset_timestamp`, `cancelled_timestamp`, `reopen_timestamp`) VALUES
(1, 5, 'fifa_21', 'ps4', 10, 10, '2021-03-18', '18:29:00', '', '', 'cancelled', '2021-03-02 12:55:49', NULL, '2021-03-06 12:02:17', '2021-03-09 13:32:46', '2021-03-09 13:29:35'),
(2, 5, 'fortnite', 'pc', 15, 14, '2021-03-26', '17:57:00', '', '', 'cancelled', '2021-03-02 12:57:09', NULL, NULL, '2021-03-09 12:00:10', NULL),
(3, 5, 'clash_of_clans', 'xbox', 20, 20, '2021-03-20', '17:58:00', '', '', 'cancelled', '2021-03-02 12:58:13', NULL, NULL, '2021-03-09 11:50:31', NULL),
(4, 5, 'fifa_21', 'ps4', 30, 30, '2021-02-20', '18:01:00', 'testing 123', 'testing 123', 'cancelled', '2021-02-02 13:02:06', NULL, '2021-03-06 13:01:52', '2021-03-09 11:59:09', NULL),
(5, 6, 'fortnite', 'ps4', 10, 10, '2021-02-18', '10:57:00', 'sadhkjasdh', 'kjhasdkjh', 'cancelled', '2021-03-04 05:57:07', NULL, '2021-03-06 10:55:42', '2021-03-09 11:56:01', NULL),
(6, 5, 'fifa_21', 'pc', 10, 2, '2021-03-26', '16:02:00', '', '', 'cancelled', '2021-03-06 11:02:20', '2021-03-06 11:02:34', NULL, '2021-03-10 11:32:50', NULL),
(7, 5, 'fifa_21', 'ps4', 10, 4, '2021-02-19', '18:05:00', 'test', 'test', 'cancelled', '2021-03-06 13:05:39', NULL, '2021-03-06 13:06:41', '2021-03-09 11:56:32', NULL),
(8, 6, 'fifa_21', 'pc', 10, 10, '2021-03-20', '11:22:00', '', '', 'cancelled', '2021-03-07 06:22:18', NULL, NULL, '2021-03-09 11:58:19', NULL),
(9, 5, 'fifa_21', 'ps4', 10, 10, '2021-03-12', '18:33:00', 'test', 'test', 'open', '2021-03-09 13:33:12', NULL, '2021-03-09 13:33:38', NULL, '2021-03-09 13:33:55'),
(10, 5, 'fortnite', 'pc', 10, 6, '2021-02-19', '09:50:00', 'test', 'test', 'reset', '2021-03-10 04:50:22', NULL, '2021-03-10 04:51:26', NULL, NULL),
(11, 5, 'clash_of_clans', 'xbox', 10, 10, '2021-03-27', '09:50:00', 'test123', 'test123', 'open', '2021-03-10 04:50:46', NULL, NULL, NULL, NULL),
(12, 6, 'clash_of_clans', 'nintendo', 20, 4, '2021-03-26', '09:56:00', 'test', 'test', 'open', '2021-03-10 04:56:10', NULL, NULL, NULL, NULL),
(13, 6, 'fortnite', 'xbox', 10, 2, '2021-03-26', '12:08:00', 'test', 'test', 'ready', '2021-03-10 07:08:28', '2021-03-10 07:08:37', NULL, NULL, NULL),
(14, 5, 'clash_of_clans', 'nintendo', 20, 2, '2021-03-27', '16:33:00', 'test', 'test', 'ready', '2021-03-10 11:33:38', '2021-03-10 11:33:48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tourney_players`
--

CREATE TABLE `tourney_players` (
  `serial_number` int(11) NOT NULL,
  `tourney_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `enter_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourney_players`
--

INSERT INTO `tourney_players` (`serial_number`, `tourney_id`, `player_id`, `enter_timestamp`) VALUES
(20, 9, 5, '2021-03-09 13:33:12'),
(21, 10, 5, '2021-03-10 04:50:22'),
(22, 11, 5, '2021-03-10 04:50:46'),
(23, 12, 6, '2021-03-10 04:56:10'),
(24, 12, 5, '2021-03-10 04:56:19'),
(25, 11, 6, '2021-03-10 04:57:14'),
(26, 9, 6, '2021-03-10 04:57:25'),
(27, 13, 6, '2021-03-10 07:08:28'),
(28, 13, 5, '2021-03-10 07:08:37'),
(29, 14, 5, '2021-03-10 11:33:38'),
(30, 14, 6, '2021-03-10 11:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `balance` decimal(65,30) UNSIGNED NOT NULL DEFAULT 0.000000000000000000000000000000,
  `skill_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_password`, `balance`, `skill_points`) VALUES
(1, 'test username', 'test firstname', 'test lastname', 'test@email.com', '$2y$10$Ya8aXypBncmEl0CxvngNq.LM7Re4WKhigqQ6VY3mDYgN2nySED/9G', '0.000000000000000000000000000000', 500),
(2, 'user 2', 'first 2', 'last 2', 'test2@email.com', '$2y$10$T/OyHhWYm9zB/ACaTdmamOEZeOTmTPvRho0VQc4xhd8cOzdJgQutK', '0.000000000000000000000000000000', 500),
(3, 'user 3', 'first 3', 'last 3', 'test3@email.com', '$2y$10$FVoMLEU/M0SVFTw2BU6d9Oineo4RobFNTIelJ3HQcBkGWsVw3Vo5y', '85.000000000000000000000000000000', 500),
(4, 'user 4', 'first 4', 'last 4', 'test4@email.com', '$2y$10$4a3OLSUtHmewGhh/siaIyuY/CgajvwrsIJ5yf5R.Ch4a/73RaV43e', '25.000000000000000000000000000000', 500),
(5, 'user 5', 'first 5', 'last 5', 'test5@email.com', '$2y$10$XKvtqT/BxmE2ZMovzAiiCupkg64hTg58iGgfQYh8CA89T801eGAiy', '481.202222900000000000000000000000', 510),
(6, 'user 6', 'first 6', 'last 6', 'test6@email.com', '$2y$10$IOZhOTW3906AtM5HP/zGi.VDE25AbhztbGP3Vkysk1p5tvx6eNOFK', '660.456789900000000000000000000000', 490),
(7, 'user 7', 'first 7', 'last 7', 'test7@email.com', '$2y$10$0yitpzEV6ofiGi9npHatYO7RbbtWTN.HBaMABQK/kjNMu4U9cwfcy', '905.000000000000000000000000000000', 500),
(8, 'user 8', 'first 8', 'last 8', 'test07@email.com', '$2y$10$5KKCpf7ER6wMP.lRIZIC5u/HSwldm80iTORIIU0rdIvvNZ/oe7hK6', '0.000000000000000000000000000000', 500),
(10, 'user new', 'first', 'last', 'new@email.com', '$2y$10$AE0y6PiCn3m/e2iu71rh6.QqGC/665Zkx8t3FeVoSL/FsULmTzusW', '0.000000000000000000000000000000', 500),
(11, 'hello', 'hello', 'world', 'hello@world.com', '$2y$10$MVcurLqKIS9sPxCO.BW2ZuqLiDuqZYIbL3bFIiH1KaDS8G0qh7A0q', '55.000000000000000000000000000000', 500),
(12, 'hello world', 'hello', 'world', 'hello@email.com', '$2y$10$oBGKi1yC6aDis/vUAsS9/eC0zWkoG5Lifp8vZytpLtUTcZoHDbWfi', '60.000000000000000000000000000000', 500),
(14, 'lajawaab', 'ahmed', 'salim', 'example@test.com', '$2y$10$atrH/eLq1mHXg9JzoWB0K.ltAimRcWXD0cspbIx1jnYop22LibdZS', '0.000000000000000000000000000000', 500);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_log`
--

CREATE TABLE `withdrawal_log` (
  `withdrawal_id` int(11) NOT NULL,
  `withdrawal_by` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` decimal(65,30) UNSIGNED NOT NULL,
  `withdrawal_status` varchar(255) NOT NULL,
  `client_date` varchar(255) NOT NULL,
  `server_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawal_log`
--

INSERT INTO `withdrawal_log` (`withdrawal_id`, `withdrawal_by`, `method`, `amount`, `withdrawal_status`, `client_date`, `server_timestamp`) VALUES
(1, 5, 'Dummy Withdrawal', '20.000000000000000000000000000000', 'Success', 'Sat Feb 06 2020 16:26:45 GMT+0500 (Pakistan Standard Time)', '2020-02-06 11:26:45'),
(2, 5, 'Dummy Withdrawal', '27.000000000000000000000000000000', 'Success', 'Sat Jan 06 2020 16:27:08 GMT+0500 (Pakistan Standard Time)', '2020-01-06 11:27:08'),
(3, 5, 'Dummy Withdrawal', '123.456789000000000000000000000000', 'Success', 'Sat Jan 06 2021 16:27:37 GMT+0500 (Pakistan Standard Time)', '2021-01-06 11:27:38'),
(4, 5, 'Dummy Withdrawal', '26.000000000000000000000000000000', 'Success', 'Sat Jan 06 2021 16:28:35 GMT+0500 (Pakistan Standard Time)', '2021-01-06 11:28:35'),
(5, 5, 'Dummy Withdrawal', '25.000000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:30:14 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:30:14'),
(6, 5, 'Dummy Withdrawal', '75.620000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:30:59 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:30:59'),
(7, 5, 'Dummy Withdrawal', '235.130000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:32:28 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:32:28'),
(8, 5, 'Dummy Withdrawal', '20.000000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:46:44 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:46:44'),
(9, 5, 'Dummy Withdrawal', '25.000000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:47:27 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:47:27'),
(10, 5, 'Dummy Withdrawal', '28.000000000000000000000000000000', 'Success', 'Sat Feb 06 2021 16:57:01 GMT+0500 (Pakistan Standard Time)', '2021-02-06 11:57:01'),
(11, 5, 'Dummy Withdrawal', '98.765432100000000000000000000000', 'Success', 'Sat Feb 06 2021 17:01:25 GMT+0500 (Pakistan Standard Time)', '2021-02-06 12:01:25'),
(12, 5, 'Dummy Withdrawal', '20.000000000000000000000000000000', 'Success', 'Mon Feb 15 2021 11:15:44 GMT+0500 (Pakistan Standard Time)', '2021-02-15 06:15:44'),
(13, 11, 'Dummy Withdrawal', '20.000000000000000000000000000000', 'Success', 'Wed Feb 17 2021 09:34:36 GMT+0500 (Pakistan Standard Time)', '2021-02-17 04:34:36'),
(14, 12, 'Dummy Withdrawal', '20.000000000000000000000000000000', 'Success', 'Wed Feb 17 2021 09:58:45 GMT+0500 (Pakistan Standard Time)', '2021-02-17 04:58:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenges_log`
--
ALTER TABLE `challenges_log`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `deposit_log`
--
ALTER TABLE `deposit_log`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `points_difference`
--
ALTER TABLE `points_difference`
  ADD PRIMARY KEY (`points_diff_id`);

--
-- Indexes for table `service_fees`
--
ALTER TABLE `service_fees`
  ADD PRIMARY KEY (`service_fee_id`);

--
-- Indexes for table `skill_levels`
--
ALTER TABLE `skill_levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `tournaments_log`
--
ALTER TABLE `tournaments_log`
  ADD PRIMARY KEY (`tournament_id`);

--
-- Indexes for table `tourney_players`
--
ALTER TABLE `tourney_players`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_log`
--
ALTER TABLE `withdrawal_log`
  ADD PRIMARY KEY (`withdrawal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenges_log`
--
ALTER TABLE `challenges_log`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `deposit_log`
--
ALTER TABLE `deposit_log`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `points_difference`
--
ALTER TABLE `points_difference`
  MODIFY `points_diff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_fees`
--
ALTER TABLE `service_fees`
  MODIFY `service_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skill_levels`
--
ALTER TABLE `skill_levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournaments_log`
--
ALTER TABLE `tournaments_log`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tourney_players`
--
ALTER TABLE `tourney_players`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `withdrawal_log`
--
ALTER TABLE `withdrawal_log`
  MODIFY `withdrawal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
