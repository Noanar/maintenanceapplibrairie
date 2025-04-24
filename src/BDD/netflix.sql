-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 avr. 2025 à 10:01
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `netflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `auteur_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `biographie` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`auteur_id`, `nom`, `prenom`, `biographie`) VALUES
(1, 'George Orwell', NULL, NULL),
(2, 'Antoine de Saint-Exupéry', NULL, NULL),
(3, 'Albert Camus', NULL, NULL),
(4, 'J.K. Rowling', NULL, NULL),
(5, 'J.R.R. Tolkien', NULL, NULL),
(6, 'Victor Hugo', NULL, NULL),
(7, 'Miguel de Cervantes', NULL, NULL),
(8, 'Fiodor Dostoïevski', NULL, NULL),
(9, 'Jane Austen', NULL, NULL),
(10, 'Charlotte Brontë', NULL, NULL),
(11, 'Alexandre Dumas', NULL, NULL),
(12, 'Charles Baudelaire', NULL, NULL),
(13, 'Umberto Eco', NULL, NULL),
(14, 'Aldous Huxley', NULL, NULL),
(15, 'Ray Bradbury', NULL, NULL),
(16, 'Stephen King', NULL, NULL),
(17, 'Bram Stoker', NULL, NULL),
(18, 'Mary Shelley', NULL, NULL),
(19, 'Paulo Coelho', NULL, NULL),
(20, 'Yuval Noah Harari', NULL, NULL),
(21, 'Bernard Werber', NULL, NULL),
(22, 'Joël Dicker', NULL, NULL),
(23, 'Stieg Larsson', NULL, NULL),
(24, 'Jules Verne', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categorie_id`, `nom`, `description`) VALUES
(1, 'Action', 'balasl'),
(2, 'Science-Fiction', 'balasl'),
(3, 'Fantastique', 'balasl'),
(4, 'Policier', 'balasl'),
(5, 'Romance', 'balasl');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(50) NOT NULL,
  `adresse_client` varchar(50) DEFAULT NULL,
  `email_client` varchar(50) NOT NULL,
  `password_client` varchar(255) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `nom_client`, `adresse_client`, `email_client`, `password_client`) VALUES
(4, 'yasser', '', 'client@gmail.com', '$2y$10$n6mJRDPbnq4CzqquCYbxCu4llPlxRKoXG1jKnhlvRulpH1WinQYsu'),
(5, 'yssour03', NULL, 'Yass@fmal.com', '$2y$10$t8kLHNNwRkkSFu5obOX2PuewYwqOq6fCrnmTCpqrB2jGR/xfrEjQi'),
(6, 'yassoura', NULL, 'yass@gmail.com', '$2y$10$XS/nBPQFJiVYhMfUlg1iIunb2y.3OmZ3YOgyx9X9Tkeif.KBaWSEq'),
(7, 'CBE', NULL, 'charles@mail.com', '$2y$10$gMBSRP/Yf4Ek4E.P2F.ioeqDuflx7h00FfCGHGSOVKMvPAzB8jPMm');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `film_id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `realisateur_id` int DEFAULT NULL,
  `categorie` int NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `annee_sortie` int DEFAULT NULL,
  `duree_minutes` int DEFAULT NULL,
  `langue_originale` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`film_id`),
  KEY `fk_film_categorie` (`categorie`),
  KEY `fk_film_realisateur` (`realisateur_id`)
) ;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`film_id`, `titre`, `realisateur_id`, `categorie`, `description`, `annee_sortie`, `duree_minutes`, `langue_originale`, `image_url`) VALUES
(1, '2001: L\'Odyssée de l\'espace', 1, 1, 'Jenny, jeune médecin généraliste, se sent coupable de ne pas avoir ouvert la porte de son cabinet à une jeune fille retrouvée morte peu de temps après. Apprenant par la police que rien ne permet de l’identifier, Jenny n’a plus qu’un seul but : trouve', 1968, 149, 'Anglais', '../img/livre.jpg'),
(7, 'Interstellar', 2, 3, 'Jenny, jeune médecin généraliste, se sent coupable de ne pas avoir ouvert la porte de son cabinet à une jeune fille retrouvée morte peu de temps après. Apprenant par la police que rien ne permet de l’identifier, Jenny n’a plus qu’un seul but : trouve', 2014, 169, NULL, 'https://m.media-amazon.com/images/I/91kFYg4fX3L._AC_SY679_.jpg'),
(39, 'Pulp Fiction', 2, 4, 'Les vies de deux tueurs à gages, d\'un boxeur et d\'un gangster s\'entrecroisent dans une histoire de violence et de rachat.', 1994, 154, 'Anglais', 'https://m.media-amazon.com/images/I/71c05lTE03L._AC_SY679_.jpg'),
(56, 'Pulp Fiction2', 2, 4, 'Histoires entrelacées de criminels à Los Angeles.', 1994, 154, 'Anglais', '../img/Pulp\n.jpg'),
(60, 'Goodfellas', 2, 3, 'L\'histoire de Henry Hill dans la mafia.', 1990, 146, 'Anglais', '../img/Goodfellas\n.jpg'),
(62, 'Se7en', 2, 5, 'Un tueur utilise les sept péchés capitaux comme modus operandi.', 2025, 127, 'Anglais', '../img/Se7en.jpg'),
(63, 'The Green Mile', 2, 1, 'Événements surnaturels sur le couloir de la mort.', 1999, 189, 'Anglais', '../img/green.jpg'),
(64, 'Gladiator', 2, 2, 'Un général romain déchu cherche à se venger.', 2000, 155, 'Anglais', '../img/galdiator.jpg'),
(69, 'Parasite', 2, 2, 'Une famille pauvre s\'infiltre chez une famille riche.', 2019, 132, 'Coréen', 'https://m.media-amazon.com/images/I/71YFxhhSRPL._AC_UF1000,1000_QL80_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `livre_id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `categorie` int NOT NULL,
  `auteur_id` int NOT NULL,
  `date_sortie` date NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `Nb_pages` int NOT NULL,
  PRIMARY KEY (`livre_id`),
  KEY `categorie` (`categorie`,`auteur_id`),
  KEY `fk_livre_auteur` (`auteur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`livre_id`, `titre`, `categorie`, `auteur_id`, `date_sortie`, `image_url`, `Nb_pages`) VALUES
(1, '1984', 1, 1, '1949-06-08', '../img/1984.jpg', 328),
(7, '1984 Version 2', 0, 1, '0000-00-00', 'https://m.media-amazon.com/images/I/71kxa1-0mfL._AC_SY679_.jpg', 328),
(8, 'Le Petit Prince', 0, 2, '0000-00-00', '../img/prince.png', 96),
(9, 'L\'Étranger', 0, 3, '0000-00-00', '../img/ger.jpg', 123),
(10, 'Harry Potter à l\'école des sorciers', 0, 4, '0000-00-00', 'https://m.media-amazon.com/images/I/81iqZ2HHD-L._AC_SY679_.jpg', 309),
(11, 'Le Seigneur des Anneaux', 0, 5, '0000-00-00', '../img/Anneaux.jpg', 1178),
(12, 'Les Misérables', 0, 6, '0000-00-00', '../img/Misérables.jpg', 1232),
(13, 'Don Quichotte', 0, 7, '0000-00-00', '../img/Quichotte.jpg', 863),
(14, 'Crime et Châtiment', 0, 8, '0000-00-00', '../img/Châtiment.jpg', 671),
(28, 'Sapiens', 0, 20, '0000-00-00', 'https://m.media-amazon.com/images/I/713jIoMO3UL._AC_SY679_.jpg', 512);

-- --------------------------------------------------------

--
-- Structure de la table `note_film`
--

DROP TABLE IF EXISTS `note_film`;
CREATE TABLE IF NOT EXISTS `note_film` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `film_id` int NOT NULL,
  `valeur` int NOT NULL,
  `date_note` date NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `unique_note_client_film` (`client_id`,`film_id`),
  KEY `fk_note_film_film` (`film_id`)
) ;

--
-- Déchargement des données de la table `note_film`
--

INSERT INTO `note_film` (`note_id`, `client_id`, `film_id`, `valeur`, `date_note`) VALUES
(8, 4, 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `note_livre`
--

DROP TABLE IF EXISTS `note_livre`;
CREATE TABLE IF NOT EXISTS `note_livre` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `livre_id` int NOT NULL,
  `valeur` int NOT NULL,
  `date_note` date NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `unique_note_client_livre` (`client_id`,`livre_id`),
  KEY `fk_note_livre_livre` (`livre_id`)
) ;

-- --------------------------------------------------------

--
-- Structure de la table `realisateurs`
--

DROP TABLE IF EXISTS `realisateurs`;
CREATE TABLE IF NOT EXISTS `realisateurs` (
  `realisateur_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `biographie` varchar(250) NOT NULL,
  PRIMARY KEY (`realisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `titre_role` varchar(100) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `titre_role`) VALUES
(1, 'Administrateur'),
(2, 'Vendeur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `email_utilisateur` varchar(100) NOT NULL,
  `password_utilisateur` varchar(250) NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `utilisateurs_ibfk_1` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
