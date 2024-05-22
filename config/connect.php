<?php
include("createdb.php");
$user = "root";
$password = "akram123";
$dsn = "mysql:host=localhost;dbname=gestionstagiaire_v1";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "done";
} catch (PDOException $e) {
    echo "Error " . $e->getMessage();
}
