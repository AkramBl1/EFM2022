<?php 
include("connexion.php");
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"]) || empty($_POST['password'])) {
        $error = "les données d'authentification sont obligatoires";
    } else {
        $login = $_POST["login"];
        $password = $_POST["password"];
    }
    if(empty($error)){
        $sql = $pdo->prepare("SELECT * FROM compteadministrateur WHERE loginAdmin = ? AND motPasse = ?");
        $sql->execute([$login, $password]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if($user){
            session_start();
            $_SESSION["nom"] = $user["nom"];
            $_SESSION["prenom"] = $user["prenom"];
            header("Location: espaceprivee.php");
        } else{
            $error .= "<br>  les données d'authentification sont incorrects. ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $error; ?>
    <form action="" method="POST">
        <label for="login">login:</label><br>
        <input type="text" name="login" ><br>
        <label for="password">password:</label><br>
        <input type="password" name="password" ><br>
        <input type="submit" value="submit">
    </form>

    </body>
</html>