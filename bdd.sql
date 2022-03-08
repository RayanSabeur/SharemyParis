-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 18 juin 2021 à 11:25
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `sharemyparis`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `titre`, `description`, `image`, `adresse`, `type`, `public`, `user_id`) VALUES
(2, 'paris', 'test', '577986-visuel-paris-velo-quai-2.jpg', 'esrzsrzrez', 'claudia', 'sdfsdfsdfsd', 15),
(19, 'Visite des catacombe de Paris', 'Une visite tres speciale nous attend dans les catacombe de paris ! venez seul ou a plusieurs explorer ces vestige de notre magnifique ville :)', '60c9b773df09a.jpg', '1 Avenue du Colonel Henri Rol-Tanguy, 75014 Paris', 'culture-art', 'groupe', 16),
(22, 'DSFSDFDSF', 'DFDSFDS', '60cc527f274dd.jpg', 'DSFDSF', '1', 'SDFDSFDS', 16),
(23, 'sdsqdsq', 'dqsdsqsq', '60cc52db82b4a.png', 'qsdqsd', '', 'sqdsqdqs', 23);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activites_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210611113459', '2021-06-11 11:35:42', 67),
('DoctrineMigrations\\Version20210611114203', '2021-06-11 11:42:21', 79),
('DoctrineMigrations\\Version20210611121206', '2021-06-11 12:12:26', 129),
('DoctrineMigrations\\Version20210611130945', '2021-06-11 13:10:05', 76),
('DoctrineMigrations\\Version20210611134420', '2021-06-11 13:44:41', 72),
('DoctrineMigrations\\Version20210611135439', '2021-06-11 13:55:24', 64),
('DoctrineMigrations\\Version20210614094820', '2021-06-14 09:48:45', 149),
('DoctrineMigrations\\Version20210615075839', '2021-06-15 07:59:06', 154),
('DoctrineMigrations\\Version20210615080204', '2021-06-15 08:02:46', 89);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `image`, `description`) VALUES
(1, 'test44@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NOv8Wd1WKhpJPXpu+sNM1A$Ub7FNm3I8vhigWUfQ6aA4Jatz4WcjWT5N0bkbQ17jI0', 'ghdfghdf', 'gdfgdfgf', NULL, NULL),
(15, 'pedro@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$OW06EPdrSMfQBvKaccdiyw$9wNlqWk5+yvSBQCh8eKB6vm7gFdc4nXOjU3ZNBreKYg', 'De la vega', 'Pedro', '60c9af95b7127.png', 'Hola !\r\n\r\nJe suis un jeune espagnol qui a fait ses études à travers le monde et a vécu dans beaucoup de pays.la plupart de mes amis rencontrés en auberge de jeunesse, vivent aux 4 coins du monde et il aime leur rendre visite régulièrement., j\'aime également découvrir de nouveaux territoires, et voyager en solo pour me faire de nouveaux amis.'),
(16, 'camille@gmail.com', '[]', '$2y$13$GIh8SA.fDBFwaGwgcnrK5.TXv7lvS1wSNUh5Tdr/I5hw.AilK9JAm', 'Sollier', 'Camille', '60c9b02a2c8c9.png', 'je suis née et a grandi dans le Sud de la France, où elle vit désormais avec son mari et où elle exerce le métier d\'institutrice, tout comme son mari. Ils bénéficient des vacances scolaires, durant lesquelles ils aiment vadrouiller, et découvrir la France et le monde.'),
(17, 'TEST7@gmail.com', '[\"ROLE_GUIDE\"]', '$argon2id$v=19$m=65536,t=4,p=1$bvNgz+MWr9t0lXp4rMFrYQ$MiSmEQvLUySDSGkoRNrXu7hQ2ckIRUMUclgvSw6P/Cc', 'dsfdsf', 'dsfsdf', '60ca0d8644c7b.jpg', 'zerfzf'),
(18, 'test5@gmail.com', '[]', '$2y$13$ITAXwGemTwG9Ll.C1K.zj.R0ATSdD7aWTO8Dh5AXEBzW0uaB7j.qa', 'mdrrr', 'tkt', '60ca0ebb9c76e.png', 'rarzeaaz'),
(19, 'test58', '[\"ROLE_GUIDE\"]', '$argon2id$v=19$m=65536,t=4,p=1$/AV3ftmpczzxpbebdtJ2Pg$mjcTp7kCfIQv8xq/QzxdqG5aGmSLj9ZcyUxg7rVxChY', 'ezrer', 'ezrezr', '60ca0fa649dff.png', 'rezrzer'),
(20, 'testy@gmail.com', '[\"ROLE_GUIDE\"]', '$2y$13$q/B5n3ZcbM.w61icqUKjBOeneZgEbssrJ7PUhCe5h5tn.1GuTu9oK', 'sdff', 'dsfsdf', '60ca0fcf47309.jpg', 'dfsdfsd'),
(21, 'testg@gmail.com', '[]', '$2y$13$/T82zD3EH5YkJCfrYmBYyOoxwW80EvjTvLe9ndGVoplEENKpYVc9i', 'qsd', 'qsdsq', '60ca100aa564b.jpg', 'qsdsqsqd'),
(22, 'fsdfdsf', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$7gfm7dtnV8IeBsG4mMajJQ$uxTBTaG/k51SvUtPAbR6fWLFFY0GXsAjBUSaWgY9HJU', 'fdsdsfs', 'dsfdsfds', '60ca104e440c0.jpg', 'fsdfsdfsd'),
(23, 'QSDQSDS@gmail.com', '[]', '$2y$13$rSug3BbtipceuU7b5sfZbOA9zaOS0SR24xsQVXUnGqfo9QFfWuV/W', 'SqqS', 'QsqS', '60cc52c032d29.jpg', 'QsqSQs');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_766B5EB5A76ED395` (`user_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_497DD6345B8C31B7` (`activites_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `FK_766B5EB5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD6345B8C31B7` FOREIGN KEY (`activites_id`) REFERENCES `activites` (`id`);