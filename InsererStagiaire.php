<?php
include ("connexion.php");
$sql = $pdo->prepare("SELECT * FROM filiere");
$sql->execute();
$filiers = $sql->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date =  $_POST["date"];;
    $filiere =  $_POST["filiere"];

    $file_name = $_FILES['pic']['name'];
    $file_tmp = $_FILES['pic']['tmp_name'];
    $target = "images/$file_name";
    move_uploaded_file($file_tmp, $target);

    $sql = $pdo->prepare("INSERT INTO stagiaire (nom, prenom, dateNaissance, photoProfil, idFiliere)
    VALUES (?, ?, ?, ?, ?)");
    $sql->execute([$nom, $prenom, $date, $file_name , $filiere]);
    header("Location: espaceprivee.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
  <a href="Espaceprivee.php">Retour</a><br>
    <h3>Ajouter un stagiare</h3><br>
    <label for="">NOM:</label><br>
    <input type="text" name="nom" ><br>
    <label for="prenom">PRENOM:</label><br>
    <input type="text" name="prenom"><br>
    <label for="date">DATE DE NAISSANCE:</label><br>
    <input type="date" name="date" ><br>
    <label for="PdP">PHOTO DE PROFIL:</label><br>
    <input type="file" name="pic"><br>
    <select name="filiere">
      <option disabled>choisissez une filiere</option>
      <?php foreach ($filiers as $filier): ;?>
        <option value="<?= $filier['idFiliere'] ?>"><?= $filier['intitule'] ?></option>
      <?php endforeach ; ?>
    </select>
    <button type="submit">Login</button>
  </form>
</body>
</html>