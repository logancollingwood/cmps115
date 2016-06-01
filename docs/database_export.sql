-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2016 at 05:05 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lolstat`
--

-- --------------------------------------------------------

--
-- Table structure for table `champions`
--

CREATE TABLE `champions` (
`id` int(11) NOT NULL,
  `championId` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `splash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_matches_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `champions`
--

INSERT INTO `champions` (`id`, `championId`, `title`, `name`, `key`, `image`, `splash`, `updated_matches_at`, `created_at`, `updated_at`) VALUES
(1, 133, 'Demacia''s Wings', 'Quinn', 'Quinn', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Quinn.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Quinn_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(2, 245, 'the Boy Who Shattered Time', 'Ekko', 'Ekko', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Ekko.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ekko_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(3, 16, 'the Starchild', 'Soraka', 'Soraka', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Soraka.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Soraka_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(4, 78, 'Keeper of the Hammer', 'Poppy', 'Poppy', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Poppy.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Poppy_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(5, 64, 'the Blind Monk', 'Lee Sin', 'LeeSin', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/LeeSin.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Lee Sin_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(6, 268, 'the Emperor of the Sands', 'Azir', 'Azir', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Azir.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Azir_0.jpg', '2016-05-30 00:40:00', '2016-05-30 07:40:00', '2016-05-30 07:40:00'),
(7, 236, 'the Purifier', 'Lucian', 'Lucian', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Lucian.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Lucian_0.jpg', '2016-05-30 00:40:01', '2016-05-30 07:40:01', '2016-05-30 07:40:01'),
(8, 103, 'the Nine-Tailed Fox', 'Ahri', 'Ahri', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Ahri.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ahri_0.jpg', '2016-05-30 00:40:01', '2016-05-30 07:40:01', '2016-05-30 07:40:01'),
(9, 80, 'the Artisan of War', 'Pantheon', 'Pantheon', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Pantheon.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Pantheon_0.jpg', '2016-05-30 00:40:01', '2016-05-30 07:40:01', '2016-05-30 07:40:01'),
(10, 1, 'the Dark Child', 'Annie', 'Annie', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Annie.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Annie_0.jpg', '2016-05-30 00:40:01', '2016-05-30 07:40:01', '2016-05-30 07:40:01'),
(11, 81, 'the Prodigal Explorer', 'Ezreal', 'Ezreal', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Ezreal.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ezreal_0.jpg', '2016-05-30 00:48:20', '2016-05-30 07:48:20', '2016-05-30 07:48:20'),
(12, 53, 'the Great Steam Golem', 'Blitzcrank', 'Blitzcrank', 'http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/Blitzcrank.png', 'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Blitzcrank_0.jpg', '2016-05-30 00:48:20', '2016-05-30 07:48:20', '2016-05-30 07:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `endofgame`
--

CREATE TABLE `endofgame` (
`id` int(11) NOT NULL,
  `riotmatchid` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `matchLength` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gameTypeStats`
--

CREATE TABLE `gameTypeStats` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gameTypeId` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `totalChampionKills` int(11) NOT NULL,
  `totalMinionKills` int(11) NOT NULL,
  `totalTurretsKilled` int(11) NOT NULL,
  `totalNeutralMinionsKilled` int(11) NOT NULL,
  `totalAssists` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gameTypeStats`
--

INSERT INTO `gameTypeStats` (`id`, `summonerId`, `region`, `gameTypeId`, `wins`, `totalChampionKills`, `totalMinionKills`, `totalTurretsKilled`, `totalNeutralMinionsKilled`, `totalAssists`, `created_at`, `updated_at`) VALUES
(1, 30896014, 'NA', 0, 26, 492, 0, 23, 0, 1077, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(2, 30896014, 'NA', 1, 3, 41, 0, 7, 66, 44, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(3, 30896014, 'NA', 2, 59, 652, 0, 100, 434, 952, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(4, 30896014, 'NA', 5, 1, 47, 0, 0, 0, 30, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(5, 30896014, 'NA', 6, 21, 304, 0, 42, 464, 259, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(6, 30896014, 'NA', 7, 0, 0, 0, 0, 0, 0, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(7, 30896014, 'NA', 9, 456, 5363, 0, 965, 12673, 7382, '2016-05-30 07:48:18', '2016-05-30 07:48:18'),
(8, 30896014, 'NA', 10, 7, 112, 0, 8, 108, 108, '2016-05-30 07:48:18', '2016-05-30 07:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
`id` bigint(20) unsigned NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masteries`
--

CREATE TABLE `masteries` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `masteryId` int(11) NOT NULL,
  `pageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_runes_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `masteries`
--

INSERT INTO `masteries` (`id`, `summonerId`, `page`, `rank`, `masteryId`, `pageName`, `updated_runes_at`, `created_at`, `updated_at`) VALUES
(1, 30896014, 35651744, 5, 6131, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(2, 30896014, 35651744, 1, 6343, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(3, 30896014, 35651744, 1, 6122, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(4, 30896014, 35651744, 5, 6331, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(5, 30896014, 35651744, 5, 6111, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(6, 30896014, 35651744, 1, 6141, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(7, 30896014, 35651744, 5, 6312, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(8, 30896014, 35651744, 1, 6322, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(9, 30896014, 35651744, 5, 6351, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(10, 30896014, 35651744, 1, 6362, 'Top/Gnar', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(11, 30896014, 35651745, 1, 6343, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(12, 30896014, 35651745, 5, 6114, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(13, 30896014, 35651745, 1, 6122, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(14, 30896014, 35651745, 1, 6321, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(15, 30896014, 35651745, 5, 6331, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(16, 30896014, 35651745, 1, 6141, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(17, 30896014, 35651745, 5, 6312, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(18, 30896014, 35651745, 5, 6351, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(19, 30896014, 35651745, 5, 6134, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(20, 30896014, 35651745, 1, 6362, 'adc', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(21, 30896014, 35651746, 1, 6343, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(22, 30896014, 35651746, 5, 6131, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(23, 30896014, 35651746, 1, 6122, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(24, 30896014, 35651746, 5, 6331, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(25, 30896014, 35651746, 5, 6111, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(26, 30896014, 35651746, 1, 6141, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(27, 30896014, 35651746, 5, 6312, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(28, 30896014, 35651746, 1, 6322, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(29, 30896014, 35651746, 1, 6162, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(30, 30896014, 35651746, 5, 6151, 'AP', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE `match` (
`id` int(11) NOT NULL,
  `matchId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platformId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `map` int(11) NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `season` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serverTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `patch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ranked` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `match`
--

INSERT INTO `match` (`id`, `matchId`, `platformId`, `map`, `queue`, `season`, `serverTime`, `length`, `patch`, `ranked`, `created_at`, `updated_at`) VALUES
(1, '2078969667', 'NA1', 11, 'RANKED_SOLO_5x5', 'SEASON2016', '1453748452012', 3240, '6.1.0.484', 1, '2016-05-30 07:39:55', '2016-05-30 07:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_08_184651_EndOfGame', 1),
('2016_04_08_185405_Player', 1),
('2016_04_08_185746_PlayerMatch', 1),
('2016_04_08_190013_WardPlacement', 1),
('2016_04_11_211905_GameTypeStats', 1),
('2016_04_13_012427_Match', 1),
('2016_04_13_175519_WardMatch', 1),
('2016_04_19_190338_create_jobs_table', 1),
('2016_04_20_063337_Rune', 1),
('2016_04_24_055030_Champions', 1),
('2016_05_14_043752_Mastery', 1),
('2016_05_18_002324_PlayerGame', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `summonerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profileIconId` int(11) NOT NULL,
  `totalChampionKills` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `deaths` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `minionKills` int(11) NOT NULL,
  `neutralMinionKills` int(11) NOT NULL,
  `turretsDestroyed` int(11) NOT NULL,
  `currentLeague` int(11) NOT NULL,
  `lastLeague` int(11) NOT NULL,
  `updated_matches_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `summonerId`, `summonerName`, `region`, `profileIconId`, `totalChampionKills`, `wins`, `deaths`, `assists`, `minionKills`, `neutralMinionKills`, `turretsDestroyed`, `currentLeague`, `lastLeague`, `updated_matches_at`, `created_at`, `updated_at`) VALUES
(1, 30896014, 'xuaqua', 'NA', 915, 7011, 573, 0, 9852, 0, 13745, 1145, 0, 0, '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `playergame`
--

CREATE TABLE `playergame` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `gameId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gameMode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gameType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `map` int(11) NOT NULL,
  `championId` int(11) NOT NULL,
  `spell1` int(11) NOT NULL,
  `spell2` int(11) NOT NULL,
  `summonerLevel` int(11) NOT NULL,
  `ipEarned` int(11) NOT NULL,
  `championLevel` int(11) NOT NULL,
  `largestMultiKill` int(11) NOT NULL,
  `largestKillingSpree` int(11) NOT NULL,
  `killingSprees` int(11) NOT NULL,
  `minionsKilled` int(11) NOT NULL,
  `largestCrit` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `won` int(11) NOT NULL,
  `wardsPlaced` int(11) NOT NULL,
  `wardsKilled` int(11) NOT NULL,
  `firstBlood` int(11) NOT NULL,
  `goldEarned` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `deaths` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `serverTime` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playergame`
--

INSERT INTO `playergame` (`id`, `summonerId`, `gameId`, `gameMode`, `gameType`, `subType`, `map`, `championId`, `spell1`, `spell2`, `summonerLevel`, `ipEarned`, `championLevel`, `largestMultiKill`, `largestKillingSpree`, `killingSprees`, `minionsKilled`, `largestCrit`, `team`, `won`, `wardsPlaced`, `wardsKilled`, `firstBlood`, `goldEarned`, `kills`, `deaths`, `assists`, `serverTime`, `created_at`, `updated_at`) VALUES
(1, 30896014, '2078969667', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 236, 4, 7, 30, 0, 18, 1, 3, 5, 306, 1047, 0, 0, 20, 8, 0, 24097, 15, 13, 16, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(2, 30896014, '2078960415', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 236, 4, 7, 30, 0, 18, 2, 8, 5, 222, 1179, 0, 1, 12, 1, 0, 20917, 23, 11, 11, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(3, 30896014, '2078934174', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 81, 4, 7, 30, 0, 15, 1, 3, 2, 191, 0, 0, 0, 11, 2, 0, 12295, 7, 7, 6, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(4, 30896014, '2078925984', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 53, 4, 14, 30, 0, 5, 2, 2, 1, 7, 0, 0, 0, 10, 1, 0, 3734, 3, 2, 2, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(5, 30896014, '2078897668', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 81, 4, 7, 30, 0, 17, 1, 2, 1, 220, 0, 0, 1, 10, 1, 0, 15762, 6, 7, 17, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(6, 30896014, '2078876249', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 81, 4, 7, 30, 0, 14, 2, 3, 2, 181, 0, 0, 1, 9, 2, 0, 13275, 9, 6, 15, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(7, 30896014, '2078884784', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 81, 4, 7, 30, 0, 11, 3, 7, 2, 125, 0, 0, 1, 2, 0, 0, 9890, 10, 2, 5, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(8, 30896014, '2078881573', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 236, 4, 7, 30, 0, 14, 2, 3, 2, 155, 561, 0, 1, 6, 1, 0, 13066, 8, 7, 9, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(9, 30896014, '2078858357', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 236, 4, 7, 30, 0, 18, 2, 5, 4, 256, 1035, 0, 1, 10, 6, 0, 19081, 14, 7, 13, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(10, 30896014, '2078855567', 'CLASSIC', 'MATCHED_GAME', 'RANKED_SOLO_5x5', 11, 53, 4, 14, 30, 0, 10, 1, 2, 1, 45, 0, 0, 0, 21, 1, 0, 7402, 2, 7, 6, 0, '2016-05-30 07:48:19', '2016-05-30 07:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `playermatch`
--

CREATE TABLE `playermatch` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `platformId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matchId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profileIcon` int(11) NOT NULL,
  `summonerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `champion` int(11) NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `season` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lane` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team` int(11) NOT NULL,
  `won` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `deaths` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `wards_placed` int(11) NOT NULL,
  `wards_killed` int(11) NOT NULL,
  `first_blood` int(11) NOT NULL,
  `serverTime` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playermatch`
--

INSERT INTO `playermatch` (`id`, `summonerId`, `platformId`, `matchId`, `profileIcon`, `summonerName`, `champion`, `queue`, `season`, `lane`, `role`, `team`, `won`, `kills`, `deaths`, `assists`, `wards_placed`, `wards_killed`, `first_blood`, `serverTime`, `created_at`, `updated_at`) VALUES
(1, 53210103, 'NA1', '2078969667', 26, 'aviloSoAmaze', 268, 'RANKED_SOLO_5x5', 'SEASON2016', 'MIDDLE', 'SOLO', 0, 1, 25, 4, 18, 29, 5, 0, 2147483647, '2016-05-30 07:39:54', '2016-05-30 07:39:54'),
(2, 28894180, 'NA1', '2078969667', 778, 'NearCat', 78, 'RANKED_SOLO_5x5', 'SEASON2016', 'JUNGLE', 'NONE', 0, 1, 11, 11, 14, 29, 13, 0, 2147483647, '2016-05-30 07:39:54', '2016-05-30 07:39:54'),
(3, 30470936, 'NA1', '2078969667', 937, 'johnsupel', 245, 'RANKED_SOLO_5x5', 'SEASON2016', 'TOP', 'SOLO', 0, 1, 10, 15, 16, 13, 4, 0, 2147483647, '2016-05-30 07:39:54', '2016-05-30 07:39:54'),
(4, 70263572, 'NA1', '2078969667', 7, 'TheBestMapKai', 16, 'RANKED_SOLO_5x5', 'SEASON2016', 'BOTTOM', 'DUO_SUPPORT', 0, 1, 0, 7, 48, 32, 25, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(5, 47564613, 'NA1', '2078969667', 714, 'xLegacyblade13x', 133, 'RANKED_SOLO_5x5', 'SEASON2016', 'BOTTOM', 'DUO_CARRY', 0, 1, 23, 13, 10, 21, 5, 1, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(6, 47815905, 'NA1', '2078969667', 936, 'Yawl', 64, 'RANKED_SOLO_5x5', 'SEASON2016', 'JUNGLE', 'NONE', 1, 0, 15, 10, 16, 47, 10, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(7, 37110439, 'NA1', '2078969667', 567, 'Bossaru99', 80, 'RANKED_SOLO_5x5', 'SEASON2016', 'TOP', 'SOLO', 1, 0, 6, 11, 7, 20, 6, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(8, 57397418, 'NA1', '2078969667', 983, 'DamnCranBerries', 103, 'RANKED_SOLO_5x5', 'SEASON2016', 'MIDDLE', 'SOLO', 1, 0, 5, 13, 15, 20, 3, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(9, 30896014, 'NA1', '2078969667', 915, 'xuaqua', 236, 'RANKED_SOLO_5x5', 'SEASON2016', 'BOTTOM', 'DUO_CARRY', 1, 0, 15, 13, 16, 20, 8, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55'),
(10, 64479555, 'NA1', '2078969667', 785, 'Guthrun Airef', 1, 'RANKED_SOLO_5x5', 'SEASON2016', 'BOTTOM', 'DUO_SUPPORT', 1, 0, 9, 22, 14, 21, 7, 0, 2147483647, '2016-05-30 07:39:55', '2016-05-30 07:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `runes`
--

CREATE TABLE `runes` (
`id` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  `runeId` int(11) NOT NULL,
  `pageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_runes_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `runes`
--

INSERT INTO `runes` (`id`, `summonerId`, `page`, `slot`, `runeId`, `pageName`, `updated_runes_at`, `created_at`, `updated_at`) VALUES
(1, 30896014, 28610903, 1, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(2, 30896014, 28610903, 2, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(3, 30896014, 28610903, 3, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(4, 30896014, 28610903, 4, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(5, 30896014, 28610903, 5, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(6, 30896014, 28610903, 6, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(7, 30896014, 28610903, 7, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(8, 30896014, 28610903, 8, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(9, 30896014, 28610903, 9, 5245, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(10, 30896014, 28610903, 10, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(11, 30896014, 28610903, 11, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(12, 30896014, 28610903, 12, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(13, 30896014, 28610903, 13, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(14, 30896014, 28610903, 14, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(15, 30896014, 28610903, 15, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(16, 30896014, 28610903, 16, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(17, 30896014, 28610903, 17, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(18, 30896014, 28610903, 18, 5317, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(19, 30896014, 28610903, 19, 5289, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(20, 30896014, 28610903, 20, 5289, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(21, 30896014, 28610903, 21, 5289, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(22, 30896014, 28610903, 22, 5277, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(23, 30896014, 28610903, 23, 5289, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(24, 30896014, 28610903, 24, 5289, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(25, 30896014, 28610903, 25, 5277, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(26, 30896014, 28610903, 26, 5277, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(27, 30896014, 28610903, 27, 5277, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(28, 30896014, 28610903, 28, 5337, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(29, 30896014, 28610903, 29, 5337, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(30, 30896014, 28610903, 30, 5337, 'AD', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(31, 30896014, 28610904, 1, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(32, 30896014, 28610904, 2, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(33, 30896014, 28610904, 3, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(34, 30896014, 28610904, 4, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(35, 30896014, 28610904, 5, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(36, 30896014, 28610904, 6, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(37, 30896014, 28610904, 7, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(38, 30896014, 28610904, 8, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(39, 30896014, 28610904, 9, 5273, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(40, 30896014, 28610904, 10, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(41, 30896014, 28610904, 11, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(42, 30896014, 28610904, 12, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(43, 30896014, 28610904, 13, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(44, 30896014, 28610904, 14, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(45, 30896014, 28610904, 15, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(46, 30896014, 28610904, 16, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(47, 30896014, 28610904, 17, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(48, 30896014, 28610904, 18, 5317, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(49, 30896014, 28610904, 19, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(50, 30896014, 28610904, 20, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(51, 30896014, 28610904, 21, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(52, 30896014, 28610904, 22, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(53, 30896014, 28610904, 23, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(54, 30896014, 28610904, 24, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(55, 30896014, 28610904, 25, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(56, 30896014, 28610904, 26, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(57, 30896014, 28610904, 27, 5289, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(58, 30896014, 28610904, 28, 5357, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(59, 30896014, 28610904, 29, 5357, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19'),
(60, 30896014, 28610904, 30, 5357, 'bruiser', '2016-05-30 00:48:19', '2016-05-30 07:48:19', '2016-05-30 07:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wardmatch`
--

CREATE TABLE `wardmatch` (
`id` int(11) NOT NULL,
  `matchId` int(11) NOT NULL,
  `summonerId` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `champions`
--
ALTER TABLE `champions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endofgame`
--
ALTER TABLE `endofgame`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gameTypeStats`
--
ALTER TABLE `gameTypeStats`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`id`), ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `masteries`
--
ALTER TABLE `masteries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match`
--
ALTER TABLE `match`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playergame`
--
ALTER TABLE `playergame`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playermatch`
--
ALTER TABLE `playermatch`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `runes`
--
ALTER TABLE `runes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wardmatch`
--
ALTER TABLE `wardmatch`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `champions`
--
ALTER TABLE `champions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `endofgame`
--
ALTER TABLE `endofgame`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gameTypeStats`
--
ALTER TABLE `gameTypeStats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `masteries`
--
ALTER TABLE `masteries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `match`
--
ALTER TABLE `match`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `playergame`
--
ALTER TABLE `playergame`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `playermatch`
--
ALTER TABLE `playermatch`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `runes`
--
ALTER TABLE `runes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wardmatch`
--
ALTER TABLE `wardmatch`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;