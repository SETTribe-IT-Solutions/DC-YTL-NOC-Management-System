<?php
session_start();
$role = $_SESSION['role'];
unset($_SESSION['name']);
unset($_SESSION['userId']);
unset($_SESSION['designation']);
unset($_SESSION['role']);
session_destroy();
header("location:login.php");

?>