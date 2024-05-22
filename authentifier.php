<?php
include("config/connect.php");
$login = $password = '';
$loginErr = $passwordErr = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['login'])) {
    $loginErr = 'Please provide a valid login';
  } else {
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
  }

  if (empty($_POST['password'])) {
    $passwordErr = 'Please provide a valid password';
  } else {
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($loginErr) && empty($passwordErr)) {
    try {
      $sql = $pdo->prepare("SELECT * FROM compteadministrateur WHERE loginAdmin = ?");
      $sql->execute([$login]);
      $user = $sql->fetch();
      if ($user && $user["motPasse"] == $password) {
        session_start();
        $_SESSION['nom'] = $user['nom'];
        header('location: espaceprivee.php');
      } else {
        echo '<div class="alert alert-danger">Invalid login or password.</div>';
      }
    } catch (PDOException $e) {
      echo 'error :' . $e->getMessage();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
  <link rel="stylesheet" href="style.css" />
  <title>Login Page</title>
</head>

<body>
  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <div class="head"></div>
    <h3>Login Page</h3>
    <label for="login">Login</label>
    <input type="text" class="<?= $loginErr ? 'is-invalid' : ''; ?>" id="login" name="login" value="<?= $login; ?>"> <br>
    <div class="invalid-feedback"> <?= $loginErr ?></div>
    <label for="password">Mote de passe</label>
    <input type="password" class="<?= $passwordErr ? 'is-invalid' : ''; ?> " id="password" name="password" value="<?= $password; ?>"> <br>
    <div class="invalid-feedback"> <?= $passwordErr ?></div>
    <button type="submit">S'authentifier</button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>