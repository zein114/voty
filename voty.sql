-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 19 oct. 2025 à 01:26
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vote`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `photo_path` varchar(512) DEFAULT NULL,
  `fr_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `en_description` text NOT NULL,
  `ar_description` text NOT NULL,
  `Supporting_party` varchar(255) NOT NULL,
  `path_supporting_party_logo` varchar(520) NOT NULL,
  `id_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `ar_name`, `photo_path`, `fr_description`, `en_description`, `ar_description`, `Supporting_party`, `path_supporting_party_logo`, `id_position`) VALUES
(1, 'Zein el abidine', 'زين العابدين', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UNEM', 'assets/images/candidates/unem.jpg', 1),
(2, 'Ayman Sidi', 'أيمن محمد', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UGEM', 'assets/images/candidates/ugem.jpg', 2),
(3, 'Sara Elhassan', 'سارة الحسن', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UNEM', 'assets/images/candidates/unem.jpg', 3),
(4, 'Mohamed Ali', 'محمد علي', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'SNEM', 'assets/images/candidates/snem.jpg', 4),
(5, 'Fatima Zahra', 'فاطمة الزهراء', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UNEM', 'assets/images/candidates/unem.jpg', 6),
(6, 'Khadija Mint Saleh', 'خديجة منت صالح', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UNEM', 'assets/images/candidates/unem.jpg', 6),
(7, 'Ali Ould Ahmed', 'علي ولد أحمد', 'assets/images/candidates/ZeinElAbidine.jpg', 'Un étudiant en deuxième année de programmation développe ses compétences en codage, apprend des langages comme Python ou Java, comprend les algorithmes et les structures de données, et travaille sur des projets collaboratifs tout en construisant une base solide pour le développement logiciel avancé.', 'A second-year programming student is developing strong coding skills, learning languages like Python or Java, understanding algorithms and data structures, and working on collaborative projects while building a foundation for advanced software development.', '\r\nطالب في السنة الثانية في قسم البرمجة يطوّر مهارات البرمجة، ويتعلم لغات مثل بايثون أو جافا، ويفهم الخوارزميات وهياكل البيانات، ويشارك في مشاريع جماعية لبناء أساس متين لتطوير البرمجيات المتقدم.', 'UGEM', 'assets/images/candidates/ugem.jpg', 7);

-- --------------------------------------------------------

--
-- Structure de la table `election`
--

CREATE TABLE `election` (
  `id` int NOT NULL,
  `year` year NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `election`
--

INSERT INTO `election` (`id`, `year`, `start_date`, `end_date`) VALUES
(1, '2025', '2025-10-18', '2025-10-24');

-- --------------------------------------------------------

--
-- Structure de la table `position`
--

CREATE TABLE `position` (
  `id` int NOT NULL,
  `fr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_Election` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `position`
--

INSERT INTO `position` (`id`, `fr_name`, `en_name`, `ar_name`, `status`, `id_Election`) VALUES
(1, 'Président', 'President', 'الرئيس', 1, 1),
(2, 'Vice-Président', 'Vice President', 'نائب الرئيس', 1, 1),
(3, 'Secrétaire général', 'General Secretary', 'الكاتب العام', 1, 1),
(4, 'Trésorier', 'Treasurer', 'أمين المالية', 1, 1),
(5, 'Chef de la Commission Académique', 'Head of Academic Committee', 'رئيس لجنة الشؤون الأكاديمية', 1, 1),
(6, 'Chef de la Commission Culturelle et Médiatique', 'Head of Cultural and Media Committee', 'رئيس لجنة الأنشطة الثقافية والإعلامية', 1, 1),
(7, 'Chef de la Commission Sportive', 'Head of Sports Committee', 'رئيس لجنة الأنشطة الرياضية', 1, 1),
(8, 'Chef de la Commission Sociale', 'Head of Social Services Committee', 'رئيس لجنة الخدمات الاجتماعية', 1, 1),
(9, 'Chef de la Commission des Relations Extérieures', 'Head of External Relations Committee', 'رئيس لجنة العلاقات الخارجية', 1, 1),
(10, 'Chef de la Commission de l’Organisation et Discipline', 'Head of Organization and Discipline Committee', 'رئيس لجنة التنظيم أو الانضباط', 1, 1),
(11, 'Délégué de Département', 'Department Representative', 'مندوب القسم أو الشعبة', 1, 1),
(12, 'Délégué de Faculté / Institut', 'Faculty / Institute Representative', 'مندوب الكلية أو المعهد', 1, 1),
(13, 'Membre du Bureau Exécutif National', 'National Executive Board Member', 'أعضاء المكتب التنفيذي للاتحاد الوطني أو العام', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `username_arabic`, `date_birth`, `place_birth`, `surname`, `surname_arabic`, `nationality`, `role`, `password_hash`, `created_at`, `updated_at`, `sex`) VALUES
(1, '1000000001', 'Kaber Sidi', 'كابر سيدي', '1999-05-12', 'Nouakchott', 'Sidi', 'سيدي', 'Mauritanian', 'admin', '$2y$10$DDPXzcf0fHCM2.bw1rs6ruoBz3Qw0bmmSmWfMvPOEtYXkRqoS3PiC', '2025-10-09 20:11:43', '2025-10-18 18:41:03', 'Male'),
(2, '1000000002', 'Ayman Sidi', 'أيمن محمد', '2004-02-10', 'Nouakchott', 'Mohamed', 'محمد', 'Mauritanian', 'user', '$2y$10$S01d.vIaX.mp16C4G2MsV.Z/SBb7dcBPbChyga2TiwRCXRx29q92e', '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Male'),
(3, '1000000003', 'Sara Elhassan', 'سارة الحسن', '2003-11-21', 'Atar', 'Elhassan', 'الحسن', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
(4, '1000000004', 'Mohamed Ali', 'محمد علي', '2002-08-15', 'Rosso', 'Ali', 'علي', 'Mauritanian', 'admin', '$2y$10$m.9nSfmICbsDwAglcHfE9OQZly0fl5.K0H9lSCyuIn0Dz3Tkes/sa', '2025-10-09 20:11:44', '2025-10-18 21:12:23', 'Male'),
(5, '1000000005', 'Fatima Zahra', 'فاطمة الزهراء', '2001-12-03', 'Kaédi', 'Zahra', 'الزهراء', 'Mauritanian', 'user', NULL, '2025-10-09 20:11:44', '2025-10-18 18:41:04', 'Female'),
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

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_position` (`id_position`);

--
-- Index pour la table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Position_Election` (`id_Election`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `election`
--
ALTER TABLE `election`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `position` (`id`);

--
-- Contraintes pour la table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `fk_Position_Election` FOREIGN KEY (`id_Election`) REFERENCES `election` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
