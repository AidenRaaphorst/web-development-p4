<?php

session_start();
unset($_SESSION['userinfo']);
header("Location: ../index.php");

?>