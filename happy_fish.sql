-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 08 日 16:12
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
(4, 'ブリ４本', 'ヤズ含む', '岐志漁港から博多近辺', '2021-07-10', '2021-07-07 14:56:28', '2021-07-07 14:56:28', 1),
(5, 'サビキで釣った小型アジ', '大量に釣れたので、20匹程まとめて貰ってくれる方', '筑前前原駅周辺', '2021-07-07', '2021-07-07 14:57:51', '2021-07-07 14:57:51', 1),
(6, 'ヤリイカ（冷凍）', '２杯', '新宮駅周辺', '2021-07-15', '2021-07-08 11:52:57', '2021-07-08 11:52:57', 2),
(8, 'ヒラマサ受け取り募集（本日中）', '50-70cm前後のヒラマサ3本', '鐘崎漁港、姪浜駅', '2021-07-08', '2021-07-08 12:21:11', '2021-07-08 12:21:11', 2),
(9, '小型ワタリガニ20-30匹', '小型ですがたくさん獲れました!!', '姪浜漁港周辺', '2021-07-10', '2021-07-08 19:56:30', '2021-07-08 20:46:21', 4);

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
(6, 'タイ三郎', 'ee@ee.ee', 'taitai', 0, 0, '2021-07-07 16:57:24', '2021-07-07 16:57:24');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `fish_list`
--
ALTER TABLE `fish_list`
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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
