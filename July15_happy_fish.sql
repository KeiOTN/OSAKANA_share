-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 15 日 13:54
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user_id` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `fish_list`
--

INSERT INTO `fish_list` (`id`, `title`, `detail`, `place`, `deadline`, `created_at`, `updated_at`, `created_user_id`) VALUES
(4, 'ブリ４本', 'ヤズ含む', '岐志漁港から博多近辺', '2021-07-10', '2021-07-07 14:56:28', '2021-07-10 13:07:10', 1),
(5, 'サビキで釣った小型アジ', '大量に釣れたので、20匹程まとめて貰ってくれる方', '筑前前原駅周辺', '2021-07-07', '2021-07-07 14:57:51', '2021-07-07 14:57:51', 1),
(6, 'ヤリイカ（冷凍）', '２杯', '新宮駅周辺', '2021-07-15', '2021-07-08 11:52:57', '2021-07-08 11:52:57', 2),
(8, 'ヒラマサ受け取り募集（本日中）', '50-70cm前後のヒラマサ3本', '鐘崎漁港、姪浜駅', '2021-07-08', '2021-07-08 12:21:11', '2021-07-08 12:21:11', 2),
(9, '小型ワタリガニ20-30匹', '小型ですがたくさん獲れました!!', '姪浜漁港周辺', '2021-07-10', '2021-07-08 19:56:30', '2021-07-08 20:46:21', 4),
(10, 'ああああ', 'いいいいい', 'ううううう', '2021-07-17', '2021-07-10 13:09:07', '2021-07-10 13:09:07', 1),
(11, 'ooo', 'iii', 'uuu', '2021-07-23', '2021-07-10 13:11:41', '2021-07-10 13:11:41', 1);

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
(5, 4, 2, 1, 0, '2021-07-15 03:23:24', NULL);

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
(7, 1, 11, '2021-07-13 15:17:38'),
(8, 1, 10, '2021-07-13 15:17:43'),
(9, 1, 9, '2021-07-13 15:18:28'),
(13, 2, 8, '2021-07-13 15:53:50'),
(14, 2, 11, '2021-07-13 15:53:53'),
(15, 1, 5, '2021-07-14 22:12:25'),
(17, 1, 4, '2021-07-14 22:15:34');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_admin` int(1) DEFAULT 0,
  `is_deleted` int(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `email`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'keiOTN', 'aa@aa.aa', 'keiko', 0, 0, '2021-07-07 05:11:57', '2021-07-07 05:11:57'),
(2, 'tanaka', 'bb@bb.bb', '11112222', 0, 0, '2021-07-07 05:20:46', '2021-07-07 05:20:46'),
(3, 'さかなくん', 'cc@cc.cc', 'sakanadaisuki', 0, 0, '2021-07-07 16:50:18', '2021-07-07 16:50:18'),
(4, 'ハゼ太郎', 'dd@dd.dd', 'hazehaze', 0, 0, '2021-07-07 16:53:00', '2021-07-07 16:53:00'),
(5, 'ブリ次郎', 'dd@dd.dd', 'buriburi', 0, 0, '2021-07-07 16:53:45', '2021-07-07 16:53:45'),
(6, 'タイ三郎', 'ee@ee.ee', 'taitai', 0, 0, '2021-07-07 16:57:24', '2021-07-07 16:57:24'),
(8, 'admin', 'admin@admin.com', 'adminadmin', 1, 0, '2021-07-13 09:38:14', '2021-07-13 09:38:14'),
(10, 'サメ次郎', 'shark@shark.com', 'shark', 0, 0, '2021-07-13 09:40:32', '2021-07-13 09:40:32'),
(11, 'ふくふく福太郎', 'fuku@fuku.com', 'fukufuku', 0, 0, '2021-07-13 09:41:56', '2021-07-13 09:41:56'),
(12, '不遇なフグ太郎', 'fuguu@fuguu.com', 'fuguu', 0, 0, '2021-07-13 09:43:32', '2021-07-13 09:43:32'),
(20, '魚くん', 'sakanakun@sakanakun.com', 'sakanakun', 0, 0, '2021-07-13 09:49:42', '2021-07-13 09:49:42'),
(21, '魚大好き小学生', 'sakanadaisukishougakusei@sakanadaisukishougakusei.com', 'sakanadaisukishougakusei', 0, 0, '2021-07-13 09:51:25', '2021-07-13 09:51:25');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `friends_table`
--
ALTER TABLE `friends_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
