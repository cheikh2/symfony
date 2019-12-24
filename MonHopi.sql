-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 24 Décembre 2019 à 08:17
-- Version du serveur :  5.7.28-0ubuntu0.18.04.4
-- Version de PHP :  7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `MonHopi`
--

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `medecin`
--

INSERT INTO `medecin` (`id`, `service_id`, `matricule`, `prenom`, `nom`, `telephone`, `date`) VALUES
(8, 2, 'MPE00001', 'Siaka', 'Samate', '778896542', '1997-11-04'),
(9, 1, 'MOP00009', 'DAM', 'Diagne', '775469834', '2019-12-03'),
(21, 2, 'MDE00010', 'Doudou', 'Mbow', '778896548', '2019-12-17');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191201115821', '2019-12-01 11:58:47'),
('20191201122726', '2019-12-01 12:27:52'),
('20191201124829', '2019-12-01 12:48:39'),
('20191201125022', '2019-12-01 12:50:33'),
('20191203003429', '2019-12-03 00:34:47'),
('20191203004828', '2019-12-03 00:48:43'),
('20191206194810', '2019-12-06 19:49:04'),
('20191207223859', '2019-12-07 22:39:23');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `libelle`) VALUES
(1, 'Cardiologie'),
(2, 'Dermatologie'),
(4, 'Oncologie'),
(5, 'Odontologie'),
(6, 'Chirurgie');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `specialite`
--

INSERT INTO `specialite` (`id`, `service_id`, `name`) VALUES
(1, 1, 'Rythmologie'),
(2, 1, 'Angiologie'),
(3, 1, 'Cardiolodie_Pediatrique'),
(4, 1, 'Phlebologie'),
(5, 2, 'Dermatologie_Esthetique'),
(6, 2, 'Dermatopathologie'),
(7, 2, 'Immunodermatologie'),
(8, 2, 'Chirurgie de Mohs'),
(9, 2, 'Dermatologie Pediatrique'),
(10, 4, 'Oncologie Pediatrique'),
(11, 4, 'Oncologie Gynecologique'),
(12, 4, 'Oncologie Chirurgicale'),
(13, 4, 'Oncologie Medicale'),
(14, 4, 'Oncologie De Radiotherapie'),
(15, 5, 'Odontologie Pediatrique'),
(16, 5, 'Odontologie Stomalogie'),
(17, 5, 'Odontologie Sportive'),
(18, 6, 'Chirurgie Vasculaire'),
(19, 6, 'Chirurgie Infantile'),
(20, 6, 'Chirurgie Digestive'),
(21, 6, 'Chirurgie Esthetique'),
(22, 6, 'Chirurgie Ophtalmologique');

-- --------------------------------------------------------

--
-- Structure de la table `specialite_medecin`
--

CREATE TABLE `specialite_medecin` (
  `specialite_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `specialite_medecin`
--

INSERT INTO `specialite_medecin` (`specialite_id`, `medecin_id`) VALUES
(1, 21),
(3, 21);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1BDA53C6ED5CA9E6` (`service_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E7D6FCC1ED5CA9E6` (`service_id`);

--
-- Index pour la table `specialite_medecin`
--
ALTER TABLE `specialite_medecin`
  ADD PRIMARY KEY (`specialite_id`,`medecin_id`),
  ADD KEY `IDX_24D341422195E0F0` (`specialite_id`),
  ADD KEY `IDX_24D341424F31A84` (`medecin_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `FK_1BDA53C6ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD CONSTRAINT `FK_E7D6FCC1ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `specialite_medecin`
--
ALTER TABLE `specialite_medecin`
  ADD CONSTRAINT `FK_24D341422195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_24D341424F31A84` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
