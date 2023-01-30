-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 30 jan. 2023 à 16:46
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_exam_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `ID` int(255) NOT NULL,
  `ID_user` int(255) NOT NULL,
  `ID_item` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

CREATE TABLE `invoice` (
  `ID` int(255) NOT NULL,
  `ID_user` int(255) NOT NULL,
  `date of a transaction` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `billing_adress` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_postal_code` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `ID` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `publication_date` date NOT NULL,
  `ID_autor` int(255) NOT NULL,
  `link_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`ID`, `name`, `description`, `price`, `publication_date`, `ID_autor`, `link_picture`) VALUES
(1, 'test', '', 100, '0000-00-00', 0, 'https://media.discordapp.net/attachments/905799668938723329/1068195827618697320/photo_de_rpofil.jpg'),
(2, 'test 2', '', 50, '0000-00-00', 0, 'https://media.discordapp.net/attachments/905799668938723329/1068195827618697320/photo_de_rpofil.jpg'),
(3, 'a', '', 20, '0000-00-00', 0, ''),
(4, 'j', '', 6, '2003-01-01', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `ID` int(255) NOT NULL,
  `ID_item` int(255) NOT NULL,
  `available` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(255) NOT NULL,
  `UUID` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_adress` varchar(50) NOT NULL,
  `balance` int(255) NOT NULL,
  `profile_picture` blob NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `UUID`, `username`, `password`, `email_adress`, `balance`, `profile_picture`, `role`) VALUES
(26, '63d7e5823bc24', 'n', '$2y$10$q/lmgaEDO3EcjKQhabCpYO0JQNETaKwiG1uElfnpsmqFDOenpHPIq', 'n', 0, 0x68747470733a2f2f63646e2e646973636f72646170702e636f6d2f6174746163686d656e74732f3930353739393636383933383732333332392f313036383139353832373631383639373332302f70686f746f5f64655f72706f66696c2e6a7067, 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
