-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 10 Juin 2015 à 14:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `website`
--
CREATE DATABASE IF NOT EXISTS `website` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `website`;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `auteur`
--

INSERT INTO `auteur` (`id`, `pseudo`, `mail`) VALUES
(1, 'Darkwao', 'darkwao@website.fr'),
(2, 'elfsifyra', 'elfsifyra@website.fr');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_topic_id` int(11) NOT NULL,
  `fk_auteur_id` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_publication` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF02D7D63E3` (`fk_topic_id`),
  KEY `IDX_5BC96BF01E2B876` (`fk_auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `fk_topic_id`, `fk_auteur_id`, `contenu`, `date_publication`) VALUES
(1, 1, 1, 'Allez venez quoi ! Bougez vous !', '2015-05-08 09:00:00'),
(2, 1, 2, 'Darkwao à raison faut se motiver sinon on va couler !', '2015-05-08 15:27:12'),
(3, 2, 2, 'Allez faites moi des calins :D', '2015-05-08 12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `forum`
--

INSERT INTO `forum` (`id`, `titre`) VALUES
(1, 'Général'),
(2, 'McM');

-- --------------------------------------------------------

--
-- Structure de la table `subforum`
--

CREATE TABLE IF NOT EXISTS `subforum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_forum_id` int(11) DEFAULT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C72F1C451BE4F90E` (`fk_forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `subforum`
--

INSERT INTO `subforum` (`id`, `fk_forum_id`, `titre`, `description`) VALUES
(1, 2, 'Homemap', 'Notre map qui faut tenir !'),
(2, 2, 'CBE', 'Map à PU, y''en de partout !!'),
(3, 1, 'Taverne public', ''),
(4, 1, 'Taverne de guilde', '');

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_auteur_id` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `fk_subForum_id` int(11) DEFAULT NULL,
  `date_last_reply` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5C81F11FB2DCC93B` (`fk_subForum_id`),
  KEY `IDX_5C81F11F1E2B876` (`fk_auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `topic`
--

INSERT INTO `topic` (`id`, `fk_auteur_id`, `titre`, `date_creation`, `fk_subForum_id`, `date_last_reply`) VALUES
(1, 1, 'Faudrait se bouger le cul !', '2015-05-08 09:00:00', 1, '2015-05-08 15:09:12'),
(2, 2, 'Venez faire des calins avec moi !', '2015-05-08 12:00:00', 1, '2015-05-08 10:00:00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_5BC96BF01E2B876` FOREIGN KEY (`fk_auteur_id`) REFERENCES `auteur` (`id`),
  ADD CONSTRAINT `FK_5BC96BF02D7D63E3` FOREIGN KEY (`fk_topic_id`) REFERENCES `topic` (`id`);

--
-- Contraintes pour la table `subforum`
--
ALTER TABLE `subforum`
  ADD CONSTRAINT `FK_C72F1C451BE4F90E` FOREIGN KEY (`fk_forum_id`) REFERENCES `forum` (`id`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_5C81F11F1E2B876` FOREIGN KEY (`fk_auteur_id`) REFERENCES `auteur` (`id`),
  ADD CONSTRAINT `FK_5C81F11FB2DCC93B` FOREIGN KEY (`fk_subForum_id`) REFERENCES `subforum` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
