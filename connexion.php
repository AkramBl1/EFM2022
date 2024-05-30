<?php 
include("createdb.php");
$dsn = "mysql:host=localhost;dbname=gestionstagiaire_v1";
$user = "root";
$password = "akram123";

try{
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "error". $e->getMessage();
}