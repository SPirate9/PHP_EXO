-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 18 fév. 2023 à 21:15
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
-- Base de données : `Cour4`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userRegistrationtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_User`, `userName`, `userEmail`, `userPassword`, `userRegistrationtime`) VALUES
(9, 'root', 'admin@gmail.com', '$2y$10$91LFeLFuJqU66oEpfts5JOlPCdkT4yUKaE1GYaXH.WcuZYM/Es3Ee', '2023-02-10 21:40:28'),
(10, 'caca', 'pipi@gmail.com', '$2y$10$ZgO8i6.pGg.RZ/EJzyDwbOnELO3g0xwMb1ICNmhbqAffhnPwoe9QS', '2023-02-10 22:47:01'),
(12, 'Saadinho', 'saad@gmail.com', '$2y$10$PvRvU4fdtx3z1qMpiaH4S.MebhyZT/RKZ9N52MyWHg1XzbX/nuzWe', '2023-02-18 18:22:49'),
(13, 'Saadinho', 'root@gmail.com', '$2y$10$w66eB0I1yk3pfxyYAuNxROfSqLT7lscfLUPS3Qb7IO3SECEHAhWXC', '2023-02-18 18:34:35');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
