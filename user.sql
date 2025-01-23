-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2025 at 05:44 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwc`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `address`, `phone`, `email`, `password`, `token`) VALUES
(25, 'Sonam Kumari', '', '0', 'sonam@gmail.com', '2dfadf1c87039ffa7beca3f732d544c4', '25-952c3ff98a6acdc36497d839e31aa57c'),
(26, 'Chandan', '', '0', 'Chan@yahoo.com', 'b18f2dfcfc1c94c17e43419b7e8f788b', '26-9a3f54913bf27e648d1759c18d007165'),
(27, 'sonam sinha', '', '0', 'sonamaztech@gmail.com', '9e6398df22f2073b579131506d2adae3', '27-829083d7452626f6e64b96ec0b734811'),
(23, 'chirag', '', '0', 'chirag@gmail.com', '7323d2248f2fab5b7a698a6fbf28715d', '23-605ac7e4c16b8a013b4779b81f883e66'),
(24, 'nausheen', '', '0', 'nausheen@123gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '24-55d99a37b2e1badba7c8df4ccd506a88'),
(28, 'shalu', '', '0', 'shalu@gmail.com', '41691b886d6222134bf2c1949f2fcf08', '28-9d12d071c18b535cda26f47f20e5c7ae'),
(29, 'anju', '', '0', 'anju@gmail.com', '9abfae448bc00ea3214033a3086e6539', NULL),
(30, 'manju', '', '0', 'manju@gmail.com', '$2y$10$unLshJuQpL2XwJKLtmNlwuMw2rZHtF/.hPDEekgHx0Zx77z4W0tk.', NULL),
(37, 'Harsh Verma', 'alkapuri, patna', '1234512345', 'harsh@gmail.com', '$2y$10$DLxTxoXAapAM.B37qb3s8OGHd0bwBYWfYvMu2RxlMHOTWBA8/ZWJa', 'b0d37afcac73806cd6b75ad48441d9d3'),
(38, 'ritesh ', 'alkapuri, patna', '1234512345', 'ritesh@gmail.com', '$2y$10$n4HOkQ5fazyId8brUd39OuaVIB9gLntKpNTSjCS6Orm7eNur1gbeO', NULL),
(33, 'adminadmin', '', '0', 'admin@gmail.com', '$2y$10$r2akY28GvdzsIqj.lwNmpuE4QvJxGwX8xzgeVxEAFTlFzcw6VB2Oi', NULL),
(39, 'om prakash', 'beiley road, patna', '4545456767', 'prakash@gmail.com', '$2y$10$kOjRCV6sWmRszpOiH.KHNOtGIh4rYMYZDHqKm8Dgr/vywzAdek1IC', NULL),
(36, 'rashmi kumari', 'patna', '9090909090', 'rash@gmail.com', '$2y$10$dmlB1CGpI8LXdfyWHTpWEOzPVXUjSDcZloa3rb1gOkU3n9DLtsI62', NULL),
(40, 'navya', 'fbjewf', '7878787878', 'ajsbd@gmail.com', '$2y$10$ZzAeX1lzaBG9YQKuTnw5S.djKI897q4pGM8XPJEFvfwCCUZpmKqxO', NULL),
(41, 'lokesh', 'nainital', '8908908908', 'lok@gmail.com', '$2y$10$oslXSNdS5N8r18IYUiaWZ.xBJcknASaqR6DtFgUVLxB7jOkVRTxmi', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
