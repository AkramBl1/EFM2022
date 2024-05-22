<?php
$user = "root";
$password = "akram123";
$dsn = "mysql:host=localhost";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS gestionstagiaire_v1;")->execute();
    $stmt = $pdo->prepare("USE gestionstagiaire_v1 ;")->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS compteadministrateur (
        loginAdmin VARCHAR(10) PRIMARY KEY ,
        motPasse VARCHAR(10) NOT NULL,
        nom VARCHAR(20) NOT NULL,
        prenom VARCHAR(20) NOT NULL
    );")->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS filiere (
        idFiliere VARCHAR(5) PRIMARY KEY ,
        intitule VARCHAR(20) NOT NULL,
        nombreGroupe int(11) DEFAULT 20
    );")->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS stagiaire (
        idStagiaire int(11) PRIMARY KEY AUTO_INCREMENT,
        nom VARCHAR(20) NOT NULL,
        prenom VARCHAR(20) NOT NULL,
        dateNaissance DATE,
        photoProfil TEXT ,
        idFiliere VARCHAR(5) ,
        FOREIGN KEY(idFiliere) REFERENCES filiere(idFiliere)
    );")->execute();
    // echo 'create done !';

} catch (PDOException $e) {
    echo "Error ". $e->getMessage();
}