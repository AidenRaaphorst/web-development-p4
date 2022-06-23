<?php
session_start();
include_once("connect.php");
unset($_SESSION['userinfo']);

if(!isset($_POST['resetten'])) {
  header("Location: ../resetwachtwoord.php");
}

$sql = "SELECT * FROM gebruikers WHERE email = :email";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":email", $_POST['email']);
$stmt -> execute();
$result = $stmt -> fetchAll();

var_dump($_POST);

if(count($result) == 0) {
  header("Location: ../resetwachtwoord.php?error=email");
} else {
  $sql = "UPDATE gebruikers
          SET wachtwoord = :wachtwoord
          WHERE email = :email";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":wachtwoord", $_POST['password']);
  $stmt -> bindParam(":email", $_POST['email']);
  $stmt -> execute();

  $sql = "SELECT * FROM gebruikers WHERE email = :email AND wachtwoord = :wachtwoord";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":email", $_POST['email']);
  $stmt -> bindParam(":wachtwoord", $_POST['password']);
  $stmt -> execute();
  $result = $stmt -> fetch();

  $_SESSION["userinfo"]['gebruikerID'] = $result['gebruikerID'];
  $_SESSION["userinfo"]['naam'] = $result['naam'];
  $_SESSION["userinfo"]['admin'] = $result['admin'];
  
  if($_SESSION['userinfo']['admin'] == 1) {
    header("Location: ../admin.php");
  }
  else {
    header("Location: ../index.php");
  }
}


?>