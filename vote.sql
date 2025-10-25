-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2025 at 11:40 PM
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
  `user_id` varchar(50) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `username_arabic` varchar(100) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `place_birth` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `surname_arabic` varchar(255) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sex` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `username_arabic`, `date_birth`, `place_birth`, `surname`, `surname_arabic`, `nationality`, `role`, `password_hash`, `created_at`, `updated_at`, `sex`) VALUES
(1, '1000000001', 'Kaber Sidi', 'كابر سيدي', '1999-05-12', 'Nouakchott', 'Sidi', 'سيدي', 'Mauritanian', 'super_admin', '$2y$10$DDPXzcf0fHCM2.bw1rs6ruoBz3Qw0bmmSmWfMvPOEtYXkRqoS3PiC', '2025-10-09 20:11:43', '2025-10-25 22:10:08', 'Male'),
(2, '1000000002', 'Ayman Sidi', 'أيمن محمد', '2004-02-10', 'Nouakchott', 'Mohamed', 'محمد', 'Mauritanian', 'user', '$2y$10$S01d.vIaX.mp16C4G2MsV.Z/SBb7dcBPbChyga2TiwRCXRx29q92e', '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(3, '1000000003', 'Sara Elhassan', 'سارة الحسن', '2003-11-21', 'Atar', 'Elhassan', 'الحسن', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(4, '1000000004', 'Mohamed Ali', 'محمد علي', '2002-08-15', 'Rosso', 'Ali', 'علي', 'Mauritanian', 'super_admin', '$2y$10$9WXiTQx9DFjL78OqNW.sN.lYcuwVy4Ab8eJ/GAl9Ps3zD.fhxyyDa', '2025-10-09 20:11:44', '2025-10-25 22:40:06', 'Male'),
(5, '1000000005', 'Fatima Zahra', 'فاطمة الزهراء', '2001-12-03', 'Kaédi', 'Zahra', 'الزهراء', 'Mauritanian', 'admin', '$2y$10$k6DrfbhOHbLyToqY2Isbs.ccqlQzo1wA9h704xy0XUAUVRj82ELXa', '2025-10-09 20:11:44', '2025-10-25 22:55:42', 'Female'),
(6, '1000000006', 'Ali Ould Ahmed', 'علي ولد أحمد', '2003-04-07', 'Nouadhibou', 'Ould Ahmed', 'ولد أحمد', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(7, '1000000007', 'Khadija Mint Saleh', 'خديجة منت صالح', '2004-07-18', 'Tidjikja', 'Mint Saleh', 'منت صالح', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(8, '1000000008', 'Youssef Ben Omar', 'يوسف بن عمر', '2002-09-25', 'Boutilimit', 'Ben Omar', 'بن عمر', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(9, '1000000009', 'Amina Mahmoud', 'أمينة محمود', '2003-03-19', 'Nouakchott', 'Mahmoud', 'محمود', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(10, '1000000010', 'Omar Elhadj', 'عمر الحاج', '2001-10-05', 'Zouerate', 'Elhadj', 'الحاج', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(11, '1000000011', 'Mouna Abdallah', 'منى عبد الله', '2004-06-14', 'Aleg', 'Abdallah', 'عبد الله', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(12, '1000000012', 'Hassan Diallo', 'حسن ديالو', '2002-11-08', 'Kaédi', 'Diallo', 'ديالو', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(13, '1000000013', 'Salma Oumar', 'سلمى عمر', '2003-01-27', 'Nouakchott', 'Oumar', 'عمر', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(14, '1000000014', 'Rachid Lemine', 'رشيد لمين', '2002-03-16', 'Rosso', 'Lemine', 'لمين', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(15, '1000000015', 'Noura Hamza', 'نورة حمزة', '2003-09-09', 'Nouadhibou', 'Hamza', 'حمزة', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Female'),
(16, '1000000016', 'Adil Bamba', 'عادل بامبا', '2001-05-28', 'Kaédi', 'Bamba', 'بامبا', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Male'),
(17, '1000000017', 'Laila Sidi', 'ليلى سيدي', '2004-04-22', 'Nouakchott', 'Sidi', 'سيدي', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Female'),
(18, '1000000018', 'Ismail Sow', 'إسماعيل سو', '2003-10-12', 'Kaédi', 'Sow', 'سو', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Male'),
(19, '1000000019', 'Hana Abdou', 'هنا عبدو', '2002-12-19', 'Aleg', 'Abdou', 'عبدو', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Female'),
(20, '1000000020', 'Zakaria Kane', 'زكريا كان', '2001-11-01', 'Nouakchott', 'Kane', 'كان', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:45', '2025-10-18 18:41:04', 'Male');

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
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `idx_user_id` (`user_id`);

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
