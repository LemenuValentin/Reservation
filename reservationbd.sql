-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 30 Décembre 2016 à 20:04
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
(5, 'Stephane', '46', 3),
(6, 'francis', '65', 4),
(7, 'Martine', '63', 4),
(8, 'Louis', '5', 4),
(13, 'Valentin', '20', 5),
(14, 'Clement', '22', 5);

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
(3, 'Islande', 1, 'OUI', 35),
(4, 'Madrid', 3, 'OUI', 60),
(5, 'Paris', 2, 'OUI', 50);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `reservationinfo`
--
ALTER TABLE `reservationinfo`
  MODIFY `IDres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
