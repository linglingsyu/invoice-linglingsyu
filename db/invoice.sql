-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-05-24 18:27:46
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `invoice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `year` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inv_date` date DEFAULT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spend` int(10) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `year`, `period`, `inv_date`, `code`, `num`, `spend`, `create_time`, `update_time`, `note`) VALUES
(1, 4, '109', '1', '0000-00-00', '', '12345678', 0, '2020-05-24 11:39:32', '2020-05-24 11:39:32', ''),
(2, 4, '109', '1', '2020-05-20', 'BN', '10146181', 35, '2020-05-24 13:38:38', '2020-05-24 13:38:38', '全家'),
(4, 4, '109', '2', '2020-05-08', 'BN', '12345679', 35, '2020-05-24 14:08:11', '2020-05-24 14:08:11', '123'),
(5, 4, '109', '1', '2020-05-07', 'BN', '12345678', 35, '2020-05-24 15:41:08', '2020-05-24 15:41:08', '7-11'),
(6, 4, '109', '1', '2020-05-23', 'ZA', '21346598', 100, '2020-05-24 15:44:21', '2020-05-24 15:44:21', ''),
(7, 4, '109', '1', '2020-05-23', 'ZA', '21346598', 100, '2020-05-24 15:44:45', '2020-05-24 15:44:45', '');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pw` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `acc`, `pw`, `name`, `birthday`, `email`, `create_time`, `update_time`) VALUES
(4, 'admin', '123', '00', '1988-11-26', 'zzxcv741@hotmail.com', '2020-05-10 15:35:26', '2020-05-10 15:35:26'),
(7, 'lalabear', '123', '拉拉熊', '2000-05-19', 'aaa@123.com', '2020-05-10 16:02:02', '2020-05-10 16:02:02'),
(10, 'curel', 'aaa', '柯潤', '2000-11-26', 'zzxcv@hotmail.com.tw', '2020-05-10 16:49:29', '2020-05-10 16:49:29'),
(11, 'alon', '789', '廣源良', '2003-11-26', 'zzxcv@hotmail.com.tw', '2020-05-10 16:52:42', '2020-05-10 16:52:42'),
(12, 'lawne', 'asdf', '蘭韻', '2003-12-26', 'zzxcv123@hotmail.com.tw', '2020-05-10 16:54:34', '2020-05-10 16:54:34'),
(13, 'menturm', 'asd123', '近江兄弟', '2018-02-13', 'zzxcv123@hotmail.com.tw', '2020-05-10 16:59:52', '2020-05-10 16:59:52'),
(14, 'spring', 'qqq', '春風', '2018-06-13', 'andante@hotmail.com.tw', '2020-05-10 17:03:05', '2020-05-10 17:03:05');

-- --------------------------------------------------------

--
-- 資料表結構 `winning numbers`
--

CREATE TABLE `winning numbers` (
  `id` int(11) UNSIGNED NOT NULL,
  `year` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_prize1` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_prize2` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_prize3` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addprize` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `winning numbers`
--

INSERT INTO `winning numbers` (`id`, `year`, `period`, `special`, `top`, `first_prize1`, `first_prize2`, `first_prize3`, `addprize`) VALUES
(4, '109', '1', '12620024', '39793895', '67913945', '09954061', '54574947', '007'),
(5, '109', '2', '12620024', '39793895', '67913945', '09954061', '54574947', '007'),
(6, '101', '3', '12620024', '39793895', '67913945', '09954061', '54574947', '007');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acc` (`acc`);

--
-- 資料表索引 `winning numbers`
--
ALTER TABLE `winning numbers`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `winning numbers`
--
ALTER TABLE `winning numbers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
