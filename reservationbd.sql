-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 22 Décembre 2016 à 17:33
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `reservationbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` varchar(255) NOT NULL,
  `IDres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `passenger`
--

INSERT INTO `passenger` (`id`, `Name`, `Age`, `IDres`) VALUES
(18, 'lolo', '20', 17),
(20, 'Valentin', '20', 19),
(21, 'toku', '17', 19),
(23, 'Valentin', '22', 21),
(24, 'toku', '17', 21),
(55, 'toku', '20', 43),
(56, 'franky', '20', 44);

-- --------------------------------------------------------

--
-- Structure de la table `reservationinfo`
--

CREATE TABLE `reservationinfo` (
  `IDres` int(11) NOT NULL,
  `Destination` varchar(255) NOT NULL,
  `NbPlaces` int(11) NOT NULL,
  `Insurance` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservationinfo`
--

INSERT INTO `reservationinfo` (`IDres`, `Destination`, `NbPlaces`, `Insurance`, `Price`) VALUES
(17, 'Islande', 1, 'OUI', 35),
(19, 'tokyo', 2, 'OUI', 50),
(21, 'tokyo', 2, 'OUI', 50),
(43, 'tokyo', 1, 'OUI', 35),
(44, 'Corse', 1, 'OUI', 50);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDres` (`IDres`);

--
-- Index pour la table `reservationinfo`
--
ALTER TABLE `reservationinfo`
  ADD PRIMARY KEY (`IDres`),
  ADD KEY `IDres` (`IDres`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `reservationinfo`
--
ALTER TABLE `reservationinfo`
  MODIFY `IDres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`IDres`) REFERENCES `reservationinfo` (`IDres`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
