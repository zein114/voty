-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2025 at 04:36 PM
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
-- Database: `vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `photo_path` varchar(512) DEFAULT NULL,
  `fr_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `en_description` text NOT NULL,
  `ar_description` text NOT NULL,
  `nominated_at` date DEFAULT NULL,
  `Supporting_party` varchar(255) NOT NULL,
  `path_supporting_party_logo` varchar(520) NOT NULL,
  `id_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `ar_name`, `photo_path`, `fr_description`, `en_description`, `ar_description`, `nominated_at`, `Supporting_party`, `path_supporting_party_logo`, `id_position`) VALUES
(19, 'Ahmed', 'أحمد', 'assets\\images\\candidates\\Ahmed_68faa510007bf_1761256720.png', 'I am a second-year student at SupNum, specializing in computer science and digital technologies. Passionate about software development, web technologies, and innovation, I am constantly looking to improve my technical and problem-solving skills through real-world projects and hackathons. I enjoy working in teams, exploring new technologies, and developing creative solutions that make a positive impact.', 'I am a second-year student at SupNum, specializing in computer science and digital technologies. Passionate about software development, web technologies, and innovation, I am constantly looking to improve my technical and problem-solving skills through real-world projects and hackathons. I enjoy working in teams, exploring new technologies, and developing creative solutions that make a positive impact.', 'أنا طالب في السنة الثانية في SupNum، أختص في علوم الحاسوب والتقنيات الرقمية. شغوف بتطوير البرمجيات والتقنيات الحديثة والابتكار، وأسعى باستمرار إلى تنمية مهاراتي التقنية والتحليلية من خلال المشاريع العملية والمشاركة في الهاكاثونات. أحب العمل الجماعي، واستكشاف التقنيات الجديدة، وتطوير حلول إبداعية تسهم في تحسين الواقع الرقمي.', '2025-10-23', 'UNEM', 'assets\\images\\supportings\\Ahmed_68faa51001d1b_1761256720.jpg', 17);

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int NOT NULL,
  `en_organizer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fr_organizer` varchar(255) NOT NULL,
  `ar_organizer` varchar(255) NOT NULL,
  `year` year NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `results` enum('publish','nopublish') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'nopublish',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `en_organizer`, `fr_organizer`, `ar_organizer`, `year`, `start_date`, `end_date`, `results`, `status`) VALUES
(15, 'SupNum', 'SupNum', 'SupNum', '2025', '2025-10-24', '2025-10-30', 'nopublish', 1),
(17, 'dfghjk', 'dtgyj', 'dfghj', '2025', '2025-12-20', '2026-12-30', 'nopublish', 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `fr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `id_election` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `fr_name`, `en_name`, `ar_name`, `status`, `id_election`) VALUES
(17, 'Président', 'President', 'الرئيس', 1, 15),
(18, 'Vice-Président', 'Vice President', 'نائب الرئيس', 1, 15),
(19, 'Secrétaire général', 'General Secretary', 'الكاتب العام', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_id_hmac` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nationality_hmac` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_encrypted` varchar(512) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id_hmac`, `nationality_hmac`, `email_encrypted`, `role`, `password_hash`, `created_at`) VALUES
(1, '6P0tcPVynCO8AMTLWkPn+jqP8wFuaFJUquPPHKICqCM=', 'Mauritanian', '', 'super_admin', '$2y$10$DDPXzcf0fHCM2.bw1rs6ruoBz3Qw0bmmSmWfMvPOEtYXkRqoS3PiC', '2025-10-09 20:11:43'),
(2, 'AcYqkgbFqszGYv7Sx1QfpI/7U9Pc1KFByDCU86gx4x0=', 'Mauritanian', '', 'user', '$2y$10$S01d.vIaX.mp16C4G2MsV.Z/SBb7dcBPbChyga2TiwRCXRx29q92e', '2025-10-09 20:11:44'),
(3, 'F7nxTRhdnCmbxlw1SVh0mFEvMrmBZ8WVYHMUTwAXQl0=', 'Mauritanian', '', 'user', NULL, '2025-10-09 20:11:44'),
(4, '7Ta5LD9Y8NPlE2/z+kOQzR7JYQX7AiwZ5yi8zSf+nYA=', 'Mauritanian', '', 'super_admin', '$2y$10$9WXiTQx9DFjL78OqNW.sN.lYcuwVy4Ab8eJ/GAl9Ps3zD.fhxyyDa', '2025-10-09 20:11:44'),
(5, '2nQiqlJzFg5VBPKwHXbuTc+RlRSnoZ0hyHg684OlZl0=', 'Mauritanian', '', 'admin', '$2y$10$k6DrfbhOHbLyToqY2Isbs.ccqlQzo1wA9h704xy0XUAUVRj82ELXa', '2025-10-09 20:11:44'),
(6, 'dr6jw2UmHLK2mcPYZoM6P6+jVIX97D3SXz3q2Oli2UQ=', 'Mauritanian', '', 'user', '$2y$10$LEdyu.TmIdu72zW6g0msHelQpItyi/sAg8NNM8mph6eyJJRxXnrEK', '2025-10-09 20:11:44'),
(7, 'vko0rlEooCTEMzE1AykWTRLzI1IWKXW6+LRqojM1PG8=', 'Mauritanian', '', 'user', NULL, '2025-10-09 20:11:44'),
(8, 'erFjToDlo6CBDjwpnPlMohrDByip5E4e53FBIHpmSCA=', 'Mauritanian', '', 'user', NULL, '2025-10-09 20:11:44'),
(9, 'AwZe0UZp/3yHdpd9Dthb/n8xxUA3hc9AgKlhp56b5LE=', 'Mauritanian', '', 'user', NULL, '2025-10-09 20:11:44'),
(10, 'LND3xaNN/F7+3wftJmjEHP8zB1/7TM0opnqpeuDPCQ8=', 'Mauritanian', '', 'user', NULL, '2025-10-09 20:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `users_election`
--

CREATE TABLE `users_election` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_election` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_position` (`id_position`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Position_Election` (`id_election`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id_hmac`),
  ADD KEY `idx_user_id` (`user_id_hmac`);

--
-- Indexes for table `users_election`
--
ALTER TABLE `users_election`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_election` (`id_election`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_election`
--
ALTER TABLE `users_election`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `position` (`id`);

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `fk_Position_Election` FOREIGN KEY (`id_election`) REFERENCES `election` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_election`
--
ALTER TABLE `users_election`
  ADD CONSTRAINT `users_election_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_election_ibfk_2` FOREIGN KEY (`id_election`) REFERENCES `election` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
