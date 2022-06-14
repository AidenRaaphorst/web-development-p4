<?php
session_start();
include_once("connect.php");

if(!isset($_POST)) {
    header("Location: ../index.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT * FROM gebruikers WHERE email = :email";
    $stmt = $connect -> prepare($sql);
    $stmt -> bindParam(":email", $_POST["email"]);
    $stmt -> execute();
    $result = $stmt -> fetchAll();

    foreach($result as $res) {
        if($_POST["password"] == $res["password"]) {
            $_SESSION["userinfo"] = $res;
            break;
        }
    }
}

header("Location: ../index.php");
?>