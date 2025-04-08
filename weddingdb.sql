-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2024 at 06:22 PM
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
-- Database: `weddingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `id` int NOT NULL,
  `adminusername` varchar(255) NOT NULL,
  `adminpassword` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `adminusername`, `adminpassword`, `email`) VALUES
(0, 'admin', '$2y$10$/ziJMtgV7beVdCsdzDMkXuyy5Uw5W76r4XK9RVNg65.x9QWeVEB7C', 'admin123@gmail.com'),
(0, 'newregister4', '$2y$10$uj.9/DsuaHCc0h.XiAkCPO2K9eNiRUJWy4a/23LofRCc2e1wTmV6m', 'newregister4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wedding_date` date NOT NULL,
  `package` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `wedding_date`, `package`, `email`) VALUES
(0, 'Sean', '3233-03-23', 'silver', 'usertest4@gmail.com'),
(0, 'Sean', '0003-03-31', 'silver', 'usertest4@gmail.com'),
(0, 't', '4444-03-31', 'silver', 'usertest4@gmail.com'),
(0, 'Sean Christopher', '4444-04-04', 'silver', 'usertest4@gmail.com'),
(0, 'seswse', '2333-03-23', 'gold', 'usertest4@gmail.com'),
(0, 'DIDDY', '0323-03-23', 'platinum', 'usertest5@gmail.com'),
(0, 'e', '2134-03-03', 'platinum', 'usertest5@gmail.com'),
(0, 'DIDDY2u', '5555-05-05', 'silver', 'usertest5@gmail.com'),
(0, 'dwdd', '0666-06-06', 'gold', 'usertest5@gmail.com'),
(0, 'p.diddy', '8767-06-08', 'silver', 'usertest5@gmail.com'),
(0, 'DIDDY2u', '0999-09-09', 'platinum', 'usertest5@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(0, 'usertest4', 'usertest4@gmail.com', '$2y$10$Mnv9gxKt5XxoKSZx0mgE2uw/6qMmPKKN9QP7G24L.GeHXzsktecji'),
(0, 'usertest5', 'usertest5@gmail.com', '$2y$10$NPc.R571SepBPiPc8.hhd.mfd9vrLBzFNFmLI38hwrqn78QGFSYvC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
