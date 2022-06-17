<?php
session_start();
include_once("connect.php");
unset($_SESSION['userinfo']);

if(!isset($_POST['login'])) {
  header("Location: ../login.php");
}

$sql = "SELECT * FROM gebruikers WHERE email = :email";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":email", $_POST['email']);
$stmt -> execute();
$result = $stmt -> fetchAll();

if(count($result) == 0) {
  header("Location: ../login.php?error=email");
} else {
  foreach($result as $res) {
    if($_POST['password'] == $res['wachtwoord']) {
      $_SESSION["userinfo"]['gebruikerID'] = $res['gebruikerID'];
      $_SESSION["userinfo"]['naam'] = $res['naam'];
      $_SESSION["userinfo"]['admin'] = $res['admin'];
      break;
    }
  }
  
  if(!isset($_SESSION['userinfo'])) {
    header("Location: ../login.php?error=password");
  } else {
    if($_SESSION['userinfo']['admin'] == 1) {
      header("Location: ../admin.php");
    } 
    else {
      header("Location: ../index.php");
    }
  }
}


?>