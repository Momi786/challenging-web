-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 05:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `balance` decimal(60,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `balance`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'abc123', '0.00', '2021-03-24 12:29:52', '2021-03-24 12:29:52');

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
  `adminResult` text DEFAULT NULL,
  `accepted_by_claim_timestamp` timestamp NULL DEFAULT NULL,
  `end_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenges_log`
--

INSERT INTO `challenges_log` (`challenge_id`, `challenge_by`, `game`, `console`, `amount`, `game_mode`, `rules`, `status`, `comments`, `created_timestamp`, `accepted_by`, `accepted_timestamp`, `challenge_date`, `challenge_time`, `confirmed_timestamp`, `cancelled_timestamp`, `reset_timestamp`, `reopen_timestamp`, `challenge_by_claimed_result`, `accepted_by_claimed_result`, `challenge_by_claim_timestamp`, `adminResult`, `accepted_by_claim_timestamp`, `end_timestamp`) VALUES
(1, 5, 'fifa_21', 'pc', 10, 'Test', 'Test', 'no_result', '', '2021-02-08 08:16:32', 6, '2021-02-18 11:05:30', '2021-02-17', '16:05:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(2, 5, 'fifa_21', 'ps4', 15, '', '', 'disputed', '', '2021-02-08 09:44:22', 11, '2021-02-17 04:35:59', '2021-02-18', '09:35:00', NULL, NULL, NULL, NULL, 'win', 'win', '2021-02-17 11:40:41', '5', '2021-02-17 11:41:17', NULL),
(3, 5, 'fortnite', 'xbox', 15, 'Test123', 'Test123', 'no_result', '', '2021-02-08 11:52:23', 6, '2021-02-16 06:53:36', '2021-02-17', '11:53:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(4, 6, 'clash_of_clans', 'xbox', 20, 'Test', 'Test', 'no_result', '', '2021-02-09 06:17:29', 5, '2021-02-15 11:49:00', '2021-02-16', '16:48:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(5, 7, 'fifa_21', 'ps4', 10, 'test1', 'test1', 'no_result', '', '2021-02-09 11:31:56', 5, '2021-02-15 11:29:23', '2021-02-15', '16:29:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(6, 7, 'fortnite', 'pc', 15, 'test2', 'test2', 'no_result', '', '2021-02-09 11:32:32', 5, '2021-02-15 10:52:18', '2021-02-10', '15:52:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(7, 7, 'clash_of_clans', 'xbox', 20, 'test3', 'test3', 'no_result', '', '2021-02-09 11:32:44', 5, '2021-02-15 10:56:16', '2021-02-12', '15:56:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(8, 7, 'clash_of_clans', 'nintendo', 25, 'test4', 'test4', 'accepted', '', '2021-02-09 11:32:57', 5, '2021-02-23 06:11:10', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(9, 5, 'clash_of_clans', 'ps4', 10, 'testing123', 'testing123', 'cancelled', 'Challenge cancelled by owner', '2021-02-15 06:22:27', 6, '2021-02-17 07:46:03', '2021-02-18', '12:46:00', NULL, '2021-02-25 11:22:14', '2021-02-25 10:43:01', NULL, 'win', 'win', '2021-02-17 09:33:35', '5', '2021-02-17 09:32:51', NULL),
(10, 11, 'fifa_21', 'ps4', 10, 'test', 'test', 'accepted', '', '2021-02-17 04:35:20', 12, '2021-02-17 05:00:16', '2021-02-18', '10:00:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(11, 12, 'fifa_21', 'ps4', 10, 'test', 'test', 'accepted', '', '2021-02-17 04:59:29', 5, '2021-02-20 08:35:07', '2021-02-23', '15:37:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(12, 5, 'fortnite', 'nintendo', 25, 'test', 'test', 'completed', '', '2021-02-17 07:19:49', 6, '2021-02-17 07:20:07', '2021-02-18', '12:20:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-17 11:43:56', NULL, '2021-02-17 11:44:33', NULL),
(13, 5, 'clash_of_clans', 'pc', 15, 'test', 'test', 'completed', '', '2021-02-17 11:48:18', 6, '2021-02-17 11:48:44', '2021-02-18', '16:48:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-17 11:49:36', NULL, '2021-02-17 11:49:47', NULL),
(14, 5, 'fortnite', 'ps4', 10, 'test123', 'test123', 'completed', '', '2021-02-18 10:47:43', 6, '2021-02-18 10:48:19', '2021-02-19', '15:48:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-18 10:50:42', NULL, '2021-02-18 10:51:06', NULL),
(15, 5, 'clash_of_clans', 'ps4', 10, 'test234', 'test234', 'completed', '', '2021-02-18 11:01:41', 6, '2021-02-18 11:02:00', '2021-02-19', '16:01:00', NULL, NULL, NULL, NULL, 'lose', 'win', '2021-02-18 11:03:14', NULL, '2021-02-18 11:03:26', NULL),
(16, 6, 'fifa_21', 'ps4', 10, 'asd', 'ghsgd', 'completed', '', '2021-02-18 11:08:49', 5, '2021-02-18 11:09:35', '2021-02-19', '16:09:00', NULL, NULL, NULL, NULL, 'win', 'lose', '2021-02-18 11:09:52', NULL, '2021-02-18 11:09:58', NULL),
(17, 5, 'fifa_21', 'ps4', 10, 'asd', 'asd', 'no_result', '', '2021-02-18 11:10:50', 6, '2021-02-18 11:11:22', '2021-02-17', '16:11:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(18, 5, 'fifa_21', 'pc', 15, 'sadhj', 'kasjhdkj', 'disputed', '', '2021-02-18 11:58:25', 6, '2021-02-18 11:58:46', '2021-02-19', '16:58:00', NULL, NULL, NULL, NULL, 'lose', 'loss', '2021-02-19 04:40:18', NULL, '2021-03-31 14:17:17', '2021-03-31 14:17:17'),
(19, 5, 'fifa_21', 'ps4', 10, 'ashdj', 'ashjdkjh', 'completed', '', '2021-02-19 04:57:08', 6, '2021-02-19 04:57:26', '2021-02-20', '09:57:00', NULL, NULL, NULL, NULL, 'lose', 'win', '2021-02-19 04:58:36', NULL, '2021-02-19 04:57:45', NULL),
(20, 5, 'clash_of_clans', 'pc', 15, 'dsf', 'sdf', 'disputed', '', '2021-02-19 05:14:31', 6, '2021-02-19 05:14:57', '2021-02-20', '10:14:00', NULL, NULL, NULL, NULL, 'win', 'win', '2021-02-19 05:15:11', NULL, '2021-02-19 05:15:15', NULL),
(21, 5, 'fortnite', 'ps4', 100, 'no mod', 'no rules', 'cancelled', 'Challenge cancelled by owner', '2021-02-20 08:25:05', 6, '2021-02-23 06:09:39', NULL, NULL, NULL, '2021-02-24 10:30:38', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(22, 6, 'fifa_21', 'pc', 10, '', '', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 10:00:20', 5, '2021-02-23 06:14:57', '2021-02-23', '15:00:00', NULL, '2021-02-24 10:33:00', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(23, 6, 'fortnite', 'ps4', 15, 'testing123', 'testing123', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 10:01:29', 5, '2021-02-23 06:07:20', '2021-01-26', '15:01:00', NULL, '2021-02-25 11:21:23', '2021-02-25 11:01:23', NULL, '', '', NULL, NULL, NULL, NULL),
(24, 5, 'clash_of_clans', 'pc', 250, 'dsas', 'dasdas', 'disputed', '', '2021-02-22 11:01:14', 6, '2021-02-23 06:15:36', '2021-02-27', '16:59:00', '2021-02-23 11:39:32', NULL, NULL, NULL, 'loss', 'loss', '2021-03-01 11:54:49', NULL, '2021-03-01 04:39:41', '2021-03-01 11:54:49'),
(25, 5, 'fortnite', 'xbox', 15, 'daasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-22 11:51:08', 6, '2021-02-23 06:03:36', '2021-02-24', '16:51:00', NULL, '2021-02-24 10:34:16', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(26, 6, 'fifa_21', 'ps4', 15, 'adasd', 'asdasd', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:15:59', 5, '2021-02-23 06:16:10', '2021-01-26', '11:15:00', NULL, '2021-02-24 11:53:56', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(27, 5, 'fifa_21', 'pc', 25, 'ddgd', 'fgdfgd', 'confirmed', '', '2021-02-23 06:18:08', 6, '2021-02-23 06:18:22', '2021-02-27', '02:21:00', NULL, NULL, NULL, NULL, 'loss', 'loss', '2021-03-01 05:00:14', NULL, '2021-03-01 05:00:52', NULL),
(28, 6, 'fortnite', 'xbox', 10, 'asjdklj', 'kljsdlakjkl', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:20:50', 5, '2021-02-23 06:20:58', '2021-01-26', '23:20:00', NULL, '2021-02-24 06:40:36', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(29, 5, 'fifa_21', 'pc', 10, 'dfs', 'fsdf', 'cancelled', 'Challenge date time exceeded', '2021-02-23 06:23:44', 6, '2021-02-23 06:23:49', '2021-02-12', '23:23:00', NULL, '2021-02-24 06:41:54', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(30, 5, 'fifa_21', 'ps4', 10, 'asdasd', 'dasdas', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:05:58', NULL, NULL, '2021-01-24', '00:05:00', NULL, '2021-02-24 07:23:05', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(31, 5, 'clash_of_clans', 'nintendo', 15, 'asdasd', 'asdas', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:06:19', 6, '2021-02-24 04:24:14', '2021-02-04', '16:10:00', NULL, '2021-02-24 06:35:58', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(32, 6, 'fortnite', 'xbox', 15, 'dadas', 'dasda', 'cancelled', 'Challenge date time exceeded', '2021-02-23 07:08:30', NULL, NULL, '2021-01-27', '16:12:00', NULL, '2021-02-24 07:24:25', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(33, 5, 'fortnite', 'pc', 15, 'dsadas', 'dasd', 'tie', '', '2021-02-23 11:46:40', 6, '2021-02-23 11:46:56', '2021-03-02', '13:49:00', '2021-02-23 11:47:34', NULL, NULL, NULL, 'tie', 'tie', '2021-03-02 09:14:59', NULL, '2021-03-02 09:15:18', '2021-03-02 09:15:18'),
(34, 5, 'fortnite', 'ps4', 15, 'asdas', 'dasdad', 'cancelled', 'Challenge date time exceeded', '2021-02-24 04:23:20', NULL, NULL, '2021-01-27', '09:23:00', NULL, '2021-02-24 07:19:15', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(35, 5, 'fifa_21', 'nintendo', 20, 'dqwdasd', 'asdasd', 'cancelled', 'Challenge date time exceeded', '2021-02-24 04:23:34', NULL, NULL, '2021-02-07', '09:23:00', NULL, '2021-02-24 07:26:39', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(36, 5, 'fifa_21', 'ps4', 10, 'ashdkjhasd', 'hksdhkjs', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 07:58:01', NULL, NULL, '2021-02-25', '12:57:00', NULL, '2021-02-24 10:29:27', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(37, 5, 'fortnite', 'pc', 20, 'sdajs', 'kjhsadkhjas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 07:58:18', NULL, NULL, '2021-03-06', '13:58:00', NULL, '2021-02-24 10:44:58', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(38, 6, 'fifa_21', 'pc', 400, 'asdasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:37:09', NULL, NULL, '2021-02-27', '15:37:00', NULL, '2021-02-24 10:37:20', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(39, 6, 'fortnite', 'nintendo', 250, 'sdas', 'dasdas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:38:38', 5, '2021-02-24 10:41:55', '2021-02-26', '03:38:00', NULL, '2021-02-24 10:43:02', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(40, 5, 'fortnite', 'pc', 12, 'asdas', 'dasdsda', 'open', '', '2021-02-24 10:49:32', NULL, NULL, '2021-02-27', '15:49:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(41, 5, 'fortnite', 'xbox', 5, 'asdasda', 'sdasdas', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:49:45', NULL, NULL, '2021-03-07', '15:49:00', NULL, '2021-02-24 10:49:48', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(42, 5, 'fifa_21', 'pc', 3, 'das', 'dasdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:50:14', NULL, NULL, '2021-03-05', '15:50:00', NULL, '2021-02-24 10:50:18', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(43, 5, 'fortnite', 'xbox', 15, 'asdasd', 'asdasd', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 10:50:38', NULL, NULL, '2021-03-05', '15:50:00', NULL, '2021-02-24 11:52:58', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(44, 6, 'fortnite', 'pc', 15, 'skjdla', 'kjsadlas', 'reset', 'Challenge date time exceeded', '2021-02-24 11:32:21', NULL, NULL, '2021-02-05', '16:32:00', NULL, NULL, '2021-02-25 10:51:44', NULL, '', '', NULL, NULL, NULL, NULL),
(45, 5, 'clash_of_clans', 'pc', 20, 'gshadgj', 'hjsagdj', 'cancelled', 'Challenge cancelled by owner', '2021-02-24 11:52:02', 6, '2021-02-24 11:52:18', '2021-03-06', '16:51:00', NULL, '2021-02-24 11:52:36', NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(46, 6, 'clash_of_clans', 'pc', 15, 'asd', 'asdasd', 'open', 'Challenge date time exceeded', '2021-02-25 11:33:22', NULL, NULL, '2021-03-06', '16:53:00', NULL, NULL, '2021-02-25 11:33:46', '2021-02-25 11:53:41', '', '', NULL, NULL, NULL, NULL),
(47, 5, 'fortnite', 'xbox', 10, 'asdkjhadjk', 'hakjsdhkhasdkj', 'open', '', '2021-02-25 11:49:13', NULL, NULL, '2021-02-28', '16:49:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(48, 6, 'fortnite', 'ps4', 15, 'asdas', 'dasdasd', 'open', '', '2021-02-25 11:53:30', NULL, NULL, '2021-02-27', '16:53:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(49, 6, 'clash_of_clans', 'xbox', 25, 'asd', 'asdasd', 'accepted', '', '2021-02-25 11:54:04', 5, '2021-03-07 04:30:07', '2021-03-13', '16:54:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(50, 5, 'fifa_21', 'ps4', 10, 'test1', 'test1', 'reset', 'Challenge date time exceeded', '2021-02-25 12:03:32', 6, '2021-02-26 04:44:04', '2021-02-27', '17:04:00', NULL, NULL, '2021-03-01 05:35:17', '2021-02-25 12:04:49', '', '', NULL, NULL, NULL, NULL),
(51, 5, 'fortnite', 'pc', 20, 'asdasd', 'sadasd', 'open', '', '2021-02-26 04:36:45', NULL, NULL, '2021-03-13', '09:36:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(52, 5, 'fortnite', 'pc', 10, 'asdad', 'asdasdas', 'accepted', '', '2021-03-07 04:25:18', 6, '2021-03-07 04:25:51', '2021-03-20', '09:25:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(53, 6, 'fifa_21', 'ps4', 10, 'testing', 'testing', 'accepted', '', '2021-03-07 07:00:30', 5, '2021-03-07 07:02:00', '2021-03-08', '12:00:00', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
(54, 15, 'clash_of_clans', 'ps4', 10, 'addd', 'adaddda', 'disputed', 'Challenge date time exceeded', '2021-03-25 14:31:49', 16, '2021-03-26 08:00:24', '2021-03-26', '13:09:00', '2021-03-26 08:00:38', NULL, '2021-03-25 15:02:20', '2021-03-26 07:57:06', 'win', 'win', '2021-03-26 08:09:12', '15', '2021-03-26 08:09:19', '2021-03-26 08:09:19'),
(55, 16, 'fifa_21', 'pc', 200, 'mom', 'mmm', 'reset', 'Challenge date time exceeded', '2021-03-25 14:47:22', 15, '2021-03-25 14:47:44', '2021-03-25', '19:50:00', NULL, NULL, '2021-03-26 08:00:07', NULL, '', '', NULL, NULL, NULL, NULL),
(56, 17, 'fortnite', 'xbox', 200, 'ddd', 'dddd', 'disputed', '', '2021-03-25 15:04:10', 15, '2021-03-25 15:04:35', '2021-03-25', '20:59:00', '2021-03-25 15:52:13', NULL, NULL, NULL, 'win', 'win', '2021-03-25 16:01:45', '17', '2021-03-25 16:04:46', '2021-03-25 16:04:46'),
(58, 17, 'fortnite', 'xbox', 10, 'ddsds', 'sdsdsdsd', 'disputed', '', '2021-03-26 18:11:28', 15, '2021-03-26 18:11:49', '2021-03-26', '23:15:00', '2021-03-26 18:13:06', NULL, NULL, NULL, 'loss', 'win', '2021-03-27 12:41:26', NULL, '2021-03-27 12:42:01', '2021-03-27 12:42:01'),
(59, 15, 'clash_of_clans', 'ps4', 10, 'nnn', 'mmm', 'completed', '', '2021-03-26 18:13:36', 17, '2021-03-26 18:13:51', '2021-03-27', '17:50:00', '2021-03-26 18:13:59', NULL, NULL, NULL, 'loss', 'win', '2021-03-27 12:55:11', NULL, '2021-03-27 12:56:13', '2021-03-27 12:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `chat_message` text DEFAULT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `admin_id` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `challenge_id`, `admin_id`, `timestamp`, `status`) VALUES
(1, 2, 1, 'hello', NULL, NULL, '2021-03-25 16:20:00', 0),
(2, 2, 3, 'ji', NULL, NULL, '2021-03-25 16:22:56', 0),
(3, 0, 2, 'hello', NULL, NULL, '2021-03-25 16:23:55', 1),
(4, 0, 3, 'ji', NULL, NULL, '2021-03-25 16:24:10', 1),
(5, 0, 1, 'han ji<div><br></div>', NULL, NULL, '2021-03-25 16:24:20', 1),
(6, 0, 2, '<p><img src=\"upload/116635829_2576847842564955_6689848435255367060_n.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', NULL, NULL, '2021-03-25 16:33:10', 1),
(7, 0, 1, 'hanji<div><br></div>', NULL, NULL, '2021-03-25 16:50:42', 1),
(8, 0, 15, 'ji janab', NULL, NULL, '2021-03-25 21:25:30', 1),
(9, 0, 17, 'hello', NULL, NULL, '2021-03-25 21:25:53', 1),
(10, 0, 17, '<p><img src=\"chat/upload/data4.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', NULL, NULL, '2021-03-25 21:29:07', 1),
(11, 0, 15, '<p><img src=\"chat/upload/33820675.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', NULL, NULL, '2021-03-25 21:29:28', 1),
(12, 0, 15, 'dsadas', NULL, NULL, '2021-03-25 21:30:04', 1),
(13, 0, 15, 'sadasd', NULL, NULL, '2021-03-25 21:32:44', 1),
(14, 0, 16, 'sadasd', 1, NULL, '2021-03-26 08:53:22', 1),
(15, 0, 15, 'sdaads', 54, NULL, '2021-03-26 08:55:47', 1),
(16, 0, 15, 'fdssdf', 54, NULL, '2021-03-26 09:01:20', 1),
(17, 0, 16, 'adsaads', 54, NULL, '2021-03-26 09:01:29', 1),
(18, 0, 16, '<p><img src=\"chat/upload/ADA.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p>this is screenshot', 54, NULL, '2021-03-26 09:08:55', 1),
(19, 0, 15, 'adsads', 54, NULL, '2021-03-26 10:25:50', 1),
(20, 0, 16, 'dsassad', 54, NULL, '2021-03-26 10:34:49', 1),
(21, 0, 16, 'hello', 54, NULL, '2021-03-26 10:35:06', 1),
(22, 0, 15, 'ji', 54, NULL, '2021-03-26 10:35:14', 1),
(23, NULL, NULL, 'fdfsd', 54, '0', '2021-03-26 15:59:05', 1),
(24, NULL, NULL, '\n\n			', 54, '0', '2021-03-26 16:13:00', 1),
(25, NULL, NULL, 'sadsad', 54, '0', '2021-03-26 16:13:03', 1),
(26, NULL, 17, 'saddas', 56, NULL, '2021-03-27 14:31:29', 1);
INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `challenge_id`, `admin_id`, `timestamp`, `status`) VALUES
(27, NULL, 17, '<img src=\"data:image/png;base64,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', 56, NULL, '2021-03-27 14:44:57', 1);

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
(27, 6, 'Dummy Deposit', '1000.000000000000000000000000000000', 'Tue Feb 23 2021 11:15:30 GMT+0500 (Pakistan Standard Time)', '2021-02-23 06:15:30'),
(28, 15, 'Dummy Deposit', '50000.000000000000000000000000000000', 'Thu Mar 25 2021 19:31:23 GMT+0500 (Pakistan Standard Time)', '2021-03-25 14:31:23'),
(29, 16, 'Dummy Deposit', '500000.000000000000000000000000000000', 'Thu Mar 25 2021 19:33:10 GMT+0500 (Pakistan Standard Time)', '2021-03-25 14:33:10'),
(30, 17, 'Dummy Deposit', '2000.000000000000000000000000000000', 'Thu Mar 25 2021 20:03:36 GMT+0500 (Pakistan Standard Time)', '2021-03-25 15:03:36'),
(31, 14, 'Dummy Deposit', '14565489.000000000000000000000000000000', 'Mon Mar 29 2021 15:16:07 GMT+0500 (Pakistan Standard Time)', '2021-03-29 10:16:07'),
(32, 12, 'Dummy Deposit', '12343.000000000000000000000000000000', 'Mon Mar 29 2021 15:17:42 GMT+0500 (Pakistan Standard Time)', '2021-03-29 10:17:43'),
(33, 10, 'Dummy Deposit', '1457896.000000000000000000000000000000', 'Mon Mar 29 2021 15:20:11 GMT+0500 (Pakistan Standard Time)', '2021-03-29 10:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `game_log`
--

CREATE TABLE `game_log` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `console` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_log`
--

INSERT INTO `game_log` (`id`, `name`, `console`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'dsaadsdas324', 'dasdas23', '116635829_2576847842564955_6689848435255367060_n.jpg', 'asddasdas213234', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'das', 'dasdas', '', 'asddasdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'das', 'dasdas', '', 'asddasdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'das', 'dasdas', '', 'asddasdas', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(141, 5, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 14', 'unread', '2021-03-10 11:33:48', NULL),
(142, 15, 'MOMI has accepted your Challenge! Waiting for your confirmation. Challenge ID: 54.', 'read', '2021-03-25 14:33:20', '2021-03-25 14:39:23'),
(143, 16, 'MOMIRANA has accepted your Challenge! Waiting for your confirmation. Challenge ID: 55.', 'read', '2021-03-25 14:47:44', '2021-03-25 14:48:04'),
(144, 16, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 15', 'read', '2021-03-25 14:54:12', '2021-03-25 14:54:29'),
(145, 16, 'Challenge # 54 has been Reset because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'unread', '2021-03-25 15:02:20', NULL),
(146, 17, 'MOMIRANA has accepted your Challenge! Waiting for your confirmation. Challenge ID: 56.', 'read', '2021-03-25 15:04:35', '2021-03-25 15:05:01'),
(147, 15, 'Challenge # 56 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-25 20:59:00', 'read', '2021-03-25 15:52:13', '2021-03-26 18:08:04'),
(148, 15, 'Your Opponent have claimed their result for Challenge # 56.', 'read', '2021-03-25 16:01:45', '2021-03-26 18:08:03'),
(149, 17, 'Your Opponent have claimed their result for Challenge # 56.', 'read', '2021-03-25 16:04:46', '2021-03-26 07:55:24'),
(150, 17, 'Challenge # 56 has ended.', 'read', '2021-03-25 16:04:46', '2021-03-26 18:10:46'),
(151, 15, 'Challenge # 55 has been Reset because the Challenge owner failed to Confirm the Challenge before the set Challenge date and time. The Challenge amount MINUS the service fee have been refunded back into your Balance.', 'read', '2021-03-26 08:00:07', '2021-03-26 18:08:01'),
(152, 15, 'MOMI has accepted your Challenge! Waiting for your confirmation. Challenge ID: 54.', 'read', '2021-03-26 08:00:24', '2021-03-26 18:07:59'),
(153, 16, 'Challenge # 54 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-27 12:58:00', 'unread', '2021-03-26 08:00:38', NULL),
(154, 16, 'Your Opponent have claimed their result for Challenge # 54.', 'unread', '2021-03-26 08:09:12', NULL),
(155, 15, 'Your Opponent have claimed their result for Challenge # 54.', 'read', '2021-03-26 08:09:19', '2021-03-26 15:59:59'),
(156, 15, 'Challenge # 54 has ended.', 'read', '2021-03-26 08:09:19', '2021-03-26 18:07:58'),
(157, 17, 'MOMIRANA has accepted your Challenge! Waiting for your confirmation. Challenge ID: 57.', 'read', '2021-03-26 18:00:03', '2021-03-26 18:07:41'),
(158, 15, 'Challenge # 57 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-27 22:00:00', 'read', '2021-03-26 18:00:18', '2021-03-26 18:07:57'),
(159, 17, 'MOMIRANA has accepted your Challenge! Waiting for your confirmation. Challenge ID: 58.', 'read', '2021-03-26 18:11:49', '2021-03-27 12:40:21'),
(160, 15, 'Challenge # 58 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-26 23:15:00', 'read', '2021-03-26 18:13:06', '2021-03-27 12:39:50'),
(161, 15, 'MOMIRANA has accepted your Challenge! Waiting for your confirmation. Challenge ID: 59.', 'read', '2021-03-26 18:13:51', '2021-03-27 12:39:50'),
(162, 17, 'Challenge # 59 has been accepted by its owner. Your Challenge is set to be played on: 2021-03-27 23:14:00', 'read', '2021-03-26 18:13:59', '2021-03-27 12:40:20'),
(163, 15, 'Your Opponent have claimed their result for Challenge # 58.', 'read', '2021-03-27 12:41:26', '2021-03-31 08:18:48'),
(164, 17, 'Your Opponent have claimed their result for Challenge # 58.', 'unread', '2021-03-27 12:42:01', NULL),
(165, 17, 'Challenge # 58 has ended.', 'unread', '2021-03-27 12:42:01', NULL),
(166, 17, 'Your Opponent have claimed their result for Challenge # 59.', 'unread', '2021-03-27 12:55:11', NULL),
(167, 15, 'Your Opponent have claimed their result for Challenge # 59.', 'read', '2021-03-27 12:56:13', '2021-03-31 08:18:46'),
(168, 15, 'Challenge # 59 has ended.', 'unread', '2021-03-27 12:56:13', NULL),
(169, 15, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 16', 'read', '2021-03-29 08:33:10', '2021-03-31 08:18:45'),
(170, 15, 'Tournament # 15 was cancelled by its owner. The Tournament amount ($200) has been refunded back into your Balance.', 'read', '2021-03-29 09:09:10', '2021-03-31 08:18:44'),
(171, 15, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 17', 'unread', '2021-03-29 10:19:06', NULL),
(172, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:15:13', '2021-03-31 08:18:43'),
(173, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:15:13', NULL),
(174, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:15:13', NULL),
(175, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:15:13', NULL),
(176, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:15:13', NULL),
(177, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:15:13', NULL),
(178, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:16:04', '2021-03-31 08:18:43'),
(179, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:16:04', NULL),
(180, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:16:04', NULL),
(181, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:16:04', NULL),
(182, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:16:04', NULL),
(183, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:16:04', NULL),
(184, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:17:07', '2021-03-31 08:18:41'),
(185, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:07', NULL),
(186, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:07', NULL),
(187, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:07', NULL),
(188, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:07', NULL),
(189, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:07', NULL),
(190, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:17:40', '2021-03-31 08:18:42'),
(191, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:40', NULL),
(192, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:40', NULL),
(193, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:40', NULL),
(194, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:40', NULL),
(195, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:17:40', NULL),
(196, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:21:46', '2021-03-31 08:18:40'),
(197, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:21:46', NULL),
(198, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:21:46', NULL),
(199, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:21:46', NULL),
(200, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:21:46', NULL),
(201, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:21:46', NULL),
(202, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:30:12', '2021-03-31 08:18:39'),
(203, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:30:12', NULL),
(204, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:30:12', NULL),
(205, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:30:12', NULL),
(206, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:30:12', NULL),
(207, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:30:12', NULL),
(208, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(209, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(210, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(211, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(212, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(213, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:31:01', NULL),
(214, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(215, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(216, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(217, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(218, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(219, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:37:46', NULL),
(220, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:50:55', '2021-03-31 08:18:38'),
(221, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:50:55', NULL),
(222, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:50:55', NULL),
(223, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:50:55', NULL),
(224, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:50:55', NULL),
(225, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:50:55', NULL),
(226, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-29 14:53:07', '2021-03-31 08:18:37'),
(227, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:53:07', NULL),
(228, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:53:07', NULL),
(229, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:53:07', NULL),
(230, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:53:07', NULL),
(231, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-29 14:53:07', NULL),
(232, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-30 08:00:26', '2021-03-31 08:18:37'),
(233, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:00:26', NULL),
(234, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:00:26', NULL),
(235, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:00:26', NULL),
(236, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:00:26', NULL),
(237, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:00:26', NULL),
(238, 15, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'read', '2021-03-30 08:01:17', '2021-03-31 08:18:35'),
(239, 16, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:01:17', NULL),
(240, 17, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:01:17', NULL),
(241, 14, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:01:17', NULL),
(242, 12, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:01:17', NULL),
(243, 11, 'Tournament # 17 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 15:06:00', 'unread', '2021-03-30 08:01:17', NULL),
(244, 16, 'Tournament # 17 was cancelled by its owner. The Tournament amount ($154) has been refunded back into your Balance.', 'unread', '2021-03-30 08:02:45', NULL),
(245, 17, 'Tournament # 17 was cancelled by its owner. The Tournament amount ($154) has been refunded back into your Balance.', 'unread', '2021-03-30 08:02:45', NULL),
(246, 14, 'Tournament # 17 was cancelled by its owner. The Tournament amount ($154) has been refunded back into your Balance.', 'unread', '2021-03-30 08:02:45', NULL),
(247, 12, 'Tournament # 17 was cancelled by its owner. The Tournament amount ($154) has been refunded back into your Balance.', 'unread', '2021-03-30 08:02:45', NULL),
(248, 11, 'Tournament # 17 was cancelled by its owner. The Tournament amount ($154) has been refunded back into your Balance.', 'unread', '2021-03-30 08:02:45', NULL),
(249, 15, 'Tournament # 16 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 14:27:00', 'read', '2021-03-30 08:05:50', '2021-03-31 08:18:34'),
(250, 16, 'Tournament # 16 has been confirmed by its owner. Your Tournament is set to be played on: 2021-03-31 14:27:00', 'unread', '2021-03-30 08:05:50', NULL),
(251, 15, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 18', 'read', '2021-03-31 07:31:48', '2021-03-31 08:18:33'),
(252, 15, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'read', '2021-03-31 07:32:18', '2021-03-31 08:18:32'),
(253, 16, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'unread', '2021-03-31 07:32:18', NULL),
(254, 17, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'unread', '2021-03-31 07:32:18', NULL),
(255, 14, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'unread', '2021-03-31 07:32:18', NULL),
(256, 12, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'unread', '2021-03-31 07:32:18', NULL),
(257, 11, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-09 15:26:00', 'unread', '2021-03-31 07:32:18', NULL),
(258, 15, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 18', 'unread', '2021-03-31 08:37:58', NULL),
(259, 15, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(260, 11, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(261, 16, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(262, 1, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(263, 2, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(264, 3, 'Tournament # 18 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 13:28:00', 'unread', '2021-03-31 08:38:17', NULL),
(265, 5, 'Challenge # 18 has ended.', 'unread', '2021-03-31 14:17:17', NULL),
(266, 15, 'Your Opponent have claimed their result for Tournament # 18.', 'unread', '2021-03-31 14:35:42', NULL),
(267, 15, 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # 19', 'unread', '2021-03-31 15:04:27', NULL),
(268, 15, 'Tournament # 19 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 21:03:00', 'unread', '2021-03-31 15:04:41', NULL),
(269, 14, 'Tournament # 19 has been confirmed by its owner. Your Tournament is set to be played on: 2021-04-01 21:03:00', 'unread', '2021-03-31 15:04:41', NULL);

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
  `confirmed_timestamp` timestamp NULL DEFAULT NULL,
  `ready_timestamp` timestamp NULL DEFAULT NULL,
  `reset_timestamp` timestamp NULL DEFAULT NULL,
  `cancelled_timestamp` timestamp NULL DEFAULT NULL,
  `reopen_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournaments_log`
--

INSERT INTO `tournaments_log` (`tournament_id`, `tournament_by`, `game`, `console`, `amount`, `players`, `start_date`, `start_time`, `game_mode`, `rules`, `status`, `created_timestamp`, `confirmed_timestamp`, `ready_timestamp`, `reset_timestamp`, `cancelled_timestamp`, `reopen_timestamp`) VALUES
(1, 5, 'fifa_21', 'ps4', 10, 10, '2021-03-18', '18:29:00', '', '', 'cancelled', '2021-03-02 12:55:49', NULL, NULL, '2021-03-06 12:02:17', '2021-03-09 13:32:46', '2021-03-09 13:29:35'),
(2, 5, 'fortnite', 'pc', 15, 14, '2021-03-26', '17:57:00', '', '', 'cancelled', '2021-03-02 12:57:09', NULL, NULL, NULL, '2021-03-09 12:00:10', NULL),
(3, 5, 'clash_of_clans', 'xbox', 20, 20, '2021-03-20', '17:58:00', '', '', 'cancelled', '2021-03-02 12:58:13', NULL, NULL, NULL, '2021-03-09 11:50:31', NULL),
(4, 5, 'fifa_21', 'ps4', 30, 30, '2021-02-20', '18:01:00', 'testing 123', 'testing 123', 'cancelled', '2021-02-02 13:02:06', NULL, NULL, '2021-03-06 13:01:52', '2021-03-09 11:59:09', NULL),
(5, 6, 'fortnite', 'ps4', 10, 10, '2021-02-18', '10:57:00', 'sadhkjasdh', 'kjhasdkjh', 'cancelled', '2021-03-04 05:57:07', NULL, NULL, '2021-03-06 10:55:42', '2021-03-09 11:56:01', NULL),
(6, 5, 'fifa_21', 'pc', 10, 2, '2021-03-26', '16:02:00', '', '', 'cancelled', '2021-03-06 11:02:20', NULL, '2021-03-06 11:02:34', NULL, '2021-03-10 11:32:50', NULL),
(7, 5, 'fifa_21', 'ps4', 10, 4, '2021-02-19', '18:05:00', 'test', 'test', 'cancelled', '2021-03-06 13:05:39', NULL, NULL, '2021-03-06 13:06:41', '2021-03-09 11:56:32', NULL),
(8, 6, 'fifa_21', 'pc', 10, 10, '2021-03-20', '11:22:00', '', '', 'cancelled', '2021-03-07 06:22:18', NULL, NULL, NULL, '2021-03-09 11:58:19', NULL),
(9, 5, 'fifa_21', 'ps4', 10, 10, '2021-03-12', '18:33:00', 'test', 'test', 'open', '2021-03-09 13:33:12', NULL, NULL, '2021-03-09 13:33:38', NULL, '2021-03-09 13:33:55'),
(10, 5, 'fortnite', 'pc', 10, 6, '2021-02-19', '09:50:00', 'test', 'test', 'reset', '2021-03-10 04:50:22', NULL, NULL, '2021-03-10 04:51:26', NULL, NULL),
(11, 5, 'clash_of_clans', 'xbox', 10, 10, '2021-03-27', '09:50:00', 'test123', 'test123', 'open', '2021-03-10 04:50:46', NULL, NULL, NULL, NULL, NULL),
(12, 6, 'clash_of_clans', 'nintendo', 20, 4, '2021-03-26', '09:56:00', 'test', 'test', 'open', '2021-03-10 04:56:10', NULL, NULL, NULL, NULL, NULL),
(13, 6, 'fortnite', 'xbox', 10, 2, '2021-03-26', '12:08:00', 'test', 'test', 'ready', '2021-03-10 07:08:28', NULL, '2021-03-10 07:08:37', NULL, NULL, NULL),
(14, 5, 'clash_of_clans', 'nintendo', 20, 2, '2021-03-27', '16:33:00', 'test', 'test', 'ready', '2021-03-10 11:33:38', NULL, '2021-03-10 11:33:48', NULL, NULL, NULL),
(15, 16, 'fortnite', 'ps4', 200, 2, '2021-03-25', '19:56:00', 'zzz', 'zzz', 'cancelled', '2021-03-25 14:53:35', NULL, '2021-03-25 14:54:11', NULL, '2021-03-29 09:09:10', NULL),
(16, 15, 'fifa_21', 'pc', 102, 2, '2021-03-31', '14:27:00', '2654`', '516saads', 'hnhvhgvhv', '2021-03-29 08:28:17', '2021-03-30 08:05:50', '2021-03-29 08:33:10', NULL, NULL, NULL),
(17, 15, 'fifa_21', 'pc', 154, 6, '2021-03-31', '19:06:00', '54213', '45230', 'ready', '2021-03-29 10:06:39', '2021-03-30 08:01:17', '2021-03-29 10:19:06', NULL, NULL, NULL),
(18, 15, 'fifa_21', 'ps4', 10, 6, '2021-03-31', '13:42:00', 'testing work', 'testing work', 'confirmed', '2021-03-31 08:28:46', '2021-03-31 08:38:17', '2021-03-31 08:37:58', NULL, NULL, NULL),
(19, 15, 'fifa_21', 'pc', 154, 2, '2021-04-01', '21:03:00', 'asdsda', 'sadasd', 'confirmed', '2021-03-31 15:03:41', '2021-03-31 15:04:41', '2021-03-31 15:04:27', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tourney_players`
--

CREATE TABLE `tourney_players` (
  `serial_number` int(11) NOT NULL,
  `tourney_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `result` text DEFAULT NULL,
  `claim_timestamp` timestamp NULL DEFAULT NULL,
  `end_timestamp` timestamp NULL DEFAULT NULL,
  `enter_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourney_players`
--

INSERT INTO `tourney_players` (`serial_number`, `tourney_id`, `player_id`, `result`, `claim_timestamp`, `end_timestamp`, `enter_timestamp`) VALUES
(20, 17, 15, NULL, NULL, NULL, '2021-03-09 13:33:12'),
(21, 17, 16, NULL, NULL, NULL, '2021-03-10 04:50:22'),
(22, 11, 5, NULL, NULL, NULL, '2021-03-10 04:50:46'),
(23, 12, 6, NULL, NULL, NULL, '2021-03-10 04:56:10'),
(24, 12, 5, NULL, NULL, NULL, '2021-03-10 04:56:19'),
(25, 11, 6, NULL, NULL, NULL, '2021-03-10 04:57:14'),
(26, 9, 6, NULL, NULL, NULL, '2021-03-10 04:57:25'),
(27, 13, 6, NULL, NULL, NULL, '2021-03-10 07:08:28'),
(28, 13, 5, NULL, NULL, NULL, '2021-03-10 07:08:37'),
(29, 14, 5, NULL, NULL, NULL, '2021-03-10 11:33:38'),
(30, 14, 6, NULL, NULL, NULL, '2021-03-10 11:33:48'),
(41, 18, 15, 'loss', '2021-03-31 14:35:42', NULL, '2021-03-31 08:28:46'),
(42, 18, 11, NULL, NULL, NULL, '2021-03-31 08:32:29'),
(43, 18, 16, NULL, NULL, NULL, '2021-03-31 08:32:54'),
(44, 18, 1, NULL, NULL, NULL, '2021-03-31 08:35:36'),
(45, 18, 2, NULL, NULL, NULL, '2021-03-31 08:36:44'),
(46, 18, 3, NULL, NULL, NULL, '2021-03-31 08:37:58'),
(47, 19, 15, NULL, NULL, NULL, '2021-03-31 15:03:41'),
(48, 19, 14, NULL, NULL, NULL, '2021-03-31 15:04:27');

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
(1, 'test username', 'test firstname', 'test lastname', 'test@email.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '147545.000000000000000000000000000000', 500),
(2, 'user 2', 'first 2', 'last 2', 'test2@email.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '444434.000000000000000000000000000000', 500),
(3, 'user 3', 'first 3', 'last 3', 'test3@email.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '8490.000000000000000000000000000000', 500),
(4, 'user 4', 'first 4', 'last 4', 'test4@email.com', '$2y$10$4a3OLSUtHmewGhh/siaIyuY/CgajvwrsIJ5yf5R.Ch4a/73RaV43e', '25.000000000000000000000000000000', 500),
(5, 'user 5', 'first 5', 'last 5', 'test5@email.com', '$2y$10$XKvtqT/BxmE2ZMovzAiiCupkg64hTg58iGgfQYh8CA89T801eGAiy', '481.202222900000000000000000000000', 510),
(6, 'user 6', 'first 6', 'last 6', 'test6@email.com', '$2y$10$IOZhOTW3906AtM5HP/zGi.VDE25AbhztbGP3Vkysk1p5tvx6eNOFK', '660.456789900000000000000000000000', 490),
(7, 'user 7', 'first 7', 'last 7', 'test7@email.com', '$2y$10$0yitpzEV6ofiGi9npHatYO7RbbtWTN.HBaMABQK/kjNMu4U9cwfcy', '905.000000000000000000000000000000', 500),
(8, 'user 8', 'first 8', 'last 8', 'test07@email.com', '$2y$10$5KKCpf7ER6wMP.lRIZIC5u/HSwldm80iTORIIU0rdIvvNZ/oe7hK6', '0.000000000000000000000000000000', 500),
(10, 'user new', 'first', 'last', 'new@email.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '1457896.000000000000000000000000000000', 500),
(11, 'hello', 'hello', 'world', 'hello@world.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '2356430.000000000000000000000000000000', 500),
(12, 'hello world', 'hello', 'world', 'hello@email.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '12388.000000000000000000000000000000', 500),
(14, 'lajawaab', 'ahmed', 'salim', 'example@test.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '14565320.000000000000000000000000000000', 500),
(15, 'MomiRana', 'Momi', 'Rana', 'rmomi786@gmail.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '49384.900000000000000000000000000000', 490),
(16, 'momi', 'momi', 'momi', 'text@gmil.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '499802.000000000000000000000000000000', 500),
(17, 'momirana', 'dddd', 'ddd', 'verifiedkameenaaa@gmail.com', '$2y$10$mBoy7dTj3lNXMfFRbMt80en6NWHxbrJobwr9sh./Kz7EK7WUlbdyK', '2093.000000000000000000000000000000', 510);

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges_log`
--
ALTER TABLE `challenges_log`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `deposit_log`
--
ALTER TABLE `deposit_log`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `game_log`
--
ALTER TABLE `game_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `challenges_log`
--
ALTER TABLE `challenges_log`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `deposit_log`
--
ALTER TABLE `deposit_log`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `game_log`
--
ALTER TABLE `game_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

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
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tourney_players`
--
ALTER TABLE `tourney_players`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `withdrawal_log`
--
ALTER TABLE `withdrawal_log`
  MODIFY `withdrawal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
