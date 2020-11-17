-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 07:01 PM
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
-- Database: `minifacebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `created_at`, `comment`) VALUES
(113, 40, 41, '2020-11-16 17:59:41', 'Pls like me!'),
(114, 41, 41, '2020-11-16 18:04:21', 'I liked your post!'),
(115, 41, 42, '2020-11-16 18:22:41', 'Liked'),
(116, 40, 43, '2020-11-16 18:32:04', 'Comment posted'),
(117, 40, 43, '2020-11-16 19:32:59', 'You cool'),
(118, 40, 43, '2020-11-16 19:34:10', 'nice'),
(119, 40, 43, '2020-11-16 19:34:48', 'nice'),
(120, 40, 43, '2020-11-16 19:34:59', 'super'),
(121, 40, 43, '2020-11-16 19:35:32', 'do you agree?'),
(122, 40, 43, '2020-11-16 19:35:37', 'do you agree?'),
(123, 40, 43, '2020-11-16 19:35:54', 'please answer'),
(124, 41, 46, '2020-11-16 19:48:48', 'Commented'),
(125, 41, 44, '2020-11-16 19:49:42', 'Kek'),
(126, 41, 43, '2020-11-17 19:23:46', 'Thx'),
(127, 44, 41, '2020-11-17 19:42:39', 'Me too!');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friendship_id`, `user_id`, `friend_id`) VALUES
(58, 41, 40),
(59, 40, 41),
(60, 41, 42),
(61, 42, 41),
(62, 40, 42),
(63, 42, 40),
(64, 44, 40),
(65, 40, 44);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`) VALUES
(28, 41, 41),
(29, 41, 42),
(38, 41, 46),
(39, 41, 44),
(41, 40, 43),
(42, 44, 48),
(44, 44, 41);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `created_at`) VALUES
(41, 40, 'Searching for friends!', '2020-11-16 17:59:18'),
(42, 43, 'Wrote something here', '2020-11-16 18:21:20'),
(43, 41, 'MY POST', '2020-11-16 18:23:01'),
(44, 40, 'My second post!?', '2020-11-16 18:31:40'),
(45, 40, 'SOme info', '2020-11-16 19:44:29'),
(46, 40, 'PEPE', '2020-11-16 19:45:37'),
(47, 40, '123', '2020-11-16 19:46:42'),
(48, 40, 'Hello world!', '2020-11-16 20:42:35'),
(49, 44, 'Anybody here?', '2020-11-17 19:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `town` varchar(50) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `description`, `created_at`, `updated_at`, `town`, `photo`) VALUES
(40, 'Vassili', 'Gorbatsov', 'vasja@gmail.com', '293662475dbe4235a50a011325b9e878194dfcca', 'Hello world!?', '2020-11-16', '2020-11-16 17:45:42', 'Narva', 'image/pep.jpg'),
(41, 'Strange', 'Name', 'a@gmail.com', '293662475dbe4235a50a011325b9e878194dfcca', 'INFO ABOUT ME', '2020-11-16', '2020-11-16 18:03:27', 'London', 'image/pep.jpg'),
(42, 'Some', 'Body', 'once@gmail.com', '293662475dbe4235a50a011325b9e878194dfcca', NULL, '2020-11-16', '2020-11-16 18:14:17', 'Berlin', 'image/pep.jpg'),
(43, 'Third', 'Third', 'third@gmail.com', '293662475dbe4235a50a011325b9e878194dfcca', NULL, '2020-11-16', '2020-11-16 18:20:25', 'Helsinki', 'image/pep.jpg'),
(44, 'vas', 'go', 'vasgo@gmail.com', '293662475dbe4235a50a011325b9e878194dfcca', 'Hello Mini Facebook!', '2020-11-17', '2020-11-17 19:38:18', 'Tallinn', 'image/pep.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendship_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
