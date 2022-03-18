-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 mars 2022 à 08:28
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base1`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(255) NOT NULL,
  `descriptionProduit` text NOT NULL,
  `prixProduit` float NOT NULL,
  `stockProduit` tinyint(1) NOT NULL,
  `dateDepot` datetime NOT NULL,
  `imageProduit` varchar(255) NOT NULL,
  PRIMARY KEY (`idProduit`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `nomProduit`, `descriptionProduit`, `prixProduit`, `stockProduit`, `dateDepot`, `imageProduit`) VALUES
(10, 'PC portable ASUS ZENBOOK OLED EVO UX325', 'Ecran OLED 13,3 Full HD\r\nProcesseur Intel Core i5-1135G7 (2.4 GHz /Turbo Boost jusqu\'à 4.2 GHz)\r\nRAM 16 Go LPDDR4x - 512 Go SSD\r\nWindows 11 - HDMI - Thunderbolt 4 - Wifi 802.11 ax - BT 5.0', 849, 0, '2022-03-08 00:00:00', '../img/pc_asus.png'),
(14, 'Casque PC THRUSTMASTER Y-250X POUR XBOX 360', 'Casque gamer filaire\r\nContrôleur multifonctions\r\nMicro unidirectionnel et détachable\r\nCompatible Xbox 360', 80.99, 0, '2022-03-09 00:00:00', '../img/casque2.png'),
(2, 'Clavier CORSAIR CLAVIER MÉCANIQUE', 'Switchs mécaniques 100 % CHERRY VIOLA\r\nRétroéclairage RGB par touche dynamique\r\nChâssis en aluminium anodisé\r\n', 78.99, 1, '2022-03-14 08:53:30', '../img/clavier.jpg.jpg'),
(1, 'Tapis de souris RAZER RZ02-01910100-R3M1', 'Tapis de souris gamer\r\ntapis de haute qualité Illumination dynamique RVB éclatante à 2 zones\r\nConfiguration facile et intuitive des notifications lumineuses de jeu\r\nTissu micro-tissé QcK pour un contrôle maximal', 33.99, 0, '2022-03-10 00:00:00', '../img/tapis1.png'),
(12, 'Clavier RAZER HUNTSMAN V2 TKL RED SWITCH', 'Touches PBT à double injection pour une finition texturée et robuste\r\nMousse d’atténuation du son pour améliorer l’acoustique du clavier\r\nRepose-poignet ergonomique pour un confort de jeu accru', 129, 0, '2022-03-04 00:00:00', '../img/clavier.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
