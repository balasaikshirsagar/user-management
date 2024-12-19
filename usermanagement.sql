-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2024 at 05:41 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_approved` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `mobile`, `email`, `address`, `gender`, `dob`, `profile_picture`, `signature`, `password`, `is_approved`, `created_at`, `is_active`) VALUES
(1, 'John Doe', 'super admin', '1234567890', 'johndoe@example.com', '123 Admin Street', 'Male', '1990-01-01', '../uploads/john_profile.jpg', '../uploads/john_signature.png', 'admin123', 1, '2024-12-10 04:30:00', 1),
(2, 'Rohit Sharma', 'admin', '8688228440', 'rohit@gmail.com', 'Mumbai', 'Male', '1987-04-30', '../uploads/rohit_profile.jpg', '../uploads/rohit_signature.png', 'rohit@123', 1, '2024-12-11 11:40:32', 1),
(3, 'Virat Kohli', 'admin', '8688228440', 'virat@gmail.com', 'Delhi', 'Male', '1988-11-05', '../uploads/virat_profile.jpg', '../uploads/virat_signature.png', 'virat@123', 1, '2024-12-11 11:51:52', 1),
(4, 'Kshirsagar Balasai', 'user', '8688228440', 'balasaikshirsagar@gmail.com', 'Hyderabad', 'Male', '2000-10-20', '../uploads/balasaiprofile.jpg', '../uploads/balasaisignature.png', 'user123', 0, '2024-12-11 11:36:36', 1),
(5, 'Hardik Pandya', 'user', '8688228440', 'hardik@gmail.com', 'Hyderabad', 'Male', '1998-01-10', '../uploads/hardik_profile.jpg', '../uploads/hardik_signature.png', 'hardik@123', 0, '2024-12-11 11:39:27', 1),
(6, 'Saha', 'user', '93484894439', 'saha@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$X0Vm49jKvg2HToDI0g483Os5OJ/QJOuuDobwYTBjJFU.rzeyf312S', 0, '2024-12-14 09:17:07', 1),
(7, 'Mayank Agarwal', 'admin', '93484894439', 'mayank@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$hakYm5WdEZ1rgUNEkyua/uyC2zecT6P8YvL4eekn8.TQjoAE7Kt8.', 1, '2024-12-14 09:18:08', 1),
(8, 'Shashank Agarwal', 'superadmin', '93484894439', 'shashank@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$YSclPYdT8alrx81AEIo0Ge92AiR8/yH4FmnxlyhNT5pVCAPks8x9.', 0, '2024-12-14 09:39:48', 1),
(9, 'Parthiv Patel', 'user', '93484894439', 'patel@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$u1YzJMa8ekPrBFSK8FcJNe6hx4i4DV8XyY4Ewltg7h27n7xBOhiVe', 1, '2024-12-14 10:14:38', 1),
(10, 'harshal Patel', 'user', '93484894439', 'harshal@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$SLROrh/PeJ0ToMeRPgCxg.hPgQTm9.I3q9RYNQM80tOtqKkg9NZU6', 0, '2024-12-14 10:19:23', 1),
(11, 'Rishab Patel', 'superadmin', '93484894439', 'rishab@gmail.com', 'saha', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$NB3N05KGJjloRKtlV2B6KOSQr1pXkQLp8zltZuJYaXTVaA1x.3Ivy', 1, '2024-12-16 07:26:41', 1),
(12, 'Ricky Ponting', 'user', '93484894439', 'ricky@gmail.com', 'ricky', 'Male', '2024-12-12', '../uploads/android.jpeg', '../uploads/androidpost.webp', '$2y$10$gmoxoI1Tcq4ONXhTATLQg.S8kbajk9lvpQ.dpPtfDJDrCeFfrukqu', 1, '2024-12-16 11:53:40', 1),
(13, 'Harbajan Singh', 'user', '955073038', 'harbajan@gmail.com', 'Hyderabad', 'Male', '2024-12-10', '../uploads/AI-Modeler-300x169.webp', '../uploads/android.jpeg', '$2y$10$Z5AnthRkdRaQkc/70eADfO9qFgx2P6/VNUio5ND.Ych9f4Z3KO3JC', 1, '2024-12-19 15:09:39', 1),
(14, 'Vivek Singh', 'user', '8688228440', 'vivek@gmail.com', 'Hyderabad', 'Male', '2024-12-10', '../uploads/android.jpeg', '../uploads/bed.jpeg', '$2y$10$F.ODoPYFOeCQT6jD4tpgaOmqAk264NrkoYxRBCQk8sesaGZupzv9q', 1, '2024-12-19 17:23:54', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
