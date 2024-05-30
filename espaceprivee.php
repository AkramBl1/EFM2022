<?php
include("connexion.php");
session_start();
if (empty($_SESSION["nom"]) && empty($_SESSION["prenom"]) ){
    die("error404");
}

$sql = $pdo->prepare("SELECT * FROM stagiaire");
$sql->execute();
$users = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
</head>
<body>

<?php
$houre = date("H");
if ($houre >= 6 && $houre < 18) {
    echo "bonjour ";
} else {
    echo "bonsoir ";
}

if (isset($_SESSION["nom"]) && isset($_SESSION['prenom'])) {
    echo $_SESSION['nom'] .' ' . $_SESSION["prenom"];
}
?>

<button><a href="InsererStagiaire.php">Inserer</a></button>
<button><a href="logout.php">Se Deconnecter</a></button>
<table class="table table-striped">
  <thead>
    <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Date de naissance</th>
    <th>Photo de profile</th>
    <th>Filiere</th>
    <th>Modifier</th>
    <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user): ?>
    <tr>
      <td><?= $user['nom']; ?></td>
      <td><?= $user['prenom']; ?></td>
      <td><?= $user['dateNaissance']; ?></td>
      <td><img style="width: 40px;" src="images/<?= $user['photoProfil'];?>"></td>
      <td><?= $user['idFiliere'] ?></td>
      <td><a href="ModifierStagiaire.php?id=<?= $user['idStagiaire'] ?>">Modifier</a></td>
      <td>
      <a href="SupprimerStagiaire.php?id=<?= $user['idStagiaire']; ?>" onclick="return confirm('are you sure?')">Supprimer</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>