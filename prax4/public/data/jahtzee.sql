-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 03:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jahtzee`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--
DROP TABLE IF EXISTS `games`;
DROP TABLE IF EXISTS `highscores`;
DROP TABLE IF EXISTS `players`;

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `firstPlayerId` int(11) DEFAULT NULL,
  `secondPlayerId` int(11) DEFAULT NULL,
  `numOfTurns` int(11) NOT NULL,
  `firstPlayerName` varchar(50) DEFAULT NULL,
  `secondPlayerName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `highscores`
--

CREATE TABLE `highscores` (
  `id` int(11) NOT NULL,
  `playerId` int(11) NOT NULL,
  `playerName` varchar(50) NOT NULL,
  `playerScore` int(11) NOT NULL,
  `gameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `highscores`
--

INSERT INTO `highscores` (`id`, `playerId`, `playerName`, `playerScore`, `gameId`) VALUES
(53, 384, 'vassili', 26, 186),
(54, 385, 'first', 33, 187),
(55, 100, 'Pepe', 50, 100),
(56, 101, 'AngryPepe', 49, 101),
(57, 103, 'Pepega', 60, 102),
(58, 102, 'GoodPepega', 55, 103),
(59, 104, 'UnskilledPlayer', 100, 106),
(60, 105, 'SkilledPlayer', 44, 105),
(61, 108, 'NoName', 47, 98),
(62, 109, 'Justname', 47, 99),
(66, 430, 'vassili', 123, 210);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gameId` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `ones` int(11) DEFAULT NULL,
  `twos` int(11) DEFAULT NULL,
  `threes` int(11) DEFAULT NULL,
  `fours` int(11) DEFAULT NULL,
  `fives` int(11) DEFAULT NULL,
  `sixes` int(11) DEFAULT NULL,
  `jokker` int(11) DEFAULT NULL,
  `numOfTurns` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `yahtzee` int(11) DEFAULT NULL,
  `FH` int(11) DEFAULT NULL,
  `LS` int(11) DEFAULT NULL,
  `SS` int(11) DEFAULT NULL,
  `FK` int(11) DEFAULT NULL,
  `TK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`);

--
-- Indexes for table `highscores`
--
ALTER TABLE `highscores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `highscores`
--
ALTER TABLE `highscores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
