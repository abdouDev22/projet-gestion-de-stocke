```SQL
-- Création de la base de données  
CREATE DATABASE gestion_stock;  
  
-- Sélection de la base de données  
USE gestion_stock;  

-- Création de la table "Groupes"  
CREATE TABLE Groupes (  
id INT PRIMARY KEY,  
nom VARCHAR(100)  
);  
  
-- Création de la table "Categories"  
CREATE TABLE Categories (  
id INT PRIMARY KEY,  
nom VARCHAR(100),  
groupe_id INT,  
FOREIGN KEY (groupe_id) REFERENCES Groupes(id)  
); 

-- Création de la table "Produits"  
CREATE TABLE Produits (  
id INT PRIMARY KEY, 
categories_id INT,
nom VARCHAR(100),  
quantite INT,  
prix DECIMAL(10, 2),  
date_ajout DATE,  
mode_vente ENUM('Cash', 'Emprunt'),
FOREIGN KEY (categories_id) REFERENCES Categories(id)  
);   

-- Création de la table "Roles utilisateur"  
CREATE TABLE Roles_utilisateur (  
id INT PRIMARY KEY,  
nom VARCHAR(100)  
);  
  
-- Création de la table "Utilisateurs"  
CREATE TABLE Utilisateurs (  
id INT PRIMARY KEY,  
nomcomplet VARCHAR(100),
username Varchar(100),
password Varchar(50),
adresse VARCHAR(200),  
telephone VARCHAR(20),  
role_id_utilisateur INT,  
FOREIGN KEY (role_id_utilisateur) REFERENCES Roles(id)  
);  

-- Création de la table "Clients"  
CREATE TABLE Clients (  
id INT PRIMARY KEY,  
nom VARCHAR(100),  
adresse VARCHAR(200),  
telephone VARCHAR(20),
type_client VARCHAR(50),
);  
  
-- Création de la table "UnitesVente"  
CREATE TABLE UnitesVente (  
id INT PRIMARY KEY,  
nom VARCHAR(100)  
);  
  
-- Création de la table de liaison "Produits_UnitesVente"  
CREATE TABLE Produits_UnitesVente (  
produit_id INT,  
unitevente_id INT,  
PRIMARY KEY (produit_id, unitevente_id),  
FOREIGN KEY (produit_id) REFERENCES Produits(id),  
FOREIGN KEY (unitevente_id) REFERENCES UnitesVente(id)  
);  
  
-- Création de la table "Emprunts"  
CREATE TABLE Emprunts (  
id INT PRIMARY KEY,  
produit_id INT,  
client_id INT,  
vendeur_id INT,  
date_emprunt DATE,  
FOREIGN KEY (produit_id) REFERENCES Produits(id),  
FOREIGN KEY (client_id) REFERENCES Clients(id),  
FOREIGN KEY (vendeur_id) REFERENCES Utilisateurs(id)  
);

-- Création de la table "Ventes"  
CREATE TABLE Ventes (  
id INT PRIMARY KEY,  
client_id INT,  
vendeur_id INT,  
prix_total DECIMAL(10, 2),  
date_vente DATE,  
FOREIGN KEY (client_id) REFERENCES Clients(id),  
FOREIGN KEY (vendeur_id) REFERENCES Utilisateurs(id)  
);  
  
-- Création de la table de liaison "Ventes_Produits"  
CREATE TABLE Ventes_Produits (  
vente_id INT,  
produit_id INT,  
quantite INT,  
prix_vente DECIMAL(10, 2),
PRIMARY KEY (vente_id, produit_id),  
FOREIGN KEY (vente_id) REFERENCES Ventes(id),  
FOREIGN KEY (produit_id) REFERENCES Produits(id)  
);

CREATE TABLE Achats (
  id INT PRIMARY KEY,
  commande_id INT,
  Nom_vendeur VARCHAR(100),
  date_achat DATE,
  prix_achat DECIMAL(10, 2)
);
CREATE TABLE Achats_Produits ( 
achat_id INT, 
produit_id INT, 
quantité INT,
PRIMARY KEY (achat_id, produit_id), 
FOREIGN KEY (achat_id) REFERENCES Achats(id), 
FOREIGN KEY (produit_id) REFERENCES Produits(id) 
);

```