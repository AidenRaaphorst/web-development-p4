<?php
session_start();
include_once("connect.php");

if(!isset($_GET['reisID'])) {
  header("Location: ../index.php");
}

$sql = "SELECT * FROM boekingen WHERE reisID = :reisID AND gebruikerID = :gebruikerID";
$stmt = $connect -> prepare($sql);
$stmt -> bindParam(":reisID", $_GET['reisID']);
$stmt -> bindParam(":gebruikerID", $_SESSION['userinfo']['gebruikerID']);
$stmt -> execute();
$result = $stmt -> fetch();

var_dump($result);

if($result) {
  $sql = "DELETE FROM boekingen WHERE boekingID = :boekingID";
  $stmt = $connect -> prepare($sql);
  $stmt -> bindParam(":boekingID", $result['boekingID']);
  $stmt -> execute();
}

header("Location: ../index.php");

?>