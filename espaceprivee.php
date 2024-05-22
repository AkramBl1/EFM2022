
<?php 
session_start();
if (empty($_SESSION['nom'])) {
  die('Error 404');
}

include("config/connect.php");
$sql = 'SELECT * FROM stagiaire';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>stagiaires</title>
</head>

<body>
    <h3>
    <?php 
    $houre = date('H');
    if ($houre >= 6 && $houre < 18) {
        echo "Bonjour ";
    } else {
        echo "Bonsoir ";
    }
    
      if (isset($_SESSION['nom'])) {
        echo $_SESSION['nom'];
      }
    ?>
    </h3><br>
    <button><a href="InsererStagiaire.php">Inserer</a></button>
    <button><a href="logout.php">Se Deconnecter</a></button>
    <?php if (empty($users)): ?>
      <p class="lead mt-3">Aucun stagiaire</p>
    <?php endif;  ?>
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
      <td><a href="ModifierStagiaire.php?id=<?= $user['idStagiaire'] ?>"><i class="bi bi-pencil"></i></i></a></td>
      <td>
      <a href="SupprimerStagiaire.php?id=<?php echo $user['idStagiaire']; ?>" onclick="return confirm('are you sure?')"><i class="bi bi-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>