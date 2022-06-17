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
    <form id="registerform" action="php/register.php" method="post">
      <label for="username">Volledige naam:</label>
      <input class="textbox" type="text" name="naam" required>

      <label for="username">Email:</label>
      <input class="textbox" type="email" name="email" required>

      <label for="password"> Wachtwoord:</label>
      <input class="textbox" id="pass1" type="password" name="password" required>

      <label for="password"> Wachtwoord herhalen:</label>
      <input class="textbox" id="pass2" type="password" name="password-repeat" required>

      <input class="form-button" id="reg" type="submit" name="register" value="Registreren"/>
      <a href="login.php">Inloggen</a>
    </form>
  </main>


  <!-- Scripts -->
  <script src="js/main.js"></script>
  <script src="js/validateForm.js"></script>
</body>

</html>