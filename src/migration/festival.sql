-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 oct. 2020 à 10:54
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `artistes`
--

CREATE TABLE `artistes` (
  `artistes_id` int(11) NOT NULL,
  `artistes_nom` varchar(120) NOT NULL,
  `artistes_genre` varchar(50) NOT NULL,
  `artistes_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `billet_id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_concert` int(11) NOT NULL,
  `billet_nb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `concerts`
--

CREATE TABLE `concerts` (
  `concert_id` int(11) NOT NULL,
  `id_artistes` int(11) NOT NULL,
  `id_scene` int(11) NOT NULL,
  `concert_horaire` datetime NOT NULL,
  `concert_places` int(11) NOT NULL,
  `concert_prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `scenes`
--

CREATE TABLE `scenes` (
  `scene_id` int(11) NOT NULL,
  `scene_location` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scenes`
--

INSERT INTO `scenes` (`scene_id`, `scene_location`) VALUES
(1, 'Nord'),
(2, 'Est'),
(3, 'Sud'),
(4, 'Ouest');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(120) NOT NULL,
  `users_email` varchar(130) NOT NULL,
  `users_psw` varchar(250) NOT NULL,
  `users_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artistes`
--
ALTER TABLE `artistes`
  ADD PRIMARY KEY (`artistes_id`);

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD PRIMARY KEY (`billet_id`) USING BTREE,
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_concert` (`id_concert`);

--
-- Index pour la table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`concert_id`),
  ADD KEY `id_artistes` (`id_artistes`),
  ADD KEY `id_scene` (`id_scene`);

--
-- Index pour la table `scenes`
--
ALTER TABLE `scenes`
  ADD PRIMARY KEY (`scene_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email` (`users_email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artistes`
--
ALTER TABLE `artistes`
  MODIFY `artistes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `billet_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `scenes`
--
ALTER TABLE `scenes`
  MODIFY `scene_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `billets_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `billets_ibfk_2` FOREIGN KEY (`id_concert`) REFERENCES `concerts` (`concert_id`);

--
-- Contraintes pour la table `concerts`
--
ALTER TABLE `concerts`
  ADD CONSTRAINT `concerts_ibfk_1` FOREIGN KEY (`id_artistes`) REFERENCES `artistes` (`artistes_id`),
  ADD CONSTRAINT `concerts_ibfk_2` FOREIGN KEY (`id_scene`) REFERENCES `scenes` (`scene_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
