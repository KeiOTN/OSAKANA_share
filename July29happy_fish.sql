-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 29 日 17:05
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `happy_fish`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `fish_list`
--

CREATE TABLE `fish_list` (
  `id` int(12) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(126) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user_id` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `fish_list`
--

INSERT INTO `fish_list` (`id`, `title`, `detail`, `place`, `deadline`, `image`, `created_at`, `updated_at`, `created_user_id`) VALUES
(4, 'ブリ４本', 'ヤズ含む', '岐志漁港から博多近辺', '2021-07-10', NULL, '2021-07-07 14:56:28', '2021-07-10 13:07:10', 1),
(5, 'サビキで釣った小型アジ', '大量に釣れたので、20匹程まとめて貰ってくれる方', '筑前前原駅周辺', '2021-07-07', NULL, '2021-07-07 14:57:51', '2021-07-07 14:57:51', 1),
(6, 'ヤリイカ（冷凍）', '２杯', '新宮駅周辺', '2021-07-15', NULL, '2021-07-08 11:52:57', '2021-07-08 11:52:57', 2),
(8, 'ヒラマサ受け取り募集（本日中）', '50-70cm前後のヒラマサ3本', '鐘崎漁港、姪浜駅', '2021-07-08', NULL, '2021-07-08 12:21:11', '2021-07-08 12:21:11', 2),
(9, '小型ワタリガニ20-30匹', '小型ですがたくさん獲れました!!', '姪浜漁港周辺', '2021-07-10', NULL, '2021-07-08 19:56:30', '2021-07-08 20:46:21', 4),
(11, 'ooo', 'iii', 'uuu', '2021-07-23', NULL, '2021-07-10 13:11:41', '2021-07-10 13:11:41', 1),
(12, '甘鯛', '対馬の甘鯛', '今宿駅近くのコンビニ', '2021-07-31', 'upload/20210728000526fa2a1238366c5586c6ce0445b35ae2a3.jpeg', '2021-07-28 07:05:26', '2021-07-28 07:05:26', 1),
(14, 'ふぐ', '下関のふぐ', '関門海峡のふぐ', '2021-07-31', 'upload/202107280016186a9c1b798e403ea952849c0e1888b5bc.png', '2021-07-28 07:16:18', '2021-07-28 07:16:18', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `friends_table`
--

CREATE TABLE `friends_table` (
  `id` int(12) NOT NULL,
  `from_id` int(12) NOT NULL,
  `to_id` int(12) NOT NULL,
  `request` int(1) NOT NULL,
  `accept` int(1) DEFAULT NULL,
  `requested_at` datetime NOT NULL,
  `accepted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `friends_table`
--

INSERT INTO `friends_table` (`id`, `from_id`, `to_id`, `request`, `accept`, `requested_at`, `accepted_at`) VALUES
(1, 1, 2, 1, 0, '2021-07-15 01:57:33', NULL),
(2, 1, 6, 1, 0, '2021-07-15 02:00:28', NULL),
(3, 4, 6, 1, 0, '2021-07-15 03:23:20', NULL),
(4, 4, 1, 1, 0, '2021-07-15 03:23:21', NULL),
(5, 4, 2, 1, 0, '2021-07-15 03:23:24', NULL),
(6, 1, 10, 1, NULL, '2021-07-17 12:37:07', NULL),
(7, 1, 3, 1, NULL, '2021-07-17 12:37:12', NULL),
(8, 5, 1, 1, NULL, '2021-07-17 12:38:48', NULL),
(9, 5, 6, 1, NULL, '2021-07-17 12:38:49', NULL),
(10, 5, 20, 1, NULL, '2021-07-17 12:38:52', NULL),
(11, 1, 5, 1, NULL, '2021-07-17 12:39:49', NULL),
(12, 11, 5, 1, NULL, '2021-07-17 12:40:39', NULL),
(13, 11, 1, 1, NULL, '2021-07-17 12:40:40', NULL),
(14, 11, 20, 1, NULL, '2021-07-17 12:40:53', NULL),
(15, 10, 1, 1, NULL, '2021-07-17 13:41:10', NULL),
(16, 11, 1, 1, NULL, '2021-07-17 14:31:07', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `like_table`
--

CREATE TABLE `like_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fish_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `like_table`
--

INSERT INTO `like_table` (`id`, `user_id`, `fish_id`, `created_at`) VALUES
(8, 1, 10, '2021-07-13 15:17:43'),
(9, 1, 9, '2021-07-13 15:18:28'),
(13, 2, 8, '2021-07-13 15:53:50'),
(14, 2, 11, '2021-07-13 15:53:53'),
(15, 1, 5, '2021-07-14 22:12:25'),
(17, 1, 4, '2021-07-14 22:15:34'),
(18, 1, 8, '2021-07-17 12:36:51'),
(19, 10, 11, '2021-07-17 13:39:32'),
(20, 8, 9, '2021-07-17 13:39:55'),
(21, 11, 8, '2021-07-17 14:30:24'),
(22, 11, 4, '2021-07-17 14:30:30'),
(23, 1, 6, '2021-07-28 20:16:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `Image` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_admin` int(1) DEFAULT 0,
  `is_deleted` int(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `email`, `password`, `Image`, `comment`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'keiOTN', 'aa@aa.aa', 'keiko', 'profile_image/20210728170118d451bbd905de445517dbf07f952b78c3.png', '福岡県内を中心に九州北部で活動しています', 0, 0, '2021-07-07 05:11:57', '2021-07-29 00:01:18'),
(2, 'tanaka', 'bb@bb.bb', '11112222', NULL, NULL, 0, 0, '2021-07-07 05:20:46', '2021-07-07 05:20:46'),
(3, 'さかなくん', 'cc@cc.cc', 'sakanadaisuki', NULL, NULL, 0, 0, '2021-07-07 16:50:18', '2021-07-07 16:50:18'),
(4, 'ハゼ太郎', 'dd@dd.dd', 'hazehaze', NULL, NULL, 0, 0, '2021-07-07 16:53:00', '2021-07-07 16:53:00'),
(5, 'ブリ次郎', 'dd@dd.dd', 'buriburi', NULL, NULL, 0, 0, '2021-07-07 16:53:45', '2021-07-07 16:53:45'),
(6, 'タイ三郎', 'ee@ee.ee', 'taitai', NULL, NULL, 0, 0, '2021-07-07 16:57:24', '2021-07-07 16:57:24'),
(8, 'admin', 'admin@admin.com', 'adminadmin', NULL, NULL, 1, 0, '2021-07-13 09:38:14', '2021-07-13 09:38:14'),
(10, 'サメ次郎', 'shark@shark.com', 'shark', NULL, NULL, 0, 0, '2021-07-13 09:40:32', '2021-07-13 09:40:32'),
(11, 'ふくふく福太郎', 'fuku@fuku.com', 'fukufuku', NULL, NULL, 0, 0, '2021-07-13 09:41:56', '2021-07-13 09:41:56'),
(12, '不遇なフグ太郎', 'fuguu@fuguu.com', 'fuguu', NULL, NULL, 0, 0, '2021-07-13 09:43:32', '2021-07-13 09:43:32'),
(20, '魚くん', 'sakanakun@sakanakun.com', 'sakanakun', NULL, NULL, 0, 0, '2021-07-13 09:49:42', '2021-07-13 09:49:42'),
(21, '魚大好き小学生', 'sakanadaisukishougakusei@sakanadaisukishougakusei.com', 'sakanadaisukishougakusei', NULL, NULL, 0, 0, '2021-07-13 09:51:25', '2021-07-13 09:51:25');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `fish_list`
--
ALTER TABLE `fish_list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `friends_table`
--
ALTER TABLE `friends_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `fish_list`
--
ALTER TABLE `fish_list`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `friends_table`
--
ALTER TABLE `friends_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルの AUTO_INCREMENT `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
