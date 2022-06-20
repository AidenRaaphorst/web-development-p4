<?php
session_start();
include_once("connect.php");

if(!isset($_POST['register'])) {
  header("Location: ../register.php");
}

$sql = "INSERT INTO gebruikers (naam, email, wachtwoord)
        VALUES(:naam, :email, :wachtwoord)";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":naam", $_POST["naam"]);
$stmt -> bindParam(":email", $_POST["email"]);
$stmt -> bindParam(":wachtwoord", $_POST["password"]);
$stmt -> execute();

$sql = "SELECT * FROM gebruikers WHERE email = :email";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":email", $_POST["email"]);
$stmt -> execute();
$result = $stmt -> fetchAll();

foreach($result as $res) {
  $_SESSION["userinfo"] = $res;
  break;
}

var_dump($_SESSION);

header("Location: ../index.php")
?>