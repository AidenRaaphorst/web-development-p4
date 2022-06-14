<?php
session_start();
include_once("connect.php");

if(!isset($_POST['login'])) {
  header("Location: ../index.php");
}

$sql = "SELECT * FROM gebruikers WHERE email = :email";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":email", $_POST["email"]);
$stmt -> execute();
$result = $stmt -> fetchAll();

foreach($result as $res) {
  if($_POST["password"] == $res["wachtwoord"]) {
    $_SESSION["userinfo"] = $res;
    break;
  }
}

header("Location: ../index.php");
?>