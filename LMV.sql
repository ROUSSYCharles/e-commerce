-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 fév. 2024 à 20:47
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
  `prenom_clt` varchar(50) NOT NULL,
  `mail_clt` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pts_fidelite` int DEFAULT NULL,
  `mdp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_clt` (`mail_clt`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `numero_com` int NOT NULL AUTO_INCREMENT,
  `id_clt` int NOT NULL,
  `date_commande` date NOT NULL,
  `id_liste_pdt` int DEFAULT NULL,
  `total_ht` decimal(15,2) NOT NULL,
  `total_tva` decimal(15,2) NOT NULL,
  `etat` tinyint(1) DEFAULT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`numero_com`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `numero_com` int NOT NULL AUTO_INCREMENT,
  `id_pdt` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`numero_com`,`id_pdt`),
  KEY `id_pdt` (`id_pdt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

DROP TABLE IF EXISTS `motifs`;
CREATE TABLE IF NOT EXISTS `motifs` (
  `id_mtf` int NOT NULL AUTO_INCREMENT,
  `nom_mtf` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mtf`),
  UNIQUE KEY `nom_mtf` (`nom_mtf`),
  UNIQUE KEY `image` (`image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_pdt` int NOT NULL AUTO_INCREMENT,
  `nom_pdt` varchar(50) DEFAULT NULL,
  `genre` varchar(1) NOT NULL,
  `id_taille` varchar(3) NOT NULL,
  `id_motif` int NOT NULL,
  `id_type` int DEFAULT NULL,
  `prix_pdt` decimal(15,2) DEFAULT NULL,
  `stock_pdt` int DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `id_taille_1` int NOT NULL,
  `id_type_1` int NOT NULL,
  `id_mtf` int NOT NULL,
  PRIMARY KEY (`id_pdt`),
  UNIQUE KEY `image` (`image`),
  KEY `id_taille_1` (`id_taille_1`),
  KEY `id_type_1` (`id_type_1`),
  KEY `id_mtf` (`id_mtf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taille_pdt`
--

DROP TABLE IF EXISTS `taille_pdt`;
CREATE TABLE IF NOT EXISTS `taille_pdt` (
  `id_taille` int NOT NULL AUTO_INCREMENT,
  `taille` varchar(3) NOT NULL,
  PRIMARY KEY (`id_taille`),
  UNIQUE KEY `taille` (`taille`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_pdt`
--

DROP TABLE IF EXISTS `type_pdt`;
CREATE TABLE IF NOT EXISTS `type_pdt` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
