-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 avr. 2024 à 21:52
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stageo`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `nom_administrateur` varchar(255) NOT NULL,
  `prenom_administrateur` varchar(255) NOT NULL,
  `telephone_administrateur` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`, `nom_administrateur`, `prenom_administrateur`, `telephone_administrateur`, `id_utilisateur`) VALUES
(50, 'Dupont', 'Marie', '06 12 34 56 78', 50),
(51, 'Lefevre', 'Nicolas', '06 23 45 67 89', 51),
(52, 'Martin', 'Laura', '06 34 56 78 90', 52),
(53, 'Dubois', 'Alexandre', '06 45 67 89 01', 53),
(54, 'Bernard', 'Julien', '06 56 78 90 12', 54);

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `nom_rue` varchar(255) NOT NULL,
  `id_campus` int(11) DEFAULT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL,
  `id_ville` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `nom_rue`, `id_campus`, `id_etudiant`, `id_entreprise`, `id_ville`) VALUES
(1, '19 Avenue de la Forêt de Haye', 13, NULL, NULL, 13),
(2, '3 Rue du Bois de la Champelle', 13, NULL, NULL, 13),
(3, '6 Rue Bois du Chêne le Loup', 13, NULL, NULL, 13),
(4, '12 Rue Victor Hugo', NULL, NULL, 9, 9),
(5, '8 Avenue des Fleurs', NULL, 21, NULL, 21),
(6, '45 Rue de la Libération', NULL, NULL, 2, 2),
(7, '20 Boulevard Saint-Michel', NULL, 24, NULL, 24),
(8, '3 Rue du Commerce', NULL, NULL, 6, 6),
(9, '14 Avenue de la République', NULL, 18, NULL, 18),
(10, '22 Rue du Château', NULL, NULL, 3, 3),
(11, '5 Place de la Gare', NULL, 19, NULL, 19),
(12, '18 Rue de la Paix', NULL, NULL, 10, 10),
(13, '7 Avenue Jean Jaurès', NULL, NULL, 5, 5),
(14, '10 Rue de la Roquette', NULL, 15, NULL, 15),
(15, '15 Boulevard de l\'Europe', NULL, 17, NULL, 17),
(16, '25 Avenue Foch', NULL, NULL, 8, 8),
(17, '9 Rue du Faubourg Saint-Antoine', NULL, 11, NULL, 11),
(18, '30 Rue des Capucins', NULL, NULL, 4, 4),
(19, '17 Quai de la Fosse', NULL, 23, NULL, 23),
(20, '15 Avenue du Château', NULL, NULL, 1, 1),
(21, '8 Impasse des Hirondelles', NULL, 22, NULL, 22),
(22, '27 Boulevard des Érables', NULL, 12, NULL, 12),
(23, '3 Passage de la Fontaine', NULL, 25, NULL, 25),
(24, '21 Allée des Mésanges', NULL, NULL, 7, 7),
(25, '12 Place des Lilas', 20, NULL, NULL, 20),
(26, '29 Rue du Moulin', 16, NULL, NULL, 16),
(27, '5 Chemin du Soleil', NULL, 14, NULL, 14),
(28, '18 Avenue des Acacias', 25, NULL, NULL, 25),
(29, '7 Passage du Verger', 24, NULL, NULL, 24),
(30, '24 Rue des Coquelicots', NULL, NULL, 3, 3),
(31, '1 Allée des Cèdres', NULL, 28, NULL, 22),
(32, '30 Boulevard des Alouettes', 11, NULL, NULL, 11),
(33, '9 Impasse des Roses', NULL, 5, NULL, 5),
(34, '20 Rue de la Forge', NULL, NULL, 7, 6),
(35, '6 Place des Étoiles', NULL, 17, NULL, 17),
(36, '23 Chemin des Lavandes', 24, NULL, NULL, 24),
(37, '14 Avenue des Primevères', 8, NULL, NULL, 8),
(38, '17 Rue de la Liberté', NULL, NULL, 11, 2),
(39, '8 Avenue de la République', NULL, NULL, 12, 3);

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

CREATE TABLE `campus` (
  `id_campus` int(11) NOT NULL,
  `nom_campus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `campus`
--

INSERT INTO `campus` (`id_campus`, `nom_campus`) VALUES
(1, 'Campus Toulouse'),
(2, 'Campus Paris'),
(3, 'Campus Lyon'),
(4, 'Campus Lille'),
(5, 'Campus Strasbourg'),
(6, 'Campus Nantes'),
(7, 'Campus Angoulème'),
(8, 'Campus Montpellier'),
(9, 'Campus Rouen'),
(10, 'Campus Dijon'),
(11, 'Campus Bordeaux'),
(12, 'Campus Aix-en-Provence'),
(13, 'Campus Nancy'),
(14, 'Campus Saint-Nazaire'),
(15, 'Campus Pau'),
(16, 'Campus Saint-Étienne'),
(17, 'Campus Le Mans'),
(18, 'Campus Reims'),
(19, 'Campus Arras'),
(20, 'Campus Châteauroux'),
(21, 'Campus Brest'),
(22, 'Campus Caen'),
(23, 'Campus La Rochelle'),
(24, 'Campus Limoges'),
(25, 'Campus Saint-Brieuc');

-- --------------------------------------------------------

--
-- Structure de la table `candidater`
--

CREATE TABLE `candidater` (
  `date_candidature` date NOT NULL,
  `date_acceptation` date DEFAULT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_offre_stage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidater`
--

INSERT INTO `candidater` (`date_candidature`, `date_acceptation`, `id_etudiant`, `id_offre_stage`) VALUES
('2024-02-10', '2024-03-01', 15, 1),
('2024-03-05', '2024-03-05', 1, 2),
('2024-02-13', '2024-02-26', 4, 3),
('2024-03-16', '2024-03-26', 10, 4),
('2024-02-24', '2024-03-05', 36, 5),
('2024-03-10', '2024-03-20', 16, 6),
('2024-05-05', NULL, 14, 7),
('2024-04-24', NULL, 9, 8),
('2024-05-13', NULL, 8, 9),
('2024-04-01', NULL, 36, 10),
('2024-04-26', NULL, 32, 11),
('2024-05-01', NULL, 34, 12),
('2024-02-10', '2024-03-01', 15, 1),
('2024-03-05', '2024-03-05', 1, 2),
('2024-02-13', '2024-02-26', 4, 3),
('2024-03-16', '2024-03-26', 10, 4),
('2024-02-24', '2024-03-05', 36, 5),
('2024-03-10', '2024-03-20', 16, 6),
('2024-05-05', NULL, 14, 7),
('2024-04-24', NULL, 9, 8),
('2024-05-13', NULL, 8, 9),
('2024-04-01', NULL, 36, 10),
('2024-04-26', NULL, 32, 11),
('2024-05-01', NULL, 34, 12);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id_competence` int(11) NOT NULL,
  `nom_competence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id_competence`, `nom_competence`) VALUES
(1, 'Programmation en Java'),
(2, 'Développement Web (HTML, CSS, JavaScript)'),
(3, 'Sécurité informatique'),
(4, 'Analyse de données'),
(5, 'Intelligence artificielle et apprentissage machine'),
(6, 'Administration de bases de données'),
(7, 'Gestion de projet informatique'),
(8, 'Développement mobile (iOS, Android)'),
(9, 'Cloud computing (AWS, Azure, Google Cloud)'),
(10, 'Réseaux et sécurité des systèmes'),
(11, 'Conception de l\'interface utilisateur (UI/UX)'),
(12, 'Tests et assurance qualité logicielle'),
(13, 'Communication écrite et verbale'),
(14, 'Résolution de problèmes'),
(15, 'Gestion du temps'),
(16, 'Esprit d\'équipe et collaboration'),
(17, 'Adaptabilité'),
(18, 'Pensée critique'),
(19, 'Organisation et planification'),
(20, 'Capacité à apprendre rapidement'),
(21, 'Créativité'),
(22, 'Prise de décision'),
(23, 'Leadership'),
(24, 'Compétences en gestion de projet'),
(25, 'Conception architecturale'),
(26, 'Lecture de plans et de schémas'),
(27, 'Gestion de projets de construction'),
(28, 'Calculs et dimensionnement de structures'),
(29, 'Maîtrise des logiciels de modélisation 3D (AutoCAD, Revit)'),
(30, 'Gestion de la sécurité sur les chantiers'),
(31, 'Connaissance des matériaux de construction'),
(32, 'Etude des sols et des fondations'),
(33, 'Planification et coordination des travaux'),
(34, 'Respect des normes de construction'),
(35, 'Maîtrise des techniques de construction durable'),
(36, 'Gestion des contrats et des budgets de construction');

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `date_debut_etudes` date NOT NULL,
  `date_fin_etudes` date NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `composer`
--

INSERT INTO `composer` (`date_debut_etudes`, `date_fin_etudes`, `id_etudiant`, `id_promo`) VALUES
('2023-09-01', '2024-06-22', 1, 1),
('2023-09-02', '2024-06-23', 2, 1),
('2023-09-03', '2024-06-24', 3, 1),
('2023-09-04', '2024-06-25', 4, 1),
('2023-09-05', '2024-06-26', 5, 1),
('2023-09-06', '2024-06-27', 6, 1),
('2023-09-07', '2024-06-28', 7, 1),
('2023-09-08', '2024-06-29', 8, 1),
('2023-09-09', '2024-06-30', 9, 1),
('2023-09-10', '2024-07-01', 10, 1),
('2023-09-11', '2024-07-02', 11, 1),
('2023-09-12', '2024-07-03', 12, 1),
('2023-09-13', '2024-07-04', 13, 1),
('2023-09-14', '2024-07-05', 14, 1),
('2023-09-15', '2024-07-06', 15, 1),
('2023-09-16', '2024-07-07', 16, 1),
('2023-09-17', '2024-07-08', 17, 1),
('2023-09-18', '2024-07-09', 18, 2),
('2023-09-19', '2024-07-10', 19, 2),
('2023-09-20', '2024-07-11', 20, 2),
('2023-09-21', '2024-07-12', 21, 2),
('2023-09-22', '2024-07-13', 22, 2),
('2023-09-23', '2024-07-14', 23, 2),
('2023-09-24', '2024-07-15', 24, 2),
('2023-09-25', '2024-07-16', 25, 2),
('2023-09-26', '2024-07-17', 26, 2),
('2023-09-27', '2024-07-18', 27, 2),
('2023-09-28', '2024-07-19', 28, 2),
('2023-09-29', '2024-07-20', 29, 2),
('2023-09-30', '2024-07-21', 30, 2),
('2023-10-01', '2024-07-22', 31, 2),
('2023-10-02', '2024-07-23', 32, 2),
('2023-10-03', '2024-07-24', 33, 2),
('2023-10-04', '2024-07-25', 34, 2),
('2023-10-05', '2024-07-26', 35, 2),
('2023-10-06', '2024-07-27', 36, 2),
('2023-10-07', '2024-07-28', 37, 2),
('2023-09-01', '2024-06-22', 1, 1),
('2023-09-02', '2024-06-23', 2, 1),
('2023-09-03', '2024-06-24', 3, 1),
('2023-09-04', '2024-06-25', 4, 1),
('2023-09-05', '2024-06-26', 5, 1),
('2023-09-06', '2024-06-27', 6, 1),
('2023-09-07', '2024-06-28', 7, 1),
('2023-09-08', '2024-06-29', 8, 1),
('2023-09-09', '2024-06-30', 9, 1),
('2023-09-10', '2024-07-01', 10, 1),
('2023-09-11', '2024-07-02', 11, 1),
('2023-09-12', '2024-07-03', 12, 1),
('2023-09-13', '2024-07-04', 13, 1),
('2023-09-14', '2024-07-05', 14, 1),
('2023-09-15', '2024-07-06', 15, 1),
('2023-09-16', '2024-07-07', 16, 1),
('2023-09-17', '2024-07-08', 17, 1),
('2023-09-18', '2024-07-09', 18, 2),
('2023-09-19', '2024-07-10', 19, 2),
('2023-09-20', '2024-07-11', 20, 2),
('2023-09-21', '2024-07-12', 21, 2),
('2023-09-22', '2024-07-13', 22, 2),
('2023-09-23', '2024-07-14', 23, 2),
('2023-09-24', '2024-07-15', 24, 2),
('2023-09-25', '2024-07-16', 25, 2),
('2023-09-26', '2024-07-17', 26, 2),
('2023-09-27', '2024-07-18', 27, 2),
('2023-09-28', '2024-07-19', 28, 2),
('2023-09-29', '2024-07-20', 29, 2),
('2023-09-30', '2024-07-21', 30, 2),
('2023-10-01', '2024-07-22', 31, 2),
('2023-10-02', '2024-07-23', 32, 2),
('2023-10-03', '2024-07-24', 33, 2),
('2023-10-04', '2024-07-25', 34, 2),
('2023-10-05', '2024-07-26', 35, 2),
('2023-10-06', '2024-07-27', 36, 2),
('2023-10-07', '2024-07-28', 37, 2);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `nom_enseignant` varchar(255) NOT NULL,
  `prenom_enseignant` varchar(255) NOT NULL,
  `telephone_enseignant` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `nom_enseignant`, `prenom_enseignant`, `telephone_enseignant`, `id_utilisateur`) VALUES
(38, 'Minich', 'Sarah', '09 87 12 36 54', 38),
(39, 'Meon', 'Justine', '03 21 32 17 89', 39),
(40, 'Roux-Marchand', 'Thibault', '04 56 45 67 89', 40),
(41, 'Remy', 'Emmanuel', '01 23 12 34 56', 41),
(42, 'Abilot', 'Jean-Baptiste', '07 89 98 77 89', 42),
(43, 'Zaidi', 'Imene', '06 54 65 43 21', 43),
(44, 'Brousse', 'Etienne', '03 21 78 96 54', 44),
(45, 'Bezoui', 'Madani', '04 56 12 33 21', 45),
(46, 'Lamige', 'Sylvain', '01 23 98 79 87', 46),
(47, 'Belhocine', 'Latifa', '07 89 65 44 56', 47),
(48, 'Alaili', 'Kamal', '06 54 32 16 54', 48),
(49, 'Bresciani ', 'Julie', '09 87 78 99 87', 49);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  `logo_entreprise` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `logo_entreprise`) VALUES
(1, 'L\'Oréal', 'https://www.1min30.com/wp-content/uploads/2018/06/Logo-LOr%C3%A9al-1.jpg'),
(2, 'TotalEnergies', 'https://i.ytimg.com/vi/ljiV7VON93E/maxresdefault.jpg'),
(3, 'Airbus', 'https://logos-marques.com/wp-content/uploads/2020/11/logo-Airbus.jpg'),
(4, 'Danone', 'https://logos-marques.com/wp-content/uploads/2021/03/Danone-Logo-1994.png'),
(5, 'Crédit Mutuel', 'https://urbantrail.montpelliertriathlon.com/wp-content/sites/13/2019/12/logo-Cr%C3%A9dit-Mutuel.png'),
(6, 'BNP Paribas', 'https://www.1min30.com/wp-content/uploads/2018/03/BNP-logo-1.jpg'),
(7, 'Renault', 'https://lescylindres.com/wp-content/uploads/2023/03/Logo-Renault-thumb-1280x720-1.png'),
(8, 'Orange', 'https://logos-marques.com/wp-content/uploads/2021/02/Orange-Couleur.jpg'),
(9, 'AXA', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/AXA_Logo.svg/1200px-AXA_Logo.svg.png'),
(10, 'Sanofi', 'https://upload.wikimedia.org/wikipedia/fr/thumb/2/2c/Sanofi.svg/2560px-Sanofi.svg.png'),
(11, 'Vinci', 'https://www.francetvinfo.fr/pictures/OuhiXNHFpll9IpL4RBQutw9fWWQ/0x53:1024x629/2656x1494/filters:format(avif):quality(50)/2022/05/20/php3uDRh8.jpg'),
(12, 'EDF', 'https://www.capitaine-energie.com/wp-content/uploads/2017/05/EDF.png');

-- --------------------------------------------------------

--
-- Structure de la table `etre_localiser`
--

CREATE TABLE `etre_localiser` (
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `id_enseignant` int(11) NOT NULL,
  `id_campus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etre_localiser`
--

INSERT INTO `etre_localiser` (`date_debut`, `date_fin`, `id_enseignant`, `id_campus`) VALUES
('2023-04-01', NULL, 38, 1),
('2023-04-01', NULL, 39, 2),
('2023-04-01', NULL, 40, 3),
('2023-04-01', NULL, 41, 4),
('2023-04-01', NULL, 42, 5),
('2023-04-01', NULL, 43, 6),
('2023-04-01', NULL, 44, 7),
('2023-04-01', NULL, 45, 8),
('2023-04-01', NULL, 46, 9),
('2023-04-01', NULL, 47, 10),
('2023-04-01', NULL, 48, 11),
('2023-04-01', NULL, 49, 12),
('2023-04-01', NULL, 38, 1),
('2023-04-01', NULL, 39, 2),
('2023-04-01', NULL, 40, 3),
('2023-04-01', NULL, 41, 4),
('2023-04-01', NULL, 42, 5),
('2023-04-01', NULL, 43, 6),
('2023-04-01', NULL, 44, 7),
('2023-04-01', NULL, 45, 8),
('2023-04-01', NULL, 46, 9),
('2023-04-01', NULL, 47, 10),
('2023-04-01', NULL, 48, 11),
('2023-04-01', NULL, 49, 12);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom_etudiant` varchar(255) NOT NULL,
  `prenom_etudiant` varchar(255) NOT NULL,
  `date_naissance_etudiant` date NOT NULL,
  `telephone_etudiant` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `date_naissance_etudiant`, `telephone_etudiant`, `id_utilisateur`) VALUES
(1, 'Armand', 'Chloé', '2004-01-03', '07 89 45 61 23', 1),
(2, 'Auchet ', 'Maxime', '2004-02-14', '06 54 32 17 89', 2),
(3, 'Bergbauer', 'Arthur', '2004-09-17', '06 11 84 14 33', 3),
(4, 'Boudemagh', 'Isra', '2004-03-07', '09 87 65 43 21', 4),
(5, 'Chaouche', 'Ylies', '2004-04-22', '01 23 45 67 89', 5),
(6, 'Evangelist', 'Clément', '2004-05-15', '04 56 78 91 23', 6),
(7, 'Fraioli', 'Enzo', '2004-06-01', '03 21 98 76 54', 7),
(8, 'Koula', 'Elrazi', '2004-06-23', '07 80 85 61 80', 8),
(9, 'Legin', 'Liam', '2004-03-03', '07 89 12 34 56', 9),
(10, 'Metino Ngoufo', 'Stadiane', '2004-07-19', '06 54 78 93 21', 10),
(11, 'Nguyen', 'Kao Duong', '2004-03-17', '07 88 78 49 60', 11),
(12, 'Noel', 'Theophile', '2004-08-10', '03 21 45 69 87', 12),
(13, 'Peiffer ', 'Alexis', '2004-09-26', '09 87 32 16 54', 13),
(14, 'Rieckenberg', 'Bruno', '2004-10-18', '04 56 12 37 89', 14),
(15, 'Romano', 'Corentin', '2004-09-09', '01 23 78 94 56', 15),
(16, 'Sabri', 'Messaoud', '2004-11-09', '07 89 32 14 56', 16),
(17, 'Zannier', 'Sabri', '2004-12-30', '06 54 98 71 23', 17),
(18, 'Baz', 'Ylies', '2004-01-05', '03 21 12 34 56', 18),
(19, 'Cristinelli', 'Guillaume', '2004-02-20', '07 89 98 76 54', 19),
(20, 'Gasiorek', 'Alban', '2004-03-12', '04 56 65 43 21', 20),
(21, 'Rizzotti', 'Léo', '2004-04-04', '01 23 78 96 54', 21),
(22, 'Lelorrain', 'Hugo', '2004-05-21', '07 89 65 43 21', 22),
(23, 'Feller', 'Lucas', '2004-06-13', '06 54 32 14 56', 23),
(24, 'Breton', 'Quentin', '2004-07-02', '09 87 45 61 23', 24),
(25, 'Trébujais', 'Noah', '2004-09-08', '03 21 65 49 87', 25),
(26, 'Pirovano', 'Adrien', '2004-10-24', '04 56 78 96 54', 26),
(27, 'Robert', 'Alexis', '2004-11-16', '01 23 32 17 89', 27),
(28, 'Boughon', 'Jean-Lou', '2004-12-07', '09 87 78 94 56', 28),
(29, 'Dangleant', 'Ethan', '2004-01-31', '06 54 45 67 89', 29),
(30, 'Laniel', 'Florian', '2004-02-15', '07 89 12 33 21', 30),
(31, 'Wavrin', 'Lilian', '2004-03-08', '03 21 45 66 54', 31),
(32, 'Chamagne', 'Liam', '2004-04-23', '04 56 65 47 89', 32),
(33, 'Clement-Henrion', 'Titouan', '2004-05-16', '01 23 98 73 21', 33),
(34, 'Guldner', 'Lucas', '2004-06-02', '07 89 65 49 87', 34),
(35, 'Colin', 'Garance', '2004-08-17', '06 54 12 37 89', 35),
(36, 'Husson', 'Baptiste', '2003-01-17', '09 87 78 93 21', 36),
(37, 'El Yaagoubi', 'Safaa', '2004-07-20', '03 21 65 44 56', 37);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation_enseignant`
--

CREATE TABLE `evaluation_enseignant` (
  `note_enseignant` decimal(2,1) DEFAULT NULL,
  `id_enseignant` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluation_enseignant`
--

INSERT INTO `evaluation_enseignant` (`note_enseignant`, `id_enseignant`, `id_entreprise`) VALUES
(3.2, 41, 1),
(2.4, 42, 1),
(3.7, 38, 2),
(4.8, 40, 2),
(1.9, 42, 3),
(0.1, 43, 3),
(4.3, 46, 4),
(2.5, 48, 4),
(3.9, 39, 5),
(1.3, 44, 5),
(0.5, 41, 6),
(4.1, 45, 6),
(2.8, 49, 7),
(5.0, 40, 7),
(1.0, 48, 8),
(0.9, 45, 8),
(2.2, 40, 9),
(1.6, 43, 9),
(4.6, 38, 10),
(3.7, 39, 10),
(2.2, 44, 11),
(4.6, 40, 11),
(3.7, 48, 12),
(1.9, 42, 12),
(3.2, 41, 1),
(2.4, 42, 1),
(3.7, 38, 2),
(4.8, 40, 2),
(1.9, 42, 3),
(0.1, 43, 3),
(4.3, 46, 4),
(2.5, 48, 4),
(3.9, 39, 5),
(1.3, 44, 5),
(0.5, 41, 6),
(4.1, 45, 6),
(2.8, 49, 7),
(5.0, 40, 7),
(1.0, 48, 8),
(0.9, 45, 8),
(2.2, 40, 9),
(1.6, 43, 9),
(4.6, 38, 10),
(3.7, 39, 10),
(2.2, 44, 11),
(4.6, 40, 11),
(3.7, 48, 12),
(1.9, 42, 12);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation_etudiant`
--

CREATE TABLE `evaluation_etudiant` (
  `note_etudiant` decimal(2,1) DEFAULT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluation_etudiant`
--

INSERT INTO `evaluation_etudiant` (`note_etudiant`, `id_etudiant`, `id_entreprise`) VALUES
(0.4, 34, 1),
(3.1, 4, 1),
(2.6, 37, 2),
(1.2, 18, 2),
(4.4, 16, 3),
(0.3, 11, 3),
(1.7, 20, 4),
(2.9, 8, 4),
(4.8, 36, 5),
(3.4, 6, 5),
(4.9, 2, 6),
(4.2, 14, 6),
(3.3, 15, 7),
(1.4, 30, 7),
(0.6, 10, 8),
(4.5, 9, 8),
(2.1, 13, 9),
(1.1, 7, 9),
(3.8, 32, 10),
(0.2, 29, 10),
(2.7, 36, 11),
(3.0, 34, 11),
(4.1, 35, 12),
(1.3, 32, 12),
(0.4, 34, 1),
(3.1, 4, 1),
(2.6, 37, 2),
(1.2, 18, 2),
(4.4, 16, 3),
(0.3, 11, 3),
(1.7, 20, 4),
(2.9, 8, 4),
(4.8, 36, 5),
(3.4, 6, 5),
(4.9, 2, 6),
(4.2, 14, 6),
(3.3, 15, 7),
(1.4, 30, 7),
(0.6, 10, 8),
(4.5, 9, 8),
(2.1, 13, 9),
(1.1, 7, 9),
(3.8, 32, 10),
(0.2, 29, 10),
(2.7, 36, 11),
(3.0, 34, 11),
(4.1, 35, 12),
(1.3, 32, 12);

-- --------------------------------------------------------

--
-- Structure de la table `exiger`
--

CREATE TABLE `exiger` (
  `id_offre_stage` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exiger`
--

INSERT INTO `exiger` (`id_offre_stage`, `id_competence`) VALUES
(1, 2),
(1, 6),
(1, 7),
(1, 21),
(2, 3),
(2, 4),
(2, 10),
(2, 14),
(2, 17),
(2, 22),
(3, 13),
(3, 14),
(3, 16),
(3, 17),
(3, 18),
(3, 22),
(3, 23),
(4, 15),
(4, 16),
(4, 17),
(4, 19),
(4, 22),
(4, 23),
(5, 25),
(5, 26),
(5, 28),
(5, 29),
(5, 33),
(6, 14),
(6, 19),
(6, 20),
(6, 22),
(7, 3),
(7, 10),
(8, 9),
(8, 17),
(9, 5),
(9, 20),
(10, 14),
(10, 20),
(11, 14),
(11, 17),
(12, 36),
(12, 35),
(1, 2),
(1, 6),
(1, 7),
(1, 21),
(2, 3),
(2, 4),
(2, 10),
(2, 14),
(2, 17),
(2, 22),
(3, 13),
(3, 14),
(3, 16),
(3, 17),
(3, 18),
(3, 22),
(3, 23),
(4, 15),
(4, 16),
(4, 17),
(4, 19),
(4, 22),
(4, 23),
(5, 25),
(5, 26),
(5, 28),
(5, 29),
(5, 33),
(6, 14),
(6, 19),
(6, 20),
(6, 22),
(7, 3),
(7, 10),
(8, 9),
(8, 17),
(9, 5),
(9, 20),
(10, 14),
(10, 20),
(11, 14),
(11, 17),
(12, 36),
(12, 35);

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

CREATE TABLE `gerer` (
  `date_debut_stage` date NOT NULL,
  `date_fin_stage` date NOT NULL,
  `id_offre_stage` int(11) NOT NULL,
  `id_tuteur_stage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gerer`
--

INSERT INTO `gerer` (`date_debut_stage`, `date_fin_stage`, `id_offre_stage`, `id_tuteur_stage`) VALUES
('2024-03-15', '2024-09-15', 1, 1),
('2024-04-02', '2024-07-30', 2, 2),
('2024-04-01', '2024-06-30', 3, 3),
('2024-05-01', '2024-09-29', 4, 4),
('2024-04-03', '2024-09-30', 5, 5),
('2024-05-01', '2024-08-31', 6, 6),
('2024-06-01', '2024-11-30', 7, 7),
('2024-04-27', '2024-07-27', 8, 8),
('2024-07-24', '2024-11-24', 9, 9),
('2024-06-01', '2024-10-31', 10, 10),
('2024-05-01', '2024-10-31', 11, 11),
('2024-08-01', '2024-11-30', 12, 12),
('2024-03-15', '2024-09-15', 1, 1),
('2024-04-02', '2024-07-30', 2, 2),
('2024-04-01', '2024-06-30', 3, 3),
('2024-05-01', '2024-09-29', 4, 4),
('2024-04-03', '2024-09-30', 5, 5),
('2024-05-01', '2024-08-31', 6, 6),
('2024-06-01', '2024-11-30', 7, 7),
('2024-04-27', '2024-07-27', 8, 8),
('2024-07-24', '2024-11-24', 9, 9),
('2024-06-01', '2024-10-31', 10, 10),
('2024-05-01', '2024-10-31', 11, 11),
('2024-08-01', '2024-11-30', 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `offre_stage`
--

CREATE TABLE `offre_stage` (
  `id_offre_stage` int(11) NOT NULL,
  `nom_offre_stage` varchar(255) NOT NULL,
  `description_stage` varchar(255) NOT NULL,
  `duree_mois` int(11) NOT NULL,
  `salaire_euro` int(11) NOT NULL,
  `places_offertes` int(11) NOT NULL,
  `date_publication` date NOT NULL,
  `date_debut_prevu` date NOT NULL,
  `date_fin_prevu` date NOT NULL,
  `id_administrateur` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offre_stage`
--

INSERT INTO `offre_stage` (`id_offre_stage`, `nom_offre_stage`, `description_stage`, `duree_mois`, `salaire_euro`, `places_offertes`, `date_publication`, `date_debut_prevu`, `date_fin_prevu`, `id_administrateur`, `id_entreprise`, `id_enseignant`) VALUES
(1, 'Développeur Web Junior', 'Rejoignez notre équipe pour développer des applications web ', 6, 1200, 3, '2024-02-01', '2024-03-15', '2024-09-15', 51, 5, 48),
(2, 'Analyste en Cybersécurité', 'Contribuez à  la sécurité de nos systèmes d\'information', 4, 1500, 2, '2024-03-05', '2024-04-02', '2024-07-31', 53, 8, 42),
(3, 'Assistant en Ressources Humaines', 'Participez aux activités RH au sein de notre entreprise.', 3, 1000, 4, '2024-02-10', '2024-04-01', '2024-06-30', 50, 10, 44),
(4, 'Assistant Marketing', 'Collaborez à  la création de campagnes marketing impactantes.', 5, 1200, 3, '2024-03-15', '2024-05-01', '2024-09-29', 54, 1, 49),
(5, 'Ingénieur Civil Junior', 'Participez à  la conception et à  la réalisation de projets d\'infrastructures.', 6, 1800, 2, '2024-02-20', '2024-04-03', '2024-09-30', 52, 4, 46),
(6, 'Technicien en Énergie Renouvelable', 'Contribuez au développement de solutions énergétiques durables.', 4, 1500, 3, '2024-03-08', '2024-05-01', '2024-08-31', 51, 2, 40),
(7, 'Administrateur Système et Réseau', 'Vous serez responsable de la gestion et de la maintenance de notre infrastructure informatique, en assurant la disponibilité et la sécurité de nos systèmes. Vous travaillerez sur des tâches d\'administration, de surveillance et de résolution d\'incidents.', 6, 900, 1, '2024-04-15', '2024-06-01', '2024-11-30', 53, 8, 42),
(8, 'Spécialiste en Cloud Computing', 'Vous participerez à la migration de nos services vers le cloud et à l\'optimisation de notre infrastructure. Vous travaillerez sur des plateformes telles que AWS, Azure ou Google Cloud, en assurant la disponibilité, la performance et la sécurité de nos app', 6, 950, 6, '2024-04-05', '2024-04-27', '2024-07-27', 54, 5, 48),
(9, 'Spécialiste en Intelligence Artificielle', 'Vous travaillerez sur des projets liés à l\'intelligence artificielle, tels que la modélisation prédictive, le traitement du langage naturel, la vision par ordinateur, etc. ', 6, 1000, 4, '2024-05-10', '2024-07-24', '2024-11-24', 52, 3, 43),
(10, 'Stage en ingénierie mécanique', 'Rejoignez notre équipe pour travailler sur la conception et l\'optimisation de systèmes mécaniques. Vous aurez l\'opportunité d\'appliquer vos connaissances théoriques à des projets concrets.', 5, 1600, 3, '2024-03-05', '2024-06-01', '2024-10-31', 51, 11, 40),
(11, 'Stage en ingénierie électrique', 'Contribuez au développement de solutions innovantes dans le domaine de l\'ingénierie électrique. Vous travaillerez sur la conception de circuits et de systèmes de contrôle.', 6, 1700, 2, '2024-02-20', '2024-05-01', '2024-10-31', 54, 12, 49),
(12, 'Stage en ingénierie environnementale', 'Participez à des projets de développement durable et de protection de l\'environnement en tant qu\'ingénieur environnemental. Vous contribuerez à la conception et à la mise en œuvre de solutions écologiques.', 4, 1800, 5, '2024-04-25', '2024-08-01', '2024-11-30', 52, 11, 44);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id_pays` int(11) NOT NULL,
  `nom_pays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom_pays`) VALUES
(1, 'France'),
(2, 'Allemagne'),
(3, 'Luxembourg'),
(4, 'Belgique'),
(5, 'Espagne'),
(6, 'Portugal'),
(7, 'Italie'),
(8, 'Pays-Bas'),
(9, 'Autriche');

-- --------------------------------------------------------

--
-- Structure de la table `piloter`
--

CREATE TABLE `piloter` (
  `date_debut_pilotage` date DEFAULT NULL,
  `date_fin_pilotage` date DEFAULT NULL,
  `id_enseignant` int(11) NOT NULL,
  `id_promo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `piloter`
--

INSERT INTO `piloter` (`date_debut_pilotage`, `date_fin_pilotage`, `id_enseignant`, `id_promo`) VALUES
('2023-09-25', '2024-07-26', 48, 1),
('2023-09-25', '2024-07-26', 49, 2),
('2023-09-25', '2024-07-26', 38, 6),
('2023-09-25', '2024-07-26', 41, 3),
('2023-09-25', '2024-07-26', 44, 9),
('2023-09-25', '2024-07-26', 40, 10),
('2023-09-25', '2024-07-26', 48, 1),
('2023-09-25', '2024-07-26', 49, 2),
('2023-09-25', '2024-07-26', 38, 6),
('2023-09-25', '2024-07-26', 41, 3),
('2023-09-25', '2024-07-26', 44, 9),
('2023-09-25', '2024-07-26', 40, 10);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE `posseder` (
  `id_entreprise` int(11) NOT NULL,
  `id_secteur_activite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`id_entreprise`, `id_secteur_activite`) VALUES
(1, 5),
(1, 9),
(1, 23),
(1, 24),
(1, 27),
(2, 3),
(2, 14),
(2, 16),
(2, 22),
(2, 27),
(3, 3),
(3, 11),
(3, 16),
(3, 22),
(3, 27),
(3, 30),
(4, 2),
(4, 16),
(5, 4),
(5, 11),
(5, 26),
(5, 27),
(6, 4),
(6, 11),
(6, 26),
(6, 27),
(7, 3),
(7, 16),
(7, 22),
(7, 27),
(8, 14),
(8, 19),
(8, 26),
(8, 27),
(8, 29),
(9, 4),
(9, 11),
(9, 21),
(9, 26),
(9, 27),
(10, 7),
(10, 14),
(10, 16),
(10, 18),
(10, 25),
(10, 27),
(11, 6),
(11, 15),
(12, 27),
(12, 14),
(1, 5),
(1, 9),
(1, 23),
(1, 24),
(1, 27),
(2, 3),
(2, 14),
(2, 16),
(2, 22),
(2, 27),
(3, 3),
(3, 11),
(3, 16),
(3, 22),
(3, 27),
(3, 30),
(4, 2),
(4, 16),
(5, 4),
(5, 11),
(5, 26),
(5, 27),
(6, 4),
(6, 11),
(6, 26),
(6, 27),
(7, 3),
(7, 16),
(7, 22),
(7, 27),
(8, 14),
(8, 19),
(8, 26),
(8, 27),
(8, 29),
(9, 4),
(9, 11),
(9, 21),
(9, 26),
(9, 27),
(10, 7),
(10, 14),
(10, 16),
(10, 18),
(10, 25),
(10, 27),
(11, 6),
(11, 15),
(12, 27),
(12, 14);

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `nom_promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`id_promo`, `nom_promo`) VALUES
(1, 'A2 INFO'),
(2, 'A2 GENE'),
(3, 'A3 INFO FISE\r\n'),
(4, 'A3 INFO FISA\r\n'),
(5, 'A3 GENE FISE\r\n'),
(6, 'A3 GENE FISA\r\n'),
(7, 'A4 INFO FISA\r\n'),
(8, 'A4 INFO FISE\r\n'),
(9, 'A4 GENE FISA\r\n'),
(10, 'A4 GENE FISE\r\n'),
(11, 'A5 INFO FISE\r\n'),
(12, 'A5 INFO FISA\r\n'),
(13, 'A5 GENE FISE\r\n'),
(14, 'A5 GENE FISA\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nom_region` varchar(255) NOT NULL,
  `id_pays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id_region`, `nom_region`, `id_pays`) VALUES
(1, 'Île-de-France', 1),
(2, 'Grand Est', 1),
(3, 'Hauts-de-France', 1),
(4, 'Normandie', 1),
(5, 'Bretagne', 1),
(6, 'Pays de la Loire', 1),
(7, 'Centre-Val de Loire', 1),
(8, 'Bourgogne-Franche-Comté', 1),
(9, 'Auvergne-Rhône-Alpes', 1),
(10, 'Provence-Alpes-Côte d\'Azur', 1),
(11, 'Occitanie', 1),
(12, 'Nouvelle-Aquitaine', 1),
(13, 'Centre-Val de Loire', 1);

-- --------------------------------------------------------

--
-- Structure de la table `secteur_activite`
--

CREATE TABLE `secteur_activite` (
  `id_secteur_activite` int(11) NOT NULL,
  `nom_secteur_activite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `secteur_activite`
--

INSERT INTO `secteur_activite` (`id_secteur_activite`, `nom_secteur_activite`) VALUES
(1, 'Agriculture, sylviculture et pêche'),
(2, 'Alimentation et boissons'),
(3, 'Automobile et équipement automobile'),
(4, 'Banque et services financiers'),
(5, 'Beauté et bien-être'),
(6, 'BTP et construction'),
(7, 'Chimie et produits chimiques'),
(8, 'Commerce de détail'),
(9, 'Commerce électronique'),
(10, 'Communication et médias'),
(11, 'Consulting et services professionnels'),
(12, 'Défense et aérospatiale'),
(13, 'Éducation et formation'),
(14, 'Énergie et services publics'),
(15, 'Environnement et développement durable'),
(16, 'Fabrication et production'),
(17, 'Immobilier'),
(18, 'Industrie pharmaceutique'),
(19, 'Informatique et technologies de l\'information'),
(20, 'Jeux et divertissement'),
(21, 'Juridique et assurance'),
(22, 'Logistique et transport'),
(23, 'Marketing et publicité'),
(24, 'Mode et habillement'),
(25, 'Santé et services médicaux'),
(26, 'Services aux entreprises'),
(27, 'Services aux consommateurs'),
(28, 'Sport et loisirs'),
(29, 'Télécommunications'),
(30, 'Tourisme et voyages');

-- --------------------------------------------------------

--
-- Structure de la table `tuteur_stage`
--

CREATE TABLE `tuteur_stage` (
  `id_tuteur_stage` int(11) NOT NULL,
  `nom_tuteur_stage` varchar(255) NOT NULL,
  `prenom_tuteur_stage` varchar(255) NOT NULL,
  `telephone_tuteur_stage` varchar(255) NOT NULL,
  `email_tuteur_stage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tuteur_stage`
--

INSERT INTO `tuteur_stage` (`id_tuteur_stage`, `nom_tuteur_stage`, `prenom_tuteur_stage`, `telephone_tuteur_stage`, `email_tuteur_stage`) VALUES
(1, 'Moreau', 'Amélie', '06 78 90 12 34', 'amelie.moreau@email.com'),
(2, 'Petit', 'Thomas', '06 89 01 23 45', 'thomas.petit@email.com'),
(3, 'Leroy', 'Emma', '06 01 23 45 67', 'emma.leroy@email.com'),
(4, 'Garcia', 'Manuel', '06 23 45 67 89', 'manuel.garcia@email.com'),
(5, 'Rousseau', 'Hugo', '06 45 67 89 01', 'hugo.rousseau@email.com'),
(6, 'Lambert', 'Antoine', '06 12 34 56 78', 'antoine.lambert@email.com'),
(7, 'Dupont', 'Jean', ' 01 23 45 67 89', 'jean.dupont@example.com'),
(8, 'Martin', 'Marie', '06 12 34 56 78', 'marie.martin@example.com'),
(9, 'Durand', 'Pierre', '02 34 56 78 90', 'pierre.durand@example.com'),
(10, 'Leroy', 'Sophie', '03 45 67 89 01', 'sophie.leroy@example.com'),
(11, 'Lefevre', 'Thomas', '04 56 78 90 12', 'thomas.lefevre@example.com'),
(12, 'Moreau', 'Emilie', '05 67 89 01 23', 'emilie.moreau@example.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `mdp`) VALUES
(1, 'chloe.armand@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(2, 'maxime.auchet@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(3, 'arthur.bergbauer@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(4, 'isra.boudemagh@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(5, 'ylies.chaouche@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(6, 'clement.evangelisti@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(7, 'enzo.fraioli@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(8, 'elrazi.koula@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(9, 'liam.legin@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(10, 'stadiane.metinongoufo@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(11, 'kaoduong.nguyen@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(12, 'theophile.noel@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(13, 'alexis.peiffer@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(14, 'bruno.rieckenberg@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(15, 'corentin.romano@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(16, 'messaoud.sabri@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(17, 'matteo.zannier@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(18, 'ylies.baz@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(19, 'guillaume.cristinelli@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(20, 'alban.gasiorek@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(21, 'leo.rizzotti@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(22, 'hugo.lelorrain@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(23, 'lucas.feller@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(24, 'quentin.breton@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(25, 'noah.trebujais@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(26, 'adrien.pirovano@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(27, 'alexis.robert@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(28, 'jeanlou.boughon@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(29, 'ethan.dangleant@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(30, 'florian.laniel@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(31, 'lilian.wavrin@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(32, 'liam.chamagne@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(33, 'titouan.clementhenrion@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(34, 'lucas.guldner@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(35, 'garance.colin@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(36, 'baptiste.husson@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(37, 'safaa.elyaagoubi@viacesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(38, 'sminich@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(39, 'jmeon@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(40, 'trouxmarchand@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(41, 'eremy@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(42, 'jbabilot@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(43, 'izaidi@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(44, 'ebrousse@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(45, 'mbezoui@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(46, 'slamige@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(47, 'lbelhocine@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(48, 'kalaili@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(49, 'jbresciani@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(50, 'marie.dupont@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(51, 'nicolas.lefevre@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(52, 'laura.martin@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(53, 'alexandre.dubois@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f'),
(54, 'julien.bernard@cesi.fr', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id_ville` int(11) NOT NULL,
  `nom_ville` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom_ville`, `code_postal`, `id_region`) VALUES
(1, 'Toulouse', 31000, 11),
(2, 'Paris', 75000, 1),
(3, 'Lyon', 69000, 9),
(4, 'Lille', 59000, 3),
(5, 'Strasbourg', 67000, 2),
(6, 'Nantes', 44000, 6),
(7, 'Angoulème', 16000, 12),
(8, 'Montpellier', 34000, 11),
(9, 'Rouen', 76000, 4),
(10, 'Dijon', 21000, 8),
(11, 'Bordeaux', 33000, 12),
(12, 'Aix-en-Provence', 13100, 10),
(13, 'Nancy', 54000, 2),
(14, 'Saint-Nazaire', 44600, 6),
(15, 'Pau', 64000, 12),
(16, 'Saint-Étienne', 42000, 9),
(17, 'Le Mans', 72000, 6),
(18, 'Reims', 51100, 2),
(19, 'Arras', 62000, 3),
(20, 'Châteauroux', 36000, 7),
(21, 'Brest', 29200, 5),
(22, 'Caen', 14000, 4),
(23, 'La Rochelle', 17000, 12),
(24, 'Limoges', 87000, 12),
(25, 'Saint-Briec', 35137, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`),
  ADD UNIQUE KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `id_campus` (`id_campus`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_ville` (`id_ville`);

--
-- Index pour la table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id_campus`);

--
-- Index pour la table `candidater`
--
ALTER TABLE `candidater`
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_offre_stage` (`id_offre_stage`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD UNIQUE KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `etre_localiser`
--
ALTER TABLE `etre_localiser`
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_campus` (`id_campus`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD UNIQUE KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `evaluation_enseignant`
--
ALTER TABLE `evaluation_enseignant`
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `evaluation_etudiant`
--
ALTER TABLE `evaluation_etudiant`
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `exiger`
--
ALTER TABLE `exiger`
  ADD KEY `id_offre_stage` (`id_offre_stage`),
  ADD KEY `id_competence` (`id_competence`);

--
-- Index pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD KEY `id_offre_stage` (`id_offre_stage`),
  ADD KEY `id_tuteur_stage` (`id_tuteur_stage`);

--
-- Index pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD PRIMARY KEY (`id_offre_stage`),
  ADD KEY `id_administrateur` (`id_administrateur`),
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_enseignant` (`id_enseignant`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`);

--
-- Index pour la table `piloter`
--
ALTER TABLE `piloter`
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Index pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_secteur_activite` (`id_secteur_activite`);

--
-- Index pour la table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`),
  ADD KEY `id_pays` (`id_pays`);

--
-- Index pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  ADD PRIMARY KEY (`id_secteur_activite`);

--
-- Index pour la table `tuteur_stage`
--
ALTER TABLE `tuteur_stage`
  ADD PRIMARY KEY (`id_tuteur_stage`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id_ville`),
  ADD KEY `id_region` (`id_region`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `campus`
--
ALTER TABLE `campus`
  MODIFY `id_campus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  MODIFY `id_offre_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  MODIFY `id_secteur_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `tuteur_stage`
--
ALTER TABLE `tuteur_stage`
  MODIFY `id_tuteur_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id_campus`),
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `adresse_ibfk_3` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`),
  ADD CONSTRAINT `adresse_ibfk_4` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`);

--
-- Contraintes pour la table `candidater`
--
ALTER TABLE `candidater`
  ADD CONSTRAINT `candidater_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `candidater_ibfk_2` FOREIGN KEY (`id_offre_stage`) REFERENCES `offre_stage` (`id_offre_stage`);

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `etre_localiser`
--
ALTER TABLE `etre_localiser`
  ADD CONSTRAINT `etre_localiser_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `etre_localiser_ibfk_2` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id_campus`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `evaluation_enseignant`
--
ALTER TABLE `evaluation_enseignant`
  ADD CONSTRAINT `evaluation_enseignant_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `evaluation_enseignant_ibfk_2` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `evaluation_etudiant`
--
ALTER TABLE `evaluation_etudiant`
  ADD CONSTRAINT `evaluation_etudiant_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `evaluation_etudiant_ibfk_2` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `exiger`
--
ALTER TABLE `exiger`
  ADD CONSTRAINT `exiger_ibfk_1` FOREIGN KEY (`id_offre_stage`) REFERENCES `offre_stage` (`id_offre_stage`),
  ADD CONSTRAINT `exiger_ibfk_2` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`id_offre_stage`) REFERENCES `offre_stage` (`id_offre_stage`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`id_tuteur_stage`) REFERENCES `tuteur_stage` (`id_tuteur_stage`);

--
-- Contraintes pour la table `offre_stage`
--
ALTER TABLE `offre_stage`
  ADD CONSTRAINT `offre_stage_ibfk_1` FOREIGN KEY (`id_administrateur`) REFERENCES `administrateur` (`id_administrateur`),
  ADD CONSTRAINT `offre_stage_ibfk_2` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`),
  ADD CONSTRAINT `offre_stage_ibfk_3` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`);

--
-- Contraintes pour la table `piloter`
--
ALTER TABLE `piloter`
  ADD CONSTRAINT `piloter_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `piloter_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`),
  ADD CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`id_secteur_activite`) REFERENCES `secteur_activite` (`id_secteur_activite`);

--
-- Contraintes pour la table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`id_pays`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `ville_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
