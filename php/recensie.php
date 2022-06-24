<?php
session_start();
include_once("connect.php");

if(!isset($_POST['recensie']) || !isset($_SESSION['userinfo'])) {
    header("Location: ../reizen.php");
}

$sql = "INSERT INTO recensies (gebruikerID, reisID, bericht, sterren)
        VALUES(:gebruikerID, :reisID, :bericht, :sterren)";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":gebruikerID", $_SESSION['userinfo']["gebruikerID"]);
$stmt -> bindParam(":reisID", $_POST["reisID"]);
$stmt -> bindParam(":bericht", $_POST["bericht"]);
$stmt -> bindParam(":sterren", $_POST["sterren"]);
$stmt -> execute();

header("Location: ../reizen.php");
?>