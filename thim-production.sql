-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 01 juin 2025 à 22:06
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thim-production`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'MEITE', 'Malika', 'sinai.meite@gmail.com', 'Malika2003@');

-- --------------------------------------------------------

--
-- Structure de la table `fiture_event`
--

DROP TABLE IF EXISTS `fiture_event`;
CREATE TABLE IF NOT EXISTS `fiture_event` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `billetrie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fiture_event`
--

INSERT INTO `fiture_event` (`id_event`, `titre`, `flyer`, `description`, `date`, `heure`, `adresse`, `billetrie`) VALUES
(15, 'L\'oiseau rare', '/THIM-PRODUCTION/uploads/image_future_ev/1748725814_df89ee8ad1ad89e4.jpeg', 'L\'oiseau rare sera à paris ce dimanche', '2025-07-06', '20h-22h', 'CASINO DE PARIS , 6 rue de clichy 75009 Paris ', 'https://www.casinodeparis.fr/fr/L-Oiseau-Rare-En-Concert-6-Juillet-2025-Billetterie-Paris');

-- --------------------------------------------------------

--
-- Structure de la table `past_event`
--

DROP TABLE IF EXISTS `past_event`;
CREATE TABLE IF NOT EXISTS `past_event` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `heure` varchar(255) NOT NULL,
  `flyer` varchar(255) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `past_event`
--

INSERT INTO `past_event` (`id_event`, `titre`, `description`, `date`, `adresse`, `heure`, `flyer`) VALUES
(12, 'La Team PAYA', 'La team était à paris', '2024-05-05', 'CASINO DE PARIS , 6 rue de clichy 75009 Paris', '20h-22h', '/THIM-PRODUCTION/uploads/image&video_past_ev/1748725019_01aa0c25dc50f3bc.jpg'),
(11, 'Roseline Layo ', 'Roseline layo était à paris ', '2024-05-04', 'CASINO DE PARIS , 16 rue de clichy 75009 Paris', '20h-22h', '/THIM-PRODUCTION/uploads/image&video_past_ev/1748724894_71de54b5dc0ac50d.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `id_event` int NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_event` (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `id_event`, `chemin`) VALUES
(27, 12, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748725019_fc11fc788848ea5e.jpg'),
(26, 12, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748725019_a7db9f86e327365a.jpg'),
(25, 11, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748724894_2246194fc744e5c5.jpg'),
(22, 10, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748708275_15bac146d2d5272e.jpg'),
(19, 8, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748708092_c180255003630c26.jpg'),
(24, 11, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748724894_aaf50c129b9baef1.jpg'),
(23, 10, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748708275_2d351717a5155cab.jpg'),
(18, 8, '/THIM-PRODUCTION/uploads/image&video_past_ev/1748708092_86888ca763415f0c.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
