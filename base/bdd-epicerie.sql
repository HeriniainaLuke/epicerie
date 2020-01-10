-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 09 Janvier 2020 à 13:30
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `epicerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `mouvements`
--

CREATE TABLE `mouvements` (
  `ID_MOUVEMENTS` int(11) NOT NULL,
  `ID_PRODUITS` int(11) NOT NULL,
  `QUANTITE` decimal(10,0) NOT NULL,
  `TYPE` int(11) NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mouvements`
--

INSERT INTO `mouvements` (`ID_MOUVEMENTS`, `ID_PRODUITS`, `QUANTITE`, `TYPE`, `DATE`) VALUES
(1, 1, '5', 1, '2020-01-09'),
(2, 2, '5', 1, '2020-01-09');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `ID_PRODUITS` int(11) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `STOCK` decimal(10,0) NOT NULL,
  `IMAGE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`ID_PRODUITS`, `NOM`, `STOCK`, `IMAGE`) VALUES
(1, 'BANANE', '5', 'banane.jpg'),
(2, 'ORANGE', '5', 'orange.jpg'),
(3, 'LETCHIS', '0', 'letchi.jpg'),
(4, 'FRAISE', '0', 'fraise.jpg'),
(5, 'PECHE', '0', 'peche.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD PRIMARY KEY (`ID_MOUVEMENTS`),
  ADD KEY `FK_ASSOCIATION_1` (`ID_PRODUITS`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ID_PRODUITS`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `ID_MOUVEMENTS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ID_PRODUITS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD CONSTRAINT `FK_ASSOCIATION_1` FOREIGN KEY (`ID_PRODUITS`) REFERENCES `produits` (`ID_PRODUITS`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
