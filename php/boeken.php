<?php
session_start();
include_once("connect.php");

var_dump($_GET);

if(!isset($_SESSION['userinfo'])) {
    header("Location: ../login.php");
}

$sql = "INSERT INTO boekingen (gebruikerID, reisID) 
        VALUES(:gebruikerID, :reisID)";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":gebruikerID", $_SESSION['userinfo']["gebruikerID"]);
$stmt -> bindParam(":reisID", $_GET["reisID"]);
$stmt -> execute();

header("Location: ../index.php");
?>