<?php
include_once("connect.php");


if(isset($_POST["berichtsubmit"])){  
  $sql = "INSERT INTO contact (naam, email, bericht)
          VALUES (:naam,:email,:bericht)";
  $stmt = $connect->prepare($sql);

  $stmt->bindParam(":naam", $_POST['naam']);
  $stmt->bindParam(":email", $_POST['email']);
  $stmt->bindParam(":bericht", $_POST['bericht']);
  $stmt->execute();
  header('Location: ../index.php');
die;
}

?>