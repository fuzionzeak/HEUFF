-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour ligue1
CREATE DATABASE IF NOT EXISTS `ligue1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ligue1`;

-- Listage de la structure de table ligue1. club
CREATE TABLE IF NOT EXISTS `club` (
  `ID_CLUB` int NOT NULL AUTO_INCREMENT,
  `NOM_CLUB` varchar(128) NOT NULL,
  `LIGUE_CLUB` char(2) NOT NULL,
  PRIMARY KEY (`ID_CLUB`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ligue1.club : ~20 rows (environ)
INSERT INTO `club` (`ID_CLUB`, `NOM_CLUB`, `LIGUE_CLUB`) VALUES
	(1, 'Paris-SG', 'L1'),
	(2, 'Lens', 'L1'),
	(3, 'Lorient', 'L1'),
	(4, 'Rennes', 'L1'),
	(5, 'Marseille', 'L1'),
	(6, 'Lille', 'L1'),
	(7, 'Monaco', 'L1'),
	(8, 'Lyon', 'L1'),
	(9, 'Clermont', 'L1'),
	(10, 'Toulouse', 'L1'),
	(11, 'Troyes', 'L1'),
	(12, 'Nice', 'L1'),
	(13, 'Montpellier', 'L1'),
	(14, 'Reims', 'L1'),
	(15, 'Nantes', 'L1'),
	(16, 'Strasbourg', 'L1'),
	(17, 'Brest', 'L1'),
	(18, 'Auxerre', 'L1'),
	(19, 'AC Ajaccio', 'L1'),
	(20, 'Angers', 'L1');

-- Listage de la structure de table ligue1. commentaires
CREATE TABLE IF NOT EXISTS `commentaires` (
  `ID_COMMENTAIRE` int NOT NULL AUTO_INCREMENT,
  `ID_NEWS` int NOT NULL,
  `ID_UTI` int NOT NULL,
  `CONTENU_COMMENTAIRE` text NOT NULL,
  `DATE_COMMENTAIRE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_COMMENTAIRE`),
  KEY `ID_NEWS` (`ID_NEWS`),
  KEY `ID_UTI` (`ID_UTI`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID_NEWS`) ON DELETE CASCADE,
  CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`ID_UTI`) REFERENCES `utilisateur` (`ID_UTI`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ligue1.commentaires : ~2 rows (environ)
INSERT INTO `commentaires` (`ID_COMMENTAIRE`, `ID_NEWS`, `ID_UTI`, `CONTENU_COMMENTAIRE`, `DATE_COMMENTAIRE`) VALUES
	(1, 4, 13, 'aaaa', '2024-11-19 11:52:29'),
	(2, 4, 13, 'ehoooo', '2024-11-19 11:52:36'),
	(3, 4, 13, 'aaaaa', '2024-11-19 11:53:01'),
	(4, 5, 13, 'je suis d\'accords', '2024-11-19 11:59:01'),
	(5, 6, 13, 'salut je l\'ai', '2024-11-19 12:00:28'),
	(6, 2, 13, 'réel', '2024-11-19 12:01:46'),
	(7, 7, 13, 'yo', '2024-11-19 12:28:31');

-- Listage de la structure de table ligue1. news
CREATE TABLE IF NOT EXISTS `news` (
  `ID_NEWS` int NOT NULL AUTO_INCREMENT,
  `ID_CLUB` int NOT NULL,
  `ARTICLE_NEWS` varchar(255) DEFAULT NULL,
  `DATE_NEWS` datetime DEFAULT CURRENT_TIMESTAMP,
  `TITRE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_NEWS`),
  KEY `ID_CLUB` (`ID_CLUB`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`ID_CLUB`) REFERENCES `club` (`ID_CLUB`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ligue1.news : ~6 rows (environ)
INSERT INTO `news` (`ID_NEWS`, `ID_CLUB`, `ARTICLE_NEWS`, `DATE_NEWS`, `TITRE`) VALUES
	(2, 1, 'Ce soir mbappe n\'as pas le role d\'un vrai numéro 10 il n\'as pas fait tout ce qu\'on attendais de lui son postionnement etait nul et il marchait continuellement.', '2024-11-07 15:10:45', 'Affaire MBAPPE'),
	(3, 3, 'AZEEA', '2024-11-19 11:06:06', 'Affaire MBAPPE'),
	(4, 5, 'bonsoir', '2024-11-19 11:06:19', 'Affaire MBAPPE2'),
	(5, 2, 'aaa AIDAIODNAOIDNOIAZ', '2024-11-19 11:58:52', 'je ne sais pas 1'),
	(6, 2, 'je recherche wilfried', '2024-11-19 12:00:18', 'hello'),
	(7, 1, 'le foot pour les nuls', '2024-11-19 12:00:49', 'bonsoir je suis nul au foot');

-- Listage de la structure de table ligue1. s_abonner
CREATE TABLE IF NOT EXISTS `s_abonner` (
  `ID_UTI` int NOT NULL,
  `ID_CLUB` int NOT NULL,
  PRIMARY KEY (`ID_UTI`,`ID_CLUB`),
  KEY `ID_CLUB` (`ID_CLUB`),
  CONSTRAINT `s_abonner_ibfk_1` FOREIGN KEY (`ID_UTI`) REFERENCES `utilisateur` (`ID_UTI`) ON DELETE CASCADE,
  CONSTRAINT `s_abonner_ibfk_2` FOREIGN KEY (`ID_CLUB`) REFERENCES `club` (`ID_CLUB`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ligue1.s_abonner : ~0 rows (environ)

-- Listage de la structure de table ligue1. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_UTI` int NOT NULL AUTO_INCREMENT,
  `ID_CLUB` int NOT NULL,
  `NOM_UTI` varchar(30) NOT NULL,
  `PRENOM_UTI` varchar(30) NOT NULL,
  `SEXE_UTI` varchar(15) NOT NULL,
  `PASSWORD_UTI` varchar(64) NOT NULL,
  `DATE_INSCRIPTION` date DEFAULT NULL,
  `IMAGE_UTI` text,
  `MAIL_UTI` varchar(255) NOT NULL,
  `derniere_connexion` datetime DEFAULT NULL,
  `statut` enum('actif','inactif') DEFAULT 'actif',
  PRIMARY KEY (`ID_UTI`),
  UNIQUE KEY `MAIL_UTI` (`MAIL_UTI`),
  KEY `ID_CLUB` (`ID_CLUB`),
  CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_CLUB`) REFERENCES `club` (`ID_CLUB`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ligue1.utilisateur : ~7 rows (environ)
INSERT INTO `utilisateur` (`ID_UTI`, `ID_CLUB`, `NOM_UTI`, `PRENOM_UTI`, `SEXE_UTI`, `PASSWORD_UTI`, `DATE_INSCRIPTION`, `IMAGE_UTI`, `MAIL_UTI`, `derniere_connexion`, `statut`) VALUES
	(5, 15, 'HEUFF', 'Anthony', 'Homme', '$2y$10$cCmVk93mcc1S6EOfJKeBe.yBQmBCDVv3TEybwT2GprrOuDbUrZHZm', '2024-10-10', '', 'anthonyhaaeuff@gmail.com', NULL, 'actif'),
	(6, 3, 'HEUFF', 'Anthony', 'Homme', '$2y$10$5mcbQG4hZPIz6CdzOCXKl.6u63KJNyhFeYj3PteAi.YBYEgUwrwOa', '2024-10-10', '', 'anthozzznyheuff@gmail.com', NULL, 'actif'),
	(7, 4, 'AAA', 'AAA', 'Homme', '$2y$10$jKG8HVFa4z8nEXJxnaOS3OHubTRP7nGGRdXOUwlzFrZEn14gN4Yhq', '2024-10-10', '', 'A@gmal.com', NULL, 'actif'),
	(8, 17, 'HEUFF', 'Anthony', 'Homme', '$2y$10$qnpD2VrUgw4mgCcTG5VzRey8lwBVcLbOTkdhObHpwgM1PU5HIB.Tm', '2024-10-15', '', 'anthonyheu@gmail.com', NULL, 'actif'),
	(9, 18, 'HUFF', 'm', 'Homme', '$2y$10$3ykqHmW84.GD.o5DJJXmXOHgm3hxdKFrfb/Rll0MrvSWWE1nR/Rzy', '2024-10-15', '', 'anthonyhedff@gmail.com', NULL, 'actif'),
	(11, 17, 'HEUFF', 'Anthony', 'Homme', '$2y$10$zUFm1.EPQteq/yTi/3jHo.idwDyuMjXlSKj6GuUfbY0bL3TNfuTg6', '2024-10-17', '', 'anthoneuff@gmail.com', '2024-10-17 08:44:23', 'actif'),
	(13, 18, 'Anthony', 'Anthony', 'Homme', '$2y$10$u/ieaYC1bGV/MOkmUhdtoe1damykcRDAPDwSy8IoMolGzaPBV5FGm', '2024-11-05', '', 'anthonyheuff@gmail.com', '2024-11-19 12:10:51', 'actif');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
