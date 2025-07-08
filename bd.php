<?php
// Connexion à la base de données en utilisant PDO
$host = 'localhost';
$db = 'bloc_estm';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Echec de la connexion à la base de données: " . $e->getMessage();
}

// Création de la base de données si elle n'existe pas déjà
try {
    $requete = "CREATE DATABASE IF NOT EXISTS $db";
    $pdo->exec($requete);
    $requete = "USE $db";
    $pdo->exec($requete);


    // Création de la table utilisateur si elle n'existe pas déjà Utilisateur(id, prenom, nom, nom_utilisateur, mot_de_passe)
    $requete = "CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($requete);

    // Création de la table tache si elle n'existe pas déjà Tache(id, titre, description, date_debut, date_fin, statut, id_utilisateur)
    $requete = "CREATE TABLE IF NOT EXISTS  sujets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    contenu TEXT NOT NULL,
    auteur_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES etudiants(id)
    )";

$pdo ->exec("CREATE TABLE IF NOT EXISTS commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    auteur_id INT NOT NULL,
    sujet_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES etudiants(id),
    FOREIGN KEY (sujet_id) REFERENCES sujets(id)
    )");
    $pdo->exec($requete);
} catch (PDOException $e) {
    echo "Error creating database or tables: " . $e->getMessage();
}