<?php
include("config/connect.php");
$id = null;
$stagiaire = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
  $id = $_GET["id"];

  $sql = "SELECT * FROM stagiaire WHERE idStagiaire = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  $stagiaire = $stmt->fetch();

  if (!$stagiaire) {
      echo "stagiaire non trouvée.";
      exit();
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['date'];
    $filiere = $_POST['filiere'];
    
    $sql = "UPDATE stagiaire SET nom = ?, prenom = ?,  dateNaissance = ?, idFiliere = ? WHERE idStagiaire = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $dateNaissance, $filiere, $id]);
    header("Location: espaceprivee.php");  
    exit();  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
  <title>Ajouter</title>
</head>

<body>
  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
  <i class="bi bi-arrow-left"></i><a href="Espaceprivee.php">Retour</a><br>
    <h3>Modifier un stagiare</h3><br>
    <input type="hidden" name="id" value="<?= $id; ?>"> 
    <label for="">NOM:</label><br>
    <input type="text" id="nom" name="nom" value="<?= $stagiaire['nom']; ?>"><br>
    <label for="prenom">PRENOM:</label><br>
    <input type="text" id="prenom" name="prenom" value="<?= $stagiaire['prenom']; ?>"><br>
    <label for="date">DATE DE NAISSANCE:</label><br>
    <input type="date" id="date" name="date" value="<?= $stagiaire['dateNaissance']; ?>"><br>
    <select name="filiere" id="filiere">
      <option value="<?= $stagiaire['idFiliere']; ?>"><?= $stagiaire['idFiliere'] ?></option>
      <option disabled>choisissez une filiere</option>
      <option value="DD">Developpement digital</option>
      <option value="INFO">Infographie</option>
      <option value="AI">Automatisation industrielle</option>
      <option value="F">Finance</option>
  </select>

    <button type="submit" name="modifier">update</button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>