-- Active: 1702963882706@@127.0.0.1@3306
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 juin 2024 à 18:50
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
-- Base de données : `stockage1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `id_Groupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `id_Groupe`) VALUES
(1, 'AEAEA', 1),
(2, 'S', 1),
(3, 'TOYOTA', 1),
(4, 'Basto', 1),
(5, 'Baris', 1),
(6, 'cahier', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_fourniseur`
--

CREATE TABLE `client_fourniseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `Type` enum('client','fournisseur') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client_fourniseur`
--

INSERT INTO `client_fourniseur` (`id`, `nom`, `adresse`, `telephone`, `Type`) VALUES
(3, 'sahal', 'cite hodane', 77110022, 'client'),
(4, 'Jameowayne', 'Hargeysa', 26262, 'fournisseur');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `date_commande` varchar(255) DEFAULT NULL,
  `quantite_totale_commande` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_Client_Fourniseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `date_commande`, `quantite_totale_commande`, `id_utilisateur`, `id_Client_Fourniseur`) VALUES
(1, '2024-01-30', 20, 1, 3),
(2, '2024-01-30', -40, 1, 3),
(3, '2024-01-30', 200, 1, 4),
(4, '2024-01-30', 100, 1, 4),
(5, '2024-01-30', 0, 1, 3),
(6, '2024-01-31', 10, 1, 3),
(7, '2024-01-31', 0, 1, 3),
(8, '2024-01-31', 0, 1, 3),
(9, '2024-01-31', 20, 1, 4),
(10, '2024-02-02', 0, 1, 3),
(11, '2024-02-21', 300, 2, 4),
(12, '2024-06-13', 400, 2, 4),
(13, '2024-06-13', 200, 2, 3),
(14, '2024-06-22', 4000, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`) VALUES
(1, 'SDSDS');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `date_Ajout` date DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `Id_UnitesVente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `quantite`, `date_Ajout`, `prix`, `id_categorie`, `Id_UnitesVente`) VALUES
(1, 'MOUSS', 20, '2024-01-30', 10, 1, 1),
(2, 'pices1', 9, '2024-02-02', 300, 1, 1),
(3, 'pices de moussa pk 12 test', 6, '2024-06-13', 200, 1, 2),
(4, 'fefe', 1, '2024-06-22', 2000, 1, 2),
(5, 'basto', 10, '2024-06-22', 1800, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produits_commande`
--

CREATE TABLE `produits_commande` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_unitaire` int(11) DEFAULT NULL,
  `prix_total` int(11) DEFAULT NULL,
  `Statut_transaction` enum('vendre','Emprunter','achat') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits_commande`
--

INSERT INTO `produits_commande` (`id_produit`, `id_commande`, `quantite`, `prix_unitaire`, `prix_total`, `Statut_transaction`) VALUES
(1, 1, 2, 10, 20, 'vendre'),
(1, 2, 2, 10, 20, 'vendre'),
(1, 3, 20, 10, 200, 'vendre'),
(1, 4, 10, 10, 100, 'vendre'),
(1, 5, 10, 10, 100, 'vendre'),
(1, 6, 1, 10, 10, 'vendre'),
(1, 7, 2, 100, 200, 'vendre'),
(1, 8, 1, 10, 10, 'vendre'),
(1, 9, 2, 10, 20, 'vendre'),
(1, 10, 2, 10, 20, 'vendre'),
(2, 10, 2, 300, 600, 'vendre'),
(2, 11, 1, 300, 300, 'achat'),
(3, 12, 2, 200, 400, 'achat'),
(3, 13, 1, 200, 200, 'Emprunter'),
(4, 14, 2, 2000, 4000, 'vendre');

-- --------------------------------------------------------

--
-- Structure de la table `roles_utilisateur`
--

CREATE TABLE `roles_utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles_utilisateur`
--

INSERT INTO `roles_utilisateur` (`id`, `nom`) VALUES
(1, 'Admin'),
(2, 'Default');

-- --------------------------------------------------------

--
-- Structure de la table `unitesvente`
--

CREATE TABLE `unitesvente` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `unitesvente`
--

INSERT INTO `unitesvente` (`id`, `nom`) VALUES
(1, 'ARRE'),
(2, 'KG'),
(3, 'boite'),
(4, 'metre');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nomcomplet` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `post` varchar(50) DEFAULT NULL,
  `date_naissance` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `id_role_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nomcomplet`, `username`, `password`, `adresse`, `email`, `post`, `date_naissance`, `telephone`, `id_role_utilisateur`) VALUES
(1, 'Abou', 'Admine', 'Admin', 'Cite hodane ', 'abdou@gmail.com', 'info', ' 2002/02/01', '77110022', 2),
(2, 'MOUSSA', 'Admin', 'Admin', 'Balbala  ', 'abdillahiabdourahman65@gmail.com', 'informatique', '  2002-01-03', '7711002 ', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Groupe` (`id_Groupe`);

--
-- Index pour la table `client_fourniseur`
--
ALTER TABLE `client_fourniseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_client_fournisseur` (`id_Client_Fourniseur`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `Id_UnitesVente` (`Id_UnitesVente`);

--
-- Index pour la table `produits_commande`
--
ALTER TABLE `produits_commande`
  ADD PRIMARY KEY (`id_produit`,`id_commande`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `roles_utilisateur`
--
ALTER TABLE `roles_utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unitesvente`
--
ALTER TABLE `unitesvente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `client_fourniseur`
--
ALTER TABLE `client_fourniseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produits_commande`
--
ALTER TABLE `produits_commande`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles_utilisateur`
--
ALTER TABLE `roles_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `unitesvente`
--
ALTER TABLE `unitesvente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`id_Groupe`) REFERENCES `groupes` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_Client_Fourniseur`) REFERENCES `client_fourniseur` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`Id_UnitesVente`) REFERENCES `unitesvente` (`id`);

--
-- Contraintes pour la table `produits_commande`
--
ALTER TABLE `produits_commande`
  ADD CONSTRAINT `produits_commande_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `produits_commande_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_role_utilisateur`) REFERENCES `roles_utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
