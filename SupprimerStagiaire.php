<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sql = "DELETE FROM stagiaire WHERE idStagiaire = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: espaceprivee.php");
}
?>