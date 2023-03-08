-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 01 mars 2023 à 17:56
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
-- Base de données : `projet_sfprint`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE IF NOT EXISTS `avoir` (
  `av_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `av_product` int UNSIGNED NOT NULL,
  `av_category` int UNSIGNED NOT NULL,
  PRIMARY KEY (`av_id`),
  KEY `fk_av_cat` (`av_category`),
  KEY `fk_p_id` (`av_product`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `avoir`
--

INSERT INTO `avoir` (`av_id`, `av_product`, `av_category`) VALUES
(13, 13, 1),
(14, 14, 2),
(15, 15, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` char(255) NOT NULL,
  `cat_validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_name`, `cat_validate`) VALUES
(1, 'Halloween', 0),
(2, 'Fantaisie', 0),
(3, 'Manga', 0),
(4, 'Animaux', 0),
(5, '18+', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `cmd_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cmd_date` datetime NOT NULL,
  `cmd_total` decimal(7,2) NOT NULL,
  `cmd_shipping` decimal(7,2) NOT NULL,
  `cmd_exp` datetime NOT NULL,
  `cmd_account` int UNSIGNED NOT NULL,
  PRIMARY KEY (`cmd_id`),
  KEY `fk_cmd_cp_id` (`cmd_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `com_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `com_comment` text,
  `com_value` int NOT NULL,
  `com_createdate` datetime NOT NULL,
  `com_account` int UNSIGNED NOT NULL,
  `com_product` int UNSIGNED NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `fk_com_cp_id` (`com_account`),
  KEY `fk_com_p_id` (`com_product`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`com_id`, `com_comment`, `com_value`, `com_createdate`, `com_account`, `com_product`) VALUES
(5, 'Ce stickers est trop bien', 5, '2023-03-01 11:37:25', 7, 13),
(7, 'Mon requin est comme le peuple, il est gentil', 5, '2023-03-01 12:20:47', 8, 15);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `cp_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cp_pseudo` char(255) NOT NULL,
  `cp_password` char(255) NOT NULL,
  `cp_name` char(255) NOT NULL,
  `cp_firstName` char(255) NOT NULL,
  `cp_phone` char(10) NOT NULL,
  `cp_mail` char(255) NOT NULL,
  `cp_numero` int UNSIGNED DEFAULT NULL,
  `cp_adress` varchar(255) DEFAULT NULL,
  `cp_lastCo` datetime DEFAULT NULL,
  `cp_ip` varchar(40) DEFAULT NULL,
  `cp_city` int UNSIGNED DEFAULT NULL COMMENT 'Clé étrangère',
  `cp_type` int UNSIGNED DEFAULT '4' COMMENT 'Clé étrangère',
  PRIMARY KEY (`cp_id`),
  KEY `habiter` (`cp_city`),
  KEY `type` (`cp_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`cp_id`, `cp_pseudo`, `cp_password`, `cp_name`, `cp_firstName`, `cp_phone`, `cp_mail`, `cp_numero`, `cp_adress`, `cp_lastCo`, `cp_ip`, `cp_city`, `cp_type`) VALUES
(7, 'Marc', '$2y$10$OMeqgYXmq.DX95RMVA5eYuAme8HVl6xtxtsOrVa0wpkNNzbwWWzLy', 'RENOULT', 'Marc', '0606060606', 'marc.renoult@gmail.com', 55, 'Rue du vide', NULL, NULL, NULL, 1),
(8, 'Dorian', '$2y$10$qANNuVMlYutD2TltUI5zMuVDf1/ziIC3iysIRtZTHtHeRpDZLwwfu', 'COTTERET', 'Dorian', '0606060606', 'dorian.cotteret@gmail.com', 55, 'rue du Genou', NULL, NULL, NULL, 2),
(9, 'Quentin', '$2y$10$LPZT18AG8Y/IbwWUzfQuf.SK8B.95VTLFIFcANJrLmvbRTehhtCv.', 'SERPETTE', 'Quentin', '0606060606', 'quentin.serpette@laposte.net', 14, 'rue de Février', NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `cont_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cont_quantity` int UNSIGNED NOT NULL,
  `cont_order` int UNSIGNED NOT NULL,
  `cont_product` int UNSIGNED NOT NULL,
  PRIMARY KEY (`cont_id`),
  KEY `fk_cont_cmd_id` (`cont_order`),
  KEY `fk_cont_p_id` (`cont_product`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `figurine`
--

DROP TABLE IF EXISTS `figurine`;
CREATE TABLE IF NOT EXISTS `figurine` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `f_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_firstName` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_phone` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_mail` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_numAddress` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_street` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_postCode` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_town` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_files` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_number` int NOT NULL,
  `f_message` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `f_archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `figurine`
--

INSERT INTO `figurine` (`f_id`, `f_name`, `f_firstName`, `f_phone`, `f_mail`, `f_numAddress`, `f_street`, `f_postCode`, `f_town`, `f_files`, `f_number`, `f_message`, `f_archive`) VALUES
(1, 'Charles', 'BERTHOME', '0606060606', 'charles.ragondin@moumoute.fr', '3', 'Rue de la perruque', '67000', 'STRASBOURG', '20230301122455.jpg', 9, 'je n&#39;ai pas de jpg de ragondin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `his_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `his_newModif` char(255) NOT NULL,
  `his_oldValue` char(255) NOT NULL,
  `his_users` char(255) NOT NULL,
  `his_dateHour` datetime NOT NULL,
  `his_table` char(255) NOT NULL,
  `his_champId` int UNSIGNED NOT NULL,
  `his_champ` char(255) NOT NULL,
  PRIMARY KEY (`his_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `ph_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ph_name` char(255) NOT NULL,
  `ph_description` char(255) NOT NULL,
  `ph_default` tinyint(1) NOT NULL DEFAULT '1',
  `ph_product` int UNSIGNED NOT NULL,
  PRIMARY KEY (`ph_id`),
  KEY `fk_ph_p_id` (`ph_product`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`ph_id`, `ph_name`, `ph_description`, `ph_default`, `ph_product`) VALUES
(19, '20230301102634.jpg', '', 1, 13),
(20, '20230301103653.jpg', '', 0, 13),
(21, '20230301103852.jpg', '', 1, 14),
(23, '20230301112023.jpg', '', 1, 15),
(24, '20230301112108.jpg', '', 0, 15),
(25, '20230301112124.jpg', '', 0, 15),
(26, '20230301112137.jpg', '', 0, 15),
(27, '20230301112145.jpg', '', 0, 15),
(28, '20230301112151.jpg', '', 0, 15),
(29, '20230301112200.jpg', '', 0, 15),
(30, '20230301112208.jpg', '', 0, 15),
(31, '20230301112215.jpg', '', 0, 15),
(34, '20230301112237.jpg', '', 0, 15),
(35, '20230301112244.jpg', '', 0, 15),
(36, '20230301112300.jpg', '', 0, 15),
(37, '20230301112308.jpg', '', 0, 15),
(38, '20230301112315.jpg', '', 0, 15),
(39, '20230301112323.jpg', '', 0, 15),
(40, '20230301122655.jpg', '', 0, 15),
(41, '20230301122715.jpg', '', 0, 15),
(42, '20230301122734.jpg', '', 0, 15),
(47, '20230301143201.jpg', '', 0, 14);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `p_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `p_name` char(255) NOT NULL,
  `p_price` decimal(7,2) NOT NULL,
  `p_description` text NOT NULL,
  `p_account` int UNSIGNED NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `fk_p_cp_id` (`p_account`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`p_id`, `p_name`, `p_price`, `p_description`, `p_account`) VALUES
(13, 'Araignée Mignonne', '1.00', 'Araignée mignonne', 7),
(14, 'Dragon Plante', '1.00', 'Dragon Plante', 9),
(15, 'Requin', '1.00', 'Un requin gentil', 8);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `ty_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ty_name` char(5) NOT NULL,
  PRIMARY KEY (`ty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`ty_id`, `ty_name`) VALUES
(1, 'Admin'),
(2, 'Mod'),
(3, 'Creat'),
(4, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `v_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `v_cp` int NOT NULL,
  `v_name` char(255) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`v_id`, `v_cp`, `v_name`) VALUES
(1, 68000, 'Colmar'),
(2, 67000, 'Strasbourg'),
(3, 67230, 'Benfeld');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `fk_av_cat` FOREIGN KEY (`av_category`) REFERENCES `categorie` (`cat_id`),
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`av_product`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_cmd_cp_id` FOREIGN KEY (`cmd_account`) REFERENCES `compte` (`cp_id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_com_cp_id` FOREIGN KEY (`com_account`) REFERENCES `compte` (`cp_id`),
  ADD CONSTRAINT `fk_com_p_id` FOREIGN KEY (`com_product`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `habiter` FOREIGN KEY (`cp_city`) REFERENCES `ville` (`v_id`),
  ADD CONSTRAINT `type` FOREIGN KEY (`cp_type`) REFERENCES `type` (`ty_id`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `fk_cont_cmd_id` FOREIGN KEY (`cont_order`) REFERENCES `commande` (`cmd_id`),
  ADD CONSTRAINT `fk_cont_p_id` FOREIGN KEY (`cont_product`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_ph_p_id` FOREIGN KEY (`ph_product`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_p_cp_id` FOREIGN KEY (`p_account`) REFERENCES `compte` (`cp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
