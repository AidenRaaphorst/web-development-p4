<?php include_once("php/connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ria's</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/nav-foot.css">
  <link rel="stylesheet" href="css/login.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>

<body id="loginbody">
  <!-- Navbar -->
  <?php include_once("includes/navbar.php"); ?>

  <!-- Main -->
  <main class="flex">
    <form id="loginform" name="login" action="php/login.php" method="post">
      <label for="username">Email:</label>
      <input class="textbox" type="text" name="email" required>

      <label for="password"> Wachtwoord:</label>
      <input class="textbox" type="password" name="password" required>

      <input class="form-button" type="submit" name="submit" value="Inloggen"/>
      <a href="registreer.php">Registreren</a>
    </form>
  </main>


  <!-- Scripts -->
  <script src="js/main.js"></script>
</body>

</html>