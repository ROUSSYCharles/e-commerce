-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 avr. 2024 à 15:49
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
-- Base de données : `lmv`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_clt` varchar(50) NOT NULL,
  `prenom_clt` varchar(50) DEFAULT NULL,
  `mail_clt` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `cp` int DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `pts_fidelite` int DEFAULT NULL,
  `mdp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_clt` (`mail_clt`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom_clt`, `prenom_clt`, `mail_clt`, `adresse`, `cp`, `ville`, `pts_fidelite`, `mdp`) VALUES
(12, 'ROUSSY', 'Charles', 'roussy.charles21@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$K8aXckUkt1q/CNfnxXwwkeeqsV7pS.dmtro5X.qtAt9f4xChnvseC');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `numero_com` int NOT NULL AUTO_INCREMENT,
  `id_clt` int DEFAULT NULL,
  `date_commande` date DEFAULT NULL,
  `total_ht` decimal(15,2) DEFAULT NULL,
  `total_tva` decimal(15,2) DEFAULT NULL,
  `etat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`numero_com`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

DROP TABLE IF EXISTS `motifs`;
CREATE TABLE IF NOT EXISTS `motifs` (
  `id_mtf` int NOT NULL AUTO_INCREMENT,
  `nom_mtf` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `catalogue` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_mtf`),
  UNIQUE KEY `nom_mtf` (`nom_mtf`),
  UNIQUE KEY `image` (`image`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `motifs`
--

INSERT INTO `motifs` (`id_mtf`, `nom_mtf`, `image`, `catalogue`) VALUES
(1, 'Punk à Chat', 'mot1_punkachat.jfif', 1),
(2, 'Voiture', 'mot2_voiture.jfif', 1),
(3, 'CraneVache', 'mot3_cranevache.png', 1),
(4, 'poseurEncre', 'mot4_poseurEncre.jpg', 1),
(5, 'Golden Pub', 'mot5_goldenpub.jfif', 1),
(6, 'MadeInFr', 'mot6_madeinFr.jfif', 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `numero_com` int NOT NULL AUTO_INCREMENT,
  `id_pdt` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`numero_com`,`id_pdt`),
  KEY `id_pdt` (`id_pdt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_pdt` int NOT NULL AUTO_INCREMENT,
  `nom_pdt` varchar(50) DEFAULT NULL,
  `genre` varchar(1) DEFAULT NULL,
  `id_taille` varchar(3) DEFAULT NULL,
  `id_motif` int DEFAULT NULL,
  `id_type` int DEFAULT NULL,
  `prix_pdt` decimal(15,2) DEFAULT NULL,
  `stock_pdt` int DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pdt`),
  UNIQUE KEY `image` (`image`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_pdt`, `nom_pdt`, `genre`, `id_taille`, `id_motif`, `id_type`, `prix_pdt`, `stock_pdt`, `image`) VALUES
(1, 'Punk à Chat', 'H', '3', 1, 2, '15.00', 6, NULL),
(2, 'Punk à Chat', 'F', '2', 1, 3, '9.00', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `taille_pdt`
--

DROP TABLE IF EXISTS `taille_pdt`;
CREATE TABLE IF NOT EXISTS `taille_pdt` (
  `id_taille` int NOT NULL AUTO_INCREMENT,
  `taille` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_taille`),
  UNIQUE KEY `taille` (`taille`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `taille_pdt`
--

INSERT INTO `taille_pdt` (`id_taille`, `taille`) VALUES
(2, 'S'),
(1, 'XS'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Structure de la table `type_pdt`
--

DROP TABLE IF EXISTS `type_pdt`;
CREATE TABLE IF NOT EXISTS `type_pdt` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `type_pdt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `type` (`type_pdt`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_pdt`
--

INSERT INTO `type_pdt` (`id_type`, `type_pdt`) VALUES
(1, 'Sweat'),
(2, 'Sweat à Capuche'),
(3, 'T-shirt'),
(4, 'T-shirt à manches longues');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
