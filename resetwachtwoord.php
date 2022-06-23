<?php
include_once("php/connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ria's</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/nav-foot.css">
  <link rel="stylesheet" href="css/login-reg.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>

<body id="loginbody">
  <!-- Navbar -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- Main -->
  <main class="flex">
    <form id="loginform" action="php/resetwachtwoord.php" method="post">
      <?php
        if(isset($_GET['error'])) {
          if($_GET['error'] == "email") { ?>
            <b id="error">Email kan niet gevonden worden.</b>
          <?php }
        }
      ?>

      <label for="email">Email:</label>
      <input class="textbox" type="email" name="email" required>

      <label for="password"> Nieuw wachtwoord:</label>
      <input id="pass1" class="textbox" type="password" name="password" required>
      
      <label for="password"> Nieuw wachtwoord herhalen:</label>
      <input id="pass2" class="textbox" type="password" name="password-repeat" required>

      <input class="form-button" type="submit" name="resetten" value="Resetten"/>
      <a href="registreer.php">Inloggen</a>
      <a href="registreer.php">Registreren</a>
    </form>
  </main>

  <!-- Scripts -->
  <script src="js/main.js"></script>
  <script src="js/validateForm.js"></script>
</body>

</html>